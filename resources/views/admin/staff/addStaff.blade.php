@section('title', 'Add Staff')

@include('layouts.adminHeader')
<title>Add staff</title>
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
							<li> <a href="#">Add staff</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="add-btn-section">
						
						<a href="{{route('office.create')}}" class="btn"> <img src="{{asset('public/images/plus-icon.png')}}"> <span> Add Office </span></a>
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
	<div class="ragistration-detele add-staff">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="fild-stats-cont contact-cont">
						<h2> Add Staff </h2>
						<div class="add-content">

							<form id="form" action="{{route('staff.store')}}" method="post">
								{{csrf_field()}}
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<input id="fname" name="fname" type="text" class="form-control"  placeholder="First Name">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input id="lname" name="lname" type="text" class="form-control" placeholder="Last Name">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<select id="organisation"  class="form-control selectpicker" name="organisation" >
											
												<option value="" disabled="" selected="">Select Organisation</option>
												@foreach($organisations as $value)
												<option value="{{$value->id}}">{{ucfirst($value->organisation)}}</option>
												@endforeach
											</select>
											<span class="select-arrow"> 
													<img src="{{asset('public/images/')}}/drop-arrow.png" class="mCS_img_loaded">
												</span>
										</div>									
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<select id="office"  class="form-control " name="office" >
											
												<option value="" disabled="" selected="">Select Office</option>

											</select>
											<span class="select-arrow"> 
													<img src="{{asset('public/images/')}}/drop-arrow.png" class="mCS_img_loaded">
												</span>
										</div>	
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<select id="department" name="department" class="form-control " name="office" >
											
												<option value="" disabled="" selected="">Select Department</option>

											</select>
											<span class="select-arrow"> 
													<img src="{{asset('public/images/')}}/drop-arrow.png" class="mCS_img_loaded">
												</span>
										</div>	
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input id="phone" name="phone" type="text" class="form-control numberControl" placeholder="Phone">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input id="email" name="email" type="text" class="form-control"  placeholder="E-mail">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input id="password" name="password" type="password" class="form-control" placeholder="Password">
										</div>
									</div>
								</div>
								<div class="btn-save">
									<button type="button" onclick="validation();" class="btn save"> save </button>
								</div>								
							</form>
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<div id="resp" class="error-message"></div>	
</main>

<script type="text/javascript">
	function validation()
	{
		var fname        = $('#fname').val();
		var lname        = $('#lname').val();
		var email        = $('#email').val();
		var password     = $('#password').val();
		var phone        = $('#phone').val();
		var organisation = $('#organisation').val();
		var office       = $('#office').val();
		var department   = $('#department').val();
		
		var is_email = isEmail(email);

		$('#resp').addClass('show-error');
		
		if (fname=='') {

			$('#resp').html();
			$('#resp').html('Please enter First Name.');
		}
		else if(lname=='')
		{
			$('#resp').html();
			$('#resp').html('Please enter Last Name.');
		}
		else if(!organisation)
		{
			$('#resp').html();
			$('#resp').html('Please select Organisation.');
		}
		else if(!office)
		{
			$('#resp').html();
			$('#resp').html('Please select Office.');
		}		
		else if(!department)
		{
			$('#resp').html();
			$('#resp').html('Please select Department.');
		}
		else if(phone =="")
		{
			$('#resp').html();
			$('#resp').html('Please enter Phone Number.');
		}
		else if(!is_email)
		{
			$('#resp').html();
			$('#resp').html('Please enter valid Email.');
		} 
		else if(password=='')
		{
			$('#resp').html();
			$('#resp').html('Please enter Password.');
		}
		else
		{
			$.ajax({
				type: "POST",
				url: "{!!URL::to('admin/search-email')!!}",				
				data: {email:email,"_token":'<?php echo csrf_token()?>'},
				success: function(response) 
				{
					console.log('email '+response);

					if(response)
					{
						$('#resp').html('');
						$('#resp').html('Email already exists. Please use another Email.');
					}
					else
					{
						$('.save').prop("disabled", true);
						$('#form').submit();
					}
				}
			});			
		} 
	}
</script>

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
				console.log(response);
				$('#department').append(response);
			}
		});
	});
</script>

<script type="text/javascript">

	$(".numberControl").on("keypress keyup blur",function (event) {  
		$(this).val($(this).val().replace(/[^\d].+/, ""));
		if ((event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});
</script>

<script type="text/javascript">

	function isEmail(email)
	{
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email);
	}
</script>

@include('layouts.adminFooter')