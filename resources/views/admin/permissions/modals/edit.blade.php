<div class="modal fade editPermissionModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center">Edit permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-permission-form">
                    <input type="hidden" name="pid">
                    <div class="form-group">
                        <strong>Permission name:</strong>
                        <input type="text" name="permission_name" placeholder="persimission" class="form-control">
                        <span class="text-danger  error-text permission_name_error"></span>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
