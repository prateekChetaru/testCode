@include('layouts.adminHeader')
<main class="main-content">
	<div class="content-top">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="page-tital"> 
						<h2> Dashboard : </h2>
						<span class="sub-tital"> Welcome Simon</span>
					</div>
					<div class="page-nav">
						<ul>
							<li> <a href="#"> Home </a> </li>
							<li> <a href="#"> Organisations </a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="content-top-right">
						<div class="add-btn-section">
							<a href="#" class="btn"> <img src="{{asset('public/images/plus-icon.png')}}"> <span> Add Office </span></a>
							<a href="#" class="btn"> <img src="{{asset('public/images/plus-icon.png')}}"> <span> Add Machine </span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="add-fild-section dashbowrd" id="examples">
		<div class="content demo-y">
			<div class="container">
				<div class="organisations-tabnav">
					<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="pills-organisations-tab" data-toggle="pill" href="#pills-organisations" role="tab" aria-controls="pills-organisations" aria-selected="true"><img src="{{asset('public/images/gide-icon.png')}}"> <span> Grid View </span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="pill" href="#pills-map" role="tab" aria-controls="pills-map" aria-selected="false"><img src="{{asset('public/images/map-view-icon.png')}}"> <span> Map View </span></a>
						</li>
					</ul>
				</div>
				
				<div class="tab-content" id="pills-tabContent">
					<div class="row tab-pane fade show active" id="pills-organisations" role="tabpanel" aria-labelledby="pills-organisations-tab">
						<div class="organisations-section">
							@foreach($organisation as $value)
							<div class="col-md-4">
								<div class="organisations-list">
									
									<div class="organisations-logo-box">
										@if(!empty($value->ImageURL))
										<img src="{{asset('public/uploads/org_images').'/'.$value->ImageURL}}">
										@else
										<img src="{{asset('public/images/no-image.png')}}">
										@endif
									</div>

									<div class="organisations-list-text">
										<h4> {{ucfirst($value->organisation)}} </h4>
										<p>  {{ucfirst($value->industry)}} </p>
										<p><img src="{{asset('public/images/map-icon.png')}}"> {{$value->address1}},{{$value->address2}}
										</p>
										<p> <a href="{{$value->website}}">{{$value->website}}</a> </p>
									</div>
								</div>
							</div>
							@endforeach

						</div>

						<div class="organ-page-nav">
							
							{!! $paginations->links('layouts.pagination') !!}

						</div>
					</div>
					<div class="tab-pane fade" id="pills-map" role="tabpanel" aria-labelledby="pills-map-tab">
						<div class="row">
							<div class="organisations-map">
								<div class="col-md-12">
									<div class="map-section">
										<h3> Worldwide Sites </h3>
										<div class="map-area">
											<img src="{{asset('public/images/single-map.jpg')}}">
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
</main>
@include('layouts/adminFooter')