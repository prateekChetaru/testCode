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
							<form id="updateModalForm" action="#" method="post" enctype="multipart/form-data">
								{{csrf_field()}}
								<div class="row">
									<div class="col-md-12">
										<div class="fild-stats-cont contact-cont">
											<h2> {{!empty($templete->name)?$templete->name:''}} </h2>
											<div class="add-content">

												<div class="row">
													@php
													$i=1;
													$j=1;
													@endphp
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

															<?php
															$txtans = DB::table('udr_answers')
															->where('question_id',$questionId)
															->where('machine_id',$machineId)
															->where('user_id',$userId)
															->where('form_id',$formId)
															->where('operation_history_id',$operationHistoryId)
															->first();	
															?>
															<?php
															if(!empty($txtans->answer_text))
															{
															?>
															<input type="text" class="form-control validate" name="texta[]" value="{{$txtans->answer_text}}">
															<?php
															}
															?>

															@elseif($qValue->input_type_id==2)

															<?php
															$checkans = DB::table('udr_answers')
															->where('question_id',$questionId)
															->where('machine_id',$machineId)
															->where('user_id',$userId)
															->where('form_id',$formId)
															->where('operation_history_id',$operationHistoryId)
															->get();

															$result1 = array();
															
															foreach ($checkans as $value) {

																array_push($result1, $value->option_choice_id);
															}

															?>


															<?php
															foreach($qValue->option as $cValue) 
															{
																if(in_array($cValue->id, $result1))
																{
																	?>
																	<div class="input-box">
																		<input type="checkbox" name="checkbox[]" class="checkbox" value="{{$questionId.'-'.$cValue->id}}" checked="checked">{{$cValue->option_choice_name}}
																	</div>
																	<?php
																}
																else
																{
																	?>

																	<div class="input-box">
																		<input type="checkbox" name="checkbox[]" class="checkbox" value="{{$questionId.'-'.$cValue->id}}" >{{$cValue->option_choice_name}}
																	</div>
																	<?php

																}
															}

															?>

															
															@elseif($qValue->input_type_id==3)
															<?php
															
															$radioans = DB::table('udr_answers')
															->where('question_id',$questionId)
															->where('machine_id',$machineId)
															->where('user_id',$userId)
															->where('form_id',$formId)
															->where('operation_history_id',$operationHistoryId)
															->first();
															
															?>


															@if(!empty($radioans->option_choice_id))


															@foreach($qValue->option as $rValue)
															
															@if(  $radioans->option_choice_id==$rValue->id)
															<div class="input-box">
																<input class="" type="radio" id="radio" name="checkradio[<?php print_r($j);?>][]" value="{{$radioans->id.'-'.$rValue->id}}" checked="checked">{{$rValue->option_choice_name}}		
															</div>
															@else
															<div class="input-box">
																<input class="" type="radio" id="radio" name="checkradio[<?php print_r($j);?>][]" value="{{$radioans->id.'-'.$rValue->id}}" >{{$rValue->option_choice_name}}		
															</div>

															@endif						
															@endforeach

															@else
															@foreach($qValue->option as $rValue)
															<div class="input-box">
																<input class="" type="radio" id="radio" name="checkradio[<?php print_r($j);?>][]" value="{{$questionId.'-'.$rValue->id}}" >{{$rValue->option_choice_name}}		
															</div>
															@endforeach
															
															@endif
															@php
															$j++;
															@endphp


															@elseif($qValue->input_type_id==4)
															<?php
															$selectans = DB::table('udr_answers')
															->where('question_id',$questionId)
															->where('machine_id',$machineId)
															->where('user_id',$userId)
															->where('form_id',$formId)
															->where('operation_history_id',$operationHistoryId)
															->first();
															?>

															@if(!empty($selectans))

															<select name="select[]" class="form-control"> 
																<option value="" disabled="" selected="">Select</option>
																@foreach($qValue->option as $okey => $sValue)

																@if($selectans->option_choice_id==$sValue->id)
																<option value="{{$selectans->id.'-'.$sValue->id}}" selected>{{ucfirst($sValue->option_choice_name)}}</option>
																@else
																<option value="{{$selectans->id.'-'.$sValue->id}}" >{{ucfirst($sValue->option_choice_name)}}</option>
																@endif
																@endforeach()
															</select>
															<span class="select-arrow"> 
																<img src="{{asset('public/images/drop-arrow.png')}}">
															</span>
															@else

															<select name="select[]" class="form-control"> 
																<option value="" disabled="" selected="">Select</option>
																@foreach($qValue->option as $okey => $sValue)

																<option value="{{$sValue->id}}" >{{ucfirst($sValue->option_choice_name)}}</option>
																
																@endforeach()
															</select>
															<span class="select-arrow"> 
																<img src="{{asset('public/images/drop-arrow.png')}}">
															</span>


															@endif

															@elseif($qValue->input_type_id==5)

															<?php
															$dateans = DB::table('udr_answers')
															->where('question_id',$questionId)
															->where('machine_id',$machineId)
															->where('user_id',$userId)
															->where('form_id',$formId)
															->where('operation_history_id',$operationHistoryId)
															->first();
															?>

															<input id="date<?php print_r($i);?>" class="date validate" type="text" class="form-control" name="datea[]" id="dot_date"  value="{{(!empty($dateans->answer_text)?date('d-m-Y', strtotime($dateans->answer_text)):'')}}" readonly="">

															@elseif($qValue->input_type_id==6)

															<?php
															$imgans = DB::table('udr_answers')
															->where('question_id',$questionId)
															->where('machine_id',$machineId)
															->where('user_id',$userId)
															->where('form_id',$formId)
															->where('operation_history_id',$operationHistoryId)
															->first();
															?>

															@if(!empty($imgans->answer_text))
															<a class="preview" href="{{asset('public/uploads/form_images\/').(!empty($imgans->answer_text)?$imgans->answer_text:'')}}" target="_blank">Preview</a>

															@else
															<a class="preview" href="javascript:void(0)" onclick="alert('File not available.')">Preview</a>

															@endif
															
															@elseif($qValue->input_type_id==8)

															<?php
															$textaans = DB::table('udr_answers')
															->where('question_id',$questionId)
															->where('machine_id',$machineId)
															->where('user_id',$userId)
															->where('form_id',$formId)
															->where('operation_history_id',$operationHistoryId)
															->first();
															?>

															@if(!empty($textaans))

															<!-- <p class="validate" name="textarea[]" id="textarea">{{ucfirst($textaans->answer_text)}}</p> -->
															<textarea class="userdText">{{ucfirst($textaans->answer_text)}}</textarea>

															@endif

															@endif()

														</div>
													</div>
													@php
													$i++;
													@endphp
													@endforeach()

												</div>								
											</div>
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
</main>

<script type="text/javascript">
	$( document ).ready(function() {

		$("#updateModalForm").find("input,button,textarea,select").prop("disabled", true);

	});
</script>
<!-- Button to Open the Modal -->
