@extends('admin.layouts.master')


@section('title')

    Edit Coordinator - {{ $coordinator->id }}

@endsection


@section('css_header')

<link href="{{ asset('admin/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">

@endsection


@section('content')
    
    <div class="container-fluid">

      <!-- Title -->
       <div class="row heading-bg">
          <div class="col-lg-5 col-md-5 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Edit Coordinator</h5>
          </div>
          <!-- Breadcrumb -->
          <div class="col-lg-7 col-sm-7 col-md-8 col-xs-12">
              {!! Breadcrumbs::render('coordinators.edit', $coordinator->id) !!}
          </div>
          <!-- /Breadcrumb -->
       </div>
       <!-- /Title -->

      <!-- Row -->
       <div class="table-struct full-width full-height">
          <div class="table-cell auth-form-wrap-inner">
             <div class="ml-auto mr-auto no-float">
                
                <div  class="col-sm-12 col-md-8 col-md-offset-2">

                  <div class="row">
                     <div class="col-sm-12 col-xs-12">
                        
                        <div class="panel panel-default card-view">
                           
                           <div class="panel-wrapper collapse in">
                              
                              <div class="panel-body">               

                                 <div class="mb-30">
                                    <h3 class="text-center txt-dark mb-10">
                                        Edit Coordinator - {{ $coordinator->first_name }} {{ $coordinator->last_name }}
                                    </h3>
                                 </div>   

                                 <hr>

                                 <div class="form-wrap">
                                   
                                    <form class="form-horizontal" method="POST" 
                                        action="{{ route('coordinators.update', $coordinator->id) }}"> 

                                       {{ method_field('PUT') }}
                                       {{ csrf_field() }}

                                       <div  class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                              
                                          <label for="first_name" class="col-sm-3 control-label">
                                             First Name
                                             <span class="text-danger"> *</span>
                                          </label>
                                          <div class="col-sm-9">
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                name="first_name" 
                                                name="first_name"
                                                value="{{ old('first_name', $coordinator->first_name)}}"
                                                required autofocus>

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
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                name="last_name" 
                                                name="last_name"
                                                value="{{ old('last_name', $coordinator->last_name)}}"
                                                required autofocus>

                                             @if ($errors->has('last_name'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('last_name') }}</strong>
                                                  </span>
                                             @endif
                                          </div>

                                       </div>

                                       <div class="form-group">
                                        
                                          <div class="row">
                                              <label for="phone" class="col-sm-3 control-label">
                                                 Phone
                                                 <span class="text-danger"> *</span>
                                              </label>
                                              <div class="col-sm-9">
                                                  
                                                  <div class="col-sm-6 no-padding-right">
                                                      <select id="phone_country" name="phone_country" class="form-control selectpicker" required>
                                                          
                                                          @foreach ($countries as $country)
                                                          <li class="mb-10">
                                                              <option value="{{ $country->sortname }}"
                                                          @if ($country->sortname == old('phone_country', $coordinator->phone_country))
                                                              selected="selected"
                                                          @endif
                                                          >
                                                                {{ $country->name }} (+{{ $country->phonecode }})
                                                              </option>
                                                          </li>
                                                          @endforeach
                                                          
                                                      </select>
                                                  </div>

                                                  <div class="col-sm-6">
                                                      <input type="text" class="form-control" name="phone" data-parsley-trigger="change" placeholder="e.g. 720000000" 
                                                      value="{{ old('phone', $coordinator->phone)}}"
                                                       required>
                                                  </div>

                                                  @if ($errors->has('phone'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('phone') }}</strong>
                                                        </span>
                                                   @endif

                                              </div>
                                          </div>
                                      
                                      </div>

                                       <div  class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                              
                                          <label for="email" class="col-sm-3 control-label">
                                             Email
                                          </label>
                                          <div class="col-sm-9">
                                            <input 
                                                type="email" 
                                                class="form-control" 
                                                id="email" 
                                                name="email"
                                                value="{{ old('email', $coordinator->email)}}"
                                                 required>

                                             @if ($errors->has('email'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('email') }}</strong>
                                                  </span>
                                             @endif
                                          </div>

                                       </div>

                                       <div  class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                              
                                          <label for="title" class="col-sm-3 control-label">
                                             Member Title
                                             <span class="text-danger"> *</span>
                                          </label>
                                          <div class="col-sm-9">
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="title" 
                                                name="title"
                                                value="{{ old('title', $coordinator->title)}}"
                                                required autofocus>

                                             @if ($errors->has('title'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('title') }}</strong>
                                                  </span>
                                             @endif
                                          </div>

                                       </div>

                                       <div  class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                              
                                          <label for="description" class="col-sm-3 control-label">
                                             Member Description
                                          </label>
                                          <div class="col-sm-9">
                                            
                                             <textarea class="form-control" rows="5" 
                                             name="description">{{ old('description', $coordinator->description)}}
                                             </textarea>

                                             @if ($errors->has('description'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('description') }}</strong>
                                                  </span>
                                             @endif
                                          
                                          </div>

                                       </div>

                                       <div  class="form-group{{ $errors->has('country_id') ? ' has-error' : '' }}">
                                              
                                          <label for="country_id" class="col-sm-3 control-label">
                                             Country
                                             <span class="text-danger"> *</span>
                                          </label>
                                          <div class="col-sm-9">
                                            
                                             <select class="selectpicker form-control" 
                                                name="country_id" 
                                                data-style="form-control btn-default btn-outline"
                                                required> 

                                                @foreach ($countries as $country)
                                                <li class="mb-10">
                                                <option value="{{ $country->id }}"
                                                      @if ($country->id == old('country_id', $coordinator->country_id))
                                                          selected="selected"
                                                      @endif
                                                    >
                                                      {{ $country->name }}
                                                    </option>
                                                </li>
                                                @endforeach
                                                
                                             </select>

                                             @if ($errors->has('country_id'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('country_id') }}</strong>
                                                  </span>
                                             @endif
                                          
                                          </div>

                                       </div>

                                       <!-- <div  class="form-group{{ $errors->has('state_id') ? ' has-error' : '' }}">
                                              
                                          <label for="state_id" class="col-sm-3 control-label">
                                             State
                                             <span class="text-danger"> *</span>
                                          </label>
                                          <div class="col-sm-9">
                                            
                                             <select class="selectpicker form-control" 
                                                name="state_id" 
                                                data-style="form-control btn-default btn-outline"
                                                > 

                                                <li class="mb-10">
                                                    <option value="">Select Country First</option>
                                                </li>
                                                
                                             </select>

                                             @if ($errors->has('state_id'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('state_id') }}</strong>
                                                  </span>
                                             @endif
                                          
                                          </div>

                                       </div> -->

                                       <div  class="form-group{{ $errors->has('status_id') ? ' has-error' : '' }}">
                                              
                                          <label for="status_id" class="col-sm-3 control-label">
                                             Status
                                             <span class="text-danger"> *</span>
                                          </label>
                                          <div class="col-sm-9">
                                            
                                             <select class="selectpicker form-control" 
                                                name="status_id" 
                                                data-style="form-control btn-default btn-outline"
                                                required>  

                                                @foreach ($statuses as $status)
                                                <li class="mb-10">
                                                <option value="{{ $status->id }}"

                                          @if ($status->id == old('status_id', $coordinator->status->id))
                                              selected="selected"
                                          @endif
                                                    >
                                                      {{ $status->name }}
                                                    </option>
                                                </li>
                                                @endforeach
                                                
                                             </select>

                                             @if ($errors->has('status_id'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('status_id') }}</strong>
                                                  </span>
                                             @endif
                                          
                                          </div>

                                       </div>

                                       @if ($coordinator->user)
                                         <div  class="form-group">
                                                
                                            <label for="created_by" class="col-sm-3 control-label">
                                               Created By 
                                            </label>
                                            <div class="col-sm-9">
                                               <input class="form-control" value="{{ $coordinator->user->first_name }} {{ $coordinator->user->last_name }}" readonly>
                                            </div>

                                         </div>
                                       @endif


                                       <hr>


                                       <br/>

                                       <div class="form-group">
                                          <div class="col-sm-3"></div>
                                          <div class="col-sm-9">
                                              <button 
                                                type="submit" 
                                                class="btn btn-lg btn-primary btn-block mr-10"
                                                 id="submit-btn">
                                                 Submit
                                              </button>
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
       </div>
       <!-- /Row --> 
        

    </div>
         

@endsection


@section('page_scripts')

  <script src="{{ asset('admin/js/bootstrap-select.min.js') }}"></script>

  @include('admin.layouts.partials.error_messages')
  
@endsection
