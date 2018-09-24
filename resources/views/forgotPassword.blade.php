<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" >
<head>
	<title> BLUE DATA </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="shortcut icon" href="{{ asset('public/images/favicon.png') }}" type="image/x-icon"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/responsive.css')}}">
	<style type="text/css">


	section.loging-section {
		background: url({{ asset('public/images/bg-img.jpg') }})no-repeat center center; 
}
.login-img {
	background:url({{ asset('public/images/round-img.png') }})no-repeat right center,url({{ asset('public/images/round-bg-img.jpg') }})no-repeat center;
}
.loing-form .form input[type="email"]{
	background:url({{ asset('public/images/use-icon.png') }})no-repeat 34px center;
}
.loing-form .form input[type="password"]{
	background:url({{ asset('public/images/key-icon.png') }})no-repeat 34px center;
}
.sidebar-menu ul li a { 
	background: url({{ asset('public/images/nav-arrow.png') }}) no-repeat 88% center;
}
.profile-user-list span {
	background: url({{ asset('public/images/user-drop-icon.png') }}) no-repeat right 6px;
}
</style>
</head>

<body>
	<section class="loging-section">    
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="logo-section">
						<div class="logo-box">
							<a href="#"><img src="{{ asset('public/images/login-logo.png')}}"> </a>
						</div>
					</div>
					<div class="login-content">
						<div class="login-img">
						</div>
						<div class="Reset-pass">
							<div class="loing-box">
								<!-- <div class="logo-img">
									<img src="{{ asset('public/images/login-logo.png') }}">
								</div>    -->         
								<div class="loing-text">
									<div class="loing-top">
									<!-- 	<div class="logo-box">
											<a href="#"><img src="{{ asset('public/images/login-logo.png')}}"> </a>
										</div>   -->            
										<h1>Welcome<br> To Blue Data</h1>
										<h2>Reset Password</h2>
										<p>Please enter email address below.</p>
									</div>
									<div class="form-section">

										<form method="POST" action="{{URL::to('forgotPassword')}}">
											{{ csrf_field() }}
											<div class="form-group">  
												<input class="form-control" placeholder="E-Mail Address" type="email" name="email" value="" required>
											</div>
											
											@if(session('error'))
											<span class="alert-danger">
												<span id="resp">{{session('error')}}</span>
											</span>
											@endif

											@if(session('success'))
											<span class="text-success">
												<span id="resp">{{session('success')}}</span>
											</span>
											@endif


											<button type="submit" class="btn btn-primary">Reset Password</button>
											<a href="{{URL::to('admin')}}">Cancel</a>
										</form>
									</div>              
								</div>        
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript" src="{{ asset('public/js/jquery.min.js')}}"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="{{ asset('public/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
	<script type="text/javascript" src="{{ asset('public/js/popper.js')}}"></script>
	<script type="text/javascript" src="{{ asset('public/js/bootstrap.min.js')}}"></script>

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
	</script>
</body>
</html>