
<main class="main-content">
	<div class="modal fade" id="myModal1" role="dialog">
		<div class="modal-dialog add-operater">

			<!-- Modal content-->
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

				</div>

				<div class="modal-body">

					<div class="ragistration-detele add-fild-section">
						<div class="container">

							<form id="modalForm" action="#" method="post" enctype="multipart/form-data">

								{{csrf_field()}}

								<div class="row">
									<div class="col-md-12">
										<div class="fild-stats-cont contact-cont">
											<h2> {{!empty($templete->name)?$templete->name:''}} </h2>
											<div class="add-content">

												<input type="hidden" name="formId" value="{{!empty($templete->id)?$templete->id:''}}">
												<div class="row">

													<?php
													$i=1;
													$j=1;
													?>

													@foreach($question as $qValue)

													@php $questionId = $qValue->id; @endphp

													<div class="col-md-3">
														<div class="form-group">
															<label>{{!empty($qValue->question_name)?ucfirst($qValue->question_name):''}}</label>
														</div>
													</div>

													<div class="col-md-9">
														<div class="form-group">

															@if($qValue->input_type_id==1)

															

															<input type="hidden" name="textq[]" value="{{$questionId}}">

															<input type="text" class="form-control validate" name="texta[]" value="" maxlength="150">

															@elseif($qValue->input_type_id==2)

															<div class="checkboxval">
															@foreach($qValue->option as $cValue) 
															<div class="input-box">
																<input type="checkbox" name="checkbox[]" class="checkbox" value="{{$questionId.'-'.$cValue->id}}">{{$cValue->option_choice_name}}
															</div>
															@endforeach()
															</div>

															@elseif($qValue->input_type_id==3)
															<div class="radioval">
															@foreach($qValue->option as $rValue)
															
															<div class="input-box">
																<input class="" type="radio" id="radio" name="checkradio[<?php print_r($j);?>][]" value="{{$questionId.'-'.$rValue->id}}">{{$rValue->option_choice_name}}		
															</div>	
																		
															@endforeach
															</div>	
															@php
															$j++;
															@endphp	
														


															@elseif($qValue->input_type_id==4)


															<select name="select[]" class="form-control"> 
																<!-- <option value="" disabled="" selected="">Select</option> -->
																@foreach($qValue->option as $okey => $sValue)
																<option value="{{$questionId.'-'.$sValue->id}}" style="color: black;">{{ucfirst($sValue->option_choice_name)}}</option>
																@endforeach()
															</select>
															<span class="select-arrow"> 
																<img src="{{asset('public/images/drop-arrow.png')}}">
															</span>

															
															@elseif($qValue->input_type_id==5)

															<input type="hidden" name="dateq[]" value="{{$questionId}}">

															<input id="date<?php print_r($i);?>" class="date validate" type="text" class="form-control" name="datea[]" id="dot_date" placeholder="Date"  value="" readonly="">


															@elseif($qValue->input_type_id==6)

															<input type="hidden" name="imageq[]" value="{{$questionId}}">

															<input class="validate" type="file" id="file" name="imagea[]">
															<span class="file-msg">Max File Size 5MB</span>

															@elseif($qValue->input_type_id==7)

															<input class="validate" type="hidden" name="hidden[]" id="" value="">

															@elseif($qValue->input_type_id==8)

															<input type="hidden"  name="textareq[]" value="{{$questionId}}">

															<textarea class="validate" name="textarea[]" id="textarea"></textarea>

															@endif()

														</div>
													</div>
													<?php
													$i++;
													?>
													@endforeach()

												</div>								
											</div>
										</div>
									</div>
								</div>
								<div class="row">

									<div class="col-md-6">
										<div class="btn-save">
											<button type="button" onclick="dirValidation();" class="btn save"> SAVE </button>
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
		<div id="mresp" class="error-message"></div>	
</main>
<script type="text/javascript" src="{{asset('public/js/bootstrap.min.js')}}"></script>
<script type="text/javascript">
	$(function() {
		$(".date").datepicker({
			showAnim: "fold",
			dateFormat: "dd-mm-yy"
		});
	});
</script>

<script type="text/javascript">
$('#test').on('click', function() {
   
});
	function dirValidation()
	{
		
		var empty = false;
		$('.validate').each(function() {
			if ($(this).val().length == 0) {
				empty = true;
			}
		});

		var valid = $('.checkboxval').toArray().every(function(item) {
			return $(item).find('input[type="checkbox"]:checked').length >= 1;
		});

		var valid = $('.radioval').toArray().every(function(item) {
			return $(item).find('input[type="radio"]:checked').length >= 1;
		});



    	
		 if(!valid)
		 {
		 	$('#mresp').addClass('show-error');

		 	$('#mresp').html('');
		 	$('#mresp').html('All the fields are mandatory.');

		 }
		 else if (empty){
		 	$('#mresp').addClass('show-error');

		 	$('#mresp').html('');
		 	$('#mresp').html('All the fields are mandatory.');

		 }

		else{


			$('input[type="file"]').each(function() {
				if($(this).val() != '') {
					
					var size = this.files[0].size;
					if(size > 5097152) {
						alert('File size must not be greater than 5MB.');
						
					}
					else{

						$('#mresp').html('');

						$('.close').click();
						$('.close').click();
					}
				}
			});


			
		}

	}
</script>


<!-- Button to Open the Modal -->
