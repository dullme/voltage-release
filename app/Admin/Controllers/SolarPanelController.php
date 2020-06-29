<?php

namespace App\Admin\Controllers;

use App\Enums\PlacementMethod;
use App\Models\SolarPanel;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SolarPanelController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'SolarPanel';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SolarPanel());

        $grid->column('name', __('Name'));
        $grid->column('placement_method', __('Placement Method'))->display(function ($placement_method){
            return PlacementMethod::getDescription($placement_method);
        })->label();
        $grid->column('length', __('Length/mm'))->display(function ($length){
            return sprintf("%.2f", $length);
        });
        $grid->column('width', __('Width/mm'))->display(function ($width){
            return sprintf("%.2f", $width);
        });
        $grid->column('m_l_pos', __('Module lead positive'))->display(function ($m_l_pos){
            return sprintf("%.2f", $m_l_pos);
        });
        $grid->column('m_l_neg', __('Module lead negative'))->display(function ($m_l_neg){
            return sprintf("%.2f", $m_l_neg);
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
        $show = new Show(SolarPanel::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('length', __('Length'));
        $show->field('width', __('Width'));
        $show->field('placement_method', __('Placement Method'));
        $show->field('m_l_pos', __('Module lead positive'));
        $show->field('m_l_neg', __('Module lead negative'));
        $show->field('created_at', __('Created at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SolarPanel());

        $form->text('name', __('Name'))->creationRules(['required', "unique:solar_panels"])
            ->updateRules(['required', "unique:solar_panels,name,{{id}}"]);
        $form->number('length', __('Length/mm'))->min(1)->rules('required|integer|min:1');
        $form->number('width', __('Width/mm'))->min(1)->rules('required|integer|min:1');
        $form->number('m_l_pos', __('Module lead positive'))->min(1)->rules('required|integer|min:1');
        $form->number('m_l_neg', __('Module lead negative'))->min(1)->rules('required|integer|min:1');
        $form->radio('placement_method', __('Placement Method'))->options(PlacementMethod::toSelectArray())->required();
        $form->display('', __(''))->with(function ($value) {
            $portrait = asset('/images/portrait.png');
            $landscape = asset('/images/landscape.png');
            return "<div style='display: flex'>
                        <div style='text-align: center'>
                            <p><b>Portrait</b></p>
                            <img style='width: 90%' src='$portrait' />
                        </div>
                        <div style='text-align: center'>
                            <p><b>Landscape</b></p>
                            <img style='width: 90%' src='$landscape' />
                        </div>
                    </div>";
        });
        $form->file('file', __('File'))->hidePreview()->removable();

        $form->saving(function (Form $form) {
//            $form->model()->id;
            if($form->isEditing()){
                if ($form->width != $form->model()->width) {
                    throw new \Exception("width 被修改了");
                }
            }
        });


        return $form;
    }
}
