<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Trident Manor</title>
  <link href="{{ asset('public/images/favicon.ico') }}" rel="icon">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="{{asset('public/css/style.css')}}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
  <header>
    <div class="head-top">
      <div class="logo-section">
       <img src="{{asset('public/images/logo.png')  }}">
      </div>
    </div>
    <nav class="navigation"> 
      <div class="container">
        <ul>
          <li></li>   
        </ul>
      </div>
    </nav>
  </header>
  <div class="content-section">
	<section class="dashboard-lists"> 
		<div class="container">
			<div class="row middle-content">
				<div class="content-section">
					<div class="error-page">
						<h1>4<span>0</span>4</h1>
						<p> Sorry - File not Found!</p>
						<div class="sub">
						   <p><a href="javascript:history.back()"> Back to Home</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12"><p>2018 © Trident Manor</p></div>
      </div>
    </div>

  </footer>
</body>
<script type="text/javascript">
$(document).ready(function() {
  function setHeight() {
  var windowHeight = $(window).height();
  var header = $("header").outerHeight(true);
  var footer = $("footer").outerHeight(true);
  var result = windowHeight - header - footer;
  $(".content-section").css("min-height", result);
  }
    setHeight();
  
  $(window).resize(function() {
     setHeight();
  });
    
});
</script>
</html>