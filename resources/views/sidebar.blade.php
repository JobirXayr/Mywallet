<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
	<div class="sidebar-img">
		<ul class="side-menu" style="margin-top: 82px;">
			
			<li class="slide">
				<a class="side-menu__item" href="{{ route('dashboard') }}"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Главная</span></a>
			</li>
			<li class="slide">
				<a class="side-menu__item" href="{{ route('categories.index') }}"><i class="side-menu__icon fe fe-type"></i><span class="side-menu__label">Категории</span></a>
			</li>
			<li class="slide">
				<a class="side-menu__item" href="{{ route('cashflows.index') }}"><i class="side-menu__icon fe fe-bar-chart-2"></i><span class="side-menu__label">Cash flow</span></a>
			</li>
		</ul>
	</div>
</aside>