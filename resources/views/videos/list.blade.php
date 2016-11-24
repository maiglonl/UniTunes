@extends('layouts.interface')

@section('intContent')
	<section class="w-f-md" id="bjax-target">
		<section class="hbox stretch">
			<!-- side content -->
			<aside class="aside bg-light dk" id="sidebar">
				<section class="vbox animated fadeInUp">
					<section class="scrollable hover">
						<div class="list-group no-radius no-border no-bg m-t-n-xxs m-b-none auto">
							<a href="genres.html" class="list-group-item">
								Todas
							</a>
							@foreach($categories as $categ)
								@if($categ->id == $cotegorie)
								<a href="{{ route('musics.list', $categ->id) }}" class="list-group-item active">
								@else
								<a href="{{ route('musics.list', $categ->id) }}" class="list-group-item">
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
							<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
								<div class="item">
									<div class="pos-rlt">
										<div class="item-overlay opacity r r-2x bg-black">
											<div class="center text-center m-t-n">
												<a href="#"><i class="fa fa-play-circle i-2x"></i></a>
											</div>
										</div>
										<a href="track-detail.html"><img src="images/m1.jpg" alt="" class="r r-2x img-full"></a>
									</div>
									<div class="padder-v">
										<a href="track-detail.html" data-bjax data-target="#bjax-target" data-el="#bjax-el" data-replace="true" class="text-ellipsis">Tempered Song</a>
										<a href="track-detail.html" data-bjax data-target="#bjax-target" data-el="#bjax-el" data-replace="true" class="text-ellipsis text-xs text-muted">Miaow</a>
									</div>
								</div>
							</div>
						</div>
					</section>                    
				</section>
			</section>
		</section>
	</section>
@endsection