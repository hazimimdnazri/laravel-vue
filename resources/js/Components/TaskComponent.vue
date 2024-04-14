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
                                    <tr >
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
export default {
    name: 'task-component',
    props: ['root_url', '_token'],
    mounted(){
        this.dt = new DataTable('#taskList', {
            bLengthChange: false,
            searchDelay: 500,
            serverSide: true,
            ajax : {
                url: this.root_url+'/api/tasks',
            },
            columns: [
                {class: 'align-middle', data: "task" },
                {class: 'align-middle', data: "remark" },
                {class: 'align-middle text-center', data: "added_by" },
                {
                    class: 'text-center align-middle px-2',
                    orderable: false,
                    render: function (data, type, row) {
                        return customJs.decodeEntities(row.status)
                    },
                },
                {
                    class: 'text-center align-middle',
                    orderable: false,
                    render: function (data, type, row) {
                        return `
                            <button class='btn btn-info' onClick="modalTask(${row.id})"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class='btn btn-danger' onClick="deleteTask(${row.id})"><i class="fa-solid fa-trash"></i></button>
                        `
                    },
                }
            ]
        })
    },
    methods: {
        modalTask () {
            customJs.runLoader('load')
            
            $.ajax({
                type:"POST",
                url: "tasks/modal-task",
                data: {
                    '_token': this._token,
                }
            }).done((response) => {
                $("#variable").html(response)
                this.pwModal = new Modal(document.getElementById('modal-task'), { keyboard: false })
                this.pwModal.show();
                customJs.closeLoader()
            });
        },
    }
}
</script>