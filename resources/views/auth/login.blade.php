@extends('admin.layouts.authMaster')

@section('title')
    Login
@endsection

@section('auth_text')
    Forgot Your Password? 
@endsection 

@section('auth_button_text_url')
    {{ route('password.request') }}
@endsection

@section('auth_button_text')
    Recover Password
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
                                  <h3 class="text-center txt-dark mb-10">Login</h3>
                                  <h6 class="text-center nonecase-font txt-grey">Please enter your details below</h6>
                               </div>   

                               <hr>

                               <div class="form-wrap">
                                  
                                  <form class="form-horizontal"  role="form" method="POST" action="{{ route('login.store') }}">
                                  <!-- <form class="form-horizontal"  
                                      role="form" @submit.prevent="handleSubmit()"> -->
                                     
                                     {{ csrf_field() }}

                                     <div  class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                        
                                        <label for="username" class="col-sm-3 control-label">
                                           Phone/ Email
                                           <span class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-9">
                                           <div class="input-group">
                                              <input 
                                                  type="text" 
                                                  class="form-control" 
                                                  id="username" 
                                                  name="username"
                                                  value="{{ old('username') }}" required autofocus>
                                              <div class="input-group-addon"><i class="icon-envelope-open"></i></div>
                                           </div>
                                           @if ($errors->has('username'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('username') }}</strong>
                                                </span>
                                           @endif
                                        </div>

                                     </div>

                                     <div class="form-group">
                                        
                                        <label for="password" class="col-sm-3 control-label">
                                           Password
                                           <span class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-9">
                                           <div class="input-group">
                                              <input 
                                                  type="password" 
                                                  class="form-control" 
                                                  id="password" 
                                                  name="password"
                                                  required>
                                              <div class="input-group-addon"><i class="icon-lock"></i></div>
                                           </div>
                                           @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                           @endif

                                        </div>
                                      </div>

                                      <div class="form-group">
                                          <div class="col-sm-3"></div>
                                          <div class="col-sm-9">
                                             <div class="checkbox">
                                                <input id="remember" type="checkbox" name="remember" 
                                                  {{ old('remember') ? 'checked' : '' }}>
                                                <label for="remember"> Remember Me</label>
                                             </div>
                                          </div>
                                       </div>

                                     <br/>

                                     <div class="form-group">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9">
                                           <button type="submit" class="btn btn-lg btn-primary btn-block mr-10">Submit</button>
                                        </div>
                                     </div>

                                     <br/>

                                     <hr>

                                     <div class="text-center">

                                        <a href="{{ route('password.request') }}">
                                            Forgot Password
                                        </a>

                                        &nbsp; | &nbsp;

                                        <a href="{{ route('register') }}">
                                            Create A New Account
                                        </a>

                                        &nbsp; | &nbsp;

                                        <a href="{{ route('confirm') }}">
                                            Confirm Account
                                        </a>
                                        
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