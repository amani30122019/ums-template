 <div class="modal fade createUserModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title text-center">Register User</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form id="create-user-form">
                     <div class="mb-3">
                         <label class="mb-2">Name <span class="text-danger">*</span></label>
                         <div class="row gx-3">
                             <div class="col-md-6 mb-2 mb-md-0">
                                 <input type="text" name="first_name" id="fname" class="form-control fs-13px"
                                     placeholder="First name" value="{{ old('first_name') }}"
                                     data-parsley-required-message="Please enter your First name "
                                     data-parsley-required />
                                 <span class="text-danger  error-text first_name_error"></span>
                             </div>
                             <div class="col-md-6">
                                 <input type="text" class="form-control fs-13px" placeholder="Last name" id="lname"
                                     name="last_name" value="{{ old('last_name') }}"
                                     data-parsley-required-message="Please enter your Last name"
                                     data-parsley-required />
                                 <span class="text-danger  error-text last_name_error"></span>
                             </div>
                         </div>
                     </div>
                     <div class="form-group mb-3">
                         <strong>Email:</strong>
                         <input type="email" name="email" id="email" placeholder="Email" class="form-control">
                         <span class="text-danger  error-text email_error"></span>

                     </div>
                     <div class="form-group mb-3">
                         <strong>Password:</strong>
                         <input type="password" name="password" id="password" placeholder="Password"
                             class="form-control">
                         <span class="text-danger  error-text password_error"></span>

                     </div>
                     <div class="form-group mb-3">
                         <strong>Confirm Password:</strong>
                         <input type="password" name="cpassword" id="cpassword" placeholder="confirm password"
                             class="form-control">
                         <span class="text-danger  error-text cpassword_error"></span>

                     </div>
                     <div class="form-group mb-3">
                         <strong>Role:</strong>
                         <select class="form-control multiple" name="roles[]" id="role">
                             <option value="" disabled selected hidden class="text-gray">Choose User's Role...
                                 eg Accountant</option>
                             @foreach ($roles as $key => $role)
                                 <option value="{{ $key }}">
                                     {{ $role }}
                                 </option>
                             @endforeach
                         </select>
                         <span class="text-danger  error-text roles_error"></span>

                     </div>
                     <div class="my-3">
                         <button type="submit" class="btn btn-primary">Submit</button>
                     </div>

                 </form>
             </div>
         </div>
     </div>
 </div>
