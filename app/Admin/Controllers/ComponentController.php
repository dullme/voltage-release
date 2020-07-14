<?php

namespace App\Admin\Controllers;

use App\Enums\PartType;
use App\Models\Component;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
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
        $grid->column('part_type', __('Part type'))->display(function ($part_type) {
            return PartType::getDescription($part_type);
        })->label();
        $grid->column('price', __('Price/RMB'));
        $grid->column('weight', __('Weight/kg'));
        $grid->column('line_number', __('Line Number'))->display(function ($line_number){
            return isset(LINE_NUMBER[$line_number]) ? LINE_NUMBER[$line_number] : '';
        });
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

    public function edit($id, Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($this->form($id)->edit($id));
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($id = null)
    {
        $form = new Form(new Component());

        $form->text('name', __('Name'))->creationRules(['required', "unique:components"])
            ->updateRules(['required', "unique:components,name,{{id}}"]);
        $form->select('part_type')->options(PartType::toSelectArray())
            ->when('in', [PartType::PVWire, PartType::MVCable, PartType::MaleConnector, PartType::FemaleConnector], function (Form $form) {
                $form->select('line_number', __('Line number'))->options(LINE_NUMBER);
            })->required();
        $form->decimal('price', __('Price'))->required();
        $form->decimal('weight', __('Weight'))->required();

        $form->saving(function (Form $form) use ($id){
            if(in_array($form->part_type, [PartType::PVWire, PartType::MVCable, PartType::MaleConnector, PartType::FemaleConnector])){
                if(is_null($form->line_number)){
                    throw new \Exception("请选择 Line number");
                }


                if($form->isEditing()){
                    $component_count = Component::where('line_number', $form->line_number)->where('id', '!=', $id)->count();
                    if($component_count){
                        throw new \Exception("Line number 已存在");
                    }
                }else{
                    $component_count = Component::where('line_number', $form->line_number)->count();
                    if($component_count){
                        throw new \Exception("Line number 已存在");
                    }
                }


            }else{
                $form->line_number = NULL;
            }
        });

        return $form;
    }
}
