 <div class="modal fade editUserModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header text-center">
                 <h5 class="modal-title ">Edit User</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form id="edit-user-form">
                     <input type="hidden" name="uid">
                     <div class="mb-3">
                         <label class="mb-2">Name <span class="text-danger">*</span></label>
                         <div class="row gx-3">
                             <div class="col-md-6 mb-2 mb-md-0">
                                 <input type="text" name="first_name" id="efname" class="form-control fs-13px"
                                     placeholder="First name"
                                     data-parsley-required-message="Please enter your First name "
                                     data-parsley-required />
                                 <span class="text-danger  error-text first_name_error"></span>
                             </div>
                             <div class="col-md-6">
                                 <input type="text" class="form-control fs-13px" placeholder="Last name" id="elname"
                                     name="last_name" data-parsley-required-message="Please enter your Last name"
                                     data-parsley-required />
                                 <span class="text-danger  error-text last_name_error"></span>
                             </div>
                         </div>
                     </div>
                     <div class="form-group mb-3">
                         <strong>Phone number:</strong>
                         <input type="numeric" class="form-control" name="phone" id="ephone"
                             onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                             placeholder="eg. 0655373778  ten digits only"
                             data-parsley-required-message="Please enter your Mobile phone number."
                             data-parsley-pattern="/^(0)(7(?:(?:[1345678][0-9]))[0-9]{6})|^(0)(6(?:(?:[25789][0-9]))[0-9]{6})$/"
                             data-parsley-pattern-message="Your Phone number must start with 0,  and valid in Tanzania ."
                             data-parsley-required>
                         <span class="text-danger  error-text phone_error"></span>
                     </div>
                     <div class="form-group">
                         <strong>Email:</strong>
                         <input type="email" name="email" id="eemail" placeholder="Email" class="form-control">
                         <span class="text-danger  error-text email_error"></span>

                     </div>

                     <div class="form-group">
                         <strong>Role:</strong>
                         <select class="form-control multiple" name="roles[]" id="select-role">
                             <option selected></option>
                             @foreach ($roles as $key => $role)
                                 <option value="{{ $key }}">
                                     {{ $role }}
                                 </option>
                             @endforeach
                         </select>
                         <span class="text-danger  error-text roles_error"></span>

                     </div>
                     <div class="mt-3">
                         <button type="submit" class="btn btn-primary">Submit</button>
                     </div>

                 </form>
             </div>
         </div>
     </div>
 </div>
