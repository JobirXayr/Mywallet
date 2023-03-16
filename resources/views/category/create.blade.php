<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<title>Создать новую категорию</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">
	<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" type="text/css">
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
									<li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Категории</a></li>
									<li class="breadcrumb-item active" aria-current="page">Создать новую категорию</li>
								</ol>
							</div>

							@if (session('message'))
							    <div class="alert alert-success">
							        {{ session('message') }}
							    </div>
							@endif
							
							<div class="row">
								<div class="col-md-12">
									<!-- Создать категорию -->
									<form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
			      						@csrf
			      						<div class="container">
					        				<div class="row">
					      						<div class="col-md-5 mb-2">
							        				<label for="category">Название категории</label>
							        				<input id="category" type="text" autocomplete="off" class="form-control" name="category">
							        			</div>
							        			<div class="col-md-3 mb-2">
							        				<?php 

							        					$category_types = [
							        						['name' => 'Доход', 'val' => 1], 
							        						['name' => 'Расход', 'val' => -1]
							        					];
							        				 ?>
							        				<label for="type_category">Тип категории</label>
							        				<select id="type_category" class="form-control" name="type">
							        					@foreach($category_types as $ct)
							        						<option value="{{ $ct['val'] }}">{{ $ct['name'] }}</option>
							        					@endforeach
							        				</select>
							        			</div>
							        			<div class="col-md-4 mb-2">
							        				<label for="category_file">Рисунок категории</label>
							        				<input id="category_file" type="file" class="form-control" name="image">
							        			</div>
							        			<div class="col-md-12 mb-2">
							        				<button type="submit" class="btn btn-primary">Сохранить категорию</button>
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
		</div>
	</div>
	<script src="{{ asset('assets/plugins/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/popper.js') }}"></script>
	<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/toggle-sidebar/js/sidemenu.js') }}"></script>
	<script src="{{ asset('assets/plugins/customscroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
	<script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>