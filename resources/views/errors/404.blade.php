@extends('admin.layouts.errorMaster')

@section('title')
    Page Not Found
@endsection

@section('content')
    
    <div id="app">

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
                                      <h3 class="text-center txt-dark mb-10">
                                        <i class="zmdi zmdi-alert-triangle mr-20 text-warning"></i>
                                         Page Not Found
                                      </h3>
                                   </div>   

                                   <hr>

                                   <div class="text-center">
                                      
                                      <p>
                                          <code>Click below to proceed</code>
                                      </p>
                                      <br/>
                                      <br/>
                                      <p>
                                          <a href="{{ route('home') }}"
                                              type="button" 
                                              class="btn btn-success btn-outline">
                                              Continue
                                          </a>
                                      </p>

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

    </div>

@endsection