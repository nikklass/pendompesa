@extends('layouts.authMaster')

@section('title')
    Forgot Password
@endsection

@section('auth_text')
    Don't Have an Account Yet?
@endsection

@section('auth_button_text_url')
    {{ route('login') }}
@endsection

@section('auth_button_text')
    Login
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
                                  
                                  @if (session('status'))
                                    <div class="alert alert-success text-center">
                                        {{ session('status') }}
                                    </div>
                                  @endif

                                  <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                                     
                                     {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-sm-3 control-label">E-Mail Address</label>

                                        <div class="col-sm-9">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                     <br/>

                                     <div class="form-group">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9">
                                           <button type="submit" class="btn btn-primary btn-block mr-10">
                                                Send Password Reset Link
                                           </button>
                                        </div>
                                     </div>

                                     <br/>

                                     <hr>

                                     <div class="text-center">
                                        <a href="{{ route('login') }}">
                                            Don't Have an Account Yet? Register
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
