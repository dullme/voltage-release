<?php

namespace App\Admin\Controllers;

use App\Models\Bracket;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BracketController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Bracket';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Bracket());

        $grid->column('name', __('Name'));
        $grid->column('driver', __('Driver'));
        $grid->column('buffer', __('Buffer'));
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
        $show = new Show(Bracket::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('driver', __('Driver'));
        $show->field('buffer', __('Buffer'));
        $show->field('file', __('File'));
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
        $form = new Form(new Bracket());

        $form->text('name', __('Name'))->creationRules(['required', "unique:brackets"])
            ->updateRules(['required', "unique:brackets,name,{{id}}"]);
        $form->number('driver', __('Driver'))->min(1)->rules('required|integer|min:1');
        $form->number('buffer', __('Buffer'))->min(1)->rules('required|integer|min:1');
        $form->file('file', __('File'))->hidePreview()->removable();

        return $form;
    }
}
