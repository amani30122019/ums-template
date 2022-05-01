 <div class="modal fade editPostModal" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title text-center">Edit Post</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <form data-parsley-validate id="form-edit-post">
                     @csrf
                     <input type="hidden" name="post_id" id="postId">
                     <div class="form-group">
                         <strong>Title:</strong>
                         <input type="text" name="title" id="title" class="form-control" placeholder="Title"
                             data-parsley-required data-parsley-required-message="Please fill in the Post title">
                         <span class="text-danger  error-text title_error"></span>
                     </div>
                     <div class="form-group mt-3">
                         <strong>Body:</strong>
                         <textarea name="body" id="body" cols="30" rows="5" class="form-control" placeholder="Type here the body message"
                             data-parsley-required
                             data-parsley-required-message="Please fill in the Post body"></textarea>
                         <span class="text-danger  error-text body_error"></span>
                     </div>
                     <div class="mt-3">
                         <button type="submit" class="btn btn-primary">Submit</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
