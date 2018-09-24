@section('title', 'Make Copy User Directive')
@include('layouts.adminHeader')
<main class="main-content">
	<div class="content-top">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="page-tital"> 
						<h2> Edit User Directive : </h2>
						<span class="sub-tital"> {{Auth::user()->name}} </span>
					</div>
				</div>

				<div class="col-md-6">
					<div class="add-btn-section">
						<a href="{{route('user-directive.index')}}" class="btn ad-dorment"> <span> Directive Templates</span></a>
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
					<form id="form" action="" method="post">
						<div class="fild-stats-cont contact-cont">
							<h2> Edit User Directive </h2>
							{{csrf_field()}}
							<div class="add-content">
								<div class="row">
									<div class="col-md-12">
										<div class="template-name">
											<input id="templateName" type="text" name="templateName" class="form-control" placeholder="Template Name" value="{{$templete->name}}">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="drop-fild-section">
											<div id="fb-editor"></div>
										</div>
									</div>
								</div>
							</div>						
						</div>						
						<button id="getJSON" type="button" onclick="" class="btn save"> SAVE </button>
					</form>
					<div id="resp" class="error-message"></div>
				</div>				
			</div>
		</div>
	</div>
</main>

<script type="text/javascript">

	$(document).ready(function() {

	});
	
	jQuery(function($) {
		initializeFormBuilder();
		$('#form_type').on('change', function () {
			var formTypeData = $(this).val();
			initializeFormBuilder();
			
		});		
	});

	function initializeFormBuilder() {

		var fbEditor = document.getElementById('fb-editor'),

		options = {
			disableFields: ['autocomplete','header','paragraph','number','button'],
			disabledAttrs: [
			'access','className','required','subtype','toggle', 'other','placeholder','inline','name', 'description',
			'maxlength','rows','multiple'
			],
			defaultFields:@php echo $inputArray @endphp
		};

		var formBuilder = $(fbEditor).formBuilder(options);


		document.getElementById('getJSON').addEventListener('click', function() {
			var formArray = formBuilder.actions.getData('json', true);

			$('#resp').addClass('show-error');
			var templateName = $('#templateName').val();

			if(!templateName){

				$('#resp').html();
				$('#resp').html('Please enter Form Name.');
			} else {
				$('#getJSON').attr('disabled',true);
				
				$('#resp').removeClass('show-error');

				$.ajax({
					type: "POST",					
					url:"{{route('user-directive.store')}}",		
					data: {templateName:templateName,formArray:formArray,"_token":'<?php echo csrf_token()?>',id:'<?php echo base64_encode($templete->id); ?>',user_configured:'1'},
					success: function(response) 
					{						
						$('#resp').addClass('show-error');	
						$('#resp').addClass('text-success');					
						$('#resp').html();
						$('#resp').html('User Directive updated successfully.');
						
						window.location.href = "<?php echo URL::to('admin/user-directive-configured'); ?>";
						
					}
				});
			}
		});	
	}	
</script>

@include('layouts.adminFooter')
