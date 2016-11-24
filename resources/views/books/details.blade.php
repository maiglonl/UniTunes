@extends('layouts.interface')

@section('intContent')
	<section class="vbox">
		<section class="scrollable wrapper-lg">
			<div class="row">
				<div class="col-sm-12">
					<div class="panel wrapper-lg">
						<div class="row">
							<div class="col-sm-4">
								<img src="{{ URL::asset("storage/images/$book->id.$book->imageExt") }}" class="img-full m-b">
							</div>
							<div class="col-sm-8">
								<h1 class="pull-right text-black m-t-none" style="font-size: 40pt;">R$ {{ $book->price }}</h1>
								<h2 class="m-t-none m-b-none text-black">{{ $book->name }}</h2>
								<h3 class="m-t-none ">{{ $book->authors }}</h3>
								<div class="clearfix m-b-lg">
									<div class="clear">
									@if($favorite != null)
										@if($favorite->id != null)
											<a href="#" data-toggle="class">
												<i class="i-2x fa fa-heart text-danger text" onclick="unsetFavorite({{ $favorite->id }})"></i>
												<i class="i-2x fa fa-heart-o text-active" onclick="setFavorite({{ $favorite->id }})"></i>
											</a>
										@else
											<a href="#" data-toggle="class">
												<i class="i-2x fa fa-heart-o text" onclick="setFavorite({{ $favorite->id }})"></i>
												<i class="i-2x fa fa-heart text-danger text-active" onclick="unsetFavorite({{ $favorite->id }})"></i>
											</a>
										@endif
									@endif
										<a href="{{ route('users.profile', $owner->id) }}" class="text-info">{{ $owner->name }}</a>
										<small class="block text-muted">{{ $uploads }} uploads</small>
									</div>
								</div>
								<div class="m-b-lg">
									@if($canDownload)
										<a href="{{ route('medias.download', $book->id) }}" class="btn btn-default">Download</a>
									@else
										<a href="{{ route('medias.buy', $book->id) }}" class="btn btn-default">Buy</a>
									@endif
									@if($isOwner || $isAdmin)
										<a href="{{ route('medias.delete', $book->id) }}" class="btn btn-danger">Delete</a>
									@endif
								</div>
								<div class="m-b-lg">
									Tags: <a href="#" class="badge bg-light">{{ $category->name }}</a>
								</div>
								<div>
									Descrição: <p>{{ $book->description }}</p>
								</div>
							</div>
						</div>
						<h4 class="m-t-lg m-b">Mais Livros ({{ count($books) }})</h4>
						<ul class="list-group list-group-lg">
							@foreach($books as $bookList)
								<li class="list-group-item">
									<div class="pull-right m-l">
										<a href="#" class="m-r-sm"><i class="icon-cloud-download"></i></a>
										<a href="{{ route('books.details', $bookList->id) }}"><i class="icon-plus"></i></a>
									</div>
									<a href="#" class="jp-play-me m-r-sm pull-left">
										<i class="icon-control-play text"></i>
										<i class="icon-control-pause text-active"></i>
									</a>
									<div class="clear text-ellipsis">
										<span>{{ $bookList->authors }} - {{ $bookList->name }}</span>
										<span class="text-muted"> -- {{ $bookList->duration }}</span>
									</div>
								</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</section>
	</section>
@endsection