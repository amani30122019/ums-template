 <div class="modal fade editRoleModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title text-center">Edit role</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">

                 <form id="update-role-form">
                     <input type="hidden" name="rid">
                     <div class="form-group">
                         <strong>Name of Role:</strong>
                         <input type="text" name="name" id="rname" class="form-control" placeholder="Role name">
                     </div>
                     <span class="text-danger  error-text name_error"></span>
                     <div class="form-group mt-2">
                         <strong>Permission:</strong>
                         <br />
                         <ul id="permission-list">
                         </ul>

                     </div>
                     <span class="text-danger  error-text permissions_error"></span>
                     <div class="mt-2">
                         <button type="submit" class="btn btn-primary">Submit</button>
                     </div>


                 </form>
             </div>
         </div>
     </div>
 </div>
