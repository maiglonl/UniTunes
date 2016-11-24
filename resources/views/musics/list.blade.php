@extends('layouts.interface')

@section('intContent')
	<section class="vbox">
		<section class="scrollable w-f-md" id="bjax-target">
			<section class="hbox stretch">
				<!-- side content -->
				<aside class="aside bg-light dk" id="sidebar">
					<section class="vbox animated fadeInUp">
						<section class="scrollable hover">
							<div class="list-group no-radius no-border no-bg m-t-n-xxs m-b-none auto">
								<a href="{{ route('musics.list', 0) }}" class="list-group-item">
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
								@foreach($musics as $music)
									<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
										<div class="item">
											<div class="pos-rlt">
												<div class="bottom">
													<span class="badge bg-info m-l-sm m-b-sm">{{ $music->duration }}</span>
												</div>
												<div class="item-overlay opacity r r-2x bg-black">
													<div class="center text-center m-t-n">
														<a href="{{ URL::asset("storage/medias/$music->id.$music->mediaExt") }}" data-toggle="class" class="jp-play-me" title="{{ $music->authors .' - '.$music->name }}">
															<i class="icon-control-play i-2x text"></i>
															<i class="icon-control-pause i-2x text-active"></i>
														</a>
													</div>
													<div class="bottom padder m-b-sm">
														@if($music->idFavorite != null)
															<a href="#" data-toggle="class" class="pull-right">
																<i class="fa fa-heart text-danger text" onclick="unsetFavorite({{ $music->idFavorite }})"></i>
																<i class="fa fa-heart-o text-active" onclick="setFavorite({{ $music->id }})"></i>
															</a>
														@else
															<a href="#" data-toggle="class" class="pull-right">
																<i class="fa fa-heart-o text" onclick="setFavorite({{ $music->id }})"></i>
																<i class="fa fa-heart text-danger text-active" onclick="unsetFavorite({{ $music->idFavorite }})"></i>
															</a>
														@endif
														<a href="#"><i class="fa fa-plus-circle"></i></a>
													</div>
												</div>
												<div class="top">
													<span class="pull-right m-t-sm m-r-sm badge bg-white">{{ $music->downloads }}</span>
												</div>
												<a href="#"><img style="height: 170px;" src="{{ URL::asset("storage/images/$music->id.$music->imageExt") }}" alt="{{ $music->name }}" class="r r-2x img-full"></a>
											</div>
											<div class="padder-v">
												<a href="{{ route('musics.details', $music->id) }}" class="text-ellipsis">{{ $music->name }}</a>
												<span class="text-ellipsis text-xs text-muted">{{ $music->authors }}</span>
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
		<!-- Player -->
		@include('musics.player')
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