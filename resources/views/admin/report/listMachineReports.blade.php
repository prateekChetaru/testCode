@section('title', 'List Machine Reports')
@include('layouts.adminHeader')
<main class="main-content">
	<div class="content-top">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="page-tital">						
						<span class="sub-tital"> {{Auth::user()->name}} </span>
					</div>
					<div class="page-nav">
						<ul>
							<li> <a href="{{URL::to('admin/admin-dashboard')}}">Dashboard</a> </li>
							<li> <a href="#">Machine Reports</a></li>							
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
	<div class="ragistration-detele add-fild-section">
		<div class="container">

			<div class="office-detele-section tab-content">				
				<div class="tab-pane fade active in show" id="machine">
					<div class="ragistration-detele-section">
						<div class="machine-detele">

							<table>
								<tr>
									<th> Machine ID </th>
									<th> Machine Name </th>
									<th> Machine Configured </th>
									<th> User Directive Configured </th>		
									<th> Last Access </th>							
								</tr>
								@foreach($machines as $machine)
								
								<!-- <tr onclick='getMachineOperationUsers("<?php echo URL::to('admin/machine-reports-operation-user-list').'/'. base64_encode($machine->id); ?>");'> -->

									<tr>
									<td ><a href="<?php echo URL::to('admin/machine-reports-operation-user-list').'/'. base64_encode($machine->id); ?>">{{$machine->machine_id}}</a></td>
									<td><a href="<?php echo URL::to('admin/machine-reports-operation-user-list').'/'. base64_encode($machine->id); ?>">{{ucfirst($machine->machine)}}</a></td>

									<td>

										@if(!empty($machine->machine))
										<i class="fa fa-check"></i>
										@endif
										
										@if(!empty($machine->answer))

										@php $i=0;@endphp

										@foreach($machine->answer as $answer)

										@if($i==0)
										
										<a href="javascript:void(0);" onclick="formPreview(<?php echo $machine->id; ?>,<?php echo $answer->question->form->id; ?>)"><img src="{{asset('public/images/eye-icon-d.png')}}"></a>

										@endif

										@php $i++ ; @endphp

										@endforeach

										@endif
									</td>

									<td>										
										<!-- <input type="checkbox" {{(!empty($machine->user_dir_id))?'checked':''}}> -->
										@if(!empty($machine->user_dir_id))
										<i class="fa fa-check"></i>
										@endif
									</td>
									<td>

										<?php 

										if(!empty($machine->machineOperatorUser[0]->created_at))
										{										

											$dateTime = $machine->machineOperatorUser[0]->created_at;	

											echo date('d-m-Y', strtotime($dateTime)).' | '.date('H:s:i', strtotime($dateTime));
										}
										?>
									</td>
								</tr>								
								@endforeach

							</table>
						</div>					
					</div>
					<div class="organ-page-nav">							
						{{-- $machineOperationUser->links('layouts.pagination') --}}
					</div>
				</div>								
			</div>
		</div>
	</main>
	<button id="modalbtn" type="hidden" style="display: none;" data-toggle="modal" data-target="#myModal1"></button>

	<div class="appendMacnDrhtml"></div>

	<script type="text/javascript">

		function formPreview(machineId,tempId,e)
		{
			
			$.ajax({
				type: "GET",					
				url: "{{route('previewForm')}}",				
				data: {machineId:machineId,tempId:tempId,"_token":'<?php echo csrf_token()?>'},
				success: function(response) 
				{				
					$('.appendMacnDrhtml div').remove();
					$('.appendMacnDrhtml').append(response);
					$('#modalbtn').click();
				}
			});
		}			
	</script>
	<!-- row clickable to get machine operators list  -->
	<script type="text/javascript">
		function getMachineOperationUsers(url)
		{
			console.log(url)
			window.location.href = url;			
		}
	</script>
	@include('layouts.adminFooter')