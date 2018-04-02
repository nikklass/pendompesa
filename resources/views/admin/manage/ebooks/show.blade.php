@extends('admin.layouts.master')

@section('title')

    Showing Ebook - {{ $ebook->title }}

@endsection


@section('content')
    
    <div class="container-fluid">

       <!-- Title -->
       <div class="row heading-bg">
          <div class="col-sm-6 col-xs-12">
            <h5 class="txt-dark">
              Showing Ebook - {{ $ebook->title }}
            </h5>
          </div>
          <!-- Breadcrumb -->
          <div class="col-sm-6 col-xs-12">
              {!! Breadcrumbs::render('ebooks.show', $ebook->id) !!}
          </div>
          <!-- /Breadcrumb -->
       </div>
       <!-- /Title -->

      <!-- Row -->
        <div class="row mt-15">


          @include('admin.layouts.partials.error_text')


          <div class="col-lg-6 col-xs-12">

            <div class="panel panel-default card-view pa-0 equalheight">
              
              <div  class="panel-wrapper collapse in">
                 
                 <div  class="panel-body pb-0 ml-20 mr-20 mb-20">
                    
                    <p class="mb-20">
                          <h5>
                            ID: 
                            <span>
                            {{ $ebook->id }}
                            </span>
                          </h5>
                    </p>

                    <hr>
 
                    <div class="social-info">
                      

                      <div class="row">
                        
                          <div class="col-lg-12">
                            <div class="followers-wrap">
                              <ul class="followers-list-wrap">
                                <li class="follow-list">
                                  <div class="follo-body">

                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block capitalize-font">
                                            <strong>Title:</strong> 
                                            <span>
                                              {{ $ebook->title }}
                                            </span>
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>

                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block capitalize-font">
                                            <strong>Description:</strong> 
                                            <span>
                                              @if ($ebook->description)
                                                {{ $ebook->description }}
                                              @else
                                                None
                                              @endif
                                            </span>
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>

                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block capitalize-font">
                                            <strong>PDF Link:</strong> 
                                            <span>
                                              @if ($ebook->src)
                                                <a href="{!! config('app.url') !!}{{ $ebook->src }}" target="_blank">View PDF</a>

                                                <!-- <a  href="/{{ $ebook->src }}" target="_blank" class="btn btn-warning btn-rounded btn-lable-wrap right-label"><span class="btn-text">View PDF</span> <span class="btn-label"><i class="fa fa-times"></i> </span>
                                                </a> -->
                                                
                                              @else
                                                None
                                              @endif
                                            </span>
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>

                                    

                                    <!-- <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block capitalize-font">
                                            <strong>State:</strong> 
                                            <span>
                                              @if ($ebook->state)
                                                {{ $ebook->state->name }}
                                              @else
                                                None
                                              @endif
                                            </span>
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div> -->

                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block">
                                           <strong>Status:</strong> 

                                           @if ($ebook->status->id == 1)
                                            <span class="txt-dark text-success">
                                                {{ $ebook->status->name }}
                                            </span>
                                          @else
                                            <span class="txt-dark text-danger">
                                                {{ $ebook->status->name }}
                                            </span>
                                          @endif

                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>
                                 
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </div>

                      </div>


                      <a  
                          href="{{ route('ebooks.edit', $ebook->id) }}" 
                          class="btn btn-success btn-block btn-outline btn-anim mt-30">
                          <i class="fa fa-pencil"></i>
                          <span class="btn-text">Edit</span>
                      </a>


                    </div>
                  </div>

              </div>

            </div>
          </div>

          <div class="col-lg-6 col-xs-12">

            <div class="panel panel-default card-view pa-0 equalheight">
              
              <div  class="panel-wrapper collapse in">
                 
                 <div  class="panel-body pb-0 ml-20 mr-20 mb-20">
                    
                      <p class="mb-20">
                          <h5><strong>Ebook Details</strong></h5>
                      </p>

                      <hr>

                      <div class="row">
                        <div class="col-lg-12">
                            <div class="followers-wrap">
                              <ul class="followers-list-wrap">
                                <li class="follow-list">
                                  <div class="follo-body">

                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block">
                                           <strong>Created At:</strong> 
                                           {{ formatFriendlyDate($ebook->created_at) }}
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>

                                    @if ($ebook->created_by)
                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block">
                                           <strong>Created By:</strong> 
                                           {{ $ebook->creator->first_name }} 
                                           {{ $ebook->creator->last_name }}
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>
                                    @endif

                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block">
                                           <strong>Updated At:</strong> 
                                           {{ formatFriendlyDate($ebook->updated_at) }}
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>

                                    @if ($ebook->updated_by)
                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block">
                                           <strong>Updated By:</strong> 
                                           {{ $ebook->updater->first_name }} 
                                           {{ $ebook->updater->last_name }}
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>
                                    @endif                                   
                                    
                                  </div>
                                </li>
                              </ul>
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




