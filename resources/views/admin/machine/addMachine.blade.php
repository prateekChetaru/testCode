@section('title', 'Add Machine')
@include('layouts.adminHeader')

<main class="main-content">
	<div class="content-top">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="page-tital"> 
						<h2> Machine : </h2>
						<span class="sub-tital"> {{Auth::user()->name}}</span>
					</div>
					<div class="page-nav">
						<ul>
							<li> <a href="{{URL::to('admin/admin-dashboard')}}">Dashboard</a> </li>
							<!-- <li> <a href="{{route('machine.index')}}">Machine</a></li> -->
							<li> <a href="#">Machine</a></li>
							<li> <a href="#">Add Machine</a></li>
						</ul>
					</div>					
				</div>
				<div class="col-md-6">
					<div class="content-top-right">
						<div class="add-btn-section">
							<a href="{{route('office.create')}}" class="btn"> <img src="{{asset('public/images/plus-icon.png')}}"> <span> Add Office </span></a>
							<a href="{{route('staff.create')}}" class="btn"> <img src="{{asset('public/images/plus-icon.png')}}"> <span> Add Staff </span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@if(session('message'))
	<div class="success">
		<p align="center" class="alert alert-success" >{{session('message')}}</p>
	</div>
	@endif
	<div class="ragistration-detele add-machine">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="fild-stats-cont">
						<h2> Add Machine </h2>
						<div class="add-content">
							<form id="form" action="#" method="post" enctype="multipart/form-data">

								{{csrf_field()}}
								<div class="row">									
									<div class="col-md-6">
										<div class="form-group">
											<select id="organisation" name="organisation" class="form-control"> 
												<option value="" disabled="" selected="">Select Organisation</option>
												@foreach($organisations as $org)
												<option value="{{$org->id}}">{{ucfirst($org->organisation)}}</option>
												@endforeach()
											</select>
											<span class="select-arrow"> 
												<img src="{{asset('public/images/drop-arrow.png')}}">
											</span>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<select id="office" name="office" class="form-control"> 
												<option value="" disabled="" selected="">Select Office</option>			
											</select>
											<span class="select-arrow"> 
												<img src="{{asset('public/images/drop-arrow.png')}}">
											</span>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<input id="machine" name="machine" type="text" class="form-control" placeholder="Machine Name">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input id="machineId" name="machineId" type="text" class="form-control" placeholder="Machine ID">
										</div>
									</div>
								</div>

								<div class="row">									
									<div class="col-md-6">
										<div class="form-group">
											<input id="latitude" name="latitude" type="text" class="form-control" placeholder="Machine Latitude">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input id="longitude" name="longitude" type="text" class="form-control" placeholder="Machine Longitude">
										</div>
									</div>									
								</div>
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<select id="machineStatus" name="machineStatus" class="form-control">  
												<option value="" disabled="" selected="">Select Status</option>
												<option value="Working">Working</option>
												<option value="Inactive">Inactive</option>
											</select>
											<span class="select-arrow"> 
												<img src="{{asset('public/images/drop-arrow.png')}}">
											</span>
										</div>
										<div class="form-group">
											<select id="machineDirective" name="machineDirective" class="form-control"> 

												<option value="" disabled="" selected="">Select Machine Directive</option>
												@foreach($mdrForm as $mFormValue)
												<option value="{{$mFormValue->id}}">{{$mFormValue->name}}</option>
												@endforeach()
											</select>
											<!-- <span class="create-new"> Create New </span> -->
											<span class="select-arrow"> 
												<img src="{{asset('public/images/drop-arrow.png')}}">
											</span>
										</div>

										<div class="form-group">
											<select id="userDirective" name="userDirective" class="form-control"> 
												<option value="" disabled="" selected="">Select User Directive</option>
												@foreach($userDirectiveForms as $userDirectiveFormsValue)
												<option value="{{$userDirectiveFormsValue->id}}">{{$userDirectiveFormsValue->name}}</option>
												@endforeach()
											</select>
											<!-- <span class="create-new"> Create New </span> -->
											<span class="select-arrow"> 
												<img src="{{asset('public/images/drop-arrow.png')}}">
											</span>
										</div>

										<div class="form-group induc">
											<select id="inductor" name="inductor[]" class="form-control inductor"> 
												<option value="" disabled="" selected="">Select Inductor</option>
											</select>
											<!-- <span class="create-new"> Create New </span> -->
											<span class="select-arrow a"> 
												<img src="{{asset('public/images/drop-arrow.png')}}">
											</span>
											<span class="add-field-icon addInductor"><img src="{{asset('public/images/add-plus-icon.png')}}"></span>
										</div>
										<div class="appendhere"></div>
										<div class="form-group induc">
											<select id="trainedUser" name="trainedUser[]" class="form-control trainedUser"> 
												<option value="" disabled="" selected="">Select Trained User</option>
											</select>
											<!-- <span class="create-new"> Create New </span> -->
											<span class="select-arrow"> 
												<img src="{{asset('public/images/drop-arrow.png')}}">
											</span>
											<span class="add-field-icon addtrainedUser"> <img src="{{asset('public/images/add-plus-icon.png')}}"> </span>
										</div>
										<div class="appendTrainedUserhere"></div>
									</div>
									<div class="col-md-6">
										<div class="add-logo-section">
											<div class="add-logo-box">
												<img src="{{asset('public/images/add-icon.png')}}">
												<h4> Drag files here
												or Browse files to upload </h4>
												<input id="imgInp" name="machineImgs[]" type="file" value="" multiple>
											</div>											
										</div>
										<div id="fileCount" style="display:none;"></div>
									</div>
								</div>
								
								

								<!-- <div class="row">
									<div class="col-md-3">
										<label>Office : </label>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<select class="form-control"> 
												<option></option>
												<option>Chetaru</option>
												<option>2</option>
											</select>
											<span class="create-new"> Create New </span>
											<span class="select-arrow"> 
												<img src="{{asset('public/images/drop-arrow.png')}}">
											</span>
											<span class="add-field-icon"> <img src="{{asset('public/images/add-plus-icon.png')}}"> </span>
										</div>
									</div>
								</div> -->
								
								

								

								

							<!-- 	<div class="row">
									<div class="col-md-3">
										<label>Machine Directive : </label>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<select id="machineDirective" name="machineDirective" class="form-control"> 
												<option value="" disabled="" selected="">Select Machine Directive</option>	
												<option value="1">1</option>
												<option value="2">2</option>
											</select>
											<span class="create-new"> Create New </span>
											<span class="select-arrow"> 
												<img src="{{asset('public/images/drop-arrow.png')}}">
											</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<label>User Directive : </label>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<select id="userDirective" name="userDirective" class="form-control"> 
												<option value="" disabled="" selected="">Select Directive</option>
												<option value="1">1</option>
												<option value="2">2</option>
											</select>
											<span class="create-new"> Create New </span>
											<span class="select-arrow"> 
												<img src="{{asset('public/images/drop-arrow.png')}}">
											</span>
										</div>
									</div>
								</div> -->
								
								
								<div class="row">
									
									<div class="col-md-6">
										<div class="btn-save">
											<button id="savebtn" type="button" onclick="validation();" class="btn save"> SAVE </button>
										</div>
									</div>
									
								</div>
							</form>
						</div>
					</div>
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

	$('#machineDirective').on('keydown', function(e){
    if(e.keyCode === 38 || e.keyCode === 40|| e.keyCode === 39 || e.keyCode === 37) { //up or down
    	e.preventDefault();
    	return false;
    }
});

	$(document).ready(function () {

		$('#machineDirective').on('change', function() {

			var id = $('#machineDirective').val();

			$.ajax({
				type: "GET",					
				url: "{{URL::to('admin/machine-directive-custom-form')}}",				
				data: {id:id,"_token":'<?php echo csrf_token()?>'},
				success: function(response) 
				{				
					$('.appendMacnDrhtml div').remove();
					$('.appendMacnDrhtml').append(response);
					$('#modalbtn').click();
				}
			});
		});
	});
