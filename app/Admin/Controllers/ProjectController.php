<?php

namespace App\Admin\Controllers;

use App\Models\Combination;
use App\Models\Project;
use App\Models\Specification;
use Carbon\Carbon;
use Encore\Admin\Admin;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Validator;

class ProjectController extends ResponseController
{

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Project';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Project());

//        $grid->column('id', __('Id'));
        $grid->column('company_id', __('Company id'));
        $grid->column('name', __('Name'))->display(function ($name) {
            return "<a href='" . url('/admin/projects/info/' . $this->id) . "'>" . $name . "</a>";
        });
        $grid->column('address', __('Address'));
        $grid->column('total_quantity', __('Total quantity'));
        $grid->column('size_dc', __('Size dc'));
        $grid->column('connector', __('Connector'));
        $grid->column('fuse', __('Fuse'));
        $grid->column('junction_box_to_rack_1', __('Junction box to rack 1'));
        $grid->column('junction_box_to_rack_2', __('Junction box to rack 2'));
        $grid->column('layout_of_whip', __('Layout of whip'));
        $grid->column('distance_between_poles', __('Distance between poles'));
        $grid->column('row_head_to_cbx_1', __('Row head to cbx 1'));
//        $grid->column('remarks', __('Remarks'));
//        $grid->column('remark_list', __('Remark list'));
        $grid->column('neg_color', __('Neg color'));
        $grid->column('pos_color', __('Pos color'));
//        $grid->column('whip_quote_quantity', __('Whip quote quantity'));
//        $grid->column('typical_quote_quantity', __('Typical quote quantity'));
//        $grid->column('whip_buffer', __('Whip buffer'));
//        $grid->column('whip_to_be_half', __('Whip to be half'));
//        $grid->column('string_length_buffer', __('String length buffer'));
        $grid->column('created_at', __('Created at'));

//        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    public function info($id, Content $content)
    {
        $project = Project::with('company', 'combinations.items.component')->findOrFail($id);
//        dd($proj?Zect->toArray());

        $specifications = Specification::whereIn('id', $project->specifications)->get();

        return $content
            ->title('Dashboard')
            ->description('Description...')
            ->row(view('admin.project.info', compact('project', 'specifications')));
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
    protected function form($id=null)
    {
        $form = new Form(new Project());

//        $form->number('company_id', __('Company id'));
//        $form->text('name', __('Name'));
//        $form->text('address', __('Address'));
//        $form->number('total_quantity', __('Total quantity'));
//        $form->decimal('size_dc', __('Size dc'));
//        $form->text('connector', __('Connector'));
//        $form->number('fuse', __('Fuse'));
//        $form->decimal('junction_box_to_rack_1', __('Junction box to rack 1'));
//        $form->decimal('junction_box_to_rack_2', __('Junction box to rack 2'));
//        $form->number('layout_of_whip', __('Layout of whip'));
//        $form->number('distance_between_poles', __('Distance between poles'));
//        $form->number('row_head_to_cbx_1', __('Row head to cbx 1'));
//        $form->textarea('remarks', __('Remarks'));
//        $form->textarea('remark_list', __('Remark list'));
//        $form->text('neg_color', __('Neg color'));
//        $form->text('pos_color', __('Pos color'));
//        $form->number('whip_quote_quantity', __('Whip quote quantity'));
//        $form->number('typical_quote_quantity', __('Typical quote quantity'));
//        $form->number('whip_buffer', __('Whip buffer'));
//        $form->switch('whip_to_be_half', __('Whip to be half'));
//        $form->number('string_length_buffer', __('String length buffer'));

        if ($form->isEditing()) {
            $project = Project::find($id);
            $specifications = $project->specifications ?? [];

            $combination = Combination::with('items.specifications')->get();
            $combination = $combination->filter(function ($item) use($specifications) {
                return !!count(array_intersect($specifications,$item->items->pluck('specifications')->flatten()->pluck('id')->toArray()));
            });

            $form->listbox('combinations')->options($combination->pluck('name', 'id'));

        }


        return $form;
    }

    public function create(Content $content)
    {
        Admin::script(<<<EOF
            const app = new Vue({
                el: '#app'
            });
EOF
        );

        return $content
            ->title($this->title())
            ->description($this->description['create'] ?? trans('admin.create'))
            ->body("<project-create></project-create>");
    }

    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'company_id'                => 'required',
            'name'                      => 'required|unique:projects',
            'address'                   => 'nullable',
            'total_quantity'            => 'required|integer|min:0',
            'size_dc'                   => 'nullable|integer|min:0',
            'pos_color'                 => 'required',
            'neg_color'                 => 'required',
            'connector'                 => 'required',
            'fuse'                      => 'required|integer|min:0',
            'junction_box_to_rack_1'    => 'required|numeric',
            'junction_box_to_rack_2'    => 'nullable|numeric',
            'module_to_module_extender' => 'nullable|integer|min:0',
            'end_of_extender'           => 'required',
            'layout_of_whip'            => 'required|integer|min:0',
            'row_head_to_cbx_1'         => 'required_if:layout_of_whip,1,2|nullable|integer|min:0',
            'row_head_to_cbx_2'         => 'required_if:layout_of_whip,2|nullable|integer|min:0',
            'distance_between_poles'    => 'required_if:layout_of_whip,1,2|nullable|integer|min:0',
            'remarks'                   => 'required',
            'remark_list'               => 'nullable',
            'specifications'            => 'required'
        ], [
            'company_id.required' => 'The client field is required.',
        ]);

        if ($validator->fails()) {
            return $this->setStatusCode(422)->responseError($validator->errors()->first());
        }

        $carbon = Carbon::now();
        $project = Project::orderBy('id', 'desc')->whereBetween('created_at', [$carbon->startOfYear()->toDateTimeString(), $carbon->endOfYear()->toDateTimeString()])->first();
        $data = request()->all();
        $data['code'] = $project ? substr($project->code, 0, 2) . (intval(substr($project->code, 2)) + 1) : substr($carbon->year, -2) . '01';

        $project = Project::create($data);

        return $this->responseSuccess(true);
    }

    public function addTypical($id, Content $content)
    {
        Admin::script(<<<EOF
            const app = new Vue({
                el: '#app'
            });
EOF
        );

        $project = Project::findOrFail($id);

        return $content
            ->title($this->title())
            ->description($this->description['create'] ?? trans('admin.create'))
            ->body("<project-typical-create project='{$project}'></project-typical-create>");
    }
}
