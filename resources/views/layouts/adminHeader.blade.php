<!DOCTYPE html>
<html>
<head>
	<title>Blue Data </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/style.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/css/jquery.mCustomScrollbar.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/responsive.css')}}">
	<!-- for jquery only number accept -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> 
	
</head>
<body>
	<div class="wrapper">
		<nav class="">
			<div class="logo-box">
				<a href="{{URL::to('admin/admin-dashboard')}}"><img src="{{ asset('public/images/logo.png')}}"></a>
				<div class="tob-nve-btn">
					<img src="{{ asset('public/images/menu-icon.png')}}">
				</div>
			</div>
			<div class="sidebar-menu">
				<div class="sidebar-tab navbar navbar-default" id="examples">
					<div class="content demo-y">
						<ul class="nav">
							<li class="active">
								<a href="#">
									<span class="icon-img"><img src="{{ asset('public/images/desbord-icon.png')}}"></span>
									<span class="menu-tital"> Dashboard </span>
								</a> 
							</li>
							<li>
								<a href="#">
									<span class="icon-img"><img src="{{ asset('public/images/ognition-icon.png')}}"></span>
									<span class="menu-tital"> Organisations </span>
									<span class="nav-arrow"><img src="{{ asset('public/images/nav-arow.png')}}"></span>
								</a> 
								<ul class="sub-menu">
									<li><a href="{{route('organisation.create')}}">Add Organisations </a></li>
									<li><a href="#">Add Office </a></li>
									<li><a href="#">Add Machine </a></li>
								</ul>
							</li>
							<li>
								<a href="#">
									<span class="icon-img"><img src="{{ asset('public/images/dirctive-icon.png')}}"> </span>
									<span class="menu-tital"> Machines Directive </span>
									<span class="nav-arrow"><img src="{{ asset('public/images/nav-arow.png')}}"></span>
								</a> 
								<ul class="sub-menu">
									<li><a href="#">Preconfigured</a></li>
									<li><a href="#">Add New </a></li>
									<li><a href="#">User Configured </a></li>
								</ul>
							</li>
							<li>
								<a href="#">
									<span class="icon-img"><img src="{{ asset('public/images/user-icon.png')}}"> </span>
									<span class="menu-tital"> User’s Check Points </span>
									<span class="nav-arrow"><img src="{{ asset('public/images/nav-arow.png')}}"></span>
								</a> 
								<ul class="sub-menu">
									<li><a href="#">Preconfigured</a></li>
									<li><a href="#">Add New </a></li>
									<li><a href="#">User Configured </a></li>
								</ul>
							</li>
							<li>
								<a href="#">
									<span class="icon-img"><img src="{{ asset('public/images/satf-icon.png')}}"> </span>
									<span class="menu-tital"> Staff </span>
									<span class="nav-arrow"><img src="{{ asset('public/images/nav-arow.png')}}"></span>
								</a> 
							</li>
						</ul>
					</div>
					<div class="logout-box">
						<a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true">
							<span class="logut-icon"><img src="{{asset('public/images/logout-con.png')}}"></span>
							<span> Log Out </span>
						</a>

						<form id="logout-form" action="{{route('admin.logout')}}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>

					</div>
				</div>
			</div>
		</nav>
		<div class="app-body">
			<header>
				<div class="search-section">
					<form>
						<input type="serch" name="" placeholder="Enter Your Keyword">
						<!-- <button type="submit"></button> -->
					</form>
				</div>
				<div class="head-right">
					<div class="notification-section">
						<ul>
							<li><a href="#"><img src="{{ asset('public/images/bel-icon.png')}}"> <span class="count-box">02</span></a></li>
							<li><a href="#"><img src="{{ asset('public/images/setion-con.png')}}"></a></li>
							<li><a href="#"><img src="{{ asset('public/images/messge-icon.png')}}"> <span class="count-box">10</span></a></li>
						</ul>
					</div>
					<div class="profile-box">
						<div class="profile-img">
							<img src="{{ asset('public/images/profile-img.png')}}">
						</div>
						<div class="profile-user-list dropdown"> 
							<span class="dropdown-toggle" data-toggle="dropdown" style="background: url({{ asset('public/images/profile-arrow.png')}}) no-repeat right 6px;"></span>
							<ul class="dropdown-menu">
								<li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out" aria-hidden="true"> Log Out </a></li>
								</ul>
								<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
							</div>
						</div>
					</div>
				</header>