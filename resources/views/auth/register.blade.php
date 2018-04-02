@extends('admin.layouts.authMaster')

@section('title')
    Register
@endsection

@section('auth_text')
    Already Have An Account? 
@endsection

@section('auth_button_text_url')
    {{ route('login') }}
@endsection

@section('auth_button_text')
    Login
@endsection

@section('css_header')
  <link href="{{ asset('admin/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">
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
                                  <h3 class="text-center txt-dark mb-10">Create A New Account</h3>
                                  <h6 class="text-center nonecase-font txt-grey">Please enter your details below</h6>
                               </div>   

                               <hr> 

                               <div class="form-wrap">
                                  
                                  <form class="form-horizontal"  role="form" method="POST" action="{{ route('register.store') }}">
                                     
                                     {{ csrf_field() }}

                                     <div  class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                        
                                        <label for="first_name" class="col-sm-3 control-label">
                                           First Name
                                           <span class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-9">
                                           <div class="input-group">
                                              <input 
                                                  type="text" 
                                                  class="form-control" 
                                                  id="first_name" 
                                                  name="first_name"
                                                  value="{{ old('first_name') }}" required autofocus>
                                              <div class="input-group-addon"><i class="icon-user"></i></div>
                                           </div>
                                           @if ($errors->has('first_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('first_name') }}</strong>
                                                </span>
                                           @endif
                                        </div>

                                     </div>

                                     <div  class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                        
                                        <label for="last_name" class="col-sm-3 control-label">
                                           Last Name
                                           <span class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-9">
                                           <div class="input-group">
                                              <input 
                                                  type="text" 
                                                  class="form-control" 
                                                  id="last_name" 
                                                  name="last_name"
                                                  value="{{ old('last_name') }}" required >
                                              <div class="input-group-addon"><i class="icon-user"></i></div>
                                           </div>
                                           @if ($errors->has('last_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                </span>
                                           @endif
                                        </div>

                                     </div>

                                     <div  class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        
                                        <label for="email" class="col-sm-3 control-label">
                                           Email
                                           <span class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-9">
                                           <div class="input-group">
                                              <input 
                                                  type="text" 
                                                  class="form-control" 
                                                  id="email" 
                                                  name="email"
                                                  value="{{ old('email') }}" required >
                                              <div class="input-group-addon"><i class="icon-envelope-open"></i></div>
                                           </div>
                                           @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                           @endif
                                        </div>

                                     </div>

                                     <div  class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                        
                                        <label for="phone_country" class="col-sm-3 control-label">
                                           Phone Number
                                           <span class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-9">
                                           
                                            <div class="col-sm-5" style="padding-left:0;">
                                          
                                                 <select class="selectpicker form-control" 
                                                    name="phone_country" 
                                                    data-style="form-control btn-default btn-outline"
                                                    required>  

                                                    @foreach ($countries as $country)
                                                    <li class="mb-10">
                                                      <option value="{{ $country->sortname }}"

                                              @if ($country->sortname == old('phone_country', $country->sortname))
                                                  selected="selected"
                                              @endif
                                                        >{{ $country->name }} 
                                                        (+{{ $country->phonecode }})
                                                      </option>
                                                    </li>
                                                    @endforeach
                                                    
                                                 </select>
                                              
                                            </div>

                                            <div class="col-sm-7" style="padding-left:0;padding-right:0;">
                                                <input 
                                                    type="text" 
                                                    class="form-control digitsOnly" 
                                                    id="phone" 
                                                    name="phone"
                                                    value="{{ old('phone') }}" required autofocus>
                                                  
                                                 @if ($errors->has('phone'))
                                                      <span class="help-block">
                                                          <strong>{{ $errors->first('phone') }}</strong>
                                                      </span>
                                                 @endif
                                             </div>
                                        </div>

                                     </div>

                                     <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                                        
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
                                        
                                        <label for="password_confirmation" class="col-sm-3 control-label">
                                           Password Confirm
                                           <span class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-9">
                                           <div class="input-group">
                                              <input 
                                                  type="password" 
                                                  class="form-control" 
                                                  id="password_confirmation" 
                                                  name="password_confirmation"
                                                  required>
                                              <div class="input-group-addon"><i class="icon-lock"></i></div>
                                           </div>
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
                                           <button type="submit" 
                                            class="btn btn-lg btn-primary btn-block mr-10">
                                            Submit</button>
                                        </div>
                                     </div>

                                     <br/>

                                     <hr>

                                     <div class="text-center">

                                        <a href="{{ route('login') }}">
                                            Login
                                        </a>

                                        &nbsp; | &nbsp;

                                        <a href="{{ route('register') }}">
                                            Register
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


@section('page_scripts')

  <script src="{{ asset('admin/js/bootstrap-select.min.js') }}"></script>
  @include('admin.layouts.partials.error_messages')

@endsection