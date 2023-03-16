<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<title>Главная</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">
	<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
	<link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/plugins/customscroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/toggle-sidebar/css/sidemenu.css') }}" rel="stylesheet">
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
						<div class="p-2 d-block d-sm-none navbar-sm-search">
							<!-- Form -->
							<form class="navbar-search navbar-search-dark form-inline ml-lg-auto">
								<div class="form-group mb-0">
									<div class="input-group input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fas fa-search"></i></span>
										</div><input class="form-control" placeholder="Search" type="text">
									</div>
								</div>
							</form>
						</div>
						
						<!-- Navbar -->
						@include('navbar')

						<!-- Page content -->
						<div class="container-fluid pt-8">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card shadow">
                                        <div class="card-header bg-transparent">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h2 class="mb-0">Доходы & Расходы</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="barChart" class="chartjs-render-monitor h-300"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="card shadow">
                                        <div class="card-header bg-transparent">
                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <h2 class="mb-0">Доходы</h2>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="btn-group btn-group-sm income_graph" role="group" aria-label="Basic example" style="float: right;">
                                                        <button type="button" class="btn btn-outline-primary" data-parameter="7">Неделя</button>
                                                        <button type="button" class="btn btn-outline-primary" data-parameter="30">Месяц</button>
                                                        <button type="button" class="btn btn-outline-primary" data-parameter="365">Год</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="pieChart" class="chartjs-render-monitor h-300"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="card shadow">
                                        <div class="card-header bg-transparent">
                                            <div class="row align-items-center">
                                                <div class="col-md-6">
                                                    <h2 class="mb-0">Расходы</h2>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="btn-group btn-group-sm expense_graph" role="group" aria-label="Basic example" style="float: right;">
                                                        <button type="button" class="btn btn-outline-primary" data-parameter="7">Неделя</button>
                                                        <button type="button" class="btn btn-outline-primary" data-parameter="30">Месяц</button>
                                                        <button type="button" class="btn btn-outline-primary" data-parameter="365">Год</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="doughutChart" class="chartjs-render-monitor h-300"></canvas>
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
    <script src="{{ asset('assets/plugins/chart-circle/circle-progress.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/chart.js/dist/Chart.extension.js') }}"></script>
    <script src="{{ asset('assets/plugins/toggle-sidebar/js/sidemenu.js') }}"></script>
    <script src="{{ asset('assets/plugins/customscroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script type="text/javascript">

        function load_data($parameter=7) // parameter=7 - bu default holatda oxirgi 7 kun ichidagi otchotlarni chiqarib beradi, parameter = 30 - shu oydagisini, parameter = 365 - shu yildagisini.
        {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: "{{ url('/cash-flow') }}",
                data: {parameter: $parameter},
                success: function(data){
                    let months = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];
                    let chart_months = [];
                    let income_data = [];
                    let expense_data = [];

                    for (let i = 0; i < data['cashflow'].length; i++) {
                        chart_months.push(months[data['cashflow'][i]['month']-1]);
                        if (data['cashflow'][i]['cashflow'] == 'income')
                            income_data.push(data['cashflow'][i]['amount']);
                        else
                            expense_data.push(data['cashflow'][i]['amount']);
                    }

                    var chart1 = document.getElementById("barChart");
                    var myChart1 = new Chart(chart1, {
                        type: 'bar',
                        data: {
                            labels: months,
                            datasets: [{
                                label: "Доходы",
                                data: income_data,
                                borderColor: "#00c3ed",
                                borderWidth: "0",
                                backgroundColor: "#00c3ed"
                            }, {
                                label: "Расходы",
                                data: expense_data,
                                borderColor: "#ffa21d",
                                borderWidth: "0",
                                backgroundColor: "#ffa21d"
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });

                    let income_chart_data = [];
                    let income_chart_label = [];

                    let expense_chart_data = [];
                    let expense_chart_label = [];

                    for (let i = 0; i < data['statement'].length; i++) {
                        if (data['statement'][i]['cashflow'] == 'income'){
                            income_chart_data.push(data['statement'][i]['amount']);
                            income_chart_label.push(data['statement'][i]['category']);
                        } else {
                            expense_chart_data.push(data['statement'][i]['amount']);
                            expense_chart_label.push(data['statement'][i]['category']);
                        }
                    }

                    var chart_income = document.getElementById("pieChart");
                    var myChart2 = new Chart(chart_income, {
                        type: 'pie',
                        data: {
                            datasets: [{
                                data: income_chart_data,
                                backgroundColor: ['#00c3ed',' #322599 ', '#ffa21d', '#f94920', '#d62649','#18b16f', '#FF9655', '#FFF263', '#6AF9C4'],
                                hoverBackgroundColor: ['#00c3ed',' #322599 ', '#ffa21d', '#f94920', '#d62649','#18b16f', '#FF9655', '#FFF263', '#6AF9C4']
                            }],
                            labels: income_chart_label
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });

                    var ctx = document.getElementById("doughutChart");
                    var myChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            datasets: [{
                                data: expense_chart_data,
                                backgroundColor: ['#00c3ed',' #322599 ', '#ffa21d', '#f94920', '#d62649','#18b16f', '#FF9655', '#FFF263', '#6AF9C4'],
                                hoverBackgroundColor: ['#00c3ed',' #322599 ', '#ffa21d', '#f94920', '#d62649','#18b16f', '#FF9655', '#FFF263', '#6AF9C4']
                            }],
                            labels: expense_chart_label
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false
                        }
                    });
                }
            });
        }
        
        $('body').on('click', '.income_graph button, .expense_graph button', function(){
            let parameter = $(this).data("parameter");
            load_data(parameter);
        });

        load_data();
    </script>
</body>
</html>