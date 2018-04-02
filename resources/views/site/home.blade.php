
@extends('site.layouts.master')

@section('title')

    Welcome to Terc

@endsection


@section('content')
    
    <div class="container-fluid pt-15">
		
		<h4>Welcome to Terc</h4>
		
		<!-- Row -->
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default card-view">
					<div class="panel-wrapper collapse in">
						<div  class="panel-body">
							<!-- <p class="muted">Add class <code class="">.carousel-caption</code>.</p> -->
							<!-- START carousel-->
							<div id="carousel-example-captions" data-ride="carousel" class="carousel slide mt-40">
								<ol class="carousel-indicators">
								   <li data-target="#carousel-example-captions" data-slide-to="0" class="active"></li>
								   <li data-target="#carousel-example-captions" data-slide-to="1"></li>
								   <li data-target="#carousel-example-captions" data-slide-to="2"></li>
								</ol>
								<div role="listbox" class="carousel-inner">
								   <div class="item active">
									  <img src="{{ asset('site/images/slides/slide1.jpg') }}" alt="MMK Ministries">
									  <div class="carousel-caption">
										<p> Apostle MMK Ministries </p>
									  </div>
								   </div>
								   <div class="item">
									  <img src="{{ asset('site/images/slides/slide1.jpg') }}" alt="MMK Ministries">
									  <div class="carousel-caption">
										<p> Apostle MMK Ministries </p>
									  </div>
								   </div>
								   <div class="item">
									  <img src="{{ asset('site/images/slides/slide1.jpg') }}" alt="MMK Ministries">
									  <div class="carousel-caption">
										<p> Apostle MMK Ministries </p>
									  </div>
								   </div>
								</div>
								<a href="#carousel-example-captions" role="button" data-slide="prev" class="left carousel-control"> <span aria-hidden="true" class="fa fa-angle-left"></span> <span class="sr-only">Previous</span> </a> <a href="#carousel-example-captions" role="button" data-slide="next" class="right carousel-control"> <span aria-hidden="true" class="fa fa-angle-right"></span> <span class="sr-only">Next</span> </a> 
							</div>
							<!-- END carousel-->
						</div>
					</div>
				</div>
		   </div>
		</div>
		<!-- /Row -->				
        
    </div>
         

@endsection
