<?php

namespace App\Admin\Controllers;

use App\Enums\ConnectionMethod;
use App\Enums\ItemType;
use App\Enums\PosNeg;
use App\Models\CombinationItem;
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
        $grid->column('show_name', __('Show name'));

        $grid->column('pos_neg', __('Pos/Neg'))->display(function ($posNeg){
            return PosNeg::getDescription($posNeg);
        })->label([
            0 => 'danger',
            1 => 'warning',
        ]);
        $grid->specifications()->pluck('name')->label();
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
        $show = new Show(Item::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('pos_neg', __('Pos neg'));
        $show->field('file', __('File'));
        $show->field('image', __('Image'));
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
        $specifications = Specification::with('bracket', 'panels')->get();
        $specifications = $specifications->map(function ($item){
            $co = ConnectionMethod::getDescription($item->connection_method);
            $bracket = $item->bracket->name;
            $width = $item->panels->first()->width;
            $string_length = getStringLength($width, $item->quantity);
            return [
                'id' => $item->id,
                'name' => "$item->name : $co : $bracket : $string_length",
            ];
        });
        $form->listbox('specifications')->options($specifications->pluck('name', 'id'));

        $form->text('name', __('Name'))->creationRules(['required', "unique:items"])
            ->updateRules(['required', "unique:items,name,{{id}}"]);
        $form->radio('pos_neg')->options(PosNeg::toSelectArray())->required();
        $form->file('file', __('File'));
        $form->image('image', __('Image'));

        $form->hasMany('component', 'Component', function (Form\NestedForm $form){
            $form->select('component_id', 'Component')->options(Component::pluck('name', 'id'))->required();
            $form->number('length', 'Length')->min(1)->default(1)->required();
            $form->number('quantity', 'Quantity')->min(1)->default(1)->required();
            $form->switch('driver', 'Driver')->states([
                'on'  => ['value' => 1, 'text' => 'True', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => 'False', 'color' => 'danger'],
            ])->default(0);
        });

        if($form->isEditing()){
            $form->saving(function (Form $form){
                if($form->model()->pos_neg != intval($form->pos_neg)){
                    $count = CombinationItem::where('item_id', $form->model()->id)->count();
                    if($count){
                        throw new \Exception('该产品已存在组合无法修改正负极');
                    }
                }
                if(is_null($form->component)){
                    throw new \Exception('Component 必须添加');
                }
                if(!!!array_filter($form->specifications)){
                    throw new \Exception('Specifications 必须添加');
                }
            });
        }else{
            $form->saving(function (Form $form){
                if(is_null($form->component)){
                    throw new \Exception('Component 必须添加');
                }
                if(!!!array_filter($form->specifications)){
                    throw new \Exception('Specifications 必须添加');
                }
            });
        }

        return $form;
    }
}
