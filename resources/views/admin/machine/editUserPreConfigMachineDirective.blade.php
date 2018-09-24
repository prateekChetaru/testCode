@section('title', 'Edit Machine Directive')
@include('layouts.adminHeader')
<main class="main-content">
	<div class="content-top">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="page-tital"> 
						<h2> Edit Machine Directive : </h2>
						<span class="sub-tital"> {{Auth::user()->name}} </span>
					</div>
				</div>

				<div class="col-md-6">
					<div class="add-btn-section">
						<a href="{{route('machine-directive.index')}}" class="btn ad-dorment"> <span> Directive Templates</span></a>
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
	<div class="ragistration-detele add-fild-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<form id="userPreConfigform" action="" method="post">
						<div class="fild-stats-cont contact-cont">
							<h2> {{!empty($templete->id)?ucfirst($templete->name):''}} </h2>
							{{csrf_field()}}
							<div class="add-content">
								<!-- <div class="row">
									<div class="col-md-12">
										<div class="template-name">
											<input id="templateName" type="text" name="templateName" class="form-control" placeholder="Template Name" value="{{$templete->name}}">
										</div>
									</div>
								</div> -->
								<div class="row">
									<div class="col-md-12">
										<div class="drop-fild-section">
											<div id="fb-editor"></div>
										</div>
									</div>
								</div>
							</div>						
						</div>						
						
					</form>
					
				</div>				
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="fild-stats-cont contact-cont edittabel">
					<!-- <h2> {{!empty($templete->name)?$templete->name:''}} </h2> -->
					<div class="add-content">
						<input type="hidden" name="formId" value="{{!empty($templete->id)?$templete->id:''}}">
						<div class="row">

							<?php
							$i=1;
							?>

							@foreach($tempInputTypes as $qValue)

							@php $questionId = $qValue->id; @endphp

							<div class="col-md-12 directive-box">
								<div class="form-group label-tital">
									<label>{{!empty($qValue->question_name)?ucfirst($qValue->question_name):''}}</label>
								</div>
								<div class="form-group">

									@if($qValue->input_type_id==1) 

									<input type="hidden" name="textq[]" value="{{$questionId}}">

									<input type="text" class="form-control validate" name="texta[]" value="">

									<!-- <div class="edit-filed-icon">
										<a href="{{URL::to('admin\user-directive-option-edit\/').base64_encode($questionId)}}">
											<i class="fa fa-pencil" aria-hidden="true"></i></a>
											<a href="{{URL::to('admin/delete\/').base64_encode('mdr_questions').'/'.base64_encode($questionId)}}" onclick="return confirm('Are you sure you want to delete.');">
												<i class="fa fa-times" aria-hidden="true"></i></a>
											</div>  -->

											@elseif($qValue->input_type_id==2)


											@foreach($qValue->option as $cValue) 
											<div class="input-box">
												<input type="checkbox" name="checkbox[]" class="checkbox" value="{{$questionId.'-'.$cValue->id}}">{{$cValue->option_choice_name}}
											</div>

											@endforeach()
											<!-- <div class="edit-filed-icon">
												<a href="{{URL::to('admin\user-directive-option-edit\/').base64_encode($questionId)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
												<a href="{{URL::to('admin\user-directive-option-edit\/').base64_encode($questionId)}}"><i class="fa fa-times" aria-hidden="true"></i></a>
											</div> -->

											@elseif($qValue->input_type_id==3)

											@foreach($qValue->option as $rValue)
											<div class="input-box">
												<input class="" type="radio" id="radio" name="checkradio[]" value="{{$questionId.'-'.$rValue->id}}">{{$rValue->option_choice_name}}		
											</div>							
											@endforeach
										<!-- 	<div class="edit-filed-icon">
												<a href="{{URL::to('admin\user-directive-option-edit\/').base64_encode($questionId)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
												<a href="{{URL::to('admin\user-directive-option-edit\/').base64_encode($questionId)}}"><i class="fa fa-times" aria-hidden="true"></i></a>
											</div> -->


											@elseif($qValue->input_type_id==4)


											<select name="select[]" class="form-control"> 
												<option value="" disabled="" selected="">Select</option>
												@foreach($qValue->option as $okey => $sValue)
												<option value="{{$questionId.'-'.$sValue->id}}">{{ucfirst($sValue->option_choice_name)}}</option>
												@endforeach()
											</select>
											<span class="select-arrow"> 
												<img src="{{asset('public/images/drop-arrow.png')}}">
											</span>
											<!-- <div class="edit-filed-icon">
												<a href="{{URL::to('admin\user-directive-option-edit\/').base64_encode($questionId)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
												<a href="{{URL::to('admin\user-directive-option-edit\/').base64_encode($questionId)}}"><i class="fa fa-times" aria-hidden="true"></i></a>
											</div> -->

											@elseif($qValue->input_type_id==5)

											<input type="hidden" name="dateq[]" value="{{$questionId}}">

											<input id="date<?php print_r($i);?>" class="date validate" type="text" class="form-control" name="datea[]" id="dot_date" placeholder="Date"  value="" readonly="">
											<!-- <div class="edit-filed-icon">
												<a href="{{URL::to('admin\user-directive-option-edit\/').base64_encode($questionId)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
												<a href="{{URL::to('admin\user-directive-option-edit\/').base64_encode($questionId)}}"><i class="fa fa-times" aria-hidden="true"></i></a>
											</div> -->
											@elseif($qValue->input_type_id==6)

											<input type="hidden" name="imageq[]" value="{{$questionId}}">

											<input class="validate" type="file" id="file" name="imagea[]">
											<!-- <div class="edit-filed-icon">
												<a href="{{URL::to('admin\user-directive-option-edit\/').base64_encode($questionId)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
												<a href="{{URL::to('admin\user-directive-option-edit\/').base64_encode($questionId)}}"><i class="fa fa-times" aria-hidden="true"></i></a>
											</div> -->
											@elseif($qValue->input_type_id==7)

											<input class="validate" type="hidden" name="hidden[]" id="" value="">
											<!-- <div class="edit-filed-icon">
												<a href="{{URL::to('admin\user-directive-option-edit\/').base64_encode($questionId)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
												<a href="{{URL::to('admin\user-directive-option-edit\/').base64_encode($questionId)}}"><i class="fa fa-times" aria-hidden="true"></i></a>
											</div> -->
											@elseif($qValue->input_type_id==8)

											<input type="hidden"  name="textareq[]" value="{{$questionId}}">

											<textarea class="validate" name="textarea[]" id="textarea"></textarea>
											<!-- <div class="edit-filed-icon">
												<a href="{{URL::to('admin\user-directive-option-edit\/').base64_encode($questionId)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
												<a href="{{URL::to('admin\user-directive-option-edit\/').base64_encode($questionId)}}"><i class="fa fa-times" aria-hidden="true"></i></a>
											</div> -->
											@endif()

											
												</div>
												<div class="edit-filed-icon">
												<a href="{{URL::to('admin\user-directive-option-edit\/').base64_encode($questionId)}}">
													<i class="fa fa-pencil" aria-hidden="true"></i></a>
													<a href="{{URL::to('admin/delete\/').base64_encode('mdr_questions').'/'.base64_encode($questionId)}}" onclick="return confirm('Are you sure you want to delete.');">
														<i class="fa fa-times" aria-hidden="true"></i></a>
													</div> 
											</div>

											<?php
											$i++;
											?>
											@endforeach()

										</div>								
									</div>
									<button id="getJSON" type="button" onclick="" class="btn save"> SAVE </button>
								</div>
								
							</div>
						</div>
					</div>
					<div id="resp" class="error-message"></div>
				</main>

				<script type="text/javascript">

					jQuery(function($) {
						initializeFormBuilder();
						$('#form_type').on('change', function () {
							var formTypeData = $(this).val();
							initializeFormBuilder();
						});		
					});

					function initializeFormBuilder() {

						options = {           
							disableFields: ['autocomplete','header','paragraph','number','button'],
							disabledAttrs: [
							'access','className','required','subtype','toggle', 'other','placeholder','inline','name', 'description',
							'maxlength','rows','multiple'
							]
						};


						$("#fb-editor").html('');
						var container = (document.getElementById('fb-editor'));
						var formBuilder = $(container).formBuilder(options);


						document.getElementById('getJSON').addEventListener('click', function() {


							var formArray = formBuilder.actions.getData('json', true);

							var formId = '<?php echo (!empty($templete->id)?$templete->id:0); ?>';

							console.log('form id '+formId);

							if(formArray.length <=2){

								$('#resp').addClass('show-error');	
								$('#resp').addClass('text-success');					
								$('#resp').html();
								$('#resp').html('Machine Directive Updated successfully.');
								window.location.href = "<?php echo route('user-configured'); ?>";	
							}
							else
							{
								$('#getJSON').attr('disabled',true);

								$('#resp').removeClass('show-error');

								$.ajax({
									type: "POST",					
									url: "{{URL::to('admin/user-config-add-New-Inputs')}}",				
									data: {formId:formId,formArray:formArray,"_token":'<?php echo csrf_token()?>'},
									success: function(response) 
									{						
										$('#resp').addClass('show-error');	
										$('#resp').addClass('text-success');					
										$('#resp').html();
										$('#resp').html('Machine Directive Updated successfully.');
										
										
										window.location.href = "<?php echo route('user-configured'); ?>";	
										//window.location.reload(1);
									}
								});
							}
						});	
					}	

				</script>

				@include('layouts.adminFooter')
