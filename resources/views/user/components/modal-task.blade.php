<div class="modal fade" id="modal-task">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-black">
                <h4 class="modal-title">Task Information</h4>
            </div>
            <div class="modal-body">
                <form id="taskData" class="row">
                    @csrf
                    <div class="col-md-12">
                        <label class="form-label">Task <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label class="form-label">Description <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control" rows="5"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" onClick="submitPassword()" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    submitPassword = () => {
        var validateGroup = $(".needs-validation");
        var formData = new FormData($('#taskData')[0]);

        if ($('#taskData')[0].checkValidity() === true) {
            customJs.runLoader('save')

            $.ajax({
                url: "{{ url('ajax/change-password') }}",
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