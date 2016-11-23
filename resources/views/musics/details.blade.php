@extends('layouts.interface')

@section('intContent')
	<section class="vbox">
		<section class="scrollable wrapper-lg">
			<div class="row">
				<div class="col-sm-12">
					<div class="panel wrapper-lg">
						<div class="row">
							<div class="col-sm-4">
								<img src="{{ URL::asset("storage/images/$music->id.$music->imageExt") }}" class="img-full m-b">
							</div>
							<div class="col-sm-8">
								<h1 class="pull-right text-black m-t-none" style="font-size: 40pt;">R$ {{ $music->price }}</h1>
								<h2 class="m-t-none m-b-none text-black">{{ $music->name }}</h2>
								<h3 class="m-t-none ">{{ $music->authors }}</h3>
								<div class="clearfix m-b-lg">
									<div class="clear">
										<a href="{{ route('users.profile', $owner->id) }}" class="text-info">{{ $owner->name }}</a>
										<small class="block text-muted">{{ $uploads }} uploads</small>
									</div>
								</div>
								<div class="m-b-lg">
									<a href="#" class="btn btn-info">Play</a>
									@if($canDownload)
										<a href="{{ route('medias.download', $music->id) }}" class="btn btn-default">Download</a>
									@else
										<a href="{{ route('medias.buy', $music->id) }}" class="btn btn-default">Buy</a>
									@endif
									@if($isOwner || $isAdmin)
										<a href="{{ route('medias.delete', $music->id) }}" class="btn btn-danger">Delete</a>
									@endif
								</div>
								<div class="m-b-lg">
									Tags: <a href="#" class="badge bg-light">{{ $category->name }}</a>
								</div>
								<div>
									Descrição: <p>{{ $music->description }}</p>
								</div>
							</div>
						</div>
						<h4 class="m-t-lg m-b">Mais Músicas ({{ count($musics) }})</h4>
						<ul class="list-group list-group-lg">
							@foreach($musics as $musicList)
								<li class="list-group-item">
									<div class="pull-right m-l">
										<a href="#" class="m-r-sm"><i class="icon-cloud-download"></i></a>
										<a href="{{ route('musics.details', $musicList->id) }}"><i class="icon-plus"></i></a>
									</div>
									<a href="#" class="jp-play-me m-r-sm pull-left">
										<i class="icon-control-play text"></i>
										<i class="icon-control-pause text-active"></i>
									</a>
									<div class="clear text-ellipsis">
										<span>{{ $musicList->authors }} - {{ $musicList->name }}</span>
										<span class="text-muted"> -- {{ $musicList->duration }}</span>
									</div>
								</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</section>

		<!-- Player -->
		@include('musics.player')
		<!-- /Player -->
	</section>
@endsection