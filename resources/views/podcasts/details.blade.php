@extends('layouts.interface')

@section('intContent')
	<section class="vbox">
		<section class="scrollable wrapper-lg">
			<div class="row">
				<div class="col-sm-12">
					<div class="panel wrapper-lg">
						<div class="row">
							<div class="col-sm-4">
								<img src="{{ URL::asset("storage/images/$podcast->id.$podcast->imageExt") }}" class="img-full m-b">
							</div>
							<div class="col-sm-8">
								<h1 class="pull-right text-black m-t-none" style="font-size: 40pt;">R$ {{ $podcast->price }}</h1>
								<h2 class="m-t-none m-b-none text-black">{{ $podcast->name }}
								@if($favorite != null)
									<a href="#" data-toggle="class">
										<i class="fa fa-star text-warning text" onclick="unsetFavorite({{ $podcast->id }})"></i>
										<i class="fa fa-star-o text-active" onclick="setFavorite({{ $podcast->id }})"></i>
									</a>
								@else
									<a href="#" data-toggle="class">
										<i class="fa fa-star-o text" onclick="setFavorite({{ $podcast->id }})"></i>
										<i class="fa fa-star text-warning text-active" onclick="unsetFavorite({{ $podcast->id }})"></i>
									</a>
								@endif
								</h2>
								<h3 class="m-t-none ">{{ $podcast->authors }}</h3>
								<div class="clearfix m-b-lg">
									<div class="clear">
										<a href="{{ route('users.profile', $owner->id) }}" class="text-info">{{ $owner->name }}</a>
										<small class="block text-muted">{{ $uploads }} uploads</small>
									</div>
								</div>
								<div class="m-b-lg">
									<a href="{{ URL::asset("storage/medias/$podcast->id.$podcast->mediaExt") }}" data-toggle="class" class="jp-play-me btn btn-info" title="{{ $podcast->authors .' - '.$podcast->name }}">
										<span class="text">Play</span>
										<span class="text-active">Pause</span>
									</a>
									@if($canDownload)
										<a href="{{ route('medias.download', $podcast->id) }}" class="btn btn-default">Download</a>
									@else
										<a href="{{ route('medias.buy', $podcast->id) }}" class="btn btn-default">Buy</a>
									@endif
									@if($isOwner || $isAdmin)
										<a href="{{ route('medias.delete', $podcast->id) }}" class="btn btn-danger">Delete</a>
									@endif
								</div>
								<div class="m-b-lg">
									Tags: <a href="#" class="badge bg-light">{{ $category->name }}</a>
								</div>
								<div>
									Descrição: <p>{{ $podcast->description }}</p>
								</div>
							</div>
						</div>
						<h4 class="m-t-lg m-b">Mais Músicas ({{ count($podcasts) }})</h4>
						<ul class="list-group list-group-lg">
							@foreach($podcasts as $podcastList)
								<li class="list-group-item">
									<div class="pull-right m-l">
										<a href="#" class="m-r-sm"><i class="icon-cloud-download"></i></a>
										<a href="{{ route('podcasts.details', $podcastList->id) }}"><i class="icon-plus"></i></a>
									</div>
									<a href="{{ URL::asset("storage/medias/$podcastList->id.$podcastList->mediaExt") }}" data-toggle="class" class="jp-play-me m-r-sm pull-left" title="{{ $podcastList->authors .' - '.$podcastList->name }}">
										<i class="icon-control-play text"></i>
										<i class="icon-control-pause text-active"></i>
									</a>
									<div class="clear text-ellipsis">
										<span>{{ $podcastList->authors }} - {{ $podcastList->name }}</span>
										<span class="text-muted"> -- {{ $podcastList->duration }}</span>
									</div>
								</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</section>

		<!-- Player -->
		@include('podcasts.player')
		<!-- /Player -->
	</section>
@endsection

@section("appFooter")
	<script>
	$(document).ready(function(){
			var	my_jPlayer = $("#jplayer_N");
			var my_trackName = $("#jp_container_N .jp-title");
			var	opt_play_first = true; // If true, will attempt to auto-play the default track on page loads. No effect on mobile devices, like iOS.
			var opt_auto_play = true; // If true, when a track is selected, it will auto-play.

			// A flag to capture the first track
			var first_track = true;

			// Instance jPlayer
			var player = my_jPlayer.jPlayer({
				ready: function () {
					$("#jp_container_N .track-default").click();
				},
				timeupdate: function(event) {
				},
				play: function(event) {
				},
				pause: function(event) {
				},
				ended: function(event) {
				},
				cssSelectorAncestor: "#jp_container_N",
				swfPath: "js/jPlayer",
				supplied: "webmv, ogv, m4v, oga, mp3",
				smoothPlayBar: false,
				audioFullScreen: false
			});

			// Create click handlers for the different tracks
			$(".jp-play-me").click(function(e) {
				e && e.preventDefault();

				var $this = $(e.target);
				if (!$this.is('a')) $this = $this.closest('a');

				// Toogle other icons
				$('.jp-play-me').not($this).removeClass('active');
				$('.jp-play-me').parent('li').not($this.parent('li')).removeClass('active');
				$('.jp-play-me').not($this).removeClass('playing');
				$('.jp-play-me').parent('li').not($this.parent('li')).removeClass('playing');

				$this.toggleClass('active');
				$this.parent('li').toggleClass('active');
				if( !$this.hasClass('active') ){
					my_jPlayer.jPlayer("pause");
				}else{
					if( !$this.hasClass('playing') ){
						my_trackName.text($(this).attr('title'));
						my_jPlayer.jPlayer("setMedia", {
							mp3: $(this).attr("href")
						});
						$this.toggleClass('playing');
					}

					if((opt_play_first && first_track) || (opt_auto_play && !first_track)) {
						my_jPlayer.jPlayer("play");
					}
					first_track = false;
					$(this).blur();
					return false;
				}
			});

			$(document).on($.jPlayer.event.pause,  function(){
				$('.musicbar').removeClass('animate');
				$('.jp-play-me').removeClass('active');
				$('.jp-play-me').parent('li').removeClass('active');
			});

			$(document).on($.jPlayer.event.play, function(){
				$('.musicbar').addClass('animate');
			});
		});

		function unsetFavorite($id){
			$.get("/medias/favorites/unset/"+$id);
		}

		function setFavorite($id){
			$.get("/medias/favorites/set/"+$id);
		}
	</script>
@endsection