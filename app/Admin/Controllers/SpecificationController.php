<?php

namespace App\Admin\Controllers;

use App\Enums\ConnectionMethod;
use App\Models\Bracket;
use App\Models\SolarPanel;
use App\Models\Specification;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SpecificationController extends ResponseController
{

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Specification';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Specification());

        $grid->column('name', __('Name'));
        $grid->column('show_name', __('Show name'));
        $grid->panels()->pluck('name')->label();
        $grid->column('bracket.name', __('Bracket name'));
        $grid->column('connection_method', __('Connection method'))->display(function ($connection_method) {
            return ConnectionMethod::getDescription($connection_method);
        })->label();
        $grid->column('quantity', __('Module count per string'));
        $grid->column('string_length', __('String length/ft'))->display(function () {
            $width = $this->panels()->get()->first()->width;
            return "<span data-toggle='tooltip' data-placement='top' title='{$width} x {$this->quantity} x " . STRING_LENGTH_BUFFER . "'>" . getStringLength($width, $this->quantity) . "</span>";
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
        $show = new Show(Specification::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('solar_panel_id', __('Solar panel id'));
        $show->field('bracket_id', __('Bracket id'));
        $show->field('name', __('Name'));
        $show->field('show_name', __('Show name'));
        $show->field('connection_method', __('Connection method'));
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
        $form = new Form(new Specification());

        $solarPanel = SolarPanel::all();
        $solarPanel = $solarPanel->map(function ($item){
            return [
                'id'    => $item->id,
                'name' => $item->name .' : '.$item->width,
                'width' => $item->width
            ];
        });


        $form->text('name', __('Name'))->creationRules(['required', "unique:specifications"])
            ->updateRules(['required', "unique:specifications,name,{{id}}"]);
        $form->text('show_name', __('Show name'));
        $form->multipleSelect('panels', __('Solar panel'))->options($solarPanel->pluck('name', 'id'))->required();
        $form->select('bracket_id', __('Bracket id'))->options(Bracket::pluck('name', 'id'))->required();
        $form->select('connection_method', __('Connection method'))->options(ConnectionMethod::toSelectArray());
        $form->number('quantity', __('Module count per string'))->default(1)->min(1)->required();

        $form->saving(function (Form $form) use($solarPanel) {
            if (is_null($form->panels)) {
                throw new \Exception("必须选择 Solar panel");
            }

            $panels = array_filter($form->panels);

            $solarPanel = $solarPanel->whereIn('id', $panels);

            if($solarPanel->unique('width')->count() != 1){
                throw new \Exception("Width 必须相同");
            }

        });

        return $form;
    }

    public function getSpecification()
    {
        $specifications = Specification::select('id', 'name')->get();

        return $this->responseSuccess($specifications);
    }
}
