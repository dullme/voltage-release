<template>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">

                <div class="box-header with-border">
                    <h3 class="box-title">Create</h3>
                    <div class="box-tools">
                        <div class="btn-group pull-right" style="margin-right: 5px">
                            <a href="/admin/projects" class="btn btn-sm btn-default" title="List">
                                <i class="fa fa-list"></i><span class="hidden-xs"> List</span>
                            </a>
                        </div>

                    </div>
                </div>

                <form class="form-horizontal">

                    <div class="box-body">

                        <div class="fields-group">

                            <div class="col-md-12">
                                <div class="form-group  ">
                                    <label class="col-sm-2 asterisk control-label">Company</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="company_id" name="company_id" v-model="project_form.company_id">
                                            <option v-for="company in companies" :value="company.id">{{ company.name }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group  ">
                                    <label class="col-sm-2 asterisk control-label">Name</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input required="1" type="text" v-model="project_form.name" id="name" name="name" value="" class="form-control" placeholder="Input Name">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group  ">
                                    <label class="col-sm-2 control-label">Address</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input required="1" type="text" v-model="project_form.address" id="address" name="address" value="" class="form-control" placeholder="Input Address">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group  ">
                                    <label class="col-sm-2 asterisk control-label">Total Quantity</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input required="1" type="number" v-model="project_form.total_quantity" id="total_block" name="total_quantity" value="" class="form-control" placeholder="Input Total Quantity">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div style="clear: both"></div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Info Analysis</h3>
                            </div>
                            <div class="panel-body">
                                <div class="form-group  ">
                                    <label class="col-sm-2 asterisk control-label">Module Dimension</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <label class="input-group-addon">Size DC</label>
                                            <input type="number" class="form-control" v-model="project_form.size_dc">
                                            <span class="input-group-addon" style="border-left: unset">MW</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group  ">
                                    <label class="col-sm-2 control-label">Module Lead</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-6 mb15">
                                                <div class="input-group">
                                                    <span class="input-group-addon asterisk">POS</span>
                                                    <input type="text" class="form-control" :class="checkbox_list.pos_color ? 'checked' : ''" v-model="project_form.pos_color">
                                                    <span class="input-group-addon">
                                                        <input type="checkbox" v-model="checkbox_list.pos_color">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 mb15">
                                                <div class="input-group">
                                                    <span class="input-group-addon asterisk">NEG</span>
                                                    <input type="text" class="form-control" :class="checkbox_list.neg_color ? 'checked' : ''" v-model="project_form.neg_color">
                                                    <span class="input-group-addon">
                                                        <input type="checkbox" v-model="checkbox_list.neg_color">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group  ">
                                    <label class="col-sm-2 asterisk control-label">Connector</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-6 mb15">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                    <input type="text" class="form-control" :class="checkbox_list.connector ? 'checked' : ''" v-model="project_form.connector">
                                                    <span class="input-group-addon">
                                                        <input type="checkbox" v-model="checkbox_list.connector">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 mb15">
                                                <div class="input-group">
                                                    <span class="input-group-addon asterisk">Fuse</span>
                                                    <input type="number" class="form-control" :class="checkbox_list.fuse ? 'checked' : ''" v-model="project_form.fuse">
                                                    <span class="input-group-addon" style="border-left: unset;">A</span>
                                                    <span class="input-group-addon">
                                                        <input type="checkbox" v-model="checkbox_list.fuse">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group  ">
                                    <label class="col-sm-2 asterisk control-label">Junction box to rack</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-6 mb15">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" :class="checkbox_list.junction_box_to_rack_1 ? 'checked' : ''" v-model="project_form.junction_box_to_rack_1">
                                                    <span class="input-group-addon" style="border-left: unset">mm</span>
                                                    <span class="input-group-addon" style="border-left: unset;font-weight: bold">{{(project_form.junction_box_to_rack_1/25.4/12).toFixed(3) }} ft</span>
                                                    <span class="input-group-addon">
                                                <input type="checkbox" v-model="checkbox_list.junction_box_to_rack_1">
                                            </span>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 mb15">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Junction box to rack'</span>
                                                    <input type="number" class="form-control" :class="checkbox_list.junction_box_to_rack_2 ? 'checked' : ''" v-model="project_form.junction_box_to_rack_2">
                                                    <span class="input-group-addon" style="border-left: unset">mm</span>
                                                    <span class="input-group-addon" style="border-left: unset;font-weight: bold">{{(project_form.junction_box_to_rack_2/25.4/12).toFixed(3) }} ft</span>
                                                    <span class="input-group-addon">
                                                        <input type="checkbox" v-model="checkbox_list.junction_box_to_rack_2">
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group  ">
                                    <label class="col-sm-2 asterisk control-label">Module to module extender</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="number" class="form-control" :class="checkbox_list.module_to_module_extender ? 'checked' : ''" v-model="project_form.module_to_module_extender">
                                            <span class="input-group-addon" style="border-left: unset">ft</span>
                                            <span class="input-group-addon">
                                                <input type="checkbox" v-model="checkbox_list.module_to_module_extender">
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group  ">
                                    <label class="col-sm-2 asterisk control-label">End of extender</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <select class="form-control" :class="checkbox_list.end_of_extender ? 'checked' : ''" v-model="project_form.end_of_extender">
                                                <option value="UNKNOWN">UNKNOWN</option>
                                                <option value="ROW HEAD">ROW HEAD</option>
                                                <option value="CBX">CBX</option>
                                                <option value="INV">INV</option>
                                            </select>
                                            <span class="input-group-addon">
                                                <input type="checkbox" v-model="checkbox_list.end_of_extender">
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group  ">
                                    <label class="col-sm-2 asterisk control-label">Layout of whip</label>
                                    <div class="col-sm-8">
                                        <label class="radio-inline" id="option_unknown" data-placement="right">
                                            <input type="radio" name="layout_of_whip" v-model="project_form.layout_of_whip" value="0"> UNKNOWN
                                        </label>
                                        <label class="radio-inline" id="option_cab" data-placement="right">
                                            <input type="radio" name="layout_of_whip" v-model="project_form.layout_of_whip" value="1"> CAB
                                        </label>
                                        <label class="radio-inline" id="option_trench" data-placement="right" style="margin-left: 15px">
                                            <input type="radio" name="layout_of_whip" v-model="project_form.layout_of_whip" value="2"> TRENCH
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group  " v-if="project_form.layout_of_whip != 0">
                                    <label class="col-sm-2 asterisk control-label">Rowhead to CBX</label>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-6 mb15">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                                    <input type="number" class="form-control" :class="checkbox_list.rowhead_to_cbx_1 ? 'checked' : ''" v-model="project_form.rowhead_to_cbx_1">
                                                    <span class="input-group-addon" style="border-left: unset">ft</span>
                                                    <span class="input-group-addon">
                                                        <input type="checkbox" v-model="checkbox_list.rowhead_to_cbx_1">
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-sm-6 mb15" v-if="project_form.layout_of_whip == 2">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Rowhead to CBX'</span>
                                                    <input type="number" class="form-control" :class="checkbox_list.rowhead_to_cbx_2 ? 'checked' : ''" v-model="project_form.rowhead_to_cbx_2">
                                                    <span class="input-group-addon" style="border-left: unset">ft</span>
                                                    <span class="input-group-addon">
                                                        <input type="checkbox" v-model="checkbox_list.rowhead_to_cbx_2">
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="form-group " v-if="project_form.layout_of_whip != 0">
                                    <label class="col-sm-2 asterisk control-label">Distance between poles</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="number" class="form-control" :class="checkbox_list.distance_between_poles ? 'checked' : ''" v-model="project_form.distance_between_poles">
                                            <span class="input-group-addon" style="border-left: unset">ft</span>
                                            <span class="input-group-addon">
                                                <input type="checkbox" v-model="checkbox_list.distance_between_poles">
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div>

                                </div>

                                <div class="form-group  ">
                                    <label class="col-sm-2 asterisk control-label">Remarks</label>
                                    <div class="col-sm-8">

                                        <div class="row" v-if="checkbox_list.solar_module">
                                            <div class="col-sm-6 mb15">
                                                <div class="input-group">
                                                    <span class="input-group-addon asterisk">Solar Module</span>
                                                    <input type="text" class="form-control" v-model="checkbox_list_remarks.solar_module">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" v-if="checkbox_list.length || checkbox_list.width">
                                            <div class="col-sm-6 mb15">
                                                <div class="input-group" v-if="checkbox_list.length">
                                                    <span class="input-group-addon asterisk">Length</span>
                                                    <input type="text" class="form-control" v-model="checkbox_list_remarks.length">
                                                </div>
                                            </div>

                                            <div class="col-sm-6 mb15" v-if="checkbox_list.width">
                                                <div class="input-group">
                                                    <span class="input-group-addon asterisk">Width</span>
                                                    <input type="text" class="form-control" v-model="checkbox_list_remarks.width">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row" v-if="checkbox_list.pos_color || checkbox_list.neg_color">
                                            <div class="col-sm-6 mb15">
                                                <div class="input-group" v-if="checkbox_list.pos_color">
                                                    <span class="input-group-addon asterisk">POS</span>
                                                    <input type="text" class="form-control" v-model="checkbox_list_remarks.pos_color">
                                                </div>
                                            </div>

                                            <div class="col-sm-6 mb15" v-if="checkbox_list.neg_color">
                                                <div class="input-group">
                                                    <span class="input-group-addon asterisk">NEG</span>
                                                    <input type="text" class="form-control" v-model="checkbox_list_remarks.neg_color">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" v-if="checkbox_list.connector || checkbox_list.fuse">
                                            <div class="col-sm-6 mb15">
                                                <div class="input-group" v-if="checkbox_list.connector">
                                                    <span class="input-group-addon asterisk">Connector</span>
                                                    <input type="text" class="form-control" v-model="checkbox_list_remarks.connector">
                                                </div>
                                            </div>

                                            <div class="col-sm-6 mb15" v-if="checkbox_list.fuse">
                                                <div class="input-group">
                                                    <span class="input-group-addon asterisk">Fuse</span>
                                                    <input type="text" class="form-control" v-model="checkbox_list_remarks.fuse">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" v-if="checkbox_list.junction_box_to_rack_1 || checkbox_list.junction_box_to_rack_2">
                                            <div class="col-sm-6 mb15">
                                                <div class="input-group" v-if="checkbox_list.junction_box_to_rack_1">
                                                    <span class="input-group-addon asterisk">Junction box to rack</span>
                                                    <input type="text" class="form-control" v-model="checkbox_list_remarks.junction_box_to_rack_1">
                                                </div>
                                            </div>

                                            <div class="col-sm-6 mb15" v-if="checkbox_list.junction_box_to_rack_2">
                                                <div class="input-group">
                                                    <span class="input-group-addon asterisk">Junction box to rack'</span>
                                                    <input type="text" class="form-control" v-model="checkbox_list_remarks.junction_box_to_rack_2">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input-group remark-list" v-if="checkbox_list.module_to_module_extender">
                                            <span class="input-group-addon asterisk">Module to module extender</span>
                                            <input type="text" class="form-control" v-model="checkbox_list_remarks.module_to_module_extender">
                                        </div>

                                        <div class="input-group remark-list" v-if="checkbox_list.end_of_extender">
                                            <span class="input-group-addon asterisk">End of extender</span>
                                            <input type="text" class="form-control" v-model="checkbox_list_remarks.end_of_extender">
                                        </div>

                                        <div class="row" v-if="checkbox_list.rowhead_to_cbx_1 || checkbox_list.rowhead_to_cbx_2">
                                            <div class="col-sm-6 mb15">
                                                <div class="input-group" v-if="checkbox_list.rowhead_to_cbx_1">
                                                    <span class="input-group-addon asterisk">Rowhead to CBX</span>
                                                    <input type="text" class="form-control" v-model="checkbox_list_remarks.rowhead_to_cbx_1">
                                                </div>
                                            </div>

                                            <div class="col-sm-6 mb15" v-if="checkbox_list.rowhead_to_cbx_2">
                                                <div class="input-group">
                                                    <span class="input-group-addon asterisk">Rowhead to CBX'</span>
                                                    <input type="text" class="form-control" v-model="checkbox_list_remarks.rowhead_to_cbx_2">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="input-group remark-list" v-if="checkbox_list.distance_between_poles">
                                            <span class="input-group-addon asterisk">Distance between poles</span>
                                            <input type="text" class="form-control" v-model="checkbox_list_remarks.distance_between_poles">
                                        </div>

                                        <textarea rows="10"  class="form-control" v-model="project_form.remarks" placeholder="Remarks"></textarea>
                                    </div>
                                </div>


                                <div class="form-group  ">
                                    <label class="col-sm-2 asterisk control-label">产品型号</label>
                                    <div class="col-sm-8">

                                    </div>
                                </div>


                            </div>
                        </div>


                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8">
                            <div class="btn-group pull-right">
                                <button v-on:click="saveProject" type="button" class="btn btn-primary"
                                        :disabled="loading.project">Submit <i v-if="loading.project"
                                                                               class="fa fa-spinner fa-spin"></i></button>
                            </div>
                        </div>
                    </div>


                    <!-- /.box-footer -->
                </form>

            </div>
        </div>
    </div>
</template>

<script src="./resources/js/helps.js"></script>
<script>
    export default {
        data() {
            return {
                companies:[],
                loading:{
                    project:false
                },
                checkbox_list:{
                    solar_module:false,
                    length:false,
                    width:false,
                    pos_color:false,
                    neg_color:false,
                    connector:false,
                    fuse:false,
                    junction_box_to_rack_1:false,
                    junction_box_to_rack_2:false,
                    module_to_module_extender:false,
                    end_of_extender:false,
                    layout_of_whip:false,
                    rowhead_to_cbx_1:false,
                    rowhead_to_cbx_2:false,
                    distance_between_poles:false,
                },
                checkbox_list_remarks:{
                    solar_module:'',
                    length:'',
                    width:'',
                    pos_color:'',
                    neg_color:'',
                    connector:'',
                    fuse:'',
                    junction_box_to_rack_1:'',
                    junction_box_to_rack_2:'',
                    module_to_module_extender:'',
                    end_of_extender:'',
                    layout_of_whip:'',
                    rowhead_to_cbx_1:'',
                    rowhead_to_cbx_2:'',
                    distance_between_poles:'',
                },
                project_form:{
                    company_id:'',
                    name:'',
                    address:'',
                    total_quantity:'', //项目Block总数
                    solar_module:'',
                    size_dc:'',
                    length:'',
                    width:'',
                    pos_color:'',//正极出线长
                    neg_color:'',//负极出线长
                    string_length:'',
                    connector:'',
                    fuse:'',
                    junction_box_to_rack_1:'',
                    junction_box_to_rack_2:'',
                    module_to_module_extender:'',
                    end_of_extender:'UNKNOWN',
                    layout_of_whip:'0',
                    rowhead_to_cbx_1:'',
                    rowhead_to_cbx_2:'',
                    distance_between_poles:'',
                    remarks:'',
                    remark_list:{},
                }
            }
        },

        mounted(){
            $('#company_id').select2({
                placeholder : 'Please choose',
                allowClear: true, //选中项可清空
            }).on('change', (e) => {
                this.project_form[e.target.name] = e.currentTarget.value
            })

            $('#option_one').popover({
                trigger : 'hover',
                html:true,
                content:"<img style='width:80%' src='/images/option_one.png'>"
            });

            $('#option_two').popover({
                trigger : 'hover',//鼠标以上时触发弹出提示框
                html:true,//开启html 为true的话，data-content里就能放html代码了
                content:"<img style='width:80%' src='/images/option_two.png'>"
            });

            $('#option_cab').popover({
                trigger : 'hover',
                html:true,
                content:"<img style='width:80%' src='/images/option_cab.png'>"
            });

            $('#option_trench').popover({
                trigger : 'hover',//鼠标以上时触发弹出提示框
                html:true,//开启html 为true的话，data-content里就能放html代码了
                content:"<img style='width:80%' src='/images/option_trench.png'>"
            });
        },

        created() {
            this.$watch('project_form.board_width', ()=>{
                this.project_form.string_length = ''
            })

            this.$watch('project_form.layout_of_whip', ()=>{
                if(this.project_form.layout_of_whip == '0'){
                    this.project_form.rowhead_to_cbx_1 = ''
                    this.checkbox_list.rowhead_to_cbx_1=false
                    this.checkbox_list_remarks.rowhead_to_cbx_1=''
                    this.project_form.rowhead_to_cbx_2 = ''
                    this.checkbox_list.rowhead_to_cbx_2=false
                    this.checkbox_list_remarks.rowhead_to_cbx_2=''
                    this.project_form.distance_between_poles = ''
                    this.checkbox_list.distance_between_poles=false
                    this.checkbox_list_remarks.distance_between_poles=''
                }
                if(this.project_form.layout_of_whip == '1'){
                    this.project_form.rowhead_to_cbx_2 = ''
                    this.checkbox_list.rowhead_to_cbx_2=false
                    this.checkbox_list_remarks.rowhead_to_cbx_2=''
                }
            })


            axios.get('/admin/company-list').then(response => {
                this.companies = response.data.data
            })

        },

        methods: {
            saveProject(){
                this.project_form.remark_list = {};

                for(let i in this.checkbox_list){
                    if(this.checkbox_list[i]){
                        if(this.checkbox_list_remarks[i]==''){
                            toastr.error('The remarks field is required.')
                            this.project_form.remark_list = {};
                            return false;
                        }else{
                            this.project_form.remark_list[i] = this.checkbox_list_remarks[i];
                        }
                    }
                }

                this.loading.project = true
                axios({
                    method: 'post',
                    url: '/admin/projects',
                    data: this.project_form
                }).then(response => {
                    if (response.data.status) {
                        swal(
                            "SUCCESS",
                            response.data.message,
                            'success'
                        ).then(function () {
                            location.href='/admin/projects'
                        })
                    }
                    // this.loading.project = false
                }).catch(error => {
                    this.loading.project = false
                    toastr.error(error.response.data.message)
                });
            },

            ceilDecimal(number, ceil = 3) {
                let str = '';
                for (let i = 1; i <= ceil; i++) {
                    str += 0
                }
                str = parseInt('1' + str)

                return Math.ceil(number * str) / str
            }

        },
    }
</script>

<style>
    .mb15{
        margin-bottom: 15px;
    }

    .popover{
        max-width:unset !important;
        width: 100%;
    }

    .form-control[readonly]{
        background-color: #fbfbfb;
    }

    .input-group span.asterisk:before {
        content: "* ";
        color: red;
    }

    .select2{
        width:100% !important;
    }

    .checked{
        color: #dd4b39 !important;
        border-color: #dd4b39 !important;
    }

    .border-red{
        border-color: #dd4b39 !important;
    }

    .remark-list {
        margin-bottom: 10px;
    }
</style>
