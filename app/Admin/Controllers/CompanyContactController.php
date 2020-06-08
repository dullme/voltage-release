<?php

namespace App\Admin\Controllers;

use App\Models\Company;
use App\Models\CompanyContact;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Support\MessageBag;

class CompanyContactController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'CompanyContact';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CompanyContact());

        $grid->company()->name('Company name');
        $grid->column('name', __('Name'));
        $grid->column('tel', __('Tel'));
        $grid->column('email', __('Email'));
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
        $show = new Show(CompanyContact::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('company_id', __('Company id'));
        $show->field('name', __('Name'));
        $show->field('tel', __('Tel'));
        $show->field('email', __('Email'));
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
        $form = new Form(new CompanyContact());

        $form->select('company_id', __('Company'))->options(Company::pluck('name', 'id'))->required();
        $form->text('name', __('Name'))->required();
        $form->text('tel', __('Tel'));
        $form->email('email', __('Email'));

        $form->saving(function (Form $form){

            $contact = CompanyContact::where('company_id', $form->company_id)->where('name', $form->name);
            $contact = $form->model()->id ? $contact->where('id', '!=', $form->model()->id)->count() : $contact->count();

            if($contact > 0){
                $error = new MessageBag([
                    'title'   => 'ERROR',
                    'message' => 'The Name has already been taken.',
                ]);

                return back()->with(compact('error'));
            }
        });

        return $form;
    }
}
