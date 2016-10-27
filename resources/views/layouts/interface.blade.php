@extends('layouts.app')

@section('appContent')
	<section class="vbox">
		<header class="bg-white-only header header-md navbar navbar-fixed-top-xs">
			<!-- Logo -->
			<div class="navbar-header aside bg-info nav-xs">
				<a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen,open" data-target="#nav,html">
					<i class="icon-list"></i>
				</a>
				<a href="{{ url('/home') }}" class="navbar-brand text-lt">
					<i class="icon-earphones"></i>
					<img src="images/logo.png" alt="." class="hide">
					<span class="hidden-nav-xs m-l-sm">UniTunes</span>
				</a>
				<a class="btn btn-link visible-xs" data-toggle="dropdown" data-target=".user">
					<i class="icon-settings"></i>
				</a>
			</div>
			<!-- /Logo -->

			<!-- Nav Toogle Btn -->
			<ul class="nav navbar-nav hidden-xs">
				<li>
					<a href="#nav,.navbar-header" data-toggle="class:nav-xs,nav-xs" class="text-muted">
						<i class="fa fa-indent text"></i>
						<i class="fa fa-dedent text-active"></i>
					</a>
				</li>
			</ul>
			<!-- /Nav Toogle Btn -->

			<!-- Search Input -->
			<form class=" navbar-left w-f input-s-lg m-t m-l-n-xs hidden-xs" role="search" >
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-sm bg-white btn-icon rounded"><i class="fa fa-search"></i></button>
						</span>
						<input type="text" class="form-control input-sm no-border rounded" placeholder="Search songs, albums..." >
					</div>
				</div>
			</form>
			<!-- /Search Input -->
		</header>
		<section>
			<section class="hbox stretch">
				<!-- .Aside -->
				<aside class="bg-black dk nav-xs aside hidden-print" id="nav">
					<section class="vbox">
						<section class="w-f scrollable">
							<div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="10px" data-railOpacity="0.2">
								<!-- nav -->
								<nav class="nav-primary hidden-xs">
									<ul class="nav bg clearfix">
										<li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">
											Discover
										</li>
										<li>
											<a href="{{ url('/home') }}">
												<i class="icon-home icon text-success"></i>
												<span class="font-bold">Home</span>
											</a>
										</li>
										
										<li>
											<a href="{{ url('/musics') }}">
												<i class="icon-music-tone-alt icon text-info"></i>
												<span class="font-bold">Músicas</span>
											</a>
										</li>
										<li>
											<a href="{{ url('/videos') }}">
												<i class="icon-social-youtube icon text-primary"></i>
												<span class="font-bold">Videos</span>
											</a>
										</li>
										<li>
											<a href="{{ url('/podcasts') }}">
												<i class="fa fa-podcast icon text-primary-lter" aria-hidden="true"></i>
												<span class="font-bold">Podcasts</span>
											</a>
										</li>
										<li>
											<a href="{{ url('/books') }}">
												<i class="icon-book-open icon text-info-dker"></i>
												<span class="font-bold">Livros</span>
											</a>
										</li>
										<li>
											<a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
												<i class="icon-logout icon text-danger"></i>
												<span class="font-bold">Logout</span>
											</a>
											<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
												{{ csrf_field() }}
											</form>
										</li>
										<li class="m-b hidden-nav-xs"></li>
									</ul>
									<ul class="nav" data-ride="collapse">
										<li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">
											Interface
										</li>
										<li >
											<a href="#" class="auto">
												<span class="pull-right text-muted">
													<i class="fa fa-angle-left text"></i>
													<i class="fa fa-angle-down text-active"></i>
												</span>
												<i class="icon-screen-desktop icon"></i>
												<span>Layouts</span>
											</a>
											<ul class="nav dk text-sm">
												<li >
													<a href="layout-color.html" class="auto">
														<i class="fa fa-angle-right text-xs"></i>
														<span>Color option</span>
													</a>
												</li>
												<li >
													<a href="layout-boxed.html" class="auto">
														<i class="fa fa-angle-right text-xs"></i>
														<span>Boxed layout</span>
													</a>
												</li>
												<li >
													<a href="layout-fluid.html" class="auto">
														<i class="fa fa-angle-right text-xs"></i>
														<span>Fluid layout</span>
													</a>
												</li>
											</ul>
										</li>
										<li >
											<a href="#" class="auto">
												<span class="pull-right text-muted">
													<i class="fa fa-angle-left text"></i>
													<i class="fa fa-angle-down text-active"></i>
												</span>
												<i class="icon-chemistry icon"></i>
												<span>UI Kit</span>
											</a>
											<ul class="nav dk text-sm">
												<li >
													<a href="buttons.html" class="auto">
														<i class="fa fa-angle-right text-xs"></i>
														<span>Buttons</span>
													</a>
												</li>
												<li >
													<a href="icons.html" class="auto">
														<b class="badge bg-info pull-right">369</b>
														<i class="fa fa-angle-right text-xs"></i>
														<span>Icons</span>
													</a>
												</li>
												<li >
													<a href="grid.html" class="auto">
														<i class="fa fa-angle-right text-xs"></i>
														<span>Grid</span>
													</a>
												</li>
												<li >
													<a href="widgets.html" class="auto">
														<b class="badge bg-dark pull-right">8</b>
														<i class="fa fa-angle-right text-xs"></i>
														<span>Widgets</span>
													</a>
												</li>
												<li >
													<a href="components.html" class="auto">
														<i class="fa fa-angle-right text-xs"></i>
														<span>Components</span>
													</a>
												</li>
												<li >
													<a href="list.html" class="auto">
														<i class="fa fa-angle-right text-xs"></i>
														<span>List group</span>
													</a>
												</li>
												<li >
													<a href="#table" class="auto">
														<span class="pull-right text-muted">
															<i class="fa fa-angle-left text"></i>
															<i class="fa fa-angle-down text-active"></i>
														</span>
														<i class="fa fa-angle-right text-xs"></i>
														<span>Table</span>
													</a>
													<ul class="nav dker">
													<li >
														<a href="table-static.html">
															<i class="fa fa-angle-right"></i>
															<span>Table static</span>
														</a>
													</li>
													<li >
														<a href="table-datatable.html">
															<i class="fa fa-angle-right"></i>
															<span>Datatable</span>
														</a>
													</li>
													</ul>
												</li>
												<li >
													<a href="#form" class="auto">
														<span class="pull-right text-muted">
															<i class="fa fa-angle-left text"></i>
															<i class="fa fa-angle-down text-active"></i>
														</span>
														<i class="fa fa-angle-right text-xs"></i>
														<span>Form</span>
													</a>
													<ul class="nav dker">
														<li >
															<a href="form-elements.html">
																<i class="fa fa-angle-right"></i>
																<span>Form elements</span>
															</a>
														</li>
														<li >
															<a href="form-validation.html">
																<i class="fa fa-angle-right"></i>
																<span>Form validation</span>
															</a>
														</li>
														<li >
															<a href="form-wizard.html">
																<i class="fa fa-angle-right"></i>
																<span>Form wizard</span>
															</a>
														</li>
													</ul>
												</li>
												<li >
													<a href="chart.html" class="auto">
														<i class="fa fa-angle-right text-xs"></i>
														<span>Chart</span>
													</a>
												</li>
												<li >
													<a href="portlet.html" class="auto">
														<i class="fa fa-angle-right text-xs"></i>
														<span>Portlet</span>
													</a>
												</li>
												<li >
													<a href="timeline.html" class="auto">
														<i class="fa fa-angle-right text-xs"></i>
														<span>Timeline</span>
													</a>
												</li>
											</ul>
										</li>
										<li >
											<a href="#" class="auto">
												<span class="pull-right text-muted">
													<i class="fa fa-angle-left text"></i>
													<i class="fa fa-angle-down text-active"></i>
												</span>
												<i class="icon-grid icon"></i>
												<span>Pages</span>
											</a>
											<ul class="nav dk text-sm">
												<li >
													<a href="profile.html" class="auto">
														<i class="fa fa-angle-right text-xs"></i>
														<span>Profile</span>
													</a>
												</li>
												<li >
													<a href="blog.html" class="auto">
														<i class="fa fa-angle-right text-xs"></i>
														<span>Blog</span>
													</a>
												</li>
												<li >
													<a href="invoice.html" class="auto">
														<i class="fa fa-angle-right text-xs"></i>
														<span>Invoice</span>
													</a>
												</li>
												<li >
													<a href="gmap.html" class="auto">
														<i class="fa fa-angle-right text-xs"></i>
														<span>Google Map</span>
													</a>
												</li>
												<li >
													<a href="jvectormap.html" class="auto">
														<i class="fa fa-angle-right text-xs"></i>
														<span>Vector Map</span>
													</a>
												</li>
												<li >
													<a href="signin.html" class="auto">
														<i class="fa fa-angle-right text-xs"></i>
														<span>Signin</span>
													</a>
												</li>
												<li >
													<a href="signup.html" class="auto">
														<i class="fa fa-angle-right text-xs"></i>
														<span>Signup</span>
													</a>
												</li>
												<li >
													<a href="404.html" class="auto">
														<i class="fa fa-angle-right text-xs"></i>
														<span>404</span>
													</a>
												</li>
											</ul>
										</li>
									</ul>
									<ul class="nav text-sm">
										<li class="hidden-nav-xs padder m-t m-b-sm text-xs text-muted">
											<span class="pull-right"><a href="#"><i class="icon-plus i-lg"></i></a></span>
											Playlist
										</li>
										<li>
											<a href="#">
											<i class="icon-music-tone icon"></i>
											<span>Hip-Pop</span>
											</a>
										</li>
										<li>
											<a href="#">
												<i class="icon-playlist icon text-success-lter"></i>
												<b class="badge bg-success dker pull-right">9</b>
												<span>Jazz</span>
											</a>
										</li>
									</ul>
								</nav>
								<!-- /nav -->
							</div>
						</section>
					</section>
				</aside>
				<!-- /.Aside -->
				<section id="content">
					<section class="hbox stretch">

						@yield('intContent')

					</section>
					<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
				</section>
			</section>
		</section>
	</section>
@endsection
