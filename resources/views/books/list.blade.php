@extends('layouts.interface')

@section('intContent')
	<section class="w-f-md" id="bjax-target">
		<section class="hbox stretch">
			<!-- side content -->
			<aside class="aside bg-light dk" id="sidebar">
				<section class="vbox animated fadeInUp">
					<section class="scrollable hover">
						<div class="list-group no-radius no-border no-bg m-t-n-xxs m-b-none auto">
							<a href="{{ route('books.list', 0) }}" class="list-group-item">
								Todas
							</a>
							@foreach($categories as $categ)
								@if($categ->id == $cotegorie)
								<a href="{{ route('books.list', $categ->id) }}" class="list-group-item active">
								@else
								<a href="{{ route('books.list', $categ->id) }}" class="list-group-item">
								@endif
									{{ $categ->name }}
								</a>
							@endforeach
						</div>
					</section>
				</section>
			</aside>
			<!-- / side content -->
			<section>
				<section class="vbox">
					<section class="scrollable padder-lg">
						<h2 class="font-thin m-b">{{ $categName }}</h2>
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
															<i class="fa fa-heart i-2x text-danger text" onclick="unsetFavorite({{ $book->id }})"></i>
															<i class="fa fa-heart-o i-2x text-active" onclick="setFavorite({{ $book->id }})"></i>
														</a>
													@else
														<a href="#" data-toggle="class">
															<i class="fa fa-heart-o i-2x text" onclick="setFavorite({{ $book->id }})"></i>
															<i class="fa fa-heart i-2x text-danger text-active" onclick="unsetFavorite({{ $book->id }})"></i>
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
					</section>                    
				</section>
			</section>
		</section>
	</section>
@endsection