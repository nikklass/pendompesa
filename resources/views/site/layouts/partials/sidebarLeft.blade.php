<div class="fixed-sidebar-left">
   <ul class="nav navbar-nav side-nav nicescroll-bar">
      <li class="navigation-header">
         <span>
            @if (Auth::user())
               {{ Auth::user()->first_name }} 
               &nbsp; 
               {{ Auth::user()->last_name }}
            @endif
         </span> 
      </li>

      <li>
         <a href="{{ route('home') }}" class="active">
            <div class="pull-left">
               <i class="zmdi zmdi-landscape mr-20"></i>
               <span class="right-nav-text">Dashboard</span>
            </div>
            <div class="pull-right">
            </div>
            <div class="clearfix"></div>
         </a>
      </li>

      @if (Auth::user())

         @if (Auth::user()->hasRole('superadministrator'))

         <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#perms_dr">
               <div class="pull-left">
                  <i class="zmdi zmdi-lock-outline mr-20"></i>
                  <span class="right-nav-text">Permissions </span>
               </div>
               <div class="pull-right">
                  <i class="zmdi zmdi-caret-down"></i>
               </div>
               <div class="clearfix"></div>
            </a>
            <ul id="perms_dr" class="collapse collapse-level-1">
               
               <li>
                  <a href="{{ route('permissions.create') }}">
                     <i class="zmdi zmdi-accounts-add mr-10"></i>
                     <span class="right-nav-text">Create Permission</span>
                  </a>
               </li>
               <li>
                  <a href="{{ route('permissions.index') }}">
                     <i class="fa fa-users mr-10"></i>
                     <span class="right-nav-text">Manage Permissions</span>
                  </a>
               </li>

            </ul>
         </li>

         <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#roles_dr">
               <div class="pull-left">
                  <i class="zmdi zmdi-lock-outline mr-20"></i>
                  <span class="right-nav-text">Roles </span>
               </div>
               <div class="pull-right">
                  <i class="zmdi zmdi-caret-down"></i>
               </div>
               <div class="clearfix"></div>
            </a>
            <ul id="roles_dr" class="collapse collapse-level-1">
               
               <li>
                  <a href="{{ route('roles.create') }}">
                     <i class="zmdi zmdi-accounts-add mr-10"></i>
                     <span class="right-nav-text">Create Role</span>
                  </a>
               </li>
               <li>
                  <a href="{{ route('roles.index') }}">
                     <i class="fa fa-users mr-10"></i>
                     <span class="right-nav-text">Manage Roles</span>
                  </a>
               </li>

            </ul>
         </li>

         @endif

      @endif

      <li>
         <a href="javascript:void(0);" data-toggle="collapse" data-target="#groups_dr">
            <div class="pull-left">
               <i class="zmdi zmdi-apps mr-20"></i>
               <span class="right-nav-text">User Groups </span>
            </div>
            <div class="pull-right">
               <i class="zmdi zmdi-caret-down"></i>
            </div>
            <div class="clearfix"></div>
         </a>
         <ul id="groups_dr" class="collapse collapse-level-1">
            
            <li>
               <a href="{{ route('groups.create') }}">
                  <i class="zmdi zmdi-accounts-add mr-10"></i>
                  <span class="right-nav-text">Create Group</span>
               </a>
            </li>
            <li>
               <a href="{{ route('groups.index') }}">
                  <i class="fa fa-users mr-10"></i>
                  <span class="right-nav-text">Manage Groups</span>
               </a>
            </li>

         </ul>
      </li>

      <li>
         <a href="javascript:void(0);" data-toggle="collapse" data-target="#users_dr">
            <div class="pull-left">
               <i class="zmdi zmdi-accounts mr-20"></i>
               <span class="right-nav-text">Users </span>
            </div>
            <div class="pull-right">
               <i class="zmdi zmdi-caret-down"></i>
            </div>
            <div class="clearfix"></div>
         </a>
         <ul id="users_dr" class="collapse collapse-level-1">
            
            <li>
               <a href="{{ route('users.create') }}">
                  <i class="zmdi zmdi-account-add mr-10"></i>
                  <span class="right-nav-text">Create Single</span>
               </a>
            </li>
            <li>
               <a href="{{ route('bulk-users.create') }}">
                  <i class="zmdi zmdi-accounts-add mr-10"></i>
                  <span class="right-nav-text">Create Bulk</span>
               </a>
            </li>
            <li>
               <a href="{{ route('users.index') }}">
                  <i class="zmdi zmdi-accounts-list mr-10"></i>
                  <span class="right-nav-text">Manage Users</span>
               </a>
            </li>

         </ul>
      </li>


      <li>
         <a href="javascript:void(0);" data-toggle="collapse" data-target="#manage_dr">
            <div class="pull-left">
               <i class="zmdi zmdi-apps mr-20"></i>
               <span class="right-nav-text">Manage </span>
            </div>
            <div class="pull-right">
               <i class="zmdi zmdi-caret-down"></i>
            </div>
            <div class="clearfix"></div>
         </a>
         <ul id="manage_dr" class="collapse collapse-level-1">

            <li>
               <a href="javascript:void(0);" data-toggle="collapse" data-target="#countries_dr">
                  <div class="pull-left">
                     <i class="zmdi zmdi-apps mr-20"></i>
                     <span class="right-nav-text">Countries </span>
                  </div>
                  <div class="pull-right">
                     <i class="zmdi zmdi-caret-down"></i>
                  </div>
                  <div class="clearfix"></div>
               </a>
               <ul id="countries_dr" class="collapse collapse-level-1 space-left">
                  
                  <li>
                     <a href="{{ route('countries.create') }}">
                        <i class="zmdi zmdi-plus mr-10"></i>
                        <span class="right-nav-text">Add New</span>
                     </a>
                  </li>
                  <li>
                     <a href="{{ route('countries.index') }}">
                        <i class="zmdi zmdi-apps mr-10"></i>
                        <span class="right-nav-text">Manage</span>
                     </a>
                  </li>

               </ul>
            </li>  

            <li>
               <a href="javascript:void(0);" data-toggle="collapse" data-target="#states_dr">
                  <div class="pull-left">
                     <i class="zmdi zmdi-apps mr-20"></i>
                     <span class="right-nav-text">States </span>
                  </div>
                  <div class="pull-right">
                     <i class="zmdi zmdi-caret-down"></i>
                  </div>
                  <div class="clearfix"></div>
               </a>
               <ul id="states_dr" class="collapse collapse-level-1 space-left">
                  
                  <li>
                     <a href="{{ route('states.create') }}">
                        <i class="zmdi zmdi-plus mr-10"></i>
                        <span class="right-nav-text">Add New</span>
                     </a>
                  </li>
                  <li>
                     <a href="{{ route('states.index') }}">
                        <i class="zmdi zmdi-apps mr-10"></i>
                        <span class="right-nav-text">Manage</span>
                     </a>
                  </li>

               </ul>
            </li>  

            <li>
               <a href="javascript:void(0);" data-toggle="collapse" data-target="#leadershipteam_dr">
                  <div class="pull-left">
                     <i class="zmdi zmdi-apps mr-20"></i>
                     <span class="right-nav-text">Leadership Team </span>
                  </div>
                  <div class="pull-right">
                     <i class="zmdi zmdi-caret-down"></i>
                  </div>
                  <div class="clearfix"></div>
               </a>
               <ul id="leadershipteam_dr" class="collapse collapse-level-1 space-left">
                  
                  <li>
                     <a href="{{ route('leadership-teams.create') }}">
                        <i class="zmdi zmdi-plus mr-10"></i>
                        <span class="right-nav-text">Add New</span>
                     </a>
                  </li>
                  <li>
                     <a href="{{ route('leadership-teams.index') }}">
                        <i class="zmdi zmdi-apps mr-10"></i>
                        <span class="right-nav-text">Manage</span>
                     </a>
                  </li>

               </ul>
            </li> 

            <li>
               <a href="javascript:void(0);" data-toggle="collapse" data-target="#ebooks_dr">
                  <div class="pull-left">
                     <i class="zmdi zmdi-apps mr-20"></i>
                     <span class="right-nav-text">Ebooks </span>
                  </div>
                  <div class="pull-right">
                     <i class="zmdi zmdi-caret-down"></i>
                  </div>
                  <div class="clearfix"></div>
               </a>
               <ul id="ebooks_dr" class="collapse collapse-level-1 space-left">
                  
                  <li>
                     <a href="{{ route('ebooks.create') }}">
                        <i class="zmdi zmdi-plus mr-10"></i>
                        <span class="right-nav-text">Add New</span>
                     </a>
                  </li>
                  <li>
                     <a href="{{ route('ebooks.index') }}">
                        <i class="zmdi zmdi-apps mr-10"></i>
                        <span class="right-nav-text">Manage</span>
                     </a>
                  </li>

               </ul>
            </li>  

            <li>
               <a href="javascript:void(0);" data-toggle="collapse" data-target="#quotes_dr">
                  <div class="pull-left">
                     <i class="zmdi zmdi-apps mr-20"></i>
                     <span class="right-nav-text">Quotes </span>
                  </div>
                  <div class="pull-right">
                     <i class="zmdi zmdi-caret-down"></i>
                  </div>
                  <div class="clearfix"></div>
               </a>
               <ul id="quotes_dr" class="collapse collapse-level-1 space-left">
                  
                  <li>
                     <a href="{{ route('quotes.create') }}">
                        <i class="zmdi zmdi-plus mr-10"></i>
                        <span class="right-nav-text">Add New</span>
                     </a>
                  </li>
                  <li>
                     <a href="{{ route('quotes.index') }}">
                        <i class="zmdi zmdi-apps mr-10"></i>
                        <span class="right-nav-text">Manage</span>
                     </a>
                  </li>

               </ul>
            </li>         

         </ul>
      </li>


      <li><hr class="light-grey-hr mb-10"/></li>

      <li>
         <a href="javascript:void(0);" data-toggle="collapse" data-target="#prayercenter_dr">
            <div class="pull-left">
               <i class="zmdi zmdi-apps mr-20"></i>
               <span class="right-nav-text">Prayer Center </span>
            </div>
            <div class="pull-right">
               <i class="zmdi zmdi-caret-down"></i>
            </div>
            <div class="clearfix"></div>
         </a>
         <ul id="prayercenter_dr" class="collapse collapse-level-1">

            <li>
               <a href="javascript:void(0);" data-toggle="collapse" data-target="#prayerpoints_dr">
                  <div class="pull-left">
                     <i class="zmdi zmdi-apps mr-20"></i>
                     <span class="right-nav-text">Prayer Points </span>
                  </div>
                  <div class="pull-right">
                     <i class="zmdi zmdi-caret-down"></i>
                  </div>
                  <div class="clearfix"></div>
               </a>
               <ul id="prayerpoints_dr" class="collapse collapse-level-1 space-left">
                  
                  <li>
                     <a href="{{ route('prayer-points.create') }}">
                        <i class="zmdi zmdi-plus mr-10"></i>
                        <span class="right-nav-text">Add New</span>
                     </a>
                  </li>

                  <li>
                     <a href="{{ route('prayer-points.index') }}">
                        <i class="zmdi zmdi-apps mr-10"></i>
                        <span class="right-nav-text">Manage</span>
                     </a>
                  </li>
                  
               </ul>
            </li>

            <li>
               <a href="javascript:void(0);" data-toggle="collapse" data-target="#prayerrequests_dr">
                  <div class="pull-left">
                     <i class="zmdi zmdi-apps mr-20"></i>
                     <span class="right-nav-text">Prayer Requests </span>
                  </div>
                  <div class="pull-right">
                     <i class="zmdi zmdi-caret-down"></i>
                  </div>
                  <div class="clearfix"></div>
               </a>
               <ul id="prayerrequests_dr" class="collapse collapse-level-1 space-left">
                  
                  <li>
                     <a href="{{ route('prayer-requests.create') }}">
                        <i class="zmdi zmdi-plus mr-10"></i>
                        <span class="right-nav-text">Add New</span>
                     </a>
                  </li>

                  <li>
                     <a href="{{ route('prayer-requests.index') }}">
                        <i class="zmdi zmdi-apps mr-10"></i>
                        <span class="right-nav-text">Manage</span>
                     </a>
                  </li>
                  
               </ul>
            </li>

         </ul>
      </li>


      <li>
         <a href="javascript:void(0);" data-toggle="collapse" data-target="#globalaltars_dr">
            <div class="pull-left">
               <i class="zmdi zmdi-apps mr-20"></i>
               <span class="right-nav-text">Global Altars </span>
            </div>
            <div class="pull-right">
               <i class="zmdi zmdi-caret-down"></i>
            </div>
            <div class="clearfix"></div>
         </a>
         <ul id="globalaltars_dr" class="collapse collapse-level-1">

            <li>
               <a href="javascript:void(0);" data-toggle="collapse" data-target="#manageglobalaltars_dr">
                  <div class="pull-left">
                     <i class="zmdi zmdi-apps mr-20"></i>
                     <span class="right-nav-text">Manage Global Altars </span>
                  </div>
                  <div class="pull-right">
                     <i class="zmdi zmdi-caret-down"></i>
                  </div>
                  <div class="clearfix"></div>
               </a>
               <ul id="manageglobalaltars_dr" class="collapse collapse-level-1 space-left">
                  
                  <li>
                     <a href="{{ route('global-altars.create') }}">
                        <i class="zmdi zmdi-plus mr-10"></i>
                        <span class="right-nav-text">Add New</span>
                     </a>
                  </li>

                  <li>
                     <a href="{{ route('global-altars.index') }}">
                        <i class="zmdi zmdi-apps mr-10"></i>
                        <span class="right-nav-text">Manage</span>
                     </a>
                  </li>
                  
               </ul>
            </li>

            <li>
               <a href="javascript:void(0);" data-toggle="collapse" data-target="#coordinators_dr">
                  <div class="pull-left">
                     <i class="zmdi zmdi-apps mr-20"></i>
                     <span class="right-nav-text">Coordinators </span>
                  </div>
                  <div class="pull-right">
                     <i class="zmdi zmdi-caret-down"></i>
                  </div>
                  <div class="clearfix"></div>
               </a>
               <ul id="coordinators_dr" class="collapse collapse-level-1 space-left">
                  
                  <li>
                     <a href="{{ route('coordinators.create') }}">
                        <i class="zmdi zmdi-plus mr-10"></i>
                        <span class="right-nav-text">Add New</span>
                     </a>
                  </li>

                  <li>
                     <a href="{{ route('coordinators.index') }}">
                        <i class="zmdi zmdi-apps mr-10"></i>
                        <span class="right-nav-text">Manage</span>
                     </a>
                  </li>
                  
               </ul>
            </li>

            <li>
               <a href="javascript:void(0);" data-toggle="collapse" data-target="#statereps_dr">
                  <div class="pull-left">
                     <i class="zmdi zmdi-apps mr-20"></i>
                     <span class="right-nav-text">State Representatives </span>
                  </div>
                  <div class="pull-right">
                     <i class="zmdi zmdi-caret-down"></i>
                  </div>
                  <div class="clearfix"></div>
               </a>
               <ul id="statereps_dr" class="collapse collapse-level-1 space-left">
                  
                  <li>
                     <a href="{{ route('state-representatives.create') }}">
                        <i class="zmdi zmdi-plus mr-10"></i>
                        <span class="right-nav-text">Add New</span>
                     </a>
                  </li>

                  <li>
                     <a href="{{ route('state-representatives.index') }}">
                        <i class="zmdi zmdi-apps mr-10"></i>
                        <span class="right-nav-text">Manage</span>
                     </a>
                  </li>
                  
               </ul>
            </li>

         </ul>
      </li>


      <li><hr class="light-grey-hr mb-10"/></li>

      <li>
         <a href="javascript:void(0);" data-toggle="collapse" data-target="#sms_dr">
            <div class="pull-left">
               <i class="zmdi zmdi-smartphone mr-20"></i>
               <span class="right-nav-text">SMS</span>
            </div>
            <div class="pull-right">
               <i class="zmdi zmdi-caret-down"></i>
            </div>
            <div class="clearfix"></div>
         </a>
         <ul id="sms_dr" class="collapse collapse-level-1 two-col-list">
            <li>
               <a href="javascript:void(0);" data-toggle="collapse" data-target="#bulksms_dr">
                  <div class="pull-left">
                     <span class="right-nav-text">Bulk SMS</span>
                  </div>
                  <div class="pull-right">
                     <i class="zmdi zmdi-caret-down"></i>
                  </div>
                  <div class="clearfix"></div>
               </a>
               <ul id="bulksms_dr" class="collapse collapse-level-1 two-col-list">
                  <li>
                     <a href="{{ route('smsoutbox.create') }}">Send SMS</a>
                  </li>
                  <li>
                     <a href="{{ route('scheduled-smsoutbox.index') }}">Scheduled SMS</a>
                  </li>
                  <li>
                     <a href="{{ route('smsoutbox.index') }}">My Outbox</a>
                  </li>
                  <!-- <li>
                     <a href="modals.php">Analytics</a>
                  </li> -->
               </ul>
            </li>
            
            <li>
               <a href="#">Inbox</a>
            </li>
            <!-- <li>
               <a href="notifications.php">Short Codes</a>
            </li> -->
            
         </ul>
      </li>

      <li>
         <a href="javascript:void(0);" data-toggle="collapse" data-target="#mpesa_dr">
            <div class="pull-left">
               <i class="zmdi zmdi-money mr-20"></i>
               <span class="right-nav-text">Donations</span>
            </div>
            <div class="pull-right">
               <i class="zmdi zmdi-caret-down"></i>
            </div>
            <div class="clearfix"></div>
         </a>

         <ul id="mpesa_dr" class="collapse collapse-level-1 two-col-list">
            
            <li>
               <a href="{{ route('mpesa-incoming.index') }}">
                  <div class="pull-left">
                     <span class="right-nav-text">Manage Mpesa</span>
                  </div>
                  <div class="pull-right">
                  </div>
                  <div class="clearfix"></div>
               </a>
            </li>
           
         </ul>
      </li>

      <li><hr class="light-grey-hr mb-10"/></li>

      <li>
         <a href="javascript:void(0);" data-toggle="collapse" data-target="#account_dr">
            <div class="pull-left">
               <i class="zmdi zmdi-account mr-20"></i>
               <span class="right-nav-text">My Account</span>
            </div>
            <div class="pull-right">
               <i class="zmdi zmdi-caret-down"></i>
            </div>
            <div class="clearfix"></div>
         </a>
         <ul id="account_dr" class="collapse collapse-level-1 two-col-list">
            <li>
               <a href="{{ route('user.profile') }}">
                  Profile
               </a>
            </li>
            <li>
               <a href="#" data-toggle="modal" data-target="#password-modal">Change Password</a>
            </li>
            
         </ul>
      </li>

      @if (Auth::user())

         <li>
               <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                  <div class="pull-left">
                     <i class="zmdi zmdi-power mr-20"></i>
                     <span class="right-nav-text">Log Out</span>
                  </div>
                  
                  <div class="clearfix"></div>
               </a>
               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                   {{ csrf_field() }}
               </form>

         </li>

      @endif

   </ul>
</div>



<!-- /.modal -->
<div id="password-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 class="modal-title">Change Password</h5>
         </div>
         <div class="modal-body">
            <form method="POST"> 
               {{ csrf_field() }}
               <div class="form-group">
                  <label for="old_password" class="control-label mb-10">Old Password:</label>
                  <input type="text" class="form-control" id="old_password" name="old_password">
               </div>
               <hr>
               <div class="form-group">
                  <label for="new_password1" class="control-label mb-10">New Password:</label>
                  <input type="text" class="form-control" id="new_password1" name="new_password1">
               </div>
               <div class="form-group">
                  <label for="new_password2" class="control-label mb-10">New Password Repeat:</label>
                  <input type="text" class="form-control" id="new_password2" name="new_password2">
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger">Save changes</button>
         </div>
      </div>
   </div>
</div>
<!-- Button trigger modal -->