@section('title', 'Admin Profile')
@include('layouts.adminHeader')
<main class="main-content">
	<div class="content-top profile_content-top">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="page-tital"> 
						<h2> Account Information : </h2>
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
						<h2> Account Information </h2>
					</div>
				</div>
				<form id="form" action="{!!route('admin.profile.update')!!}" method="post" enctype="multipart/form-data">
					{{csrf_field()}}

					<div class="edit-profile-section">
						<div class="edit-profile-img">
							<img id="blah" src="{{asset('public/uploads/user_profile\/').$user->image_url}}" alt="Preview Image" class="mCS_img_loaded">	
						</div> 
						<div class="edit-profile-btn">	
							<div id="form1" runat="server">
								<input type='file' id="imgInp" name="profileImg">
								<i class="fa fa-pencil" aria-hidden="true"></i>
							</div>
						</div>
					</div>

					<div class="row">					
						<div class="col-md-6">
							<label>Name</label>
							<div class="form-group">									
								<input class="form-control" id="name"  type="text" name="name" placeholder="Name" maxlength="50" value="{{$user->name}}">
							</div>									
						</div>
						<div class="col-md-6">
							<label>Email</label>
							<div class="form-group">
								<input class="form-control" id="email" type="email" name="email" placeholder="Email" autocomplete="off" maxlength="50" value="{{$user->email}}" readonly="">
							</div>									
						</div>	
					</div>

					<div class="row">

						<div class="col-md-6">
							<label>Contact</label>
							<div class="form-group">
								<input class="form-control numberControl" id="contact" type="phone" name="contact" placeholder="Contact" autocomplete="off" maxlength="50" value="{{$user->phone}}">
							</div>									
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
							<div class="btn-save">
								<button type="button" onclick="validation()" class="btn save">SAVE</button>
							</div>
						</div>
					</div>
					
				</form>
			</div>
<div id="resp" class="error-message"></div>	

					@if(session('message'))			
					<div id="resp" class="error-message text-success show-error">{{session('message')}}</div>
					@endif
		</main>

		<script type="text/javascript">

			$( document ).ready(function() {
				
				$("#form").find("input,button,textarea,select").prop("disabled", true);
				$("#edit").prop("disabled", false);
				$(".edit-profile-btn").hide();
				
			});

			function enableAll()
			{	

				var e = $('#form input');

				if(e.is(':disabled'))
				{
					$("#edit").addClass('active');
					$("#form").find("input,button,textarea,select").prop("disabled", false);
					$(".edit-profile-btn").show();
				}
				else
				{
					$("#edit").removeClass('active');
					$("#form").find("input,button,textarea,select").prop("disabled", true);
					$("#edit").prop("disabled", false);
					
					$(".edit-profile-btn").hide();	
				}

			}
		</script>

		<script type="text/javascript">
			function validation()
			{
				$('#resp').addClass('show-error');

				if(!$('#name').val()){

					$('#resp').html('');
					$('#resp').html('Please enter Name.');
				}else if(!$('#contact').val()){

					$('#resp').html('');
					$('#resp').html('Please enter Contact.');
				}else{
					$('#form').submit();
				}

			}

			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#blah').attr('src', e.target.result);
					}

					reader.readAsDataURL(input.files[0]);
				}
			}

			$("#imgInp").change(function(){
				readURL(this);
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
		@include('layouts.adminFooter')

