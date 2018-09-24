@section('title', 'List User Templates')
@include('layouts.adminHeader')
<main class="main-content">
	<div class="content-top">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="page-tital"> 
						<h2> User Directive Templates : </h2>
						<span class="sub-tital"> {{Auth::user()->name}} </span>
					</div>
					<div class="page-nav">
						<ul>
							<li> <a href="{{URL::to('admin/admin-dashboard')}}">Dashboard</a> </li>
							<li> <a href="{{route('user-directive.index')}}">User Directive</a></li>
							<li> <a href="#">Directive Templates</a></li>
						</ul>
					</div>
				</div>
				<div class="col-md-6">
					<div class="add-btn-section">
						<a href="{{route('user-directive.create')}}" class="btn ad-dorment"> <img src="{{asset('public/images/plus-icon.png')}}"><span> Add Directive Templates</span></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	@if(session('message'))
	<div class="success">
		<p align="center" class="alert alert-success"> {{session('message')}}</p>
	</div>
	@endif
	<div class="ragistration-detele staff-list">
		<div class="container">			
			<div class="row">
				<div class="staff-list-section add-search-data">
					@foreach($userDirectives as $value)	
					<div class="col-md-4">
						<a href="{!!route('user-directive.edit',['id'=>base64_encode($value->id)])!!}">
							<div class="staff-list-box">
								<ul>			
									<li> 
										<span class="staff-tital">Template: </span>
										<strong> {{ucfirst($value->name)}} </strong>
									</li>
									<li> 
										<span class="staff-tital">Date: </span>
										{{$value->created_at}} 
									</li>	

									<li> 										
										<a href="{{URL::to('admin/user-directive-edit\/').base64_encode($value->id)}}">Make Copy</a>
									</li>																
								</ul>
							</div>
						</a>
					</div>			
					@endforeach			

					<div class="organ-page-nav" >
						{!! $userDirectives->links('layouts.pagination') !!}                              
					</div>		
				</div>
			</div>
		</div>
	</div>
</main>

@include('layouts.adminFooter')