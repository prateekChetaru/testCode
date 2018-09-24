@section('title', 'Edit Organisation')
@include('layouts.adminHeader')
<main class="main-content">
	<div class="content-top">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="page-tital"> 
						<h2> Organisation : {{$organisation->organisation}} </h2>
						<span class="sub-tital"> {{Auth::user()->name}} </span>
					</div>
					<div class="page-nav">
						<ul>
							<li> <a href="{{URL::to('admin/admin-dashboard')}}">Dashboard</a> </li>
							<li> <a href="{{route('organisation.index')}}">Organisations</a></li>
							<li> <a href="#">Edit organisation</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="page-tital1"> 
						<h2> {{$organisation->lead_name}} </h2>
						<span class="sub-tital"> {{$organisation->lead_email}} </span>
						<span class="sub-tital"> {{$organisation->lead_mobile}} </span>
					</div>
				</div>
								<!-- <div class="col-md-6">
									<div class="content-top-right">
										<div class="add-btn-section">
											<a href="#" class="btn"> <img src="{{asset('public/images/') }}/plus-icon.png"> <span> Add Office </span></a>
											<a href="#" class="btn"> <img src="{{asset('public/images/') }}/plus-icon.png"> <span> Add Machine </span></a>
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
							
							

							<div class="ragistration-detele-map">
								<div class="detele-tab">
									<ul class="nav nav-tabs">
										<li>
											<a href="#machine" class="active" data-toggle="tab" aria-expanded="true">
												<img class="wite-icon" src="{{asset('public/images/machine-icon-d.png')}}">
												<img class="gray-icon" src="{{asset('public/images/machine-icon.png')}}"> 
												<span> MACHINE </span>
											</a>
										</li> 
										<li>
											<a  href="#offices" data-toggle="tab" aria-expanded="false">
												<img class="wite-icon" src="{{asset('public/images/office-icon.png')}}">
												<img class="gray-icon" src="{{asset('public/images/gray-office-icon.png')}}"> 
												<span> OFFICES </span>
											</a>
										</li>
										<li>
											<a href="#detail" data-toggle="tab" aria-expanded="false">
												<img class="wite-icon" src="{{asset('public/images/detail-icon-w.png')}}">
												<img class="gray-icon" src="{{asset('public/images/detail-icon.png')}}"> 
												<span> Details </span>
											</a>
										</li>          
									</ul>
								</div>
								<div>
									<a href="{{URL::to('admin/machine-reports\/').base64_encode($organisation->id)}}" class="report-btn" >
								<img  src="{{asset('public/images/report.png')}}"> 
										Reports</a>
								</div>
							</div>

							<div class="office-detele-section tab-content">
								<div class="tab-pane fade " id="offices"> 

									<div class="ragistration-detele-section office-detele">
										<div class="row">
											<div class="col-md-12">
												<h2> Offices </h2>
												<!-- <a href="{{route('office.create')}}" class="btn"> <img src="{{asset('public/images/plus-icon.png')}}"> <span> Add Office </span></a> -->
												<div class="office-box">

													@foreach($offices as $office)

													<a href="{!!route('office.edit',['id'=>base64_encode($office->id)])!!}">
														<div class="office-box-detel">
															<div class="office-tital">
																<span class="office-map-icon"> <img src="{{asset('public/images/office-map-icon.png')}}"> </span>
																<h3> {{$office->country}}</h3>
															</div>
															<div class="office-addres">
																<span class="office-ad-icon"> <img src="{{asset('public/images/adders-icon.png')}}"></span>
																<p> 
																	{{$office->address1}}
																	
																	<!-- 	{{$office->address2}} -->
																</p>
															</div>
															<div class="machines-tital">
																<h3> Machines: <span class="m-number">{{count($machines)}}</span> </h3>
															</div>
														</div>
													</a>
													@endforeach

												</div>
											</div>
										</div>
									</div>
								</div>

								

								<div class="tab-pane fade active in show" id="machine">
									<div class="ragistration-detele-section">
										<div class="machine-detele">
											<?php
											
											if(!$machines->isEmpty())
											{
												?>
												<table>
													<tr>
														<th> Machine </th>
														<!-- <th> Location </th>		 -->											
														<!-- <th> Instructions </th> -->
														<th> Status </th>
														<th> Machine Directive </th>
														<th> User Directive </th>
													</tr>
													@foreach($machines as $machine)
													<tr>									
														<td><a href="{!!route('machine.edit',['id'=>base64_encode($machine->id)])!!}">{{$machine->machine_id}}</a> </td>

														<!-- <td> Birmingham </td> -->


													<!-- <td> Yes </td>
													-->
													<td> {{$machine->machine_status}} </td>

													<td>
														@if(!empty($machine->answer))

														@php $i=0;@endphp

														@foreach($machine->answer as $answer)

														@if($i==0)

														<a href="javascript:void(0);" onclick="formPreview(<?php echo $machine->id; ?>,<?php echo $answer->question->form->id; ?>)" >{{$answer->question->form->name}} </a>
														
														@endif

														@php $i++ ; @endphp

														@endforeach
														
														@endif
													</td>

													
													<td><a href="{{URL::to('admin/machine-operation-user-list\/').base64_encode($machine->id)}}"> {{(!empty($machine->udrForm->name))?ucfirst($machine->udrForm->name):''}}</a><?php if(!empty($machine->udrForm->name)) {?> <span style="font-size: 11px; font-style: italic;">(Responses: {{$machine->machineOperatorUser->count()}}) </span><?php } ?></td>

												</tr>
												@endforeach
											</table>
											<?php
										}
										else
										{
											?>
											<div class="add-btn-section">
												<h5 class="no-response">No machines added for this organisation yet.</h5>
												<a href="{{route('machine.create')}}" class="btn"> <img src="{{asset('public/images/plus-icon.png')}}"> <span> Add Machine </span></a>
											</div>
											<?php
										}
										?>
									</div>
								</div>
							</div>
							<div class="tab-pane fade" id="detail">
								<div class="ragistration-detele-section">
									<div class="row">
										<div class="col-md-12">
											<h2> Organisation </h2>
											<div class="del-chng-cont">
													<!-- <div class="rgist-compy-logo">
														
													</div> -->
											<!-- <div class="chng-dlt-btn">
												<button class="change"> Change </button>
												<button class="dlt"> delete </button>
											</div> -->
										</div>
									</div>
								</div>

								{{ Form::model($organisation, ['method' => 'PUT', 'route' => array('organisation.update', base64_encode($organisation->id)),'id'=>'orgForm']) }}

								<input type="hidden" name="userId" value="{{$user->id}}">

								

								<input type="hidden" name="orgId" value="{{$organisation->id}}">

								<div class="row">
									
									<div class="col-md-6">
										<div class="form-group">
											<label>Name </label>
											<input id="organisation" name="organisation" class="form-control length50" type="text" placeholder="Name of Organisation " value="{{ucfirst($organisation->organisation)}}">
										</div>
										<div class="form-group">
											<label>Industry </label>
											<input id="industry" name="industry" class="form-control length50" type="text" placeholder="Industry type" value="{{ucfirst($organisation->industry)}}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="edit-org-img">
											@if($organisation->ImageURL)
											<img src="{{asset('public/uploads/org_images').'/'.$organisation->ImageURL}}">
											@else
											<img src="{{asset('public/images/no-image.png')}}">
											@endif
										</div>
									</div>
								</div>
								

							</div>
							<div class="ragistration-detele-section">
								<div class="row">
									<div class="col-md-12">
										<h2> Details </h2>
									</div>
								</div>


								<div class="row">
									
									<div class="col-md-6">
										<div class="form-group">
											<label>Address 1 </label>
											<input id="address1" name="address1" class="form-control length200" type="text" placeholder="Address 1" value="{{ucfirst($organisation->address1)}}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Address 2 </label>
											<input id="address2" name="address2" class="form-control length200" type="text" placeholder="Address 2" value="{{ucfirst($organisation->address2)}}">
										</div>
									</div>
								</div>

								

								<div class="row">
									
									<div class="col-md-6">
										<div class="form-group">
											<label>City </label>
											<input id="city" name="city" class="form-control length50" type="text" placeholder="City" value="{{ucfirst($organisation->city)}}"> 
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Country </label>
											<input id="country" name="country" class="form-control length50" type="text" placeholder="Country" value="{{ucfirst($organisation->country)}}"> 
										</div>
									</div>
								</div>


								<div class="row">
									
									<div class="col-md-6">
										<div class="form-group">
											<label>Zipcode </label>
											<input id="zipcode" name="zipcode" class="form-control length50" type="text" placeholder="Zipcode" value="{{$organisation->postcode}}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Phone </label>
											<input id="phone" name="phone" class="form-control length50" type="text" placeholder="Phone" value="{{$organisation->phone}}" maxlength="10"> 
										</div>
									</div>
								</div>
								<div class="row">
									
									
								</div>


								<div class="row">

									<div class="col-md-6">
										<div class="form-group">
											<label>E-mail </label>
											<input id="email" name="email" class="form-control length50" type="text" placeholder="E-mail" value="{{$user->email}}" readonly="">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Website </label>
											<input id="website" name="website" class="form-control length100" type="text" placeholder="Website" value="{{$organisation->website}}">
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
														<input id="lead_name" name="lead_name" type="text" class="form-control length50"  placeholder="Full Name" value="{{$organisation->lead_name}}">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>E-mail </label>
														<input id="lead_email" name="lead_email" type="text" class="form-control length50" placeholder=" Email" value="{{$organisation->lead_email}}">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Phone </label>
														<input id="lead_mobile" name="lead_mobile" type="phone" class="form-control numberControl length50" placeholder="Contact Number" value="{{$organisation->lead_mobile}}">
													</div>
												</div>
												
											</div>								
										</div>
									</div>
								</div>
							</div>
							<div class="ragistration-detele-section">
								<div class="row">
									<div class="col-md-12">
										<h2> Admin </h2>
									</div>
								</div>

								<div class="row">
									
									<div class="col-md-4">
										<div class="form-group">
											<label> First Name </label>
											<input id="fname" name="fname" class="form-control length50" type="text" placeholder="First Name" value="{{ucfirst($user->name)}}">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label> Last Name </label>
											<input id="lname" name="lname" class="form-control length50" type="text" placeholder="Last Name" value="{{ucfirst($user->last_name)}}">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label>Password </label>
											<input id="password" name="password" type="password" class="form-control length50" placeholder="Password" value="{{base64_decode($user->password2)}}">
										</div>
										<span toggle="#password" class=" toggle-password eye-icon"><img src="{{asset('public/images/eye-icon-d.png')}}"> <img src="{{asset('public/images/v-eye-icon.png')}}"> </span>
									</div>
								</div>
								
								<div class="row">									
									<div class="col-md-12">
										<div class="btn-save edit-orgition">
											<button type="button" onclick="validation();" class="btn save"> save </button>
										</div>
									</div>
								</div>	
								
							</div>				
							
							{!! Form::close() !!}
						</div>

					</div>

				</div>
			</div>
			<div id="resp" class="error-message"></div>
		</main>

		<button id="modalbtn" type="hidden" style="display: none;" data-toggle="modal" data-target="#myModal1"></button>
		<!-- Modal create new user-->

		<div class="appendMacnDrhtml"></div>

		<script type="text/javascript">



		$(".toggle-password").click(function() {
			$(this).toggleClass("field-icon");
			var input = $($(this).attr("toggle"));
			if (input.attr("type") == "password") {
				input.attr("type", "text");
			} else {
				input.attr("type", "password");
			}
		});	
	

			function formPreview(machineId,tempId)
			{
				$.ajax({
					type: "GET",					
					url: "{{route('previewForm')}}",				
					data: {machineId:machineId,tempId:tempId,"_token":'<?php echo csrf_token()?>'},
					success: function(response) 
					{				
						$('.appendMacnDrhtml div').remove();
						$('.appendMacnDrhtml').append(response);
						$('#modalbtn').click();
					}
				});
			}
			
		</script>

		<script type="text/javascript">

			function validation() {

				var orgName  = $('#organisation').val();
				var industry = $('#industry').val();		
				var address1 = $('#address1').val();
				var address2 = $('#address2').val();
				var city     = $('#city').val();
				var zipCode  = $('#zipcode').val();
				var country  = $('#country').val();
				var phone    = $('#phone').val();
				var website  = $('#website').val();
				var fname    = $('#fname').val();
				var lname    = $('#lname').val();
				var email    = $('#email').val();
				var password = $('#password').val();
				var lead_name = $('#lead_name').val();
				var lead_email = $('#lead_email').val();
				var lead_mobile = $('#lead_mobile').val();

						// var orgLogoCount = document.getElementById("imgInp").files.length;

						// else if(orgLogoCount== 0){

						// 	$('#resp').html('');
						// 	$('#resp').html('Please enter organisation logo.');
						// }

						is_email = isEmail(email);

						isWebUrl = isUrlValid(website);

						$('#resp').addClass('show-error');
						
						if(orgName ==""){

							$('#resp').html('');
							$('#resp').html('Please enter Organisation.');
						} else if(industry ==""){

							$('#resp').html('');
							$('#resp').html('Please enter Industry.');
						} else if(address1 ==""){

							$('#resp').html('');
							$('#resp').html('Please enter Address Line 1.');
						} 
						//else if(address2 ==""){

						// 	$('#resp').html('');
						// 	$('#resp').html('Please enter Address Line 2.');
						// } 
						else if (address1==address2) {

							$('#resp').html('');
							$('#resp').html('Address Line 1 and Line 2 same.');
						} else if(city ==""){

							$('#resp').html('');
							$('#resp').html('Please enter City.');
						} else if(zipCode ==""){

							$('#resp').html('');
							$('#resp').html('Please enter Zipcode.');
						} else if(country ==""){

							$('#resp').html('');
							$('#resp').html('Please enter Country.');
						} else if(phone ==""){

							$('#resp').html('');
							$('#resp').html('Please enter Phone.');
						} else if(website =="" || !isWebUrl){

							$('#resp').html('');
							$('#resp').html('Please enter valid Website.');
						}else if(lead_name =="" ){

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
						} else if(fname==""){

							$('#resp').html('');
							$('#resp').html('Please enter First Name.');
						}else if(lname==""){

							$('#resp').html('');
							$('#resp').html('Please enter Last Name.');
						} else if(!is_email){

							$('#resp').html('');
							$('#resp').html('Please enter valid Email.');
						} else if (password=="") {

							$('#resp').html('');
							$('#resp').html('Please enter user Password.');
						}
						else if(password.length < 6)
						{
							$('#resp').html('');
							$('#resp').html('Your Password should be more than 6 character.');
						}
						else if(! isEmail($('#lead_email').val()))
						{
							$('#resp').html('');
							$('#resp').html('Please enter valid lead contact person E-mail.');
						} else {

							$('.save').prop("disabled", true);
							$('#orgForm').submit();							
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