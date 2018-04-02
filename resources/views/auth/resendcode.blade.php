@extends('admin.layouts.authMaster')

@section('title')
    Resend Code
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
                                  <h3 class="text-center txt-dark mb-10">Resend Code</h3>
                                  <h6 class="text-center nonecase-font txt-grey">Please enter your details below</h6>
                               </div>   

                               <hr>

                               <div class="form-wrap">
                                  
                                  <form class="form-horizontal"  role="form" method="POST" action="{{ route('confirm.store') }}">
                                     
                                     {{ csrf_field() }}

                                     <div  class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                        
                                        <label for="phone_country" class="col-sm-3 control-label">
                                           Phone Number
                                           <span class="text-danger"> *</span>
                                        </label>
                                        <div class="col-sm-9">
                                           
                                            <div class="col-sm-3" style="padding-left:0;">
                                          
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
                                                        >{{ $country->phonecode }}</option>
                                                    </li>
                                                    @endforeach
                                                    
                                                 </select>
                                              
                                            </div>

                                            <div class="col-sm-9" style="padding-left:0;padding-right:0;">
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