@extends('layouts.interface')

@section('intContent')
	<section class="vbox">
		<section class="scrollable padder-lg" id="bjax-target">
			<!-- Novidades -->
			<div class="row">
				<div class="col-xs-12">
					<a href="{{ route('books.new') }}" class="pull-right text-muted m-t-lg">
						Upload Novo Livro
						<i class="icon-cloud-upload i-lg inline"></i>
					</a>
					<h2 class="font-thin m-b">Novidades 
						<span class="bookbar inline m-l-sm" style="width:20px;height:20px">
							<span class="bar1 a1 bg-primary lter"></span>
							<span class="bar2 a2 bg-info lt"></span>
							<span class="bar3 a3 bg-success"></span>
							<span class="bar4 a4 bg-warning dk"></span>
							<span class="bar5 a5 bg-danger dker"></span>
						</span>
					</h2>

					<div class="row row-sm">
						@foreach($books as $book)
							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
								<div class="item">
									<div class="pos-rlt">
										<div class="bottom">
											<span class="badge bg-info m-l-sm m-b-sm">{{ $book->pages }}</span>
										</div>
										<div class="item-overlay opacity r r-2x bg-black">
											<div class="center text-center m-t-n">
												@if($book->idFavorite != null)
													<a href="#" data-toggle="class">
														<i class="fa fa-heart i-2x text-danger text" onclick="unsetFavorite({{ $book->idFavorite }})"></i>
														<i class="fa fa-heart-o i-2x text-active" onclick="setFavorite({{ $book->id }})"></i>
													</a>
												@else
													<a href="#" data-toggle="class">
														<i class="fa fa-heart-o i-2x text" onclick="setFavorite({{ $book->id }})"></i>
														<i class="fa fa-heart i-2x text-danger text-active" onclick="unsetFavorite({{ $book->idFavorite }})"></i>
													</a>
												@endif
											</div>
										</div>
										<div class="top">
											<span class="pull-right m-t-sm m-r-sm badge bg-white">{{ $book->downloads }}</span>
										</div>
										<a href="#"><img src="{{ URL::asset("storage/images/$book->id.$book->imageExt") }}" alt="{{ $book->name }}" class="r r-2x img-full"></a>
									</div>
									<div class="padder-v">
										<a href="{{ route('books.details', $book->id) }}" class="text-ellipsis">{{ $book->name }}</a>
										<span class="text-ellipsis text-xs text-muted">{{ $book->authors }}</span>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
			<!-- /Novidades -->

			<!-- Favoritos/Top -->
			<div class="row">
				<!-- Favoritos -->
				<div class="col-md-7">
					<h3 class="font-thin">Favoritos</h3>
					<div class="row row-sm">
						@foreach($favorites as $favorite)
							<div class="col-xs-6 col-sm-3">
								<div class="item">
									<div class="pos-rlt">
										<div class="bottom">
											<span class="badge bg-info m-l-sm m-b-sm">{{ $favorite->pages }}</span>
										</div>
										<div class="item-overlay opacity r r-2x bg-black">
											<div class="center text-center m-t-n">
												@if($favorite->idFavorite != null)
													<a href="#" data-toggle="class">
														<i class="i-2x fa fa-heart text-danger text" onclick="unsetFavorite({{ $favorite->idFavorite }})"></i>
														<i class="i-2x fa fa-heart-o text-active" onclick="setFavorite({{ $favorite->id }})"></i>
													</a>
												@else
													<a href="#" data-toggle="class">
														<i class="i-2x fa fa-heart-o text" onclick="setFavorite({{ $favorite->id }})"></i>
														<i class="i-2x fa fa-heart text-danger text-active" onclick="unsetFavorite({{ $favorite->idFavorite }})"></i>
													</a>
												@endif
											</div>
										</div>
										<div class="top">
											<span class="pull-right m-t-sm m-r-sm badge bg-white">{{ $favorite->downloads }}</span>
										</div>
										<a href="#"><img src="{{ URL::asset("storage/images/$favorite->id.$favorite->imageExt") }}" alt="{{ $favorite->name }}" class="r r-2x img-full"></a>
									</div>
									<div class="padder-v">
										<a href="{{ route('books.details', $favorite->id) }}" class="text-ellipsis">{{ $favorite->name }}</a>
										<span class="text-ellipsis text-xs text-muted">{{ $favorite->authors }}</span>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
				<!-- /Favoritos -->

				<!-- Top -->
				<div class="col-md-5">
					<h3 class="font-thin">Top 10</h3>
					<div class="list-group bg-white list-group-lg no-bg auto">
						@foreach($books as $key => $book)
							<a href="{{ route('books.details', $book->id) }}" class="list-group-item clearfix">
								<span class="pull-right h2 text-muted m-l">{{ $key+1 }}</span>
								<span class="pull-left thumb-sm  m-r">
									<img src="{{ URL::asset("storage/images/$book->id.$book->imageExt") }}" alt="...">
								</span>
								<span class="clear">
									<span>{{ $book->name }}</span>
									<small class="text-muted clear text-ellipsis">{{ $book->authors }}</small>
								</span>
							</a>
						@endforeach
					</div>
				</div>
				<!-- /Top -->
			</div>
			<!-- /Favoritos/Top -->
		</section>
	</section>
@endsection

@section("appFooter")
	<script>
		function unsetFavorite($id){
			$.get("medias/favorites/unset/"+$id);
		}

		function setFavorite($id){
			$.get("medias/favorites/set/"+$id);
		}
	</script>
@endsection
