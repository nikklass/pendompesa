@extends('admin.layouts.master')

@section('title')

    Showing State - {{ $state->id }}

@endsection


@section('content')
    
    <div class="container-fluid">

       <!-- Title -->
       <div class="row heading-bg">
          <div class="col-sm-6 col-xs-12">
            <h5 class="txt-dark">Showing State - {{ $state->id }}</h5>
          </div>
          <!-- Breadcrumb -->
          <div class="col-sm-6 col-xs-12">
              {!! Breadcrumbs::render('states.show', $state->id) !!}
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
                           Name: 

                           @if ($state->status->id == 1)
                              <span class="text-success">
                           @elseif (($state->status->id == 2)
                                 || ($state->status->id == 3)
                                 || ($state->status->id == 7)
                                 || ($state->status->id == 99))
                              <span class="text-danger">
                           @else 
                              <span class="text-primary">
                           @endif 
                                
                                {{ $state->name }}
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
                                            <strong>ID:</strong> 
                                            <span>
                                              {{ $state->id }}
                                            </span>
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>

                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block capitalize-font">
                                            <strong>Name:</strong> 
                                            <span>
                                              {{ $state->name }}
                                            </span>
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>

                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block capitalize-font">
                                            <strong>Country:</strong> 
                                            <span>
                                              {{ $state->country->name }}
                                            </span>
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>

                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block">
                                           <strong>Status:</strong>
                                           @if ($state->status->id == 1)
                                              <span class="text-success">
                                           @elseif (($state->status->id == 2)
                                                 || ($state->status->id == 3)
                                                 || ($state->status->id == 7)
                                                 || ($state->status->id == 99))
                                              <span class="text-danger">
                                           @else 
                                              <span class="text-primary">
                                           @endif 
                                                
                                                {{ $state->status->name }}
                                              </span>  
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
                          href="{{ route('states.edit', $state->id) }}" 
                          class="btn btn-success btn-block btn-outline btn-anim mt-30">
                          <i class="fa fa-pencil"></i>
                          <span class="btn-text">Edit State</span>
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
                          <h5>Details</h5>
                      </p>

                      <hr>

                      <div class="row">
                        <div class="col-lg-12">
                            <div class="followers-wrap">
                              <ul class="followers-list-wrap">
                                <li class="follow-list">
                                  <div class="follo-body">

                                    @if ($state->creator)
                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block">
                                           <strong>Created By:</strong> 
                                           {{ $state->creator->first_name }} 
                                           {{ $state->creator->last_name }}
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>
                                    @endif

                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block">
                                           <strong>Created At:</strong> 
                                           {{ formatFriendlyDate($state->created_at) }}
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>

                                    @if ($state->updater)
                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block">
                                           <strong>Updated By:</strong> 
                                           {{ $state->updater->first_name }} 
                                           {{ $state->updater->last_name }}
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>
                                    @endif

                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block">
                                           <strong>Updated At:</strong> 
                                           {{ formatFriendlyDate($state->updated_at) }}
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

                  </div>

              </div>

            </div>
              
          </div>
        </div>
        <!-- /Row -->

    </div>

@endsection

