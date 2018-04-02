@extends('layouts.authMaster')

@section('title')
    Reset Password
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
                                     Enter your email address and new password below
                                  </h6>
                               </div>   

                               <hr>

                               <div class="form-wrap">
                                  
                                  @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                  @endif

                                  <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                                     
                                     {{ csrf_field() }}

                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-sm-3 control-label">E-Mail Address</label>

                                        <div class="col-sm-9">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-sm-3 control-label">Password</label>

                                        <div class="col-sm-9">
                                            <input id="password" type="password" class="form-control" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        <label for="password-confirm" class="col-sm-3 control-label">Confirm Password</label>
                                        <div class="col-sm-9">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                            @if ($errors->has('password_confirmation'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                     <br/>

                                     <div class="form-group">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9">
                                           <button type="submit" class="btn btn-primary btn-block mr-10">Submit</button>
                                        </div>
                                     </div>

                                     <br/>

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
