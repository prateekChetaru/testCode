@include('layouts.adminHeader')
<main class="main-content">
					<div class="content-top">
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<div class="page-tital"> 
										<h2> Dashboard : </h2>
										<span class="sub-tital"> Welcome Simon</span>
									</div>
									<div class="page-nav">
										<ul>
											<li> <a href="#"> Home </a> </li>
											<li> <a href="#"> Organisations </a></li>
										</ul>
									</div>
								</div>
								<!-- <div class="col-md-6">
									<div class="content-top-right">
										<div class="add-btn-section">
											<a href="#" class="btn"> <img src="{{asset('public/images/') }}/plus-icon.png"> <span> Add Office </span></a>
											<a href="#" class="btn"> <img src="{{asset('public/images/') }}/plus-icon.png"> <span> Add Machine </span></a>
										</div>
									</div>
								</div> -->
							</div>
						</div>
					</div>
					<div class="ragistration-detele add-fild-section">
						<div class="container">
							<div class="ragistration-detele-section">
								<div class="row">
									<div class="col-md-12">
										<h2> Organisation </h2>
										<div class="del-chng-cont">
										<div class="rgist-compy-logo"> <img src="{{asset('public/images/') }}/detaile-logo.png"></div>
											<div class="chng-dlt-btn">
												<button class="change"> Change </button>
												<button class="dlt"> delete </button>
											</div>
										</div>
									</div>
								</div>
								<form>
									
									@foreach($organisation as $key => $value)
																		{{$value->id}}
									   @endforeach 

									<div class="row">
										<div class="col-md-3">
											<label>Name of Organisation </label>
										</div>
										<div class="col-md-9">
											<input type="text" placeholder="Live & Study" value="">
										</div>
									</div>
										<div class="row">
											<div class="col-md-3">
												<label> Department </label>
											</div>
											<div class="col-md-9">
												<input type="text" placeholder="Network Security">
											</div>
										</div>
								</form>
							</div>
							<div class="ragistration-detele-section">
								<div class="row">
									<div class="col-md-12">
										<h2> Contact </h2>
									</div>
								</div>
								<form>
									<div class="row">
										<div class="col-md-3">
											<label>Address </label>
										</div>
										<div class="col-md-9">
											<input type="text" placeholder="133  Square de la Couronne, PANTINÎle-de-France 93500">
										</div>
									</div>
										<div class="row">
											<div class="col-md-3">
												<label> Phone </label>
											</div>
											<div class="col-md-9">
												<input type="text" placeholder="+44 (0) 1325 734 845">
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<label>systems@gmail.com</label>
											</div>
											<div class="col-md-9">
											<input type="text" placeholder="100000">
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<label>E-mail</label>
											</div>
											<div class="col-md-9">
											<input type="text" placeholder="systems@gmail.com">
											</div>
										</div>
								</form>
							</div>
							<div class="ragistration-detele-section">
								<div class="row">
									<div class="col-md-12">
										<h2> User </h2>
									</div>
								</div>
								<form>
									<div class="row">
										<div class="col-md-3">
											<label>User </label>
										</div>
										<div class="col-md-9">
											<input type="text" placeholder="Oliver">
										</div>
									</div>
									<div class="row">
										<div class="col-md-3">
											<label> Password </label>
										</div>
										<div class="col-md-9">
											<input id="password-field" type="password" class="form-control" placeholder="Password">
								    		<span toggle="#password-field" class="field-icon toggle-password eye-icon"><img src="{{asset('public/images/') }}/eye-icon-d.png"> </span>
										</div>
									</div>
								</form>
							</div>
							<div class="ragistration-detele-map">
								<div class="detele-tab">
									<ul class="nav nav-tabs">
			                            <li>
						                    <a class="active" href="#offices" data-toggle="tab" aria-expanded="true">
							                    <img class="wite-icon" src="{{asset('public/images/') }}/office-icon.png">
							                    <img class="gray-icon" src="{{asset('public/images/') }}/gray-office-icon.png"> 
							                    <span> OFFICES </span>
						                    </a>
						                </li>
						               	<li>
						                    <a href="#machine" data-toggle="tab" aria-expanded="false">
						                    <img class="wite-icon" src="{{asset('public/images/') }}/machine-icon-d.png">
						                    <img class="gray-icon" src="{{asset('public/images/') }}/machine-icon.png"> 
						                    <span> MACHINE </span>
						                    </a>
						               	</li>                    
						            </ul>
								</div>
							</div>
							<div class="office-detele-section tab-content">
								<div class="tab-pane fade active in show" id="offices"> 
									
									<div class="ragistration-detele-section office-detele">
										<div class="row">
											<div class="col-md-12">
												<h2> Offices </h2>
												<div class="office-box">
													<div class="office-box-detel">
														<div class="office-tital">
															<span class="office-map-icon"> <img src="{{asset('public/images/') }}/office-map-icon.png"> </span>
															<h3> USA</h3>
														</div>
														<div class="office-addres">
															<span class="office-ad-icon"> <img src="{{asset('public/images/') }}/adders-icon.png"></span>
															<p> 
																3735  Wescam Court, Fallon
																<br> 
																Nevada 89406
															</p>
														</div>
														<div class="machines-tital">
															<h3> Machines: <span class="m-number">46</span> </h3>
														</div>
													</div>
													<div class="office-box-detel">
														<div class="office-tital">
															<span class="office-map-icon"> <img src="{{asset('public/images/') }}/office-map-icon.png"> </span>
															<h3> USA</h3>
														</div>
														<div class="office-addres">
															<span class="office-ad-icon"> <img src="{{asset('public/images/') }}/adders-icon.png"></span>
															<p> 
																3735  Wescam Court, Fallon
																<br> 
																Nevada 89406
															</p>
														</div>
														<div class="machines-tital">
															<h3> Machines: <span class="m-number">46</span> </h3>
														</div>
													</div>
													<div class="office-box-detel">
														<div class="office-tital">
															<span class="office-map-icon"> <img src="{{asset('public/images/') }}/office-map-icon.png"> </span>
															<h3> USA</h3>
														</div>
														<div class="office-addres">
															<span class="office-ad-icon"> <img src="{{asset('public/images/') }}/adders-icon.png"></span>
															<p> 
																3735  Wescam Court, Fallon
																<br> 
																Nevada 89406
															</p>
														</div>
														<div class="machines-tital">
															<h3> Machines: <span class="m-number">46</span> </h3>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="machine">
									<div class="ragistration-detele-section">
										<div class="machine-detele">
											<table>
												<tr>
													<th> Machine </th>
													<th> Location </th>
													<th> User  </th>
													<th> Documents </th>
													<th> Instructions </th>
													<th> Status </th>
												</tr>
												<tr>
													<td> 0806C1U </td>
													<td> Birmingham </td>
													<td> John </td>
													<td> Yes </td>
													<td> Yes </td>
													<td> Repair </td>
												</tr>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</main>
@include('layouts.adminFooter')