</script>

<script type="text/javascript">

	function validation()
	{	
		var organisation      = $('#organisation').val();
		var office            = $('#office').val();
		var machine           = $('#machine').val();
		var machineId         = $('#machineId').val();
		var latitude          = $('#latitude').val();
		var longitude         = $('#longitude').val();
		var inductor          = $('#inductor').val();
		var trainedUser       = $('#trainedUser').val();
		var machineDirective  = $('#machineDirective').val();
		var userDirective     = $('#userDirective').val();
		var machineStatus     = $('#machineStatus').val();
		var machineImgs       = document.getElementById("imgInp").files.length;


		$('#resp').addClass('show-error');

		if(!organisation)
		{
			$('#resp').html();
			$('#resp').html('Please select Organisation.');
		}else if(!office){

			$('#resp').html();
			$('#resp').html('Please select Office.');
		}else if(!machine){

			$('#resp').html();
			$('#resp').html('Please enter Machine Name.');
		}else if(!machineId){

			$('#resp').html();
			$('#resp').html('Please enter Machine ID.');
		}else if(!latitude){

			$('#resp').html();
			$('#resp').html('Please enter Machine Latitude.');
		}else if(!longitude){

			$('#resp').html();
			$('#resp').html('Please enter Machine Longitude.');
		}else if(!machineStatus){

			$('#resp').html();
			$('#resp').html('Please select Machine Status.');
		}else if(!inductor){

			$('#resp').html();
			$('#resp').html('Please select Inductor.');
		}else if(!trainedUser){

			$('#resp').html();
			$('#resp').html('Please select Trained User.');
		}else if(!latlong(latitude)){

			$('#resp').html();
			$('#resp').html('Please enter valid Latitude.');
		}
		else if(!latlong(longitude)){

			$('#resp').html();
			$('#resp').html('Please enter valid Longitude.');
		}
		else if(!userDirective){

			$('#resp').html();
			$('#resp').html('Please select User Directives.');
		}
		else if(!machineImgs){

			$('#resp').html();
			$('#resp').html('Please select Machine Images.');
		}else{

			$.ajax({
				type: "POST",
				url: "{!!URL::to('admin/get-machine-id')!!}",				
				data: {machineId:machineId,"_token":'<?php echo csrf_token()?>'},
				success: function(response) 
				{

					if(response)
					{
						$('#resp').html('');
						$('#resp').html('This Machine ID already exists.');
					}
					else
					{


						var empty = false;
						$('.validate').each(function() {
							if ($(this).val().length == 0) {
								empty = true;
							}
						});

						if (empty){

							$('#resp').html('Please fill Machine Directive.');
							$('#machineDirective').prop('selectedIndex',0);
						}else{
							$('#mresp').html('');
							$('#resp').html('');





							$('#savebtn').attr('disabled',true);

							var form = new FormData($('#form')[0]);

							form.append('_token', '{{csrf_token()}}');

							$.ajax({
								type: "POST",
								url: "{{route('machine.store')}}",				
								data: form,
								processData: false,
								contentType: false,
								success: function(response) 
								{							

									machineId = response.machineId;	

									var modalFormData = new FormData($('#modalForm')[0]);

									modalFormData.append('_token', '{{csrf_token()}}');
									modalFormData.append('machineId',machineId);

									$.ajax({
										type: "POST",					
										url: "{{URL::to('admin/machine-directive-custom-form-insert')}}",				
										data: modalFormData,
										processData: false,
										contentType: false,
										success: function(response) 
										{			

											location.reload();
										}


									});	
								}
							});



						}
					}
				}
			});		
		}
	}
