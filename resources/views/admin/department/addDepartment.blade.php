@section('title', 'Add Department')

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
							<li> <a href="#">Add Department</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="add-btn-section">
						<a href="{{route('organisation.create')}}" class="btn ad-dorment"> <img src="{{asset('public/images/plus-icon.png')}}"> <span> Add Organisation </span></a>
						<a href="{{route('office.create')}}" class="btn"> <img src="{{asset('public/images/plus-icon.png')}}"> <span> Add Office </span></a>
						
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
						<h2> Add Department </h2>
						<div class="add-content">

							<form id="form" action="{{route('department.store')}}" method="POST">

								{{csrf_field()}}
								<div class="row">									
									<div class="col-md-6">
										<div class="form-group">
											<input id="department" name="department" type="text" class="form-control" placeholder="Department">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input id="noOfEmp" name="noOfEmp" type="text" class="form-control numberControl" placeholder="Number of Employees">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<select id="organisation"  class="form-control selectpicker" name="organisation">
												
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
											<select id="office" class="form-control " name="office" >
												
												<option value="" disabled="" selected="">Select Office</option>
											</select>
											<span class="select-arrow"> 
													<img src="{{asset('public/images/')}}/drop-arrow.png" class="mCS_img_loaded">
												</span>
										</div>	
									</div>	

								</div>
								
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="fild-stats-cont contact-cont">
						<h2> Lead Contact Person </h2>
						<div class="add-content">

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<input id="lead_name" name="lead_name" type="text" class="form-control"  placeholder="Full Name">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input id="lead_email" name="lead_email" type="text" class="form-control" placeholder=" Email">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<input id="lead_mobile" name="lead_mobile" type="phone" class="form-control numberControl" placeholder="Contact Number">
									</div>
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
	<div id="resp" class="error-message"></div>	
</main>

<script type="text/javascript">
	function validation()
	{	
		var department   = $('#department').val();
		var noOfEmp      = $('#noOfEmp').val();
		var organisation = $('#organisation').val();
		var office       = $('#office').val();
		var lead_name = $('#lead_name').val();
		var lead_email = $('#lead_email').val();
		var lead_mobile = $('#lead_mobile').val();

		$('#resp').addClass('show-error');

		if(department =='')
		{
			$('#resp').html();
			$('#resp').html('Please enter Department Name.');
		} 
		else if (noOfEmp=='')
		{
			$('#resp').html();
			$('#resp').html('Please enter Number of Employees.');
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
		else if(lead_name =="" ){

			$('#resp').html('');
			$('#resp').html('Please enter lead Full Name.'); 
		}
		else if(lead_email ==""){

			$('#resp').html('');
			$('#resp').html('Please enter lead E-mail.'); 
		}
		else if(lead_mobile =="" ){

			$('#resp').html('');
			$('#resp').html('Please enter lead Contact Number.'); 
		}
		else if(! isEmail($('#lead_email').val()))
		{
			$('#resp').html('');
			$('#resp').html('Please enter valid lead contact person E-mail.');
		}	
		else
		{
			$('.save').prop("disabled", true);
			$('#form').submit();		
		}
	}
</script>

<script type="text/javascript">	
	$('#organisation').on('change', function() {
		console.log('hi');
		$('#office option').remove();
		var orgId = $('#organisation').val();

		$.ajax({
			type: "POST",
			url: "{!!URL::to('admin/get-offices')!!}",				
			data: {orgId:orgId,"_token":'<?php echo csrf_token()?>'},
			success: function(response) 
			{
				console.log(response);
				$('#office').append(response);
			}
		});
	});
</script>

<script type="text/javascript">
function isEmail(email)
					{
						var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
						return regex.test(email);
					}
	$(".numberControl").on("keypress keyup blur",function (event) {  
		$(this).val($(this).val().replace(/[^\d].+/, ""));
		if ((event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});
</script>

@include('layouts.adminFooter')