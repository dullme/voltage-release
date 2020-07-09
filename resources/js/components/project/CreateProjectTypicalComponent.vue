<template>
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Create</h3>

            <div class="box-tools">
                <div class="btn-group pull-right" style="margin-right: 5px">
                    <a :href="'/admin/projects/info/' + project_id" class="btn btn-sm btn-default" title="List"><i
                        class="fa fa-list"></i><span class="hidden-xs">&nbsp;List</span></a>
                </div>

                <div class="btn-group pull-right" style="margin-right: 5px">
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                            data-target="#addTypical">
                        <i class="fa fa-plus"></i><span class="hidden-xs">&nbsp;&nbsp;Add Typical</span>
                    </button>
                </div>

            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="col-sm-12">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Combinations</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

        </div>

        <div class="modal fade in" id="addTypical">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Add Typical：<span class="po_client_no"></span></h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="form-group ">
<!--                                <div class="col-sm-12">-->
<!--                                    <div class="input-group"><label class="input-group-addon">Typical Name</label>-->
<!--                                        <input type="text" class="form-control">-->
<!--                                    </div>-->
<!--                                </div>-->
                                <div class="col-sm-12">
                                    <table class="table table-hover" id="table-fields">
                                        <tbody>
                                            <tr>
                                                <th width="100%">Combination</th>
                                                <th>Action</th>
                                            </tr>
                                            <tr v-for="(item,key) in form_data.items">
                                                <td>
                                                    <select class="form-control" v-model="item.combination">
                                                        <option v-for="combination in combinations" :value="combination.id">{{ combination.name }}</option>
                                                    </select>
                                                </td>
                                                <td><a class="btn btn-sm btn-danger table-field-remove" @click="deleteItem(key)"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr style="margin-top: 0;">
                                    <div class="form-inline margin" style="width: 100%">
                                        <div class="form-group">
                                            <button type="button" @click="addItem" class="btn btn-sm btn-success" id="add-table-field">
                                                <i class="fa fa-plus"></i>&nbsp;&nbsp;Add
                                            </button>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer" style="clear: both">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button v-on:click="submit" type="button" class="btn btn-primary">Submit <i v-if="loading.submit" class="fa fa-spinner fa-spin"></i></button>
                    </div>

                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>




    </div>
</template>

<script>
    export default {
        data() {
            return {
                loading:{
                  submit:false
                },
                project_id:'',
                combinations:[],
                form_data: {
                    items: [], //产品
                },
            }
        },

        computed:{},
        watch:{},
        props: [
            'project', //项目
        ],

        created() {
            let project = JSON.parse(this.project);
            this.project_id = project.id

            axios.get('/admin/combination-list').then(response => {
                this.combinations = response.data.data
            })
        },

        mounted() {},

        methods: {
            addItem(){
                if(this.form_data.items.length == 0 || this.form_data.items[this.form_data.items.length - 1]['combination'] !=''){
                    this.form_data.items.push({
                        combination:'',
                    })
                }

            },

            deleteItem(key){
                this.form_data.items.splice(key, 1)
            },

            submit(){
                this.loading.submit = true
            }
        }
    }
</script>
