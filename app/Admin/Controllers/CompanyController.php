<?php

namespace App\Admin\Controllers;

use App\Models\Company;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CompanyController extends ResponseController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Company';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Company());

        $grid->column('name', __('Name'));
        $grid->column('code', __('Code'));
        $grid->column('tel', __('Tel'));
        $grid->column('address', __('Address'));
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
        $show = new Show(Company::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('code', __('Code'));
        $show->field('tel', __('Tel'));
        $show->field('address', __('Address'));
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
        $form = new Form(new Company());

        $form->text('name', __('Name'))->creationRules(['required', "unique:companies"])
            ->updateRules(['required', "unique:companies,name,{{id}}"]);
        $form->text('tel', __('Tel'));
        $form->text('address', __('Address'));
        $form->hidden('code', __('Code'));

        if($form->isCreating()){
            $form->saving(function (Form $form) {
                $client = Company::orderBy('id', 'desc')->first();
                $number = 0;
                if($client){
                    $number = intval($client->code) == 0 ? 100 : intval($client->code) + 1;
                }
                $form->code = sprintf('%03d', $number);
            });
        }

        return $form;
    }

    public function getCompany()
    {
        $clients = Company::select('id', 'name')->get();

        return $this->responseSuccess($clients);
    }
}
