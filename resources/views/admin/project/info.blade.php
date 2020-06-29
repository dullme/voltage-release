<div class="row">
    <div class="col-md-12">
        <div class="box box-info form-horizontal">
            <div class="box-header with-border">
                <h3 class="box-title">Project info</h3>

                <div class="box-tools">
{{--                    <div class="btn-group pull-right" style="margin-right: 5px">--}}
{{--                        <a href="{{ url('/admin/extender/add/'.$project->id) }}" class="btn btn-sm btn-primary" title="Edit">--}}
{{--                            <i class="fa fa-edit"></i><span class="hidden-xs"> Extender</span>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="btn-group pull-right" style="margin-right: 5px">--}}
{{--                        <a href="{{ url('/admin/harness/add/'.$project->id) }}" class="btn btn-sm btn-primary" title="Edit">--}}
{{--                            <i class="fa fa-edit"></i><span class="hidden-xs"> Harness</span>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                    <div class="btn-group pull-right" style="margin-right: 5px">--}}
{{--                        <a href="{{ url('/admin/block/add/'.$project->id) }}" class="btn btn-sm btn-primary" title="Edit">--}}
{{--                            <i class="fa fa-edit"></i><span class="hidden-xs"> Block</span>--}}
{{--                        </a>--}}
{{--                    </div>--}}
                    <div class="btn-group pull-right" style="margin-right: 5px">
                        <a href="{{ url('/admin/projects') }}" class="btn btn-sm btn-default" title="List">
                            <i class="fa fa-list"></i><span class="hidden-xs"> List</span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <div>
                    @foreach($specifications as $specification)
                        <span class="label label-success">{{ $specification->name }}</span>
                    @endforeach
                </div>

                <div class="fields-group">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Company</label>
                            <div class="col-sm-8">
                                <span class="form-control">{{ $project->company->name }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-8">
                                <span class="form-control">{{ $project->name }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-8">
                                <span class="form-control">{{ $project->address }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Total Quantity</label>
                            <div class="col-sm-8">
                                <span class="form-control">{{ $project->total_quantity }}</span>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title">Info Analysis</h3></div>
                            <div class="panel-body">

                                <div class="form-group  ">
                                    <label class="col-sm-2 control-label">Module Dimension</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <label class="input-group-addon">Size DC</label>
                                            <span class="form-control">{{ $project->size_dc }}</span>
                                            <span class="input-group-addon" style="border-left: unset;">MW</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group  ">
                                    <label class="col-sm-2 control-label">Module Lead</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-6 mb15">
                                                <div class="input-group">
                                                    <span class="input-group-addon">POS Color</span>
                                                    <span class="form-control">{{ $project->pos_color }}</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 mb15">
                                                <div class="input-group">
                                                    <span class="input-group-addon">NEG Color</span>
                                                    <span class="form-control">{{ $project->neg_color }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group  ">
                                    <label class="col-sm-2 control-label">Connector</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-6 mb15">
                                                <span class="form-control">{{ $project->connector }}</span>
                                            </div>
                                            <div class="col-sm-6 mb15">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Fuse</span>
                                                    <span class="form-control">{{ $project->fuse }}</span>
                                                    <span class="input-group-addon">A</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group  ">
                                    <label class="col-sm-2 control-label">Junction box to rack</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-6 mb15">
                                                <div class="input-group">
                                                    <span class="form-control">{{ $project->junction_box_to_rack_1 }}</span>
                                                    <span class="input-group-addon" style="border-left: unset;">mm</span>
                                                    <span class="input-group-addon" style="border-left: unset; font-weight: bold;">
                                                        {{ round($project->junction_box_to_rack_1/25.4/12, 3) }} ft
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 mb15">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Junction box to rack'</span>
                                                    <span class="form-control">{{ $project->junction_box_to_rack_2 }}</span>
                                                    <span class="input-group-addon" style="border-left: unset;">mm</span>
                                                    <span class="input-group-addon" style="border-left: unset; font-weight: bold;">
                                                        {{ round($project->junction_box_to_rack_2/25.4/12, 3) }} ft
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group  ">
                                    <label class="col-sm-2 control-label">Module to module extender</label>
                                    <div class="col-sm-8">
                                        <span class="form-control">{{ $project->module_to_module_extender }}</span>
                                    </div>
                                </div>


                                <div class="form-group  ">
                                    <label class="col-sm-2 control-label">End of extender</label>
                                    @if(isset($project->remark_list['end_of_extender']) && $project->remark_list['end_of_extender'])
                                        <div class="col-sm-8" data-toggle="tooltip" data-placement="top" title="{{ $project->remark_list['end_of_extender'] }}">
                                            <span class="form-control checked">{{ $project->end_of_extender }}</span>
                                        </div>
                                    @else
                                        <div class="col-sm-8">
                                            <span class="form-control">{{ $project->end_of_extender }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group  ">
                                    <label class="col-sm-2 control-label">Layout of whip</label>
                                    <div class="col-sm-8">
                                        <span class="form-control">
                                            @if($project->layout_of_whip == 0)
                                                UNKNOWN
                                            @elseif($project->layout_of_whip == 1)
                                                CAB
                                            @elseif($project->layout_of_whip == 2)
                                                TRENCH
                                            @endif
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group  ">
                                    <label class="col-sm-2 control-label">Rowhead to CBX</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-6 mb15">
                                                <div class="input-group">
                                                    <span class="form-control">{{ $project->row_head_to_cbx_1 }}</span>
                                                    <span class="input-group-addon">ft</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 mb15">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Rowhead to CBX'</span>
                                                    <span class="form-control">{{ $project->row_head_to_cbx_2 }}</span>
                                                    <span class="input-group-addon">ft</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group  ">
                                    <label class="col-sm-2 control-label">Distance between poles</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="form-control">{{ $project->distance_between_poles }}</span>
                                            <span class="input-group-addon">ft</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group  ">
                                    <label class="col-sm-2 control-label">Remarks</label>
                                    <div class="col-sm-8">
                                        @if($project->remark_list)
                                        <span class="form-control" style="margin-bottom: 15px">
                                            @foreach($project->remark_list as $key=>$item)
                                                {{ ucfirst(str_replace('_', ' ', $key)) }}: {{ $item }}
                                            @endforeach
                                        </span>
                                        @endif
                                        <textarea rows="5" style="width: 100%" readonly>{{ $project->remarks }}</textarea>
                                    </div>
                                </div>


                            </div>
                        </div>


                    </div>
                </div>

            </div>



        </div>
    </div>
</div>

<style>
    .checked{
        color: #dd4b39 !important;
        border-color: #dd4b39 !important;
    }

    .panel-red{
        border-color: #dd4b39;
    }

    .panel-red>.panel-heading {
        color: #ffffff;
        background-color: #dd4b39;
        border-color: #dd4b39;
    }

    .panel-black{
        border-color: #000000;
    }

    .panel-black>.panel-heading {
        color: #ffffff;
        background-color: #000000;
        border-color: #000000;
    }
</style>
