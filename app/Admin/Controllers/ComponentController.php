<?php

namespace App\Admin\Controllers;

use App\Enums\PartType;
use App\Models\Component;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ComponentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Component';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Component());

        $grid->column('name', __('Name'));
        $grid->column('part_type', __('Part type'))->display(function ($part_type){
            return PartType::getDescription($part_type);
        })->label();
        $grid->column('price', __('Price'));
        $grid->column('weight', __('Weight/kg'));
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
        $show = new Show(Component::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('part_type', __('Part type'));
        $show->field('price', __('Price'));
        $show->field('weight', __('Weight'));
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
        $form = new Form(new Component());
        $form->text('name', __('Name'))->required();
        $form->select('part_type')->options(PartType::toSelectArray())->required();
//        $form->number('part_type', __('Part type'));
        $form->decimal('price', __('Price'))->required();
        $form->decimal('weight', __('Weight'))->required();

        return $form;
    }
}
