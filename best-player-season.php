<?php 
	$args = array(
		'post_type' => 'sp_player' ,
		'orderby' => 'date' ,
		'order' => 'DESC' ,
		'posts_per_page' => 10,
		'meta_key' => 'best_player_of_season',
		'meta_value' => '1'
	); 
	$q = new WP_Query($args);
	$posts = ($q->posts);
?>
<h2 class="best_player">Best Players of the season</h2>
<div class="best_player_section">
	<div class="owl-carousel owl-theme">	
		<?php  
		if(is_array($posts) && count($posts)) {
			for($i=0 ; $i<count($posts) ; $i++) {
		?>
		<div class="item">
			<div class="player_section row">
				<div class="col-lg-5 player_image_sec">
					<div class="playerimage">
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $posts[$i]->ID ), 'single-post-thumbnail' ); ?>
						<img src="<?php echo $image[0]; ?>">
					</div>
				</div>
				<div class="col-lg-7 player_image_content">
					<div class="playertitle"><?php echo $posts[$i]->post_title; ?></div>
					<div class="playerdesc"><?php echo $posts[$i]->player_desciption; ?></div>
					<div class="playerrole">
						<span>role</span>
						<p><?php echo $posts[$i]->role; ?></p>
					</div>
					<div class="playerbattingstyle">
						<span>BATTING STYLE</span>
						<p><?php echo $posts[$i]->batting_style; ?></p>
					</div>
					<div class="playerbowlingstyle">
						<span>BOWLING STYLE</span>
						<p><?php echo $posts[$i]->bowling_style; ?></p>
					</div>
					<div class="playerdob">
						<span>DOB</span>
						<p><?php echo $posts[$i]->dob; ?></p>
					</div>
					<div class="playerwidth">
						<span>WEIGHT</span>
						<p><?php echo $posts[$i]->sp_metrics['weight']; ?></p>
					</div>
					<div class="player_profile_link">
						<a href="<?php echo $posts[$i]->detailed_profile_link; ?>" target="_blank">View Detailed Profile</a>
					</div>
				</div>
			</div>
		</div>
		<?php
			}
		}
		?>
	</div>
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
		jQuery('.best_player_section .owl-carousel').owlCarousel({
	    loop:true,
	    margin:20,
	    nav:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:1
	        },
	        1000:{
	            items:1
	        }
	    }
	})
	jQuery( ".owl-prev").html('<i class="fa fa-angle-left"></i>');
 	jQuery( ".owl-next").html('<i class="fa fa-angle-right"></i>');
});
</script>