@extends('layouts.interface')

@section('intContent')
	<section class="vbox">
		<section class="scrollable">
			<section class="hbox stretch">
				<aside class="bg-white">
					<section class="vbox">
						<header class="header bg-light lt">
							<ul class="nav nav-tabs nav-white">
								<li class="active"><a href="#academics" data-toggle="tab">Acadêmicos</a></li>
								<li class=""><a href="#authors" data-toggle="tab">Autores</a></li>
								<li class=""><a href="#admin" data-toggle="tab">Administradores</a></li>
							</ul>
						</header>
						<section class="scrollable">
							<div class="tab-content m-r">
								<div class="tab-pane active" id="academics">
									<ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
										@foreach($academics as $academic)
											<li class="list-group-item">
												<a href="{{ route('users.profile', $academic->id) }}" class="thumb-sm pull-left m-r-sm">
													<img src="{{ URL::asset("images/userIcon.png") }}" class="img-circle">
												</a>
												<a href="{{ route('users.profile', $academic->id) }}" class="clear">
													<small class="pull-right">{{ $academic->created_at }}</small>
													<strong class="block">{{ $academic->name }}</strong>
													<small>{{ $academic->email }}</small>
												</a>
											</li>
										@endforeach
									</ul>
								</div>
								<div class="tab-pane" id="authors">
									<ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
										@foreach($authors as $author)
											<li class="list-group-item">
												<a href="{{ route('users.profile', $author->id) }}" class="thumb-sm pull-left m-r-sm">
													<img src="{{ URL::asset("images/userIcon.png") }}" class="img-circle">
												</a>
												<a href="{{ route('users.profile', $author->id) }}" class="clear">
													<small class="pull-right">{{ $author->created_at }}</small>
													<strong class="block">{{ $author->name }}</strong>
													<small>{{ $author->email }}</small>
												</a>
											</li>
										@endforeach
									</ul>
								</div>
								<div class="tab-pane" id="admin">
									<ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
										@foreach($admins as $admin)
											<li class="list-group-item">
												<a href="{{ route('users.profile', $admin->id) }}" class="thumb-sm pull-left m-r-sm">
													<img src="{{ URL::asset("images/userIcon.png") }}" class="img-circle">
												</a>
												<a href="{{ route('users.profile', $admin->id) }}" class="clear">
													<small class="pull-right">{{ $admin->created_at }}</small>
													<strong class="block">{{ $admin->name }}</strong>
													<small>{{ $admin->email }}</small>
												</a>
											</li>
										@endforeach
									</ul>
								</div>
							</div>
						</section>
					</section>
				</aside>	
			</section>
		</section>
	</section>
	<a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen,open" data-target="#nav,html"></a>
@endsection