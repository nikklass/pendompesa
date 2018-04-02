@extends('admin.layouts.master')

@section('title')

    Add New Coordinator

@endsection

@section('css_header')

    <link href="{{ asset('admin/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">

@endsection


@section('content')
    
    <div class="container-fluid">
       
       <!-- Title -->
       <div class="row heading-bg">
          <div class="col-sm-6 col-xs-12">
            <h5 class="txt-dark">Add New Coordinator</h5>
          </div>
          <div class="col-sm-6 col-xs-12">
              {!! Breadcrumbs::render('coordinators.create') !!}
          </div>
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
                                    <h3 class="text-center txt-dark mb-10">Add New Coordinator</h3>
                                 </div>   

                                 <hr>

                                 <div class="form-wrap">
                                  
                                    <form class="form-horizontal" method="POST" 
                                        action="{{ route('coordinators.store') }}"> 

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
                                                id="first_name" 
                                                name="first_name"
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
                                                id="last_name" 
                                                name="last_name"
                                                required>

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
                                                          @if ($country->sortname == old('phone_country', 'KE'))
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
                                                      <input type="text" class="form-control" name="phone" data-parsley-trigger="change" placeholder="e.g. 720000000" required>
                                                  </div>

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
                                                value="{{ old('email') }}" required>

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
                                                value="{{ old('title') }}" required>

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

                                            <textarea 
                                                class="form-control" 
                                                rows="5"
                                                id="description" 
                                                name="description">{{ old('description') }}</textarea>

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
                                                      @if ($country->id == old('country_id', '113'))
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

                                       <!-- <div  class="form-group{{ $errors->has('status_id') ? ' has-error' : '' }}">
                                              
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
                                                      @if ($status->id == old('status_id', $status->id))
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

                                       </div> -->


                                       <hr>


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

@endsection