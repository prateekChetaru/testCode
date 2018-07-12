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
							<h3>Comming soon..</h3>								
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