<template>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tasks List</h3>
                            <button class="btn btn-primary float-right" @click="modalTask">Add New Task</button>
                        </div>

                        <div class="card-body">
                            <table id="taskList" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Task</th>
                                        <th>Description</th>
                                        <th>Added By</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>          
                    </div>          
                </div>          
            </div>          
        </div>
    </div>
</template>

<script>
import 'admin-lte/plugins/bootstrap/js/bootstrap';
export default {
    name: 'task-component',
    props: ['root_url', '_token'],
    mounted(){
        this.dt = new DataTable(document.getElementById('taskList'))
    },
    methods: {
        modalTask () {
            customJs.runLoader('load')
            
            $.ajax({
                type:"POST",
                url: "ajax/modal-task",
                data: {
                    '_token': this._token,
                }
            }).done((response) => {
                $("#variable").html(response)
                this.pwModal = new Modal(document.getElementById('modal-task'), { keyboard: false })
                this.pwModal.show();
                customJs.closeLoader()
            });
        }
    }
}
</script>