@extends('layouts.interface')

@section('intContent')
	<section class="vbox">
		<section class="scrollable wrapper-lg">
			<div class="row">
				<div class="col-sm-8">
					<div class="panel">
						<div class="wrapper-lg">
							<!-- video player -->
							<div id="jp_container_1">
								<div class="jp-type-single pos-rlt">
									<div id="jplayer_1" class="jp-jplayer jp-video"></div>
									<div class="jp-gui">
										<div class="jp-video-play">
											<a class="fa fa-5x text-white fa-play-circle"></a>
										</div>
										<div class="jp-interface bg-info padder">
											<div class="jp-controls">
												<div>
													<a class="jp-play"><i class="icon-control-play i-2x"></i></a>
													<a class="jp-pause hid"><i class="icon-control-pause i-2x"></i></a>
												</div>
												<div class="jp-progress">
													<div class="jp-seek-bar dker">
														<div class="jp-play-bar dk">
														</div>
														<div class="jp-title text-lt">
															<ul>
																<li></li>
															</ul>
														</div>
													</div>
												</div>
												<div class="hidden-xs hidden-sm jp-current-time text-xs text-muted"></div>
												<div class="hidden-xs hidden-sm jp-duration text-xs text-muted"></div>
												<div class="hidden-xs hidden-sm">
													<a class="jp-mute" title="mute"><i class="icon-volume-2"></i></a>
													<a class="jp-unmute hid" title="unmute"><i class="icon-volume-off"></i></a>
												</div>
												<div class="hidden-xs hidden-sm jp-volume">
													<div class="jp-volume-bar dk">
														<div class="jp-volume-bar-value lter"></div>
													</div>
												</div>
												<div>
													<a class="jp-full-screen" title="full screen"><i class="fa fa-expand"></i></a>
													<a class="jp-restore-screen" title="restore screen"><i class="fa fa-compress text-lt"></i></a>
												</div>
											</div>
										</div>
									</div>
									<div class="jp-no-solution hide">
										<span>Update Required</span>
										To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
									</div>
								</div>
							</div>
							<!-- / video player -->
							<div class="wrapper-lg">
								<h1 class="pull-right text-black m-t-none" style="font-size: 40pt;">R$ {{ $video->price }}</h1>
								<h2 class="m-t-none m-b-none text-black">{{ $video->name }}</h2>
								<h3 class="m-t-none ">{{ $video->authors }}</h3>
								<div class="clearfix m-b-lg">
									<div class="clear">
										<a href="{{ route('users.profile', $owner->id) }}" class="text-info">{{ $owner->name }}</a>
										<small class="block text-muted">{{ $uploads }} uploads</small>
									</div>
								</div>
								<div class="m-b-lg">
									@if($canDownload)
										<a href="{{ route('medias.download', $video->id) }}" class="btn btn-default">Download</a>
									@else
										<a href="{{ route('medias.buy', $video->id) }}" class="btn btn-default">Buy</a>
									@endif
									@if($isOwner || $isAdmin)
										<a href="{{ route('medias.delete', $video->id) }}" class="btn btn-danger">Delete</a>
									@endif
								</div>
								<div class="m-b-lg">
									Tags: <a href="#" class="badge bg-light">{{ $category->name }}</a>
								</div>
								<div>
									Descrição: <p>{{ $video->description }}</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="panel panel-default">
						<div class="panel-heading">Mais Videos</div>
							<div class="panel-body">
								@foreach($videos as $videoList)
									<article class="media">
										<a href="{{ route('videos.details', $videoList->id) }}" class="pull-left thumb-lg m-t-xs">
											<img src="{{ URL::asset("storage/images/$video->id.$video->imageExt") }}">
										</a>
										<div class="media-body">                        
											<a href="{{ route('videos.details', $videoList->id) }}" class="font-semibold">{{ $videoList->name }}</a>
											<div class="text-xs block m-t-xs"><a href="#">{{ $videoList->authors }}</a>: {{ substr($videoList->description, 0, 120) }}...</div>
										</div>
									</article>
								@endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</section>
@endsection


@section("appFooter")
	<script>
		$("#jplayer_1").jPlayer({
			ready: function () {
				$(this).jPlayer("setMedia", {
					title: "{{ $video->name }}",
					@if($video->mediaExt == "webm")
						webmv: "{{ URL::asset("storage/medias/$video->id.$video->mediaExt") }}",
					@else
						{{ $video->mediaExt }}: "{{ URL::asset("storage/medias/$video->id.$video->mediaExt") }}",
					@endif
					poster: "{{ URL::asset("storage/images/$video->id.$video->imageExt") }}"
				});
			},
			swfPath: "js",
			supplied: "webmv, ogv, m4v, mp4, avi, wmv",
			size: {
				width: "100%",
				height: "auto",
				cssClass: "jp-video-360p"
			},
			globalVolume: true,
			smoothPlayBar: true,
			keyEnabled: true
		});
	</script>
@endsection