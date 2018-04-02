@extends('admin.layouts.authMaster')

@section('title')
    Confirm Account
@endsection

@section('auth_text')
    Login 
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
                                  <h3 class="text-center txt-dark mb-10">Confirm Account</h3>
                                  <h6 class="text-center nonecase-font txt-grey">
                                  Please check your email/ phone and enter received details below</h6>
                               </div>   

                               <hr>

                               <div class="form-wrap">
                                  
                                  <form class="form-horizontal"  role="form" method="POST" action="{{ route('confirm.store') }}">
                                     
                                     {{ csrf_field() }}

                                     <div  class="form-group {{ $errors->has('phone_country') ? ' has-error' : '' }}">
                                        
                                        <label for="phone_country" class="col-sm-3 control-label">
                                           Country
                                           <span class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-9">
                                                                                     
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

                                     </div>

                                     <div  class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                                        
                                        <label for="phone" class="col-sm-3 control-label">
                                           Phone No/ Email
                                           <span class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-9">

                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    id="phone" 
                                                    name="phone"
                                                    value="{{ old('phone') }}" required>
                                                  
                                                 @if ($errors->has('phone'))
                                                      <span class="help-block">
                                                          <strong>{{ $errors->first('phone') }}</strong>
                                                      </span>
                                                 @endif
                                        </div>

                                     </div>

                                     <div class="form-group {{ $errors->has('confirm_code') ? ' has-error' : '' }}">
                                        
                                        <label for="confirm_code" class="col-sm-3 control-label">
                                           Confirm Code
                                           <span class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-9">
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="confirm_code" 
                                                name="confirm_code"
                                                value="{{ old('confirm_code') }}"
                                                required>

                                             @if ($errors->has('confirm_code'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('confirm_code') }}</strong>
                                                  </span>
                                             @endif

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

                                        <a href="{{ route('login') }}">
                                            Login
                                        </a>

                                        &nbsp; | &nbsp;

                                        <a href="{{ route('register') }}">
                                            Register
                                        </a>

                                        &nbsp; | &nbsp;

                                        <a href="{{ route('resend_code') }}">
                                            Resend Code
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