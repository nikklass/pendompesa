@extends('admin.layouts.master')


@section('title')

    Edit Ebook - {{ $ebook->title }}

@endsection


@section('css_header')

    <link href="{{ asset('admin/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Bootstrap Dropify CSS -->
    <link href="{{ asset('admin/css/dropify.min.css') }}" rel="stylesheet" type="text/css">

@endsection


@section('content')
    
    <div class="container-fluid">

      <!-- Title -->
       <div class="row heading-bg">
          <div class="col-lg-5 col-md-5 col-sm-4 col-xs-12">
            <h5 class="txt-dark">Edit Ebook</h5>
          </div>
          <!-- Breadcrumb -->
          <div class="col-lg-7 col-sm-7 col-md-8 col-xs-12">
              {!! Breadcrumbs::render('ebooks.edit', $ebook->id) !!}
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
                                        Edit Ebook - {{ $ebook->title }}
                                    </h3>
                                 </div>   

                                 <hr>

                                 <div class="form-wrap">
                                   
                                    <form class="form-horizontal" method="POST" 
                                        action="{{ route('ebooks.update', $ebook->id) }}" 
                                        enctype="multipart/form-data"> 

                                       {{ method_field('PUT') }}
                                       {{ csrf_field() }}


                                       <div  class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                              
                                          <label for="title" class="col-sm-3 control-label">
                                             Title
                                             <span class="text-danger"> *</span>
                                          </label>
                                          <div class="col-sm-9">
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="title" 
                                                name="title"
                                                value="{{ old('title', $ebook->title)}}"
                                                required autofocus>

                                             @if ($errors->has('title'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('title') }}</strong>
                                                  </span>
                                             @endif
                                          </div>

                                       </div>

                                       <div  class="form-group{{ $errors->has('uploadfile') ? ' has-error' : '' }}">
                                              
                                          <label for="uploadfile" class="col-sm-3 control-label">
                                              Ebook PDF
                                          </label>
                                          <div class="col-sm-9">
                                          
                                            <a href="{!! config('app.url') !!}{{ $ebook->src }}" target="_blank">Current Ebook PDF - Click To View</a>
                                            <br><br>
                                            Select a replacement PDF below:
                                            <br>
                                            <input 
                                                type="file" 
                                                class="form-control dropify" 
                                                id="uploadfile" 
                                                name="uploadfile"
                                                value="{{ old('uploadfile') }}">

                                             @if ($errors->has('uploadfile'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('uploadfile') }}</strong>
                                                  </span>
                                             @endif
                                          </div>

                                       </div>

                                       <div  class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                              
                                          <label for="description" class="col-sm-3 control-label">
                                            Description
                                          </label>
                                          <div class="col-sm-9">
                                            
                                             <textarea class="form-control" rows="5" 
                                             name="description">{{ old('description', $ebook->description)}}
                                             </textarea>

                                             @if ($errors->has('description'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('description') }}</strong>
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

                                          @if ($status->id == old('status_id', $ebook->status->id))
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

                                       @if ($ebook->user)
                                         <div  class="form-group">
                                                
                                            <label for="created_by" class="col-sm-3 control-label">
                                               Created By 
                                            </label>
                                            <div class="col-sm-9">
                                               <input class="form-control" value="{{ $ebook->user->first_name }} {{ $ebook->user->last_name }}" readonly>
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
  <script src="{{ asset('admin/js/dropify.min.js') }}"></script>
  <script src="{{ asset('admin/js/form-file-upload-data.js') }}"></script>

  @include('admin.layouts.partials.error_messages')
  
@endsection
