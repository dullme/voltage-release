<?php

namespace App\Admin\Controllers;

use App\Enums\ItemType;
use App\Models\Combination;
use App\Models\Item;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\MessageBag;

class CombinationController extends AdminController
{

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Combination';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Combination());

        $grid->column('name', __('Name'));
        $grid->column('show_name', __('Show name'));
        $grid->column('type', __('Type'))->display(function ($type) {
            return ItemType::getDescription($type);
        })->label();
        $grid->column('created_at', __('Created at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Combination::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('show_name', __('Show name'));
        $show->field('type', __('Type'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Combination());

        $form->text('name', __('Name'))->creationRules(['required', "unique:combinations"])
            ->updateRules(['required', "unique:combinations,name,{{id}}"]);
        $form->text('show_name', __('Show name'));
        $form->radio('type')->options(ItemType::toSelectArray())->required();
        $form->listbox('items', 'Extender')->options(Item::pluck('name', 'id'));

        $form->saving(function (Form $form) {
            if (is_null($form->items)) {
                throw new \Exception("必须选择" . ItemType::getDescription(intval($form->type)));
            }

            $items = array_filter($form->items);

            if (count($items) > 2) {
                throw new \Exception("最多只能选择两个" . ItemType::getDescription(intval($form->type)));
            }

            if (count($items) == 2) {
                $items = Item::with('component')->whereIn('id', $items)->get();
                $items = $items->map(function ($item) {
                    return [
                        'type'   => $item->type,
                        'form'   => $item->form,
                        'length' => $item->component->sum('length')
                    ];
                })->toArray();

                if ($items[0]['type'] != $items[1]['type'] || $items[0]['type'] != $form->type) {
                    throw new \Exception("type 必须一致");
                }

                if ($items[0]['form'] != $items[1]['form'] || $items[0]['length'] != $items[1]['length']) {
                    throw new \Exception("Form 和 length 必须一致");
                }
            }
        });

        return $form;
    }
}