</script>

<script type="text/javascript">
	$('#organisation').on('change', function() {
		$('#office option').remove();
		var orgId = $('#organisation').val();

		$.ajax({
			type: "POST",
			url: "{!!URL::to('admin/get-offices')!!}",				
			data: {orgId:orgId,"_token":'<?php echo csrf_token()?>'},
			success: function(response) 
			{				
				$('#office').append(response);


			}
		});
	});
</script>

<script type="text/javascript">
	$('#organisation').on('change', function() {
		$('.inductor option').remove();
		$('.trainedUser option').remove();
		var orgId = $('#organisation').val();

		$.ajax({
			type: "POST",
			url: "{!!URL::to('admin/get-inductor-users')!!}",				
			data: {orgId:orgId,roleId:3,"_token":'<?php echo csrf_token()?>',type:'Select Inductor'},
			success: function(response) 
			{				
				$('.inductor').append(response);

				$.ajax({
					type: "POST",
					url: "{!!URL::to('admin/get-inductor-users')!!}",				
					data: {orgId:orgId,roleId:3,"_token":'<?php echo csrf_token()?>',type:'Select Trained User'},
					success: function(response) 
					{				

						$('.trainedUser').append(response);
					}
				});
			}
		});
	});
</script>

<script type="text/javascript">
	$('.numDec').keypress(function(event) {
		if (((event.which != 46 || (event.which == 46 && $(this).val() == ''))   ||
			$(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
			event.preventDefault();
	}


});



	$(".latlong").on("keypress keyup blur",function (event) {  
		if (((event.which != 46 || (event.which == 46 && $(this).val() == '')) && (event.which != 43 && event.which >31)   && (event.which != 45)||
			$(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
			event.preventDefault();
	}

});

</script>

<script type="text/javascript">

	function isEmail(email)
	{
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email);
	}

	function latlong(latlong)
	{
		var regex =  /^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}/;

		console.log( regex.test(latlong));
		return regex.test(latlong);
	}
</script>

<script type="text/javascript">
	$(document).ready(function(){

		$(".addInductor").on('click',function(){
				//get inductors list
				geInductors();

				$('.appendhere').on('click','.removeInductor',function(){

					$(this).parent('div').remove();
				});
			});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){

		$(".addtrainedUser").on('click',function(){
				//get trained users
				getTrainedUsers();

				$('.appendTrainedUserhere').on('click','.removeTrainedUser',function(){
					$(this).parent('div').remove();
				});

			});
	});
</script>

<script type="text/javascript">
	
	function geInductors(){

		var orgId = $('#organisation').val();

		$.ajax({
			type: "POST",
			url: "{!!URL::to('admin/get-inductor-users')!!}",				
			data: {orgId:orgId,roleId:3,"_token":'<?php echo csrf_token()?>',type:'Select Inductor'},
			success: function(response) 
			{				
				$('.appendhere').append('<div class="form-group induc"><select id="inductor" name="inductor[]" class="form-control inductor">'+response+'</select><span class="select-arrow"><img src="{{asset("public/images/drop-arrow.png")}}"></span><span class="add-field-icon removeInductor"><img src="{{asset("public/images/minus-icon.png")}}"></span></div>');						
			}
		});
	}
</script>
<script type="text/javascript">
	function getTrainedUsers(){

		var orgId = $('#organisation').val();

		$.ajax({
			type: "POST",
			url: "{!!URL::to('admin/get-inductor-users')!!}",				
			data: {orgId:orgId,roleId:3,"_token":'<?php echo csrf_token()?>',type:'Select Trained User'},
			success: function(response) 
			{				
				$('.appendTrainedUserhere').append('<div class="form-group induc"><select id="trainedUser" name="trainedUser[]" class="form-control trainedUser">'+response+'</select><span class="select-arrow"><img src="{{asset("public/images/drop-arrow.png")}}"></span><span class="add-field-icon removeTrainedUser"><img src="{{asset("public/images/minus-icon.png")}}"></span></div>');						
			}
		});		
	}
</script>
<script type="text/javascript">

	$('input#imgInp').change(function(){
		var files = $(this)[0].files;
		$('#fileCount').empty();
		$('#fileCount').show();
		$('#fileCount').append(files.length +' files selected');

	});
</script>
<script type="text/javascript">
	
	$(document).on('change', '.inductor', function(e) {
		var tralse = true;
  var selectRound_arr = []; // for contestant name
  $('.inductor').each(function(k, v) {
  	var getVal = $(v).val();
    //alert(getVal);
    if (getVal && $.trim(selectRound_arr.indexOf(getVal)) != -1) {
    	tralse = false;
      //it should be if value 1 = value 1 then alert, and not those if -select- = -select-. how to avoid those -select-
      alert('Please select another inductor.');
      $(v).val("");
      return false;
  } else {
  	selectRound_arr.push($(v).val());
  }

});
  if (!tralse) {
  	return false;
  }
});

	$(document).on('change', '.trainedUser', function(e) {
		var tralse = true;
  var selectRound_arr = []; // for contestant name
  $('.trainedUser').each(function(k, v) {
  	var getVal = $(v).val();
    //alert(getVal);
    if (getVal && $.trim(selectRound_arr.indexOf(getVal)) != -1) {
    	tralse = false;
      //it should be if value 1 = value 1 then alert, and not those if -select- = -select-. how to avoid those -select-
      alert('Please select another trained user.');
      $(v).val("");
      return false;
  } else {
  	selectRound_arr.push($(v).val());
  }

});
  if (!tralse) {
  	return false;
  }
});

</script>

@include('layouts/adminFooter')