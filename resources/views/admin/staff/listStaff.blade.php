
@section('title', 'List Staffs')
@include('layouts.adminHeader')

<main class="main-content">
	<div class="content-top">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="page-tital"> 
						<h2> Staff : </h2>
						<span class="sub-tital"> {{Auth::user()->name}} </span>
					</div>
					<div class="page-nav">
						<ul>
							<li> <a href="{{URL::to('admin/admin-dashboard')}}">Dashboard</a> </li>
							<li> <a href="{{route('staff.index')}}">Staff</a></li>
							<li> <a href="#">List staff</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="add-btn-section">
						<a href="{{route('staff.create')}}" class="btn"> <img src="{{asset('public/images/plus-icon.png')}}"> <span> Add Staff </span></a>
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
					<!-- @foreach($users as $value)
					<a href="{!!route('staff.edit',['id'=>base64_encode($value->id)])!!}">{{$value->name}}</a>
					@endforeach -->
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
									<option value="" disabled="" selected="">Select Office</option>
								</select>
							</li>	
							<li>
								<select id="department" name="department">
									<option value="" disabled="" selected="">Select Department</option>
								</select>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="staff-list-section add-search-data">

					@foreach($users as $value)					
					<div class="col-md-4">
						<a href="{!!route('staff.edit',['id'=>base64_encode($value->id)])!!}">
							<div class="staff-list-box">
								<ul>
									<li> 
										<span class="staff-tital">Name: </span>
										<strong>{{ucfirst($value->name)}} {{$value->last_name}}</strong>
									</li>
									<li> 
										<span class="staff-tital">Department: </span>
										<strong>
											@if(!empty($value->department->department))
											{{ucfirst($value->department->department)}}
											@endif
										</strong>
									</li>
									<li> 
										<span class="staff-tital">Office: </span>
										<strong>
											@if(!empty($value->department->office->office))
											{{ucfirst($value->department->office->office)}} 
											@endif
										</strong>
									</li>	
									<li> 
										<span class="staff-tital">Organisation: </span>
										<strong>
											@if(!empty($value->department->office->organisation->organisation))
											{{ucfirst($value->department->office->organisation->organisation)}} 
											@endif
										</strong>
									</li>
									<li> 
										<span class="staff-tital">E-mail: </span>
										<strong>{{$value->email}}</strong>
									</li>																	
								</ul>
							</div>
						</a>
					</div>

					@endforeach

					<div class="organ-page-nav" >
						{!! $users->links('layouts.pagination') !!}                              
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
				// console.log(response);
				$('#office').append(response);
				$.ajax({
					type: "POST",
					url: "{!!URL::to('admin/get-search-users')!!}",
					data: {orgId:orgId,"_token":'<?php echo csrf_token()?>'},
					success: function(response) {
				// console.log(response);
				$('.add-search-data').html(response);
					}
					});


			}
		});
	});
</script>

<script type="text/javascript">
	$('#office').on('change', function() {
		$('#department option').remove();
		var officeId = $('#office').val();
		
		$.ajax({
			type: "POST",
			url: "{!!URL::to('admin/get-departments')!!}",				
			data: {officeId:officeId,"_token":'<?php echo csrf_token()?>'},
			success: function(response) 
			{				
				// console.log(response);
				$('#department').append(response);
				$.ajax({
					type: "POST",
					url: "{!!URL::to('admin/get-search-users')!!}",
					data: {officeId:officeId,"_token":'<?php echo csrf_token()?>'},
					success: function(response) {
				// console.log(response);
				$('.add-search-data').html(response);
					}
					});
			}
		});
	});
</script>

<script type="text/javascript">

	$('#department').on('change', function() {

		var departmentId = $('#department').val();

		$.ajax({
			type: "POST",
			url: "{!!URL::to('admin/get-search-users')!!}",
			data: {departmentId:departmentId,"_token":'<?php echo csrf_token()?>'},
			success: function(response) {
				// console.log(response);
				$('.add-search-data').html(response);
			}
		});

	});
</script>

@include('layouts.adminFooter')