@section('title', 'List Machine Operation Users')
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
							<li> <a href="#">Machine Operation Users</a></li>							
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

			<div class="ragistration-detele-map">
				<div class="detele-tab">
					<ul class="nav nav-tabs">
						<li>							
							<span> {{!(empty($machine->machine))?ucfirst($machine->machine):''}} </span>							
						</li> 						    
					</ul>
				</div>
			</div>

			<div class="office-detele-section tab-content">				
				<div class="tab-pane fade active in show" id="machine">
					<div class="ragistration-detele-section">
						<div class="machine-detele">
							<?php
							if(!$machineOperationUser->isEmpty())
							{
							?>
							<table>
								<tr>
									<th> Date </th>
									<th> Time </th>
									<th> User </th>
									<th> View </th>									
								</tr>
								@foreach($machineOperationUser as $value)
								<tr>								
									<td> {{date('d/m/Y', strtotime($value->created_at))}} </td>
									<td> {{date('H:i:s', strtotime($value->created_at))}} </td>
									<td> {{(!empty($value->user->name))?ucfirst($value->user->name):''}} </td>
									<td><a href="javascript:void(0);" onclick="getUserDirectiveAnsPreview(<?php echo $value->user_id; ?>,<?php echo $value->machine_id; ?>,<?php echo $machine->user_dir_id; ?>,<?php echo $value->id; ?>)"><img src="{{asset('public/images/eye-icon-d.png')}}"></a></td>
								</tr>
								@endforeach								
							</table>
							<?php
						}
						else
						{
							?>
							<h5 class="no-response">No response for this machine yet.</h5>
							<?php
						}
						?>
						</div>					
					</div>
					<div class="organ-page-nav">							
						{!! $machineOperationUser->links('layouts.pagination') !!}
					</div>
				</div>								
			</div>
		</div>
	</main>

	<button id="modalbtn" type="hidden" style="display: none;" data-toggle="modal" data-target="#myModal1"></button>

	<div class="appendUserDirectiveHtml"></div>

	<script type="text/javascript">

		function getUserDirectiveAnsPreview(userId,machineId,formId,operationHistoryId)
		{

			$.ajax({
				type: "GET",					
				url: "{{route('getUserDirectiveAnsPreview')}}",				
				data: {userId:userId,machineId:machineId,formId:formId,operationHistoryId:operationHistoryId,"_token":'<?php echo csrf_token()?>'},
				success: function(response) 
				{	

					console.log(response)

					$('.appendUserDirectiveHtml div').remove();
					$('.appendUserDirectiveHtml').append(response);
					$('#modalbtn').click();
				}
			});
		}

	</script>
	@include('layouts.adminFooter')