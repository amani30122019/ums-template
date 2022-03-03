 <div id="sidebar" class="app-sidebar">

     <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">

         <div class="menu">
             <div class="menu-profile">
                 <a href="javascript:;" class="menu-profile-link" data-toggle="app-sidebar-profile"
                     data-target="#appSidebarProfileMenu">
                     <div class="menu-profile-cover with-shadow"></div>
                     <div class="menu-profile-image">
                         <img src="../assets/img/user/user-13.jpg" alt="" />
                     </div>
                     <div class="menu-profile-info">
                         <div class="d-flex align-items-center">
                             <div class="flex-grow-1">
                                 Sean Ngu
                             </div>
                             <div class="menu-caret ms-auto"></div>
                         </div>
                         <small>Front end developer</small>
                     </div>
                 </a>
             </div>
             <div id="appSidebarProfileMenu" class="collapse">
                 <div class="menu-item pt-5px">
                     <a href="javascript:;" class="menu-link">
                         <div class="menu-icon"><i class="fa fa-cog"></i></div>
                         <div class="menu-text">Settings</div>
                     </a>
                 </div>
                 <div class="menu-item">
                     <a href="javascript:;" class="menu-link">
                         <div class="menu-icon"><i class="fa fa-pencil-alt"></i></div>
                         <div class="menu-text"> Send Feedback</div>
                     </a>
                 </div>
                 <div class="menu-item pb-5px">
                     <a href="javascript:;" class="menu-link">
                         <div class="menu-icon"><i class="fa fa-question-circle"></i></div>
                         <div class="menu-text"> Helps</div>
                     </a>
                 </div>
                 <div class="menu-divider m-0"></div>
             </div>
             <div class="menu-header">Navigation</div>
             <div class="menu-item">
                 @can('user-list')
                     <a href="{{ route('index.users') }}" class="menu-link">
                         <div class="menu-icon">
                             <i class="fa fa-users"></i>
                         </div>
                         <div class="menu-text">Users</div>
                     </a>
                 @endcan
             </div>
             <div class="menu-item">
                 @can('permission-list')
                     <a href="{{ route('index.permissions') }}" class="menu-link">
                         <div class="menu-icon">
                             <i class="fa fa-lock"></i>
                         </div>
                         <div class="menu-text">Permissions</div>
                     </a>
                 @endcan
             </div>
             <div class="menu-item">
                 @can('role-list')
                     <a href="{{ route('roles.index') }}" class="menu-link">
                         <div class="menu-icon">
                             <i class="fa fa-tasks"></i>
                         </div>
                         <div class="menu-text">Roles</div>
                     </a>
                 @endcan
             </div>
             <div class="menu-item">
                 @can('post-list')
                     <a href="{{ route('posts.index') }}" class="menu-link">
                         <div class="menu-icon">
                             <i class="fa fa-comment"></i>
                         </div>
                         <div class="menu-text">Posts</div>
                     </a>
                 @endcan
             </div>
         </div>

     </div>

 </div>
 <div class="app-sidebar-bg"></div>
 <div class="app-sidebar-mobile-backdrop"><a href="index.html#" data-dismiss="app-sidebar-mobile"
         class="stretched-link"></a></div>
