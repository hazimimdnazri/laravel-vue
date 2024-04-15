@extends('layouts.main')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Tasks</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Tasks</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div id="variable"></div>

<task-component :root_url="'{{ url('/') }}'" :_token="'{{ csrf_token() }}'"></task-component>
@endsection

@section('postscript')
<script>
modalTask = (id) => {
    customJs.runLoader('load')
    $.ajax({
        type:"POST",
        url: "{{ url('tasks/modal-task') }}",
        data: {
            '_token': '{{ csrf_token() }}',
            'id' : id
        }
    }).done((response) => {
        $("#variable").html(response)
        this.pwModal = new Modal(document.getElementById('modal-task'), { keyboard: false })
        this.pwModal.show();
        customJs.closeLoader()
    });
}

deleteTask = (id) => {
    customJs.runLoader('load')
    $.ajax({
        type:"POST",
        url: "{{ url('tasks/modal-task') }}",
        data: {
            '_token': '{{ csrf_token() }}',
            'id' : id,
            'action': 'delete'
        }
    }).done((response) => {
        if(response.status == 'success'){
            customJs.runSuccess(response.message)
        } else {
            customJs.runError(response.message)
        }
    });
}
</script>
@endsection