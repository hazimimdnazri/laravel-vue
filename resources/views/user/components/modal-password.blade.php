<div class="modal fade" id="modal-password">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-black">
                <h4 class="modal-title">Change Password</h4>
            </div>
            <div class="modal-body">
                <form id="passwordData" class="row">
                    @csrf
                    <div class="col-md-12">
                        <label class="form-label">Current Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label class="form-label">New Password <span class="text-danger">*</span></label>
                        <input type="password" name="password_new" class="form-control">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label class="form-label">Confirm New Password <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirm" class="form-control">
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
        var formData = new FormData($('#passwordData')[0]);

        if ($('#passwordData')[0].checkValidity() === true) {
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