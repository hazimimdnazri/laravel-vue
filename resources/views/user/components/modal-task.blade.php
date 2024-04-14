<div class="modal fade" id="modal-task">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-black">
                <h4 class="modal-title">Task Information</h4>
            </div>
            <div class="modal-body">
                <form id="taskData" class="row">
                    @csrf
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Task <span class="text-danger">*</span></label>
                        <input name="task" style="text-transform: uppercase" class="form-control" value="{{ $task->task }}" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-control">
                            <option value="1" {{ $task->status == 1 ? 'selected' : NULL }}>New</option>
                            <option value="2" {{ $task->status == 2 ? 'selected' : NULL }}>In Progress</option>
                            <option value="3" {{ $task->status == 3 ? 'selected' : NULL }}>Done</option>
                        </select>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label class="form-label">Remark <span class="text-danger">*</span></label>
                        <textarea name="remark" class="form-control" rows="5">{{ $task->remark }}</textarea>
                    </div>
                    <input type="hidden" name="id" value="{{ $task->id }}">
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onClick="submitTask()" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    submitTask = () => {
        var validateGroup = $(".needs-validation");
        var formData = new FormData($('#taskData')[0]);

        if ($('#taskData')[0].checkValidity() === true) {
            customJs.runLoader('save')

            $.ajax({
                url: "{{ url('tasks/store-task') }}",
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done((response) => {
                if(response.status == 'success'){
                    customJs.runSuccess(response.message)
                } else {
                    customJs.runAlertError(response.message)
                }
            });
        } else {
            customJs.runAlertError('Error!')
            for (var i = 0; i < validateGroup.length; i++) {
                validateGroup[i].classList.add('was-validated');
            }
        }
    }
</script>