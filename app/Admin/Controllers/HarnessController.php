<?php

namespace App\Admin\Controllers;

use App\Enums\HarnessModule;
use App\Enums\PartType;
use App\Models\Component;
use App\Models\Harness;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class HarnessController extends AdminController
{

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Harness';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Harness());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('min_length', __('Min length'));
        $grid->column('max_length', __('Max length'));
        $grid->column('fuse', __('Fuse'));
        $grid->column('string', __('String'));
        $grid->column('outlet_length', __('Outlet length'));
        $grid->column('remarks', __('Remarks'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Harness::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('min_length', __('Min length'));
        $show->field('max_length', __('Max length'));
        $show->field('fuse', __('Fuse'));
        $show->field('string', __('String'));
        $show->field('outlet_length', __('Outlet length'));
        $show->field('remarks', __('Remarks'));
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
        $form = new Form(new Harness());

        $form->hidden('name', __('Name'));
        $form->number('min_length', __('Min length'))->required();
        $form->number('max_length', __('Max length'))->rules('required|gte:min_length');
        $form->number('fuse', __('Fuse'))->required();
        $form->number('string', __('String'))->default(1)->min(1)->max(99)->required();
        $form->number('outlet_length', __('Outlet length'))->required();
        $form->select('module', 'Module')->options(HarnessModule::toSelectArray())->required();

        $form->hasMany('component', 'Component', function (Form\NestedForm $form) {
            $components = Component::orderBy('part_type')->get()->map(function ($item) {
                $item->name = $item->name;
                if(in_array($item->part_type, [PartType::PVWire, PartType::MVCable]) && isset(LINE_NUMBER[$item->line_number])){
                    $item->name .= ' : '. LINE_NUMBER[$item->line_number];
                }

                return $item;
            });
            $form->select('component_id', 'Component')->options($components->pluck('name', 'id'));
            $form->number('length', 'Length')->min(1)->default(1);
            $form->number('quantity', 'Quantity')->min(1)->default(1);
        });


        $form->image('image', __('Image'))->removable();
        $form->file('file', __('File'))->removable();
        $form->textarea('remarks', __('Remarks'));

        $form->saving(function (Form $form) {
            $component_ids = collect($form->component)->where('_remove_', 0)->pluck('component_id');
            if ($component_ids->unique()->count() != $component_ids->count()) {
                throw new \Exception('存在相同的组件');
            }
            $components = is_null($form->component) ? 0 : Component::whereIn('id', $component_ids)->whereIn('part_type', [PartType::PVWire, PartType::MVCable])->get();

            if ($components->count() == 0) {
                throw new \Exception('必须添加一根线');
            }

            $form_components = collect($form->component)->where('_remove_', 0)->keyBy('component_id')->toArray();

            $components = $components->sortBy('line_number')->map(function ($item) use($form_components){
                $item['length'] = intval($form_components[$item->id]['length']);
                $item['quantity'] = intval($form_components[$item->id]['quantity']);
                $length = $item['length'] * $item['quantity'];
                if($length > 999){
                    throw new \Exception('长度不能超过999');
                }
                $item['other_name'] = LINE_NUMBER_LETTER[$item->line_number].sprintf('%03d', $length);
                return $item;
            });

            $other_name = '';
            foreach ($components as $component){
                $other_name.=$component['other_name'];
            }
            $name = 'VH'.sprintf('%02d', $form->string).HarnessModule::getDescription($form->module).$other_name;

            $harness = Harness::where('name', 'like', $name.'%')->count();
            $harness += 1;
            $form->name = $name.sprintf('%02d', $harness);
        });

        return $form;
    }
}
