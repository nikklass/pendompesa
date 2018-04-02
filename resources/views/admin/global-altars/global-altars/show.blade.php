@extends('admin.layouts.master')

@section('title')

    Showing Prayer Point - {{ $prayerPoint->id }}

@endsection


@section('content')
    
    <div class="container-fluid">

       <!-- Title -->
       <div class="row heading-bg">
          <div class="col-sm-6 col-xs-12">
            <h5 class="txt-dark">Showing Prayer Point - {{ $prayerPoint->id }}</h5>
          </div>
          <!-- Breadcrumb -->
          <div class="col-sm-6 col-xs-12">
              {!! Breadcrumbs::render('prayer-points.show', $prayerPoint->account_no) !!}
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
                            {{ $prayerPoint->id }}
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
                                            <strong>Name:</strong> 
                                            <span class="text-success">
                                              {{ $prayerPoint->name }}
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
                                                {{ $prayerPoint->description }}
                                            </span>
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>

                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block">
                                           <strong>Status:</strong> 

                                           @if ($prayerPoint->status->id == 1)
                                            <span class="txt-dark text-success">
                                                {{ $prayerPoint->status->name }}
                                            </span>
                                          @else
                                            <span class="txt-dark text-danger">
                                                {{ $prayerPoint->status->name }}
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
                          href="{{ route('prayer-points.edit', $prayerPoint->id) }}" 
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
                          <h5><strong>Prayer Point Details</strong></h5>
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
                                           {{ formatFriendlyDate($prayerPoint->created_at) }}
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>

                                    @if ($prayerPoint->user)
                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block capitalize-font">
                                            <strong>Created By:</strong> 
                                            {{ $prayerPoint->user->first_name }} 
                                            {{ $prayerPoint->user->last_name }}
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>
                                    @endif

                                    @if ($prayerPoint->created_by)
                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block">
                                           <strong>Created By:</strong> 
                                           {{ $prayerPoint->creator->first_name }} 
                                           {{ $prayerPoint->creator->last_name }}
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>
                                    @endif

                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block">
                                           <strong>Updated At:</strong> 
                                           {{ formatFriendlyDate($prayerPoint->updated_at) }}
                                        </span>
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>

                                    @if ($prayerPoint->updated_by)
                                    <div class="follo-data">
                                      <div class="user-data">
                                        <span class="name block">
                                           <strong>Updated By:</strong> 
                                           {{ $prayerPoint->updater->first_name }} 
                                           {{ $prayerPoint->updater->last_name }}
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




