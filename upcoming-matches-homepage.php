<?php 
	$args = array(
		'post_type' => 'sp_event',
    	'order' => 'ASC',
    	'post_status' => 'future',
	  	'posts_per_page' => 100
	); 
	$q = new WP_Query($args);
	$posts = ($q->posts);
?>
	<div class="upcoming_matches">
		<div class="owl-carousel owl-theme">	
		<?php  
			if(is_array($posts) && count($posts)) {
				for($i=0 ; $i<count($posts) ; $i++) 
				{
					$post_id = $posts[$i]->ID;
					$teams = get_post_meta($post_id, 'sp_team', false);
					
					if (count($teams) > 1)
					{
						$team_1_id = $teams[0];
			            $team_2_id = $teams[1];

			            $team_1_url = get_permalink($team_1_id);
			            $team_2_url = get_permalink($team_2_id);
			            $team_1_img_url = splash_get_thumbnail_url($team_1_id, '', 'thumbnail');
			            $team_2_img_url = splash_get_thumbnail_url($team_2_id, '', 'thumbnail');
						
						/*Get League name*/
			            $league = wp_get_post_terms($post_id, 'sp_league');
			            $league_name = '';
			            if (!empty($league) and !is_wp_error($league)) 
			            {
							$league_name = $league[0]->name;
			            }
						
			            /*Get venue name*/
			            $venue = wp_get_post_terms($post_id, 'sp_venue');
			            $venue_name = '';
			            if (!empty($venue) and !is_wp_error($venue)) 
			            {
							$venue_name = $venue[0]->name;
			            }

						/*Get teams meta*/
						$team_1_title = get_the_title($team_1_id);
						$team_2_title = get_the_title($team_2_id);

						$team_1_url = get_permalink($team_1_id);
						$team_2_url = get_permalink($team_2_id);

						$date = new DateTime(get_the_time('Y/m/d H:i:s'));
						$time = new DateTime(get_the_time('H:i'));
						if ($date) {
							$date_show = get_post_time(get_option('date_format'), false, $post_id, true);
							$time_show = get_post_time(get_option('time_format'), false, $post_id, true);
						}
					}		
				?>
			<div class="item">
				<div class="leaguename"><?php echo $league_name; ?></div>
				<div class="venuename"><?php echo date('d M Y',strtotime($posts[$i]->post_date)) . " - " . $venue_name; ?></div>
				<div class="opponents">
					<div class="team_1 ">
						<img src="<?php echo $team_1_img_url ?>" alt="<?php echo $team_1_title ?>">
						<span><?php echo $team_1_title ?></span>
					</div>
					<b>VS</b>
					<div class="team_2">
						<img src="<?php echo $team_2_img_url ?>" alt="<?php echo $team_2_title ?>">
						<span><?php echo $team_2_title ?></span>
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
		jQuery('.upcoming_matches .owl-carousel').owlCarousel({
	    loop: false,
	    margin: 0,
	    nav: true,
	    responsive:{
	        0:{
	            items: 1
	        },
	        600:{
	            items: 2
	        },
	        1000:{
	            items: 3
	        }
	    }
	});
});
</script>