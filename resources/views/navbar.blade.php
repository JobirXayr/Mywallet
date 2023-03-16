<nav class="navbar navbar-top  navbar-expand-md navbar-dark" id="navbar-main">
	<div class="container-fluid">
		<a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>
		<ul class="navbar-nav align-items-center">
			<li class="nav-item d-none d-md-flex">
				<div class="dropdown d-none d-md-flex mt-2 ">
					<a class="nav-link pl-0 pr-0">Мой баланс: {{ session('balance') }}</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a aria-expanded="false" aria-haspopup="true" class="nav-link pr-md-0" data-toggle="dropdown" href="#" role="button">
				<div class="media align-items-center">
					@if(auth()->user()->path)
						<span class="avatar avatar-sm rounded-circle"><img alt="Image placeholder" src="{{ auth()->user()->path }}"></span>
					@endif
					<div class="media-body ml-2 d-none d-lg-block">
						<span class="mb-0 ">{{ auth()->user()->username }}</span>
					</div>
				</div></a>
				<div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
					<a class="dropdown-item" href="{{ route('my-profile') }}"><i class="ni ni-single-02"></i> <span>Мой профиль</span></a>
					<div class="dropdown-divider"></div><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="ni ni-user-run"></i> <span>Выход</span></a>
				</div>

				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				    @csrf
				</form>

			</li>
		</ul>
	</div>
</nav>