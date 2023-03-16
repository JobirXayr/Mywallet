<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<title>Категории</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">
	<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/plugins/customscroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/plugins/toggle-sidebar/css/sidemenu.css') }}" rel="stylesheet" type="text/css">
</head>
<body class="app sidebar-mini rtl" >
	<div id="global-loader" ></div>
	<div class="page">
		<div class="page-main">
			<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
			
			<!-- Sidebar -->
			@include('sidebar')

			<!-- app-content-->
			<div class="app-content ">
				<div class="side-app">
					<div class="main-content">

						<!-- Navbar -->
						@include('navbar')

						<!-- Page content -->
						<div class="container-fluid pt-8">
							<div class="page-header mt-0 shadow p-3">
								<ol class="breadcrumb mb-sm-0">
									<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Главная</a></li>
									<li class="breadcrumb-item active" aria-current="page">Категории</li>
								</ol>
							</div>

							@if (session('message'))
							    <div class="alert alert-success">
							        {{ session('message') }}
							    </div>
							@endif

							<div class="row">
								<div class="col-md-12">
									<a href="{{ route('categories.create') }}">Создать новую категорию</a>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-6">
											<h3 class="text-success text-center">Категории дохода</h3>
											<div class="table-responsive">
												<table id="income_table" class="table table-bordered w-100">
													<thead>
														<tr>
															<th class="text-center">П.н.</th>
															<th class="text-center">Название</th>
															<th class="text-center">Рисунок</th>
															<th class="text-center">Функция</th>
														</tr>
													</thead>
													<tbody>
														@foreach($income_categories as $key => $value)
															<tr>
																<td style="width: 15px;" class="text-center align-middle">{{ $key + 1 }}</td>
																<td>{{ $value->name }}</td>
																<td class="text-center">
																	@if($value->path)
																		<img src="{{ url('images/'.$value->path) }}" class="rounded">
																	@endif
																</td>
																<td style="width:15%;">
																	<a href="{{ route('categories.show', $value->id) }}"><i class="fa fa-edit" style="font-size:14px; color:green;"></i></a>
																	<form method="post" action="{{ route('categories.destroy', $value->id) }}" style="float: right;">
											                            @csrf
											                            @method('DELETE')
											                            <button type="submit" style="border: 0; background-color: #F4F6FB;"><i class="fa fa-trash" style="font-size:14px; color:red;"></i></button>
											                        </form>
																</td>
															</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
										<div class="col-md-6">
											<h3 class="text-success text-center">Категории расхода</h3>
											<div class="table-responsive">
												<table id="expense_table" class="table table-bordered w-100">
													<thead>
														<tr>
															<th class="text-center">П.н.</th>
															<th class="text-center">Название</th>
															<th class="text-center">Рисунок</th>
															<th class="text-center">Функция</th>
														</tr>
													</thead>
													<tbody>
														@foreach($expense_categories as $key => $value)
															<tr>
																<td style="width: 15px;" class="text-center align-middle">{{ $key + 1 }}</td>
																<td>{{ $value->name }}</td>
																<td class="text-center">
																	@if($value->path)
																		<img src="{{ url('images/'.$value->path) }}" style="border-radius:50%; width:30px;">
																	@endif
																</td>
																<td style="width:15%;">
																	<a href="{{ route('categories.show', $value->id) }}"><i class="fa fa-edit" style="font-size:14px; color:green;"></i></a>
																	<form method="post" action="{{ route('categories.destroy', $value->id) }}" style="float: right;">
											                            @csrf
											                            @method('DELETE')
											                            <button type="submit" style="border: 0; background-color: #F4F6FB;"><i class="fa fa-trash" style="font-size:14px; color:red;"></i></button>
											                        </form>
																</td>
															</tr>
														@endforeach
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>					
						</div>
					</div>
				</div>
			</div>
			<!-- app-content-->
		</div>
	</div>
	<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

	<script src="{{ asset('assets/plugins/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/popper.js') }}"></script>
	<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/toggle-sidebar/js/sidemenu.js') }}"></script>
	<script src="{{ asset('assets/plugins/customscroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
	<script src="{{ asset('assets/js/custom.js') }}"></script>
	
</body>
</html>