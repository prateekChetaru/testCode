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
							<li> <a href="#">Edit Department</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="page-tital1"> 
						<h2> {{$department->lead_name}} </h2>
						<span class="sub-tital"> {{$department->lead_email}} </span>
						<span class="sub-tital"> {{$department->lead_mobile}} </span>
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
			
							{{ Form::model($department, ['method' => 'PUT', 'route' => array('department.update', base64_encode($department->id)),'id'=>'form']) }}

			<div class="row">
				<div class="col-md-12">
					<div class="fild-stats-cont contact-cont">
						<h2> Edit Department </h2>
						<div class="add-content">

							
							<div class="row">									
								<div class="col-md-6">
									<div class="form-group">
										<label>Name </label>
										<input id="department" name="department" type="text" class="form-control" placeholder="Department" value="{{$department->department}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Number of Employees </label>
										<input id="noOfEmp" name="noOfEmp" type="text" class="form-control numberControl" placeholder="Number of Employees" value="{{$department->numberOfEmployees}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Organisation </label>
										<select id="organisation"  class="form-control selectpicker" name="organisation">
											
											<option value="" disabled="" selected="">Select Organisation</option>
											@foreach($organisations as $value)
											<option {{($value->id==$department->orgId)?'selected':''}} value="{{$value->id}}">{{ucfirst($value->organisation)}}</option>
											@endforeach
										</select>
										<span class="select-arrow"> 
													<img src="{{asset('public/images/')}}/drop-arrow.png" class="mCS_img_loaded">
												</span>
									</div>									
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Office </label>
										<select id="office" class="form-control " name="office" >
											
											<option value="" disabled="" selected="">Select Office</option>

											@foreach($offices as $oValue)
											
											<option {{($oValue->id==$department->officeId)?'selected':''}} value="{{$oValue->id}}">{{ucfirst($oValue->office)}}</option>
											@endforeach

										</select>
										<span class="select-arrow"> 
													<img src="{{asset('public/images/')}}/drop-arrow.png" class="mCS_img_loaded">
												</span>
									</div>	
								</div>

							</div>
							
						
						<div class="edit-btn">
					<button type="button" id="edit" onclick="enableAll();">
						<img src="{{asset('public/images/')}}/edit-icon.png" class="mCS_img_loaded"> 
						Edit 
					</button>
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
							<label>Name </label>
							<input id="lead_name" name="lead_name" type="text" class="form-control"  placeholder="Full Name" value="{{$department->lead_name}}">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>E-mail </label>
							<input id="lead_email" name="lead_email" type="text" class="form-control" placeholder=" Email" value="{{$department->lead_email}}">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Phone </label>
							<input id="lead_mobile" name="lead_mobile" type="phone" class="form-control numberControl" placeholder="Contact Number" value="{{$department->lead_mobile}}">
						</div>
					</div>

				</div>								
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="btn-box">

						<!-- 	<button class="back-btn"> Back </button> -->
						<button type="button" onclick="validation();" class="btn save"> Save </button>
					</div>
				</div>
			</div>
			

		</div>

	</div>
</div>	
			{!! Form::close() !!}
</div>
</div>
<div id="resp" class="error-message"></div>	
</main>

<script type="text/javascript">

		$( document ).ready(function() {
    //$("#ofcForm").children().prop('disabled',true);
    $("#form").find("input,button,textarea,select").prop("disabled", true);
    $("#edit").prop("disabled", false);
    
});

	function enableAll()
	{
		
		
		var e = $('#form input');
		
		if(e.is(':disabled'))
		{
			$("#edit").addClass('active');
			$("#form").find("input,button,textarea,select").prop("disabled", false);	
		}
		else
		{
			$("#edit").removeClass('active');
			$("#form").find("input,button,textarea,select").prop("disabled", true);
			$("#edit").prop("disabled", false);
		}

	}
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
		{$('.save').prop("disabled", true);
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