@extends('admin.layouts.master')

@section('title')

    Add New Quote

@endsection

@section('css_header')

    <link href="{{ asset('admin/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">

@endsection


@section('content')
    
    <div class="container-fluid">
       
       <!-- Title -->
       <div class="row heading-bg">
          <div class="col-sm-6 col-xs-12">
            <h5 class="txt-dark">Add New Quote</h5>
          </div>
          <div class="col-sm-6 col-xs-12">
              {!! Breadcrumbs::render('quotes.create') !!}
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
                                    <h3 class="text-center txt-dark mb-10">Add New Quote</h3>
                                 </div>   

                                 <hr>

                                 <div class="form-wrap">
                                  
                                    <form class="form-horizontal" method="POST" 
                                        action="{{ route('quotes.store') }}"> 

                                       {{ csrf_field() }}

                                       <div  class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                              
                                          <label for="title" class="col-sm-3 control-label">
                                             Text
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
                                            Description 
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
                                                      @if ($status->id == old('status_id', '1'))
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