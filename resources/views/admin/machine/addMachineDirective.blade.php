@section('title', 'Add Machine Directive Template')
@include('layouts.adminHeader')
<main class="main-content">
	<div class="content-top">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="page-tital"> 
						<h2> Add Machine Directive Template : </h2>
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
					<form id="form" action="" method="post">
						<div class="fild-stats-cont contact-cont">
							<h2> Add Machine Directive Template </h2>
							{{csrf_field()}}
							<div class="add-content">
								<div class="row">
									<div class="col-md-12">
										<div class="template-name">
											<input id="templateName" type="text" name="templateName" class="form-control" placeholder="Template Name">
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

			$('#resp').addClass('show-error');
			var templateName = $('#templateName').val();

			if(!templateName){

				$('#resp').html();
				$('#resp').html('Please enter Template Name.');
			}
			else if(formArray.length <=2){

				$('#resp').html();
				$('#resp').html('Please select atleast One Input Type.');
			}
			else
			{
				$('#getJSON').attr('disabled',true);
				
				$('#resp').removeClass('show-error');

				$.ajax({
					type: "POST",					
					url: "{{route('machine-directive.store')}}",				
					data: {templateName:templateName,formArray:formArray,"_token":'<?php echo csrf_token()?>',user_configured:'0'},
					success: function(response) 
					{						
						$('#resp').addClass('show-error');	
						$('#resp').addClass('text-success');					
						$('#resp').html();
						$('#resp').html('Machine Directive added successfully.');
						
						window.location.href = "<?php echo URL::to('admin/machine-directive'); ?>";	

						// setTimeout(function(){
						// 	window.location.reload(1);
						// }, 2000);
					}
				});
			}
		});	
	}			

</script>
@include('layouts.adminFooter')
