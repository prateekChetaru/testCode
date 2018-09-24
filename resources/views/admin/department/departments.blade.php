@section('title', 'List Departments')

@include('layouts.adminHeader')
<main class="main-content">
	<div class="content-top">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="page-tital"> 
						<h2> Department : </h2>
						<span class="sub-tital"> {{Auth::user()->name}} </span>
					</div>
					<div class="page-nav">
						<ul>
							<li> <a href="{{URL::to('admin/admin-dashboard')}}">Dashboard</a> </li>
							<li> <a href="{{route('department.index')}}">Department</a></li>
							<li> <a href="#">List Department</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="add-btn-section">
						<a href="{{route('department.create')}}" class="btn ad-dorment"> <img src="{{asset('public/images/plus-icon.png')}}"> <span> Add Department </span></a>
					</div>
				</div>
			</div>
		</div>
	</div>
@if(session('message'))
	<div class="success">
	<p align="center" class="alert alert-success" > {{session('message')}}</p>
	</div>
	@endif
	<div class="ragistration-detele staff-list">
		<div class="container">
			<div class="row">
				<div class="col-md-12">					
					<div class="select-list">
						<ul>
							<li>								
								<select id="organisation" name="organisation">
									<option value="" disabled="" selected=""> Select Organisation </option>
									
									@foreach($organisations as $oValue)
									<option value="{{$oValue->id}}">{{$oValue->organisation}}</option>
									@endforeach
								</select>
							</li>

							<li>
								<select id="office" name="office">
									<option value="" disabled="" selected=""> Select Office </option>							
								</select>
							</li>							
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="staff-list-section add-search-data">

					@foreach($departments as $value)
					
					<div class="col-md-4">
						<a href="{!!route('department.edit',['id'=>base64_encode($value->id)])!!}">
							<div class="staff-list-box">
								<ul>			
									<li> 
										<span class="staff-tital">Department: </span>
										<strong> {{ucfirst($value->department)}} </strong>
									</li>	
									<li> 
										<span class="staff-tital">Office: </span>
										<strong> 
											@if(!empty($value->office->office))							
											{{ucfirst($value->office->office)}}
											@endif
										</strong>
									</li>					
									<li> 
										<span class="staff-tital">Organisation: </span>
										<strong>
											@if(!empty($value->office->organisation->organisation))
											{{ucfirst($value->office->organisation->organisation)}}
											@endif
										</strong>
									</li>							
								</ul>
							</div>
							</a>
						</div>					

						@endforeach

						<div class="organ-page-nav" >

							{!! $departments->links('layouts.pagination') !!}  

						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script type="text/javascript">	
		$('#organisation').on('change', function() {
			
			$('#office option').remove();
			var orgId = $('#organisation').val();

			$.ajax({
				type: "POST",
				url: "{!!URL::to('admin/get-offices')!!}",				
				data: {orgId:orgId,"_token":'<?php echo csrf_token()?>'},
				success: function(response) 
				{					
					$('#office').append(response);
					$.ajax({
						type: "POST",
						url: "{!!URL::to('admin/get-search-departments')!!}",
						data: {orgId:orgId,"_token":'<?php echo csrf_token()?>'},
						success: function(response) {
							console.log(response);
							$('.add-search-data').html(response);
						}
					});
				}
			});
		});
	</script>

	<script type="text/javascript">

		$('#office').on('change', function() {

			var officeId = $('#office').val();

			$.ajax({
				type: "POST",
				url: "{!!URL::to('admin/get-search-departments')!!}",
				data: {officeId:officeId,"_token":'<?php echo csrf_token()?>'},
				success: function(response) {
					console.log(response);
					$('.add-search-data').html(response);
				}
			});

		});
	</script>

	@include('layouts.adminFooter')