<!DOCTYPE html>
<html>
<head>
	<title> BLUE DATA </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/responsive.css')}}">
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
						<div class="loing-text">
							<div class="logo-box">
								<a href="#"><img src="{{ asset('public/images/login-logo.png')}}"> </a>
							</div>
							<h1>Welcome<br> To Blue Data</h1>
							<div class="form-section">
								<form method="POST" action="{{ route('admin.auth') }}">
									{{ csrf_field() }}
									<div class="form-group">
										<input type="email" name="email" class="form-control"  placeholder="Email Address">
									</div>
									<div class="form-group">
										<input id="password-field" name="password" type="password" class="form-control" placeholder="Password">
										<span toggle="#password-field" class="field-icon toggle-password eye-icon"><img src="{{ asset('public/images/eye-icon.png')}}"> </span>
									</div>

									@if ($errors->has('email'))
									<span class="alert-danger">
										{{ $errors->first('email') }}
									</span>
									@endif

									@if ($errors->has('password'))
									<span class="alert-danger">
										{{ $errors->first('password') }}
									</span>
									@endif

									<button type="submit" class="btn btn-primary">Login</button>
									<div class="change-forget">
										<div class="forget-pass">
											<span> Forgot Password? </span>
										</div>
										<div class="account">
											<span>Don’t have an account? <a href="#">Get Started</a> </span>
										</div>
									</div>
								</form>
							</div>
							<div class="download-app">
								<span>Android app <a href="#">Download here</a></span>
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