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
								<h2 class="m-t-none m-b-none text-black">{{ $book->name }}
								@if($favorite != null)
									<a href="#" data-toggle="class">
										<i class="fa fa-star text-warning text" onclick="unsetFavorite({{ $book->id }})"></i>
										<i class="fa fa-star-o text-active" onclick="setFavorite({{ $book->id }})"></i>
									</a>
								@else
									<a href="#" data-toggle="class">
										<i class="fa fa-star-o text" onclick="setFavorite({{ $book->id }})"></i>
										<i class="fa fa-star text-warning text-active" onclick="unsetFavorite({{ $book->id }})"></i>
									</a>
								@endif
								</h2>
								<h3 class="m-t-none ">{{ $book->authors }}</h3>
								<div class="clearfix m-b-lg">
									<div class="clear">
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
									<div class="clear text-ellipsis">
										<span>{{ $bookList->authors }} - {{ $bookList->name }}</span><br>
										<span class="text-muted">{{ $bookList->description }}</span>
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

@section("appFooter")
	<script>
		function unsetFavorite($id){
			$.get("/medias/favorites/unset/"+$id);
		}

		function setFavorite($id){
			$.get("/medias/favorites/set/"+$id);
		}
	</script>
@endsection