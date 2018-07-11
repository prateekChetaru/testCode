
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
				</div>
				<div class="col-md-6">
					<div class="content-top-right">
						<div class="add-btn-section">
							<a href="#" class="btn"> <img src="{{ asset('public/images/plus-icon.png')}}"> <span> Add Office </span></a>
							<a href="#" class="btn"> <img src="{{ asset('public/images/plus-icon.png')}}"> <span> Add Machine </span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="add-fild-section dashbowrd" id="examples">
		<div class="content demo-y">
			<div class="container">
				<div class="row">
					<div class="col-md-7">
						<div class="map-section">
							<h3> Worldwide Sites </h3>
							<div class="map-area">
								<img src="{{ asset('public/images/map-img.jpg')}}">
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="organisations-right">
							<div class="organisations-head">
								<h2>organisations </h2>
								<span><a href="{{route('organisation.index')}}"> View All </a></span>
							</div>
							<div class="organisations-list" id="examples1">
								<div class="content demo-y">
									<ul>

										@foreach($organisations as $org)

										<li> 
											<div class="organisations-logo-box">
												
												@if(!empty($org->ImageURL))
												<img src="{{asset('public/uploads/org_images').'/'.$org->ImageURL}}">
												@else
												<img src="{{asset('public/images/no-image.png')}}">
												@endif

											</div>
											<div class="organisations-list-text">
												<h4> {{$org->organisation}} </h4>
												<p> {{$org->industry}}</p>
												<p><img src="{{ asset('public/images/map-icon.png')}}"> {{$org->address1}} </p>
												<p> <a href="#"> www.mikrosystems.com </a> </p>
											</div>
										</li>

										@endforeach

									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@include('layouts.adminFooter')
