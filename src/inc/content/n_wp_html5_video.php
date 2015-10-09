<?php


function n_wp_html5_video($video_mp4, $video_ogv, $image, $title = null){

	?>
	<div class="player-video full-width">
		<!-- caption -->
		<div class="carousel-caption">
			<?php echo $title; ?>
		</div>
		<!-- video -->
		<video class="video-item" preload="none" poster="<?php echo $image; ?>">
			<source src="<?php echo $video_mp4; ?>" type="video/mp4">
			<source src="<?php echo $video_ogv; ?>" type="video/ogg">
		</video>
		<!-- UI -->
		<div class="buffering"><spinner></spinner></div>
		<div class="close-btn"><span class="glyphicon glyphicon-remove"></span></div>
		<div class="play-pause-btn"><span class="glyphicon glyphicon-play play"></span><span class="glyphicon glyphicon-pause pause"></span></div>
	
	</div>
	<?php

}



function n_wp_iframe_video($src, $image, $title = null){

	?>
	<div class="player-video-container">
		<div class="player-video">

			<div class="carousel-caption">
				<?php echo $title; ?>
			</div>

			<div class="video-container">
				
				<iframe class="video-element" src="//www.youtube.com/embed/MJYTEOkmKiI"></iframe>
				
			</div>
			<div class="buffering"><spinner></spinner></div>
			<div class="close-btn"><span class="glyphicon glyphicon-remove"></span></div>
			<div class="play-pause-btn"><span class="glyphicon glyphicon-play play"></span><span class="glyphicon glyphicon-pause pause"></span></div>
		</div>
	</div>
	<?php

}






?>