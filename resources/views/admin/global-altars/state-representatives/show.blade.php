@extends('admin.layouts.master')

@section('title')

    Showing State Representative - {{ $stateRepresentative->first_name }} {{ $stateRepresentative->last_name }}

@endsection


@section('content')
    
    <div class="container-fluid">

       <!-- Title -->
       <div class="row heading-bg">
          <div class="col-sm-6 col-xs-12">
            <h5 class="txt-dark">
              Showing State Representative - {{ $stateRepresentative->first_name }} {{ $stateRepresentative->last_name }}
            </h5>
          </div>
          <!-- Breadcrumb -->
          <div class="col-sm-6 col-xs-12">
              {!! Breadcrumbs::render('state-representatives.show', $stateRepresentative->id) !!}
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
                            {{ $stateRepresentative->id }}
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
                                            <strong>Full Names:</strong> 
                                            <span class="text-success">
                                              {{ $stateRepresentative->first_name }} {{ $stateRepresentative->last_name }}
                                            </span>
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>

                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block capitalize-font">
                                            <strong>Title:</strong> 
                                            <span>
                                              @if ($stateRepresentative->title)
                                                {{ $stateRepresentative->title }}
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
                                            <strong>Description:</strong> 
                                            <span>
                                              @if ($stateRepresentative->description)
                                                {{ $stateRepresentative->description }}
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
                                            <strong>Phone:</strong> 
                                            <span>
                                              @if ($stateRepresentative->phone)
                                                {{ $stateRepresentative->phone }}
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
                                            <strong>Country:</strong> 
                                            <span>
                                              @if ($stateRepresentative->country)
                                                {{ $stateRepresentative->country->name }}
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
                                              @if ($stateRepresentative->state)
                                                {{ $stateRepresentative->state->name }}
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

                                           @if ($stateRepresentative->status->id == 1)
                                            <span class="txt-dark text-success">
                                                {{ $stateRepresentative->status->name }}
                                            </span>
                                          @else
                                            <span class="txt-dark text-danger">
                                                {{ $stateRepresentative->status->name }}
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
                          href="{{ route('state-representatives.edit', $stateRepresentative->id) }}" 
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
                          <h5><strong>State Representative Details</strong></h5>
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
                                           {{ formatFriendlyDate($stateRepresentative->created_at) }}
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>

                                    @if ($stateRepresentative->user)
                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block capitalize-font">
                                            <strong>Created By:</strong> 
                                            {{ $stateRepresentative->user->first_name }} 
                                            {{ $stateRepresentative->user->last_name }}
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>
                                    @endif

                                    @if ($stateRepresentative->created_by)
                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block">
                                           <strong>Created By:</strong> 
                                           {{ $stateRepresentative->creator->first_name }} 
                                           {{ $stateRepresentative->creator->last_name }}
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>
                                    @endif

                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block">
                                           <strong>Updated At:</strong> 
                                           {{ formatFriendlyDate($stateRepresentative->updated_at) }}
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>

                                    @if ($stateRepresentative->updated_by)
                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block">
                                           <strong>Updated By:</strong> 
                                           {{ $stateRepresentative->updater->first_name }} 
                                           {{ $stateRepresentative->updater->last_name }}
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




