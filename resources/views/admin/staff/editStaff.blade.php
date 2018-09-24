@section('title', 'Edit Staff')

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
							<li> <a href="#">Edit staff</a></li>
						</ul>
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
	<div class="ragistration-detele staff-detail">
		<div class="container">
			<div class="ragistration-detele-section">
				<div class="row">
					<div class="col-md-12">
						<h2> Staff Details </h2>
					</div>
				</div>
				{{ Form::model($users, ['method' => 'PUT', 'route' => array('staff.update', base64_encode($users->id)),'id'=>'staffForm']) }}
				<div class="row">
					
					<div class="col-md-6">
						<div class="form-group">
							<label>First Name </label>
							<input type="text" placeholder="First Name" class="form-control" name="fname" id="fname" value="{{ucfirst($users->name)}}">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Last Name </label>
							<input type="text" placeholder="Last Name" class="form-control" name="lname" id="lname" value="{{ucfirst($users->last_name)}}">
						</div>
					</div>
				</div>
				
				<div class="row">
					
					<div class="col-md-6">
						<div class="form-group">
							<label>Organisation </label>
							<select id="organisation"  class="form-control selectpicker" name="organisation" >
								
								<option value="" disabled="" selected="">Select Organisation</option>
								@foreach($organisations as $value)
								<option {{($value->id==$users->organisation_id)?'selected':''}} value="{{$value->id}}">{{ucfirst($value->organisation)}}</option>
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
							<select id="office"  class="form-control " name="office" >
								
								<option value="" disabled="" selected="">Select Office</option>
								@foreach($offices as $oValue)											
								<option {{($oValue->id==$users->office_id)?'selected':''}} value="{{$oValue->id}}">{{ucfirst($oValue->office)}}</option>
								@endforeach
							</select>
							<span class="select-arrow"> 
													<img src="{{asset('public/images/')}}/drop-arrow.png" class="mCS_img_loaded">
												</span>
						</div>
					</div>
				</div>
				
				<div class="row">
					
					<div class="col-md-6">
						<div class="form-group">
							<label>Department </label>
							<select id="department" name="department" class="form-control " name="office">

								<option value="" disabled="" selected="">Select Department</option>
								@foreach($departments as $dValue)											
								<option {{($dValue->id==$users->department_id)?'selected':''}} value="{{$oValue->id}}">{{ucfirst($dValue->department)}}</option>
								@endforeach
							</select>
							<span class="select-arrow"> 
													<img src="{{asset('public/images/')}}/drop-arrow.png" class="mCS_img_loaded">
												</span>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Phone </label>
							<input type="text" placeholder="Phone" class="form-control" name="phone" id="phone" value="{{$users->phone}}" maxlength="10">
						</div>
					</div>
				</div>
				
				<div class="row">
					
					<div class="col-md-6">
						<div class="form-group">
							<label>E-mail </label>
							<input type="text" placeholder="E-mail" class="form-control" name="email" id="email" value="{{$users->email}}" readonly="">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Password </label>
							<input id="password-field" type="password" class="form-control" placeholder="Password"  name="password" id="password" value="{{base64_decode($users->password2)}}">
						</div>
						<span toggle="#password-field" class="field-icon toggle-password eye-icon"><img src="{{asset('public/images/eye-icon-d.png')}}"> </span>
					</div>
				</div>
				
				<div class="edit-btn">
					<button type="button" id="edit" onclick="enableAll();">
						<img src="{{asset('public/images/')}}/edit-icon.png" class="mCS_img_loaded"> 
						Edit 
					</button>
				</div>
				<div class="row">
					
					<div class="col-md-12">
						<div class="btn-box">
							
							<!-- 	<button class="back-btn"> Back </button> -->
							<button type="button" onclick="validation();" class="btn save"> Save </button>
						</div>
					</div>
				</div>
			
			</form>
		</div>
	</div>
</div>
	<div id="resp" class="error-message"></div>	
</main>
<script type="text/javascript">

		$( document ).ready(function() {
    //$("#ofcForm").children().prop('disabled',true);
    $("#staffForm").find("input,button,textarea,select").prop("disabled", true);
    $("#edit").prop("disabled", false);
    
});

	function enableAll()
	{
		
		
		var e = $('#staffForm input');
		
		if(e.is(':disabled'))
		{
			$("#edit").addClass('active');
			$("#staffForm").find("input,button,textarea,select").prop("disabled", false);	
		}
		else
		{
			$("#edit").removeClass('active');
			$("#staffForm").find("input,button,textarea,select").prop("disabled", true);
			$("#edit").prop("disabled", false);
		}

	}
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
		// else if(!is_email)
		// {
		// 	$('#resp').html();
		// 	$('#resp').html('Please enter valid Email.');
		// } 
		else if(password='')
		{
			$('#resp').html();
			$('#resp').html('Please enter Password.');
		}
		else
		{
			$('.save').prop("disabled", true);
			$('#staffForm').submit();
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