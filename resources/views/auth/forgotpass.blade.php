@extends('admin.layouts.authMaster')

@section('title')
    Forgot Password
@endsection

@section('auth_text')
    Don't Have an Account Yet?
@endsection

@section('auth_button_text_url')
    /register
@endsection

@section('auth_button_text')
    Register
@endsection

@section('content')

    <div class="container-fluid">
       <!-- Row -->
       <div class="table-struct full-width full-height">
          <div class="table-cell vertical-align-middle auth-form-wrap">
             <div class="auth-form  ml-auto mr-auto no-float">
                <div class="row">
                   <div class="col-sm-12 col-xs-12">
                      
                      <div class="panel panel-default card-view">
                         
                         <div class="panel-wrapper collapse in">
                            
                            <div class="panel-body">               

                               <div class="mb-30">
                                  <h3 class="text-center txt-dark mb-10">Forgot Your Password?</h3>
                                  <h6 class="text-center nonecase-font txt-grey">
                                     Enter your email address below, and we’ll help you create a new password.
                                  </h6>
                               </div>   

                               <hr>

                               <div class="form-wrap">
                                  
                                  <form class="form-horizontal" method="POST" action="/user/forgotpass">
                                     
                                     {{ csrf_field() }}

                                     <div class="form-group">
                                        <label for="email" class="col-sm-3 control-label">
                                           Email Address
                                           <span class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-9">
                                           <div class="input-group">
                                              <input type="email" class="form-control" id="email" name="email">
                                              <div class="input-group-addon"><i class="icon-envelope-open"></i></div>
                                           </div>
                                        </div>
                                     </div>

                                     <br/>

                                     <div class="form-group">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9">
                                           <button type="submit" class="btn btn-success btn-block mr-10">Submit</button>
                                        </div>
                                     </div>

                                     <br/>

                                     <hr>

                                     <div class="text-center">
                                        <a href="/user/register">Don't Have an Account Yet? Register</a>
                                     </div>

                                  </form>

                               </div>

                            </div>

                         </div>

                      </div>   
                   </div>
                </div>
             </div>
          </div>
       </div>
       <!-- /Row -->  
    
    </div>

@endsection
