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
					<img src="{{ URL::asset('images/logo.png') }}" alt="." class="hide">
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
											<a href="{{ route('home') }}">
												<i class="icon-home icon text-success"></i>
												<span class="font-bold">Home</span>
											</a>
										</li>
										
										<li>
											<a href="{{ route('musics.home') }}">
												<i class="icon-music-tone-alt icon text-info"></i>
												<span class="font-bold">Músicas</span>
											</a>
										</li>
										<li>
											<a href="{{ route('videos.home') }}">
												<i class="icon-social-youtube icon text-primary"></i>
												<span class="font-bold">Videos</span>
											</a>
										</li>
										<li>
											<a href="{{ route('podcasts.home') }}">
												<i class="fa fa-podcast icon text-primary-lter" aria-hidden="true"></i>
												<span class="font-bold">Podcasts</span>
											</a>
										</li>
										<li>
											<a href="{{ route('books.home') }}">
												<i class="icon-book-open icon text-info-dker"></i>
												<span class="font-bold">Livros</span>
											</a>
										</li>
										<li>
											<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
												<i class="icon-logout icon text-danger"></i>
												<span class="font-bold">Logout</span>
											</a>
											<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
												{{ csrf_field() }}
											</form>
										</li>
										<li class="m-b hidden-nav-xs"></li>
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
