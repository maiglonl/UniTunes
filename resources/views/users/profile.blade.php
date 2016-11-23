@extends('layouts.interface')

@section('intContent')
	<section class="vbox">
		<section class="scrollable">
			<section class="hbox stretch">
				<aside class="aside-lg bg-light lter b-r">
					<section class="vbox">
						<section class="scrollable">
							<div class="wrapper">
								<div class="text-center m-b m-t">
									<a href="#" class="thumb-lg">
										<img src="{{ URL::asset("images/userIcon.png") }}" class="img-circle">
									</a>
									<div>
										<div class="h3 m-t-xs m-b-xs">{{ $author->name }}</div>
										@switch($author->profile)
											@case(0) 
												<div class="h4 m-t-xs m-b-xs">[ Administrador ]</div> 
											@breakswitch
											@case(1) 
												<div class="h4 m-t-xs m-b-xs">[ Acadêmico ]</div> 
											@breakswitch
											@case(2) 
												<div class="h4 m-t-xs m-b-xs">[ Autor ]</div> 
											@breakswitch
										@endswitch
										<small class="text-muted"><i class="fa fa-envelope-o"></i> {{ $author->email }}</small>
									</div>                
								</div>
								<div class="panel wrapper">
									<div class="row text-center">
										<div class="col-xs-4">
											<a href="#">
												<span class="m-b-xs h4 block">{{ $uploads }}</span>
												<small class="text-muted">Uploads</small>
											</a>
										</div>
										<div class="col-xs-4">
											<a href="#">
												<span class="m-b-xs h4 block">{{ $purchases }}</span>
												<small class="text-muted">Compras</small>
											</a>
										</div>
										<div class="col-xs-4">
											<a href="#">
												<span class="m-b-xs h4 block">{{ $sales }}</span>
												<small class="text-muted">Vendas</small>
											</a>
										</div>
									</div>
								</div>
								<div class="btn-group btn-group-justified m-b">
									@if($author->id == Auth::id())
										<a href="{{ route('users.delete', $author->id) }}" class="btn btn-success btn-rounded">
											<i class="fa fa-plus"></i> Add Créditos
										</a>
									@endif
									@if($canDelete)
										<a href="{{ route('users.delete', $author->id) }}" class="btn btn-danger btn-rounded">
											<i class="fa fa-times"></i> Excluir Conta
										</a>
									@endif
								</div>
							</div>
						</section>
					</section>
				</aside>
				<aside class="bg-white">
					<section class="vbox">
						<header class="header bg-light lt">
							<ul class="nav nav-tabs nav-white">
								<li class="active"><a href="#musics" data-toggle="tab">Músicas</a></li>
								<li class=""><a href="#videos" data-toggle="tab">Vídeos</a></li>
								<li class=""><a href="#podcasts" data-toggle="tab">Podcasts</a></li>
								<li class=""><a href="#books" data-toggle="tab">Livros</a></li>
							</ul>
						</header>
						<section class="scrollable">
							<div class="tab-content m-r">
								<div class="tab-pane active" id="musics">
									<ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
										@foreach($musics as $music)
											<li class="list-group-item">
												<a href="{{ route('musics.details', $music->id) }}" class="thumb-sm pull-left m-r-sm">
													<img src="{{ URL::asset("storage/images/$music->id.$music->imageExt") }}" class="img-circle">
												</a>
												<a href="{{ route('musics.details', $music->id) }}" class="clear">
													<small class="pull-right">{{ $music->created_at }}</small>
													<strong class="block">{{ $music->authors." - ".$music->name }}</strong>
													<small>{{ $music->description }}</small>
												</a>
											</li>
										@endforeach
										@if(count($musics) == 0)
											<h4 class="text-center m-t-xl">Nenhuma música encontrada.</h4>
										@endif
										@if($author->id == Auth::id())
											<div class="text-center m-t-xl">
												<a href="{{ route('musics.new') }}" class=" m-t-lg">
													Cadastrar nova música
													<i class="icon-cloud-upload i-lg inline"></i>
												</a>
											</div>
										@endif
									</ul>
								</div>
								<div class="tab-pane" id="videos">
									<ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
										@foreach($videos as $video)
											<li class="list-group-item">
												<a href="{{ route('videos.details', $video->id) }}" class="thumb-sm pull-left m-r-sm">
													<img src="{{ URL::asset("storage/images/$video->id.$video->imageExt") }}" class="img-circle">
												</a>
												<a href="{{ route('videos.details', $video->id) }}" class="clear">
													<small class="pull-right">{{ $video->created_at }}</small>
													<strong class="block">{{ $video->authors." - ".$video->name }}</strong>
													<small>{{ $video->description }}</small>
												</a>
											</li>
										@endforeach
										@if(count($videos) == 0)
											<h4 class="text-center m-t-xl">Nenhum video encontrada.</h4>
										@endif
										@if($author->id == Auth::id())
											<div class="text-center m-t-xl">
												<a href="{{ route('musics.new') }}" class=" m-t-lg">
													Cadastrar novo video
													<i class="icon-cloud-upload i-lg inline"></i>
												</a>
											</div>
										@endif
									</ul>
								</div>
								<div class="tab-pane" id="podcasts">
									<ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
										@foreach($podcasts as $podcast)
											<li class="list-group-item">
												<a href="{{ route('podcasts.details', $podcast->id) }}" class="thumb-sm pull-left m-r-sm">
													<img src="{{ URL::asset("storage/images/$podcast->id.$podcast->imageExt") }}" class="img-circle">
												</a>
												<a href="{{ route('podcasts.details', $podcast->id) }}" class="clear">
													<small class="pull-right">{{ $podcast->created_at }}</small>
													<strong class="block">{{ $podcast->authors." - ".$podcast->name }}</strong>
													<small>{{ $podcast->description }}</small>
												</a>
											</li>
										@endforeach
										@if(count($podcasts) == 0)
											<h4 class="text-center m-t-xl">Nenhum podcast encontrada.</h4>
										@endif
										@if($author->id == Auth::id())
											<div class="text-center m-t-xl">
												<a href="{{ route('musics.new') }}" class=" m-t-lg">
													Cadastrar novo podcast
													<i class="icon-cloud-upload i-lg inline"></i>
												</a>
											</div>
										@endif
									</ul>
								</div>
								<div class="tab-pane" id="books">
									<ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
										@foreach($books as $book)
											<li class="list-group-item">
												<a href="{{ route('books.details', $book->id) }}" class="thumb-sm pull-left m-r-sm">
													<img src="{{ URL::asset("storage/images/$book->id.$book->imageExt") }}" class="img-circle">
												</a>
												<a href="{{ route('books.details', $book->id) }}" class="clear">
													<small class="pull-right">{{ $book->created_at }}</small>
													<strong class="block">{{ $book->authors." - ".$book->name }}</strong>
													<small>{{ $book->description }}</small>
												</a>
											</li>
										@endforeach
										@if(count($books) == 0)
											<h4 class="text-center m-t-xl">Nenhum livro encontrada.</h4>
										@endif
										@if($author->id == Auth::id())
											<div class="text-center m-t-xl">
												<a href="{{ route('musics.new') }}" class=" m-t-lg">
													Cadastrar novo livro
													<i class="icon-cloud-upload i-lg inline"></i>
												</a>
											</div>
										@endif
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