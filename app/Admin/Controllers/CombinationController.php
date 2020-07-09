<?php

namespace App\Admin\Controllers;

use App\Enums\ItemType;
use App\Enums\PosNeg;
use App\Models\Combination;
use App\Models\Item;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\MessageBag;

class CombinationController extends ResponseController
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
        $grid->items()->pluck('name')->label();
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
        $items = Item::all();
        $items = $items->map(function ($item){
            return [
                'id' => $item->id,
                'name' => $item->name .' : '. PosNeg::getDescription($item->pos_neg),
            ];
        });

        $form->text('name', __('Name'))->creationRules(['required', "unique:combinations"])
            ->updateRules(['required', "unique:combinations,name,{{id}}"]);
        $form->text('show_name', __('Show name'));
        $form->listbox('items', 'Harness')->options($items->pluck('name', 'id'));

        $form->saving(function (Form $form) {
            if (is_null($form->items)) {
                throw new \Exception("必须选择 Harness");
            }

            $items = array_filter($form->items);

            if (count($items) != 2) {
                throw new \Exception("必须选择两个 Harness");
            }

            $items = Item::with('component')->whereIn('id', $items)->get();
            if($items->unique('pos_neg')->count() != 2){
                throw new \Exception("两个 Harness 必须一正一负");
            }
        });

        return $form;
    }

    public function getCombinationList()
    {
        $combination = Combination::select('id', 'name')->get();

        return $this->responseSuccess($combination);
    }
}
