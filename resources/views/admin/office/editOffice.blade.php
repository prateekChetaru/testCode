@section('title', 'Edit Office')
@include('layouts.adminHeader')
<main class="main-content">
	<div class="content-top">
		<div class="container">			
			<div class="row">
				<div class="col-md-6">
					<div class="page-tital"> 
						<h2> Office : </h2>
						<span class="sub-tital"> {{Auth::user()->name}} </span>
					</div>
					<div class="page-nav">
						<ul>
							<li> <a href="{{URL::to('admin/admin-dashboard')}}">Dashboard</a></li>
							<li> <a href="{{URL::to('admin/office')}}">Office</a></li>
							<li> <a href="#">Edit Office</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="page-tital1"> 
						<h2> {{$office->lead_name}} </h2>
						<span class="sub-tital"> {{$office->lead_email}} </span>
						<span class="sub-tital"> {{$office->lead_mobile}} </span>
					</div>
				</div>
				<!-- <div class="col-md-6">
					<div class="content-top-right">
						<div class="add-btn-section">
							<a href="{{route('office.create')}}" class="btn"> <img src="{{asset('public/images/plus-icon.png')}}"> <span> Add Office </span></a>
							<a href="#" class="btn"> <img src="{{asset('public/images/plus-icon.png')}}"> <span> Add Machine </span></a>
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</div>
	@if(session('message'))
	<div class="success">
		<p align="center" class="alert alert-success" > {{session('message')}}</p>
	</div>
	@endif
	<div class="ragistration-detele add-fild-section">

		<div class="container">
			{{ Form::model($office, ['method' => 'PUT', 'route' => array('office.update', base64_encode($office->id)),'id'=>'ofcForm']) }}
			<div class="row">
				<div class="col-md-12">
					<div class="fild-stats-cont contact-cont">
						<h2> Office </h2>
						<div class="add-content">
							
							
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Office </label>
										<input id="office" type="text" name="office" class="form-control"  placeholder="Office" value="{{$office->office}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>No. Of Employees </label>
										<input id="noOfEmp" type="text" name="noOfEmp" class="form-control numberControl" placeholder="No. Of Employees" autocomplete="off" value="{{$office->numberOfEmployees}}">
									</div>
								</div>
								<div class="col-md-6">										
									<div class="form-group">
										<label>Select Organisation </label>
										<select id="organisation"  class="form-control selectpicker" name="organisation" >
											
											<option value="" disabled="" selected="">Select Organisation</option>
											@foreach($organisations as $value)
											<option <?php echo ($value->id==$office->orgId)?'selected':'';  ?> value="{{$value->id}}">{{$value->organisation}}</option>
											@endforeach
										</select>
										<span class="select-arrow"> 
													<img src="{{asset('public/images/')}}/drop-arrow.png" class="mCS_img_loaded">
												</span>
									</div>										
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Address Line 1 </label>
										<input id="address1" type="text" name="address1" class="form-control" placeholder="Address Line 1" value="{{$office->address1}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Address Line 2 </label>
										<input id="address2" type="text" name="address2" class="form-control" placeholder="Address Line 2" value="{{$office->address2}}">
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label>City </label>
										<input id="city" name="city" type="text" class="form-control" placeholder="City" value="{{$office->city}}">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>State </label>
										<input id="state" type="text" name="state" class="form-control" placeholder="State" value="{{$office->state}}">
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group">
										<label>Country </label>
										<input id="country" type="text" name="country" class="form-control" placeholder="Country" value="{{$office->country}}">
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group">
										<label>Zipcode </label>
										<input id="zipcode" name="zipcode" type="text" class="form-control numberControl" placeholder="Zipcode" autocomplete="off" value="{{$office->postcode}}">
									</div>
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
			<div class="row">
				<div class="col-md-12">
					<div class="fild-stats-cont contact-cont">
						<h2> Lead Contact Person </h2>
						<div class="add-content">

							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label>Name </label>
										<input id="lead_name" name="lead_name" type="text" class="form-control"  placeholder="Full Name" value="{{$office->lead_name}}">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>E-mail </label>
										<input id="lead_email" name="lead_email" type="text" class="form-control" placeholder=" Email" value="{{$office->lead_email}}">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Phone </label>
										<input id="lead_mobile" name="lead_mobile" type="phone" class="form-control numberControl" placeholder="Contact Number" value="{{$office->lead_mobile}}">
									</div>
								</div>

							</div>								
						</div>
						<div class="btn-save">
							<button type="button" onclick="validation();" class="btn save"> Save</button>
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

	$( document ).ready(function() {
    //$("#ofcForm").children().prop('disabled',true);
    $("#ofcForm").find("input,button,textarea,select").prop("disabled", true);
    $("#edit").prop("disabled", false);
    
});

	function enableAll()
	{
		
		

		var e = $('#ofcForm input');
		
		if(e.is(':disabled'))
		{
			$("#edit").addClass('active');
			$("#ofcForm").find("input,button,textarea,select").prop("disabled", false);	
		}
		else
		{
			$("#edit").removeClass('active');
			$("#ofcForm").find("input,button,textarea,select").prop("disabled", true);
			$("#edit").prop("disabled", false);
		}
		


	}

	function validation() {

		var office   = $('#office').val();
		var noOfEmp  = $('#noOfEmp').val();		
		var address1 = $('#address1').val();
		var address2 = $('#address2').val();
		var organisation = $('#organisation').val();
		var country  = $('#country').val();
		var state    = $('#state').val();
		var city     = $('#city').val();		
		var zipcode  = $('#zipcode').val();
		var lead_name = $('#lead_name').val();
		var lead_email = $('#lead_email').val();
		var lead_mobile = $('#lead_mobile').val();

		// console.log(organisation);
		$('#resp').addClass('show-error');
		
		if(office ==""){

			$('#resp').html('');
			$('#resp').html('Please enter Office Name.');
		} else if(noOfEmp ==""){

			$('#resp').html('');
			$('#resp').html('Please enter No. Of Employees.');
		}else if(!organisation){

			$('#resp').html('');
			$('#resp').html('Please select Organisation.');
		} else if(address1 ==""){

			$('#resp').html('');
			$('#resp').html('Please enter Address Line 1.');
		}
		//  else if(address2 ==""){

		// 	$('#resp').html('');
		// 	$('#resp').html('Please enter Address Line 2.');
		// } 
		else if (address1==address2) {

			$('#resp').html('');
			$('#resp').html('Address Line 1 and Line 2 same.');
		} else if(city ==""){

			$('#resp').html('');
			$('#resp').html('Please enter City.');
		}else if(state ==""){

			$('#resp').html('');
			$('#resp').html('Please enter State.');
		}  else if(country ==""){

			$('#resp').html('');
			$('#resp').html('Please enter Country.');
		}  else if(zipcode ==""){

			$('#resp').html('');
			$('#resp').html('Please enter Zipcode.');
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
		else {
			$('.save').prop("disabled", true);

			$('#ofcForm').submit();

		} 
	}				
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