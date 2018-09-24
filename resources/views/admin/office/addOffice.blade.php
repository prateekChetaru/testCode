@section('title', 'Add Office')
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
							<li> <a href="#">Add Office</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="content-top-right">
						<div class="add-btn-section">
							<a href="{{route('department.create')}}" class="btn ad-dorment" > <img src="{{asset('public/images/plus-icon.png')}}"> <span> Add Department </span></a>
							<a href="{{route('staff.create')}}" class="btn"> <img src="{{asset('public/images/plus-icon.png')}}"> <span> Add Staff </span></a>
						</div>
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
	<div class="ragistration-detele add-fild-section">

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="fild-stats-cont contact-cont">
						<h2> Add Office </h2>
						<div class="add-content">

							<form id="ofcForm" action="{{route('office.store')}}" method="post">
								{{csrf_field()}}
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<input id="office" type="text" name="office" class="form-control"  placeholder="Office">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input id="noOfEmp" type="text" name="noOfEmp" class="form-control numberControl" placeholder="No. Of Employees" autocomplete="off">
										</div>
									</div>
									<div class="col-md-6">										
										<div class="form-group">
											<select id="organisation"   class="form-control selectpicker" name="organisation">
											
												<option value="" disabled="" selected="">Select Organisation</option>
												@foreach($organisations as $value)
												<option value="{{$value->id}}">{{$value->organisation}}</option>
												@endforeach
											</select>
											<span class="select-arrow"> 
													<img src="{{asset('public/images/')}}/drop-arrow.png" class="mCS_img_loaded">
												</span>
										</div>										
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input id="address1" type="text" name="address1" class="form-control" placeholder="Address Line 1">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input id="address2" type="text" name="address2" class="form-control" placeholder="Address Line 2">
										</div>
									</div>

									

									<div class="col-md-6">
										<div class="form-group">
											<input id="city" name="city" type="text" class="form-control" placeholder="City">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input id="state" type="text" name="state" class="form-control" placeholder="State">
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group">
											<input id="country" type="text" name="country" class="form-control" placeholder="Country">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input id="zipcode" name="zipcode" type="text" class="form-control" placeholder="Zipcode" autocomplete="off">
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
									<button type="button" onclick="validation();" class="btn save"> save</button>
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
		// else if(address2 ==""){

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
		} else if(country ==""){

			$('#resp').html('');
			$('#resp').html('Please enter Country.');
		}   else if(zipcode ==""){

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