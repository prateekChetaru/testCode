@section('title', 'Admin Profile')
@include('layouts.adminHeader')
<main class="main-content">
	<div class="content-top profile_content-top">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="page-tital"> 
						<h2> Change Password : </h2>
						<span class="sub-tital"> {{Auth::user()->name}} </span>
					</div>					
				</div>				
			</div>
		</div>
	</div>

	<div class="ragistration-detele staff-detail">
		<div class="container">
			<div class="ragistration-detele-section">
				<div class="row">
					<div class="col-md-12">
						<h2> Change Password </h2>
					</div>
				</div>
				<form id="form" action="{!!URL::to('admin/profile-password-update')!!}" method="post" enctype="multipart/form-data">
					{{csrf_field()}}

					<input  type="hidden" name="email" value="{{$user->email}}">
					<div class="row">					
						<div class="col-md-6">							
							<div class="form-group">									
								<input class="form-control" id="currentpsw" type="password" name="currentpsw" placeholder="Current password" autocomplete="off" maxlength="50" >
								<!-- <span toggle="#currentpsw" class="field-icon toggle-password eye-icon"><img src="https://production.chetaru.co.uk/bluedata/public/images/eye-icon.png"><img src="https://production.chetaru.co.uk/bluedata/public/images/v-eye-icon.png"> </span> -->
							</div>									
							
							<div class="form-group">
								<input class="validate form-control" id="newpsw" type="password" name="newpsw" placeholder="New password" autocomplete="off" maxlength="50">
								<!-- <span toggle="#newpsw" class="field-icon toggle-password eye-icon"><img src="https://production.chetaru.co.uk/bluedata/public/images/eye-icon.png"><img src="https://production.chetaru.co.uk/bluedata/public/images/v-eye-icon.png"> </span> -->
							</div>								
							
							<div class="form-group">
								<input class="validate form-control" id="confirmPsw" type="password" name="confirmPsw" placeholder="Confirm password" autocomplete="off" maxlength="50">
								<!-- <span toggle="#confirmPsw" class="field-icon toggle-password eye-icon"><img src="https://production.chetaru.co.uk/bluedata/public/images/eye-icon.png"><img src="https://production.chetaru.co.uk/bluedata/public/images/v-eye-icon.png"> </span> -->
							</div>	
							
						</div>					
					</div>

					<!-- <div class="edit-btn">
						<button type="button" id="edit" onclick="enableAll();">
							<img src="{{asset('public/images/')}}/edit-icon.png" class="mCS_img_loaded"> 
							Edit 
						</button>
					</div> -->

					<div class="row">
						<div class="col-md-12">
							<div class="btn-save">
								<button type="button" onclick="validation()" class="btn save">SAVE</button>
							</div>
						</div>
					</div>
				
				</form>
			</div>
				<div id="resp" class="error-message"></div>	

					@if(count($errors)>0)

					<div id="resp" class="error-message text-danger show-error">{{$errors}}</div>			
					@endif

					@if(session('message'))			
					<div id="resp" class="error-message text-success show-error">{{session('message')}}</div>
					@endif
		</main>

<!-- 		<script type="text/javascript">

			$(document).ready(function()
			{
				
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
		</script> -->

		<script type="text/javascript">
			function validation()
			{
				$('#resp').addClass('show-error');

				if(!$('#currentpsw').val()){

					$('#resp').html('');
					$('#resp').html('Please enter Current Password.');
				}else if(!$('#newpsw').val()){

					$('#resp').html('');
					$('#resp').html('Please enter New Password.');
				}else if(!$('#confirmPsw').val()){

					$('#resp').html('');
					$('#resp').html('Please enter Confirm Password.');
				}else if($('#newpsw').val()!=$('#confirmPsw').val()){

					$('#resp').html('');
					$('#resp').html('New and confirm password are not same.');
				}else{
					$('#form').submit();
				}

			}
		</script>

		<script type="text/javascript">
			$(function() {
				$('.validate').on('keypress', function(e) {
					if (e.which == 32)				
						return false;
				});
			});
		</script>
		@include('layouts.adminFooter')

