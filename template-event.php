<?php /* Template Name: Webinar */
get_header(); ?>

<div class="container">
	<div class="row">
		<div class="french_title">Upcoming Webinar</div>

		<?php
			$today = date('F d, Y');

			$webinar_posts = new WP_Query(
									array('post_type'=>'ac_event', 
										'post_status'=>'publish', 
										'posts_per_page'=> -1, 
										'orderby'=>'date', 
										'order'=>'DESC',
										'meta_key'=> 'ac_event_start_date',
										'meta_query' => array(
									        array(
									            'key' => 'ac_event_start_date',
									            'value' => $today,
									            'compare' => '>=',
									        )
									    ),
									)
								);
			
				if ( $webinar_posts -> have_posts() ) { ?>
					<?php while ( $webinar_posts -> have_posts() ) : $webinar_posts -> the_post(); ?>
						<?php 
						 $event_date = get_post_meta(get_the_id(), 'ac_event_start_date', true);
						 $webinar_language = get_field( 'webinar_language' ); ?>
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
								<div class="rt-course-box-3">
									<div class="rtin-thumbnail hvr-bounce-to-right">
										<?php the_post_thumbnail( 'single-post-thumbnail' ); ?>
				        				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="fas fa-link" aria-hidden="true"></i></a>
				        			</div>
									<div class="rtin-content-wrap category_data">
								        <div class="rtin-content">
								            <h3 class="rtin-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
											  <div class="rtin-description"><?php echo the_excerpt(); ?></div>
								              <div class="start_cource_button"><a href="<?php the_permalink(); ?>">View More</a></div>
								        </div>
								    </div>
								</div>
							</div>
				    <?php endwhile; ?>
				 <?php wp_reset_postdata(); ?>
		    <?php } ?>

		    <div class="french_title">Previous Webinar</div>
		    
		<?php
			$today = date('F d, Y');

			$webinar_posts = new WP_Query(
									array('post_type'=>'ac_event', 
										'post_status'=>'publish', 
										'posts_per_page'=> -1, 
										'orderby'=>'date', 
										'order'=>'DESC',
										'meta_key'=> 'ac_event_start_date',
										'meta_query' => array(
									        array(
									            'key' => 'ac_event_start_date',
									            'value' => $today,
									            'compare' => '<=',
									        )
									    ),
									)
								);
			
				if ( $webinar_posts -> have_posts() ) { ?>
					<?php while ( $webinar_posts -> have_posts() ) : $webinar_posts -> the_post(); ?>
						<?php 
						 $event_date = get_post_meta(get_the_id(), 'ac_event_start_date', true);
						 $webinar_language = get_field( 'webinar_language' ); ?>
							<?php if( get_field('yotube_iframe') ) { ?>
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
									<div class="rt-course-box-3">
										<div class="event_youtube_iframe">
											<?php the_field('yotube_iframe');?>
										</div>	
									</div>
								</div>
							<?php } ?>
				    <?php endwhile; ?>
				 <?php wp_reset_postdata(); ?>
		    <?php } ?>
	</div>
</div>
<?php get_footer(); ?>