 <div class="modal fade createRoleModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title text-center">Add role</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form action="" id="create-role-form">
                     <div class="form-group">
                         <strong>Name of Role:</strong>
                         <input type="text" name="name" id="rname" class="form-control" placeholder="Role name">
                     </div>
                     <span class="text-danger  error-text name_error"></span>
                     <div class="form-group mt-2">
                         <strong>Permission:</strong>
                         <br />
                         @foreach ($permissions as $permission)
                             <label>
                                 <input type="checkbox" name="permissions[]" class="name" id="permissions"
                                     value="{{ $permission->id }}">
                                 {{ $permission->name }}
                             </label>
                             <br />
                         @endforeach
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
