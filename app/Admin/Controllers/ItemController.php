<?php

namespace App\Admin\Controllers;

use App\Enums\ItemType;
use App\Enums\PosNeg;
use App\Models\Component;
use App\Models\Item;
use App\Models\SolarPanel;
use App\Models\Specification;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ItemController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'item';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Item());

        $grid->column('name', __('Name'));
        $grid->column('type', __('Type'))->display(function ($type){
            return ItemType::getDescription($type);
        });
        $grid->column('pos_neg', __('Pos/Neg'))->display(function ($posNeg){
            return PosNeg::getDescription($posNeg);
        })->label([
            0 => 'danger',
            1 => 'warning',
        ]);
        $grid->specifications()->pluck('name')->label();
        $grid->column('color', __('Color'));
        $grid->column('form', __('Form'));
        $grid->column('created_at', __('Created at'));


        $grid->tags()->pluck('name')->label();

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
        $show = new Show(Item::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('type', __('Type'));
        $show->field('pos_neg', __('Pos neg'));
        $show->field('color', __('Color'));
        $show->field('file', __('File'));
        $show->field('image', __('Image'));
        $show->field('form', __('Form'));
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
        $form = new Form(new Item());

        $form->text('name', __('Name'))->creationRules(['required', "unique:items"])
            ->updateRules(['required', "unique:items,name,{{id}}"]);
        $form->radio('type')->options(ItemType::toSelectArray())->required();
        $form->radio('pos_neg')->options(PosNeg::toSelectArray())->required();
        $form->text('color', __('Color'));
        $form->file('file', __('File'));
        $form->image('image', __('Image'));
        $form->text('form', __('Form'));
        $form->listbox('specifications')->options(Specification::all()->pluck('name', 'id'));
        $form->hasMany('component', 'Component', function (Form\NestedForm $form){
            $form->select('component_id', 'Component')->options(Component::pluck('name', 'id'))->required();
            $form->number('length', 'Length')->min(1)->default(1)->required();
            $form->number('quantity', 'Quantity')->min(1)->default(1)->required();
            $form->switch('driver', 'Driver')->states([
                'on'  => ['value' => 1, 'text' => 'True', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => 'False', 'color' => 'danger'],
            ])->default(0);
            $form->number('tracker', 'Tracker')->min(0);
            $form->currency('multiple', 'Multiple');
        });

        $form->saving(function (Form $form){
            if(is_null($form->component)){
                throw new \Exception('Component 必须添加');
            }
        });


        return $form;
    }
}
