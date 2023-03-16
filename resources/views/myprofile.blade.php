<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<title>Мой профил</title>
	<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">
	<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/plugins/customscroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/toggle-sidebar/css/sidemenu.css') }}" rel="stylesheet">
</head>
<body class="app sidebar-mini rtl" >
	<div id="global-loader" ></div>
	<div class="page">
		<div class="page-main">
			<!-- Sidebar menu-->
			<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
			
			@include('sidebar')

			<!-- app-content-->
			<div class="app-content ">
				<div class="side-app">
					<div class="main-content">
						
						@include('navbar')

						<!-- Page content -->
						<div class="container-fluid pt-8">
							<div class="row">
								<div class="col-lg-12">
									<div class="card shadow">
										<div class="card-header">
											<h2 class="mb-0">Редактировать личные данные</h2>
										</div>
										<div class="card-body">
											<form action="{{ route('update-my-profile') }}" method="POST">
												<div class="row">
													@csrf
													@method("PUT")
													<div class="col-md-4">
														<label for="user_image">Рисунок пользователя</label>
										        		<input id="user_image" type="file" class="form-control" name="image">
													</div>
													<div class="col-md-4">
														<label for="password">Пароль</label>
										        		<input id="password" type="password" class="form-control" name="password">
													</div>
													<div class="col-md-4">
														<label for="password_confirm">Подтвердите пароль</label>
										        		<input id="password_confirm" type="password" class="form-control" name="confirm_password">
													</div>
													<div class="col-md-12 mt-3">
										        		<input type="submit" class="btn btn-primary" value="Сохранить">
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
		</div>
	</div>
	<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>
	<script src="{{ asset('assets/plugins/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/popper.js') }}"></script>
	<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/toggle-sidebar/js/sidemenu.js') }}"></script>
	<script src="{{ asset('assets/plugins/customscroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
	<script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>