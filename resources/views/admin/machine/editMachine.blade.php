@section('title', 'Edit Machine')
@include('layouts/adminHeader')
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
							<li> <a href="#">Edit Machine</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	@if(session('message'))
	<div class="success">
		<p align="center" class="alert alert-success" > {{session('message')}}</p>
	</div>
	@endif
	<div class="ragistration-detele add-machine">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="fild-stats-cont">
						<h2> Machine Details </h2>
						<div class="add-content">
							
							{{ Form::model($machine, ['method' => 'PUT', 'route' => array('machine.update', base64_encode($machine->id)),'id'=>'form','enctype'=>'multipart/form-data']) }}

							{{csrf_field()}}
							<div class="row">								
								<div class="col-md-6">
									<div class="form-group">
										<label>Organisation </label>
										<select id="organisation" name="organisation" class="form-control"> 
											<option value="" disabled="" selected="">Select Organisation</option>
											@foreach($organisations as $org)
											<option value="{{$org->id}}" {{($org->id==$machine->org_id)?'selected':''}} value="{{$org->id}}">{{ucfirst($org->organisation)}}</option>
											@endforeach
										</select>
										<span class="select-arrow"> 
											<img src="{{asset('public/images/drop-arrow.png')}}">
										</span>
									</div>
								</div>															
								<div class="col-md-6">
									<div class="form-group">
										<label>Office </label>
										<select id="office" name="office" class="form-control"> 
											<option value="" disabled="" selected="">Select Office</option>	
											@foreach($offices as $office)
											<option value="{{$office->id}}" {{($office->id==$machine->office_id)?'selected':''}}>{{$office->office}}</option>	
											@endforeach		
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
										<label>Machine Name </label>
										<input id="machine" name="machine" type="text" class="form-control" placeholder="Machine" value="{{$machine->machine}}">
									</div>
								</div>							
								<div class="col-md-6">
									<div class="form-group">
										<label>Machine Id </label>
										<input id="machineId" name="machineId" type="text" class="form-control" placeholder="Machine ID" value="{{$machine->machine_id}}">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Machine Latitude </label>
										<input id="latitude" name="latitude" type="text" class="latlong form-control" placeholder="Latitude" value="{{$machine->latitude}}">
									</div>
								</div>					
								<div class="col-md-6">
									<div class="form-group">
										<label>Machine Longitude </label>
										<input id="longitude" name="longitude" type="text" class="latlong form-control" placeholder="Longitude" value="{{$machine->longitude}}">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Status </label>
										<select id="machineStatus" name="machineStatus" class="form-control">  
											<option value="" disabled="" selected="">Select Status</option>
											<option {{('Working'==$machine->machine_status)?'selected':''}} value="Working">Working</option>
											<option {{('Inactive'==$machine->machine_status)?'selected':''}} value="Inactive">Inactive</option>
										</select>
										<span class="select-arrow"> 
											<img src="{{asset('public/images/drop-arrow.png')}}">
										</span>
									</div>
									

									
									@if(!empty($machine->answer[0]->question->form->id))
									
									<div class="form-group">
										<label> Machine Directive </label>
										<select id="machineDirective" name="machineDirective" class="form-control"> 

											@foreach($mdrForm as $mFormValue)
											<option value="{{$mFormValue->id}}" {{($machine->answer[0]->question->form->id==$mFormValue->id)?'selected':''}}>{{ $mFormValue->name}}</option>
											@endforeach
										</select>
										<!-- <span class="create-new"> Create New </span> -->
										<span class="select-arrow"> 
											<img src="{{asset('public/images/drop-arrow.png')}}">
										</span>
										<a href="javascript:void(0);" id="edit-modal" onclick="formPreview(<?php echo $machine->id; ?>,<?php echo (!empty($machine->answer[0]->question->form->id)?$machine->answer[0]->question->form->id:0) ?>)" > Edit</a>


									</div>
									@else

									<div class="form-group">
										<label> Machine Directive </label>
										<select id="machineDirective" name="machineDirective" class="form-control"> 
											
											<option value="" disabled="" selected="">Select Machine Directive</option>
											@foreach($mdrForm as $mFormValue)
											<option value="{{$mFormValue->id}}">{{ $mFormValue->name}}</option>
											@endforeach()
										</select>
										<!-- <span class="create-new"> Create New </span> -->
										<span class="select-arrow"> 
											<img src="{{asset('public/images/drop-arrow.png')}}">
										</span>										
									</div>
									@endif

									<div class="form-group">
										<label> User Directive </label>
										<select id="userDirective" name="userDirective" class="form-control"> 
											<option value="" disabled="" selected="">Select User Directive</option>
											@foreach($userDirectiveForms as $userDirectiveFormsValue)
											<option value="{{$userDirectiveFormsValue->id}}" {{($machine->user_dir_id==$userDirectiveFormsValue->id)?'selected':''}} value="{{$userDirectiveFormsValue->id}}">{{ucfirst($userDirectiveFormsValue->name)}}</option>
											@endforeach()
										</select>
										<!-- <span class="create-new"> Create New </span> -->
										<span class="select-arrow"> 
											<img src="{{asset('public/images/drop-arrow.png')}}">
										</span>
									</div>


									@foreach(json_decode($machine->inductor_id) as $value)	

									<div class="form-group">
										<label>Inductor </label>
										<select id="inductor" name="inductor[]" class="form-control inductor"> 
											<option value="" disabled="" selected="">Select Inductor</option>
											@foreach($inductors as $inductor)											
											<option value="{{$inductor->id}}"{{(!empty($inductor->id==$value))?'selected':''}}>{{ucfirst($inductor->name) .' '.ucfirst($inductor->last_name)}}</option>
											@endforeach
										</select>
										<!-- <span class="create-new"> Create New </span> -->
										<span class="select-arrow"> 
											<img src="{{asset('public/images/drop-arrow.png')}}">
										</span>

										@if(json_decode($machine->inductor_id)[0]==$value)
										<span class="add-field-icon addInductor"><img src="{{asset('public/images/add-plus-icon.png')}}"></span>											
										@else 
										<span class="add-field-icon removeTrainedUser"> <img src="{{asset('public/images/minus-icon.png')}}"> </span>
										@endif
									</div>
									@endforeach
									<div class="appendhere"></div>
									@foreach(json_decode($machine->trained_user_id) as $value)	


									<div class="form-group">
										<label>Trained User </label>
										<select id="trainedUser" name="trainedUser[]" class="form-control inductor"> 
											<option value="" disabled="" selected="">Select Trained User</option>
											@foreach($inductors as $inductor) 
											<option value="{{$inductor->id}}"{{!empty($inductor->id==$value)?'selected':''}}>{{ucfirst($inductor->name) .' '.ucfirst($inductor->last_name)}}</option>
											@endforeach
										</select>
										<!-- <span class="create-new"> Create New </span> -->
										<span class="select-arrow"> 
											<img src="{{asset('public/images/drop-arrow.png')}}">
										</span>
										@if(json_decode($machine->trained_user_id)[0]==$value)
										<span class="add-field-icon addtrainedUser"> <img src="{{asset('public/images/add-plus-icon.png')}}"> </span>
										@else 
										<span class="add-field-icon removeTrainedUser"> <img src="{{asset('public/images/minus-icon.png')}}"> </span>
										@endif
									</div>

									@endforeach
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

									@foreach($machineImages as $image)

									<div class="add-logo-section">											
										<div class="add-img-box"> 
											<img id="blah" src="{{asset('public/uploads/mcn_images\/').$image->image_url}}" alt="Preview Logo" class="mCS_img_loaded"> 
										</div>
									</div>

									@endforeach
								</div>
								<div id="fileCount" style="display:none;"></div>		
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
								

								

						<!-- 		<div class="row">
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
												<option {{('1'==$machine->machine_status)?'selected':''}} value="1">1</option>
												<option {{('2'==$machine->machine_status)?'selected':''}} value="2">2</option>
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
										<div class="add-logo-section">			
											<img id="blah" width="100%" height="100%" src="{{asset('public/uploads/qr_code\/').$machine->qr_code}}" alt="Preview Logo" class="mCS_img_loaded qrcode">
											<p><strong>{{ucfirst($machine->machine)}}</strong></p>
											<button type="button" class="btn print" data-toggle="modal" data-target="#myModal" id="Print">Print</button>
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
											<button type="button" onclick="validation();" class="btn save"> SAVE </button>
										</div>
									</div>

								</div>
								{!! Form::close() !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<div id="resp" class="error-message"></div>	
	</main>

	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">QR Code</h4>
				</div>
				<div class="modal-body">
					<img id="blah" width="100%" height="100%" src="{{asset('public/uploads/qr_code\/').$machine->qr_code}}" alt="Preview Logo" class="mCS_img_loaded qrcode">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				</div>
			</div>

		</div>
	</div>

	<button id="modalbtn" type="hidden" style="display: none;" data-toggle="modal" data-target="#myModal1"></button>
	<!-- Modal create new user-->

	<div class="appendMacnDrhtml"></div>
	<!-- get new directives -->
	<script type="text/javascript">

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

		function formPreview(machineId,tempId)
		{
			$.ajax({
				type: "GET",					
				url: "{{route('previewForm')}}",				
				data: {machineId:machineId,tempId:tempId,updateBtn:'update_button',"_token":'<?php echo csrf_token()?>'},
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

		$( document ).ready(function() {
    //$("#ofcForm").children().prop('disabled',true);
    $("#form").find("input,button,textarea,select").prop("disabled", true);
    $("#edit").prop("disabled", false);
    $("#Print").prop("disabled", false);
    $('.addInductor').hide();
    $('.addtrainedUser').hide();
    $("#edit-modal").hide();

    
    
    
});

		function enableAll()
		{


			var e = $('#form input');

			if(e.is(':disabled'))
			{
				$("#edit").addClass('active');
				$("#form").find("input,button,textarea,select").prop("disabled", false);	
				$('.addInductor').show();
				$('.addtrainedUser').show();
				$("#edit-modal").show();
			}
			else
			{
				$("#edit").removeClass('active');
				$("#form").find("input,button,textarea,select").prop("disabled", true);
				$("#edit").prop("disabled", false);
				$('.addInductor').hide();
				$('.addtrainedUser').hide();
				$("#edit-modal").hide();
			}

		}
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
			// var machineImgs       = document.getElementById("imgInp").files.length;

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
			}else if(!latlong(latitude)){

				$('#resp').html();
				$('#resp').html('Please enter valid Latitude.');
			}
			else if(!latlong(longitude)){

				$('#resp').html();
				$('#resp').html('Please enter valid Longitude.');
			}else if(!machineStatus){

				$('#resp').html();
				$('#resp').html('Please select Machine Status.');				
			}else if(!inductor){

				$('#resp').html();
				$('#resp').html('Please select Inductor.');
			}else if(!trainedUser){

				$('#resp').html();
				$('#resp').html('Please select Trained User.');
			}
			/*else if(!machineDirective){

				$('#resp').html();
				$('#resp').html('Please select Machine Directive.');
			}else if(!userDirective){

				$('#resp').html();
				$('#resp').html('Please select User Directives.');
			}*/
			else{



				var empty = false;
				var empty1 = "no";
				$('#modalForm .validate').each(function() {
					if ($(this).val().length == 0) {
						empty = true;
					}
					else if($(this).val().length > 0)
					{
						empty1 = "yes";

					}
					
				});

				// alert(empty);

				if (empty){

					$('.appendMacnDrhtml div').remove();
					$('#resp').html('Please fill Machine Directive.');
					$('#machineDirective').prop('selectedIndex',0);
				}else{


					

					if(empty1=="yes")
					{
						var modalFormData = new FormData($('#modalForm')[0]);

						console.log(modalFormData)

						modalFormData.append('_token', '{{csrf_token()}}');
						modalFormData.append('machineId',<?php echo $machine->id; ?>);

						$.ajax({
							type: "POST",					
							url: "{{URL::to('admin/machine-directive-custom-form-insert')}}",				
							data: modalFormData,
							processData: false,
							contentType: false,
							success: function(response) 
							{						
							//location.reload();
						}
					});	

						

					}

					$('.save').prop("disabled", true);
					$('#form').submit();
					
				}
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
			var orgId = $('#organisation').val();

			$.ajax({
				type: "POST",
				url: "{!!URL::to('admin/get-inductor-users')!!}",				
				data: {orgId:orgId,roleId:3,"_token":'<?php echo csrf_token()?>'},
				success: function(response) 
				{					
					$('.inductor').append(response);
				}
			});
		});
	</script>

	<script type="text/javascript">
		$('.numDec').keypress(function(event) {
			if (((event.which != 46 || (event.which == 46 && $(this).val() == '')) ||
				$(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
				event.preventDefault();
		}
	}).on('paste', function(event) {
		event.preventDefault();
	});

	function latlong(latlong)
	{
		var regex =  /^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,6}/;

		console.log( regex.test(latlong));
		return regex.test(latlong);
	}

		$(".latlong").on("keypress keyup blur",function (event) {  
		if (((event.which != 46 || (event.which == 46 && $(this).val() == '')) && (event.which != 43 && event.which >31)   && (event.which != 45)||
			$(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
			event.preventDefault();
	}

});

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
	$('.remparentcls').on('click','.removeTrainedUser',function(){
		console.log('hi')
		$(this).parent('div').remove();
	});
</script>

<script type="text/javascript">	
	function geInductors(){

		var orgId = $('#organisation').val();

		$.ajax({
			type: "POST",
			url: "{!!URL::to('admin/get-inductor-users')!!}",				
			data: {orgId:orgId,roleId:3,"_token":'<?php echo csrf_token()?>'},
			success: function(response) 
			{				
				$('.appendhere').append('<div class="row"><div class="col-md-6"><div class="form-group"><select id="inductor" name="inductor[]" class="form-control inductor">'+response+'</select><span class="select-arrow"><img src="{{asset("public/images/drop-arrow.png")}}"></span><span class="add-field-icon removeInductor"><img src="{{asset("public/images/minus-icon.png")}}"></span></div></div></div>');						
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
			data: {orgId:orgId,roleId:3,"_token":'<?php echo csrf_token()?>'},
			success: function(response) 
			{				
				$('.appendTrainedUserhere').append('<div class="row"><div class="col-md-6"><div class="form-group"><select id="trainedUser" name="trainedUser[]" class="form-control trainedUser">'+response+'</select><span class="select-arrow"><img src="{{asset("public/images/drop-arrow.png")}}"></span><span class="add-field-icon removeTrainedUser"><img src="{{asset("public/images/minus-icon.png")}}"></span></div></div></div>');						
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
@include('layouts/adminFooter')