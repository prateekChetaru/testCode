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
	<div class="ragistration-detele add-fild-section">
		<div class="container">
			<form id="orgForm" action="{{route('organisation.store')}}" method="post" enctype="multipart/form-data">
				
				{{csrf_field()}}
				<div class="row">
					<div class="col-md-12">
						<div class="fild-stats-cont">
							<h2> Add Organisations </h2>
							<div class="add-content">								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<input id="orgId"  name="organisation" type="text" class="form-control"  placeholder=" Organisations Name">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input id="industry" name="industry" type="text" class="form-control" placeholder="Industry Type">
										</div>
									</div>
								</div>							
							</div>

							<div class="add-logo-section">
								<div class="add-logo-box">
									<img src="{{asset('public/images/add-icon.png')}}">
									<h4> Add Logo </h4>
									<!-- <div id="form1"> -->
										<input id="imgInp" name="orgLogo" type="file" value="" />
										<!-- </div> -->
									</div>
									<div class="add-img-box"> <img id="blah" src="#" alt="Preview Logo" /> </div>
								</div>

							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="fild-stats-cont contact-cont">
								<h2> Contact </h2>
								<div class="add-content">

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<input id="add1" name="address1" type="text" class="form-control"  placeholder="Address 1">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input id="add2" name="address2" type="text" class="form-control" placeholder="Address 2">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input id="city" name="city" type="text" class="form-control" placeholder="City">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input id="zipCode" name="zipCode" type="text" class="form-control numberControl" placeholder="zip code" autocomplete="off">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input id="country" name="country" type="text" class="form-control" placeholder="Country">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input id="phone" name="phone" type="phone" class="form-control numberControl" placeholder="Phone" autocomplete="off">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input id="website" name="website" type="text" class="form-control" placeholder="Website">
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
								<h2> Create Admin </h2>
								<div class="add-content">

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
												<input id="email" name="email" type="email" class="form-control" placeholder="Email">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<input id="password" name="password" type="password" class="form-control" placeholder="Password">
											</div>
										</div>
									</div>

								</div>
							</div>
							<div class="btn-save">
								<button type="button" onclick="validation();" class="btn"> save </button>
							</div>
							<div class="error-message">
								<span id="resp"></span>
							</div>	
						</div>
					</div>
				</form>
			</div>		
		</div>
	</main>


	<script type="text/javascript">

		function validation() {

			var orgName  = $('#orgId').val();
			var industry = $('#industry').val();		
			var add1     = $('#add1').val();
			var add2     = $('#add2').val();
			var city     = $('#city').val();
			var zipCode  = $('#zipCode').val();
			var country  = $('#country').val();
			var phone    = $('#phone').val();
			var website  = $('#website').val();
			var fname    = $('#fname').val();
			var lname    = $('#lname').val();
			var email    = $('#email').val();
			var password = $('#password').val();

			var orgLogoCount = document.getElementById("imgInp").files.length;

			is_email = isEmail(email);

			isWebUrl = isUrlValid(website);


			if(orgName ==""){

				$('#resp').html('');
				$('#resp').html('Please enter organisation.');
			} else if(industry ==""){

				$('#resp').html('');
				$('#resp').html('Please enter industry.');
			} else if(orgLogoCount== 0){

				$('#resp').html('');
				$('#resp').html('Please enter organisation logo.');
			} else if(add1 ==""){

				$('#resp').html('');
				$('#resp').html('Please enter address1.');
			} else if(add2 ==""){

				$('#resp').html('');
				$('#resp').html('Please enter address2.');
			} else if (add1==add2) {

				$('#resp').html('');
				$('#resp').html('address1 and address2 same !.');
			} else if(city ==""){

				$('#resp').html('');
				$('#resp').html('Please enter city.');
			} else if(zipCode ==""){

				$('#resp').html('');
				$('#resp').html('Please enter zip code.');
			} else if(country ==""){

				$('#resp').html('');
				$('#resp').html('Please enter country.');
			} else if(phone ==""){

				$('#resp').html('');
				$('#resp').html('Please enter phone number.');
			} else if(website =="" || !isWebUrl){

				$('#resp').html('');
				$('#resp').html('Please enter valid website address.');
			} else if(fname==""){

				$('#resp').html('');
				$('#resp').html('Please enter first name.');
			} else if(email =="" || !is_email){

				$('#resp').html('');
				$('#resp').html('Please enter valid email.');
			} else if (password=="") {

				$('#resp').html('');
				$('#resp').html('Please enter user password.');
			} else {

				$.ajax({
					type: "POST",
					url: "{!!URL::to('admin/search-email')!!}",				
					data: {email:email,"_token":'<?php echo csrf_token()?>'},
					success: function(response) {
       			// console.log('email '+response);

       			if(response)
       			{
       				$('#resp').html('');
       				$('#resp').html('Admin email already exists.');

       			}
       			else
       			{
       				$('#orgForm').submit();
       			}
       		}
       	});			
			} 
		}				
	</script>

	<script type="text/javascript">

		function isEmail(email)
		{
			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			return regex.test(email);
		}
//check valid website url
function isUrlValid(url) {
	return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
}

</script>

<script type="text/javascript">

	$(".numberControl").on("keypress keyup blur",function (event) {  
		$(this).val($(this).val().replace(/[^\d].+/, ""));
		if ((event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});
</script>
@include('layouts.adminFooter')