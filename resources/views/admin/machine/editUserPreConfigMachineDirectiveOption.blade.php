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

	@php

	$qValue = $tempInputTypes; 
	$questionId = $qValue->id;
	$queInputType = $qValue->input_type_id;

	@endphp
	<div class="ragistration-detele add-fild-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<form id="" action="{{URL::to('admin/update-directive-question')}}" method="post">
						<input type="hidden" name="updateId" value="{{$questionId}}">
						<input type="hidden" name="inputType" value="{{$queInputType}}">
						{{csrf_field()}}
						<div class="row">
							<div class="col-md-12">
								<div class="question">
									<h3>Question</h3>
									<div class="form-group">
										@if($qValue->input_type_id==1 || $qValue->input_type_id==5 || $qValue->input_type_id==6 || $qValue->input_type_id==7 || $qValue->input_type_id==8)

										<input type="text" class="form-control validate" name="question" value="{{$qValue->question_name}}">

										@elseif($qValue->input_type_id==2 || $qValue->input_type_id==3 || $qValue->input_type_id==4)

										<input type="text" class="form-control validate" name="question" value="{{$qValue->question_name}}">
										@endif
									</div>
								</div>

							</div>
						</div>
						@if($qValue->input_type_id==2 || $qValue->input_type_id==3 || $qValue->input_type_id==4)
						<div class="row">
							<div class="col-md-12 option-filed">
								<h3> Options </h3>					
								<ol class="addCheckboxOptionHere">
									@foreach($qValue->option as $cValue)
									<li>
										<div class="form-group input-area">
											<input type="text" name="option[]" class="form-control" value="{{$cValue->option_choice_name}}">
											<div class="add_delete pull-right">

												<a href="{{URL::to('admin/delete\/').base64_encode('mdr_form_option_choices').'/'.base64_encode($cValue->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a>

											</div>
											<input type="hidden" name="optionId[]" value="{{$cValue->id}}">

										</div>
									</li>
									<input type="hidden" name="inputTypeId" value="{{$qValue->input_type_id}}">
									@endforeach()
									<div class="add_delete pull-right">
										<i class="fa fa-plus addCheckboxOption" aria-hidden="true"></i>
									</div>

								</ol>
							</div>
						</div>
						@endif

						
						@if(Request::segment(2)=='directive-option-edit')

						<a href="{{URL::to('admin/machine-directive-edit\/').base64_encode($qValue->form_id)}}"><button type="button" onclick="" class="btn save"> BACK </button></a>

						@else

						<a href="{{URL::to('admin/user-pre-directive-edit\/').base64_encode($qValue->form_id)}}"><button type="button" onclick="" class="btn save"> BACK </button></a>

						@endif
						<button type="submit" onclick="" class="btn save"> SAVE </button>
					</form>
				</div>
			</div>
		</div>
	</div>
</main>

<script type="text/javascript">
	$('.addCheckboxOption').on('click',function(){		
		$('.addCheckboxOptionHere').append('<li><div class="form-group input-area"><input type="text" name="newOption[]" class="form-control"><div class="add_delete pull-right"></div></div></li>');
	});
</script>


@include('layouts.adminFooter')
