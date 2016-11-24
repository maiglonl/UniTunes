@extends('layouts.interface')

@section('intContent')
	<section class="vbox">
		<section class="scrollable padder-lg">
			<a href="{{ route('videos.new') }}" class="pull-right text-muted m-t-lg">
				Upload Novo Video
				<i class="icon-cloud-upload i-lg inline"></i>
			</a>
			<h2 class="font-thin m-b">Novidades</h2>
			<div class="row row-sm">
				@foreach($news as $video)
					<div class="col-xs-12 col-sm-4">
						<div class="item">
							<div class="pos-rlt">
								<div class="bottom">
									<span class="badge bg-info m-l-sm m-b-sm">{{ $video->duration }}</span>
								</div>
								<div class="item-overlay opacity r r-2x bg-black">
									<div class="center text-center m-t-n">
										<a href="{{ route('videos.details', $video->id) }}"><i class="fa fa-play-circle i-2x"></i></a>
									</div>
									<div class="bottom padder m-b-sm">
										@if($video->idFavorite != null)
											<a href="#" data-toggle="class" class="pull-right">
												<i class="fa fa-heart text-danger text" onclick="unsetFavorite({{ $video->id }})"></i>
												<i class="fa fa-heart-o text-active" onclick="setFavorite({{ $video->id }})"></i>
											</a>
										@else
											<a href="#" data-toggle="class" class="pull-right">
												<i class="fa fa-heart-o text" onclick="setFavorite({{ $video->id }})"></i>
												<i class="fa fa-heart text-danger text-active" onclick="unsetFavorite({{ $video->id }})"></i>
											</a>
										@endif
									</div>
								</div>
								<a href="{{ route('videos.details', $video->id) }}">
									<img style="height: 220px;" src="{{ URL::asset("storage/images/$video->id.$video->imageExt") }}" alt="" class="r r-2x img-full">
								</a>
							</div>
							<div class="padder-v">
								<a href="{{ route('videos.details', $video->id) }}" class="text-ellipsis">{{ $video->name }}</a>
								<a href="{{ route('videos.details', $video->id) }}" class="text-ellipsis text-xs text-muted">{{ $video->authors }}</a>
							</div>
						</div>
					</div>
				@endforeach
			</div>
			<h3 class="font-thin m-b">Videos Recentes</h3>
			<div class="row row-sm">
				@foreach($news as $video)
					<div class="col-xs-6 col-sm-4 col-md-3">
						<div class="item">
							<div class="pos-rlt">
								<div class="bottom">
									<span class="badge bg-info m-l-sm m-b-sm">{{ $video->duration }}</span>
								</div>
								<div class="item-overlay opacity r r-2x bg-black">
									<div class="center text-center m-t-n">
										<a href="{{ route('videos.details', $video->id) }}"><i class="fa fa-play-circle i-2x"></i></a>
									</div>
									<div class="bottom padder m-b-sm">
										@if($video->idFavorite != null)
											<a href="#" data-toggle="class" class="pull-right">
												<i class="fa fa-heart text-danger text" onclick="unsetFavorite({{ $video->idFavorite }})"></i>
												<i class="fa fa-heart-o text-active" onclick="setFavorite({{ $video->id }})"></i>
											</a>
										@else
											<a href="#" data-toggle="class" class="pull-right">
												<i class="fa fa-heart-o text" onclick="setFavorite({{ $video->id }})"></i>
												<i class="fa fa-heart text-danger text-active" onclick="unsetFavorite({{ $video->idFavorite }})"></i>
											</a>
										@endif
									</div>
								</div>
								<a href="{{ route('videos.details', $video->id) }}">
									<img style="height: 150px;" src="{{ URL::asset("storage/images/$video->id.$video->imageExt") }}" alt="" class="r r-2x img-full">
								</a>
							</div>
							<div class="padder-v">
								<a href="{{ route('videos.details', $video->id) }}" class="text-ellipsis">{{ $video->name }}</a>
								<a href="{{ route('videos.details', $video->id) }}" class="text-ellipsis text-xs text-muted">{{ $video->authors }}</a>
							</div>
						</div>
					</div>
				@endforeach
			</div>
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
