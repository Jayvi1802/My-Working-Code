<?php /* Template Name: French Page */
get_header(); ?>

<div class="container">
	<div class="row">
		<div class="french_title">Cours</div>
		<?php
			$course_posts = new WP_Query(array('post_type'=>'lp_course', 'post_status'=>'publish', 'posts_per_page'=>-1));
				if ( $course_posts -> have_posts() ) { ?>
					<?php while ( $course_posts -> have_posts() ) : $course_posts -> the_post(); ?>
						<?php 
						 $course_language = get_field( 'course_language' );
						 if( $course_language ) { ?>
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
								              <div class="start_cource_button"><a href="<?php the_permalink(); ?>">Cliquez ici</a></div>
								        </div>
								    </div>
								</div>
							</div>
						<?php } ?>
				    <?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php } ?>


		<div class="french_title">Webinaires à venir</div>
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
											//'relation' => 'AND',
									        array(
									            'key' => 'ac_event_start_date',
									            'value' => $today,
									            'compare' => '>=',
									        )
									    ),
									)
								);
			$count = 0;
			if ( $webinar_posts->have_posts() )  { ?>
			<?php while ( $webinar_posts->have_posts() ) { 
						  $webinar_posts->the_post(); 
			?>
						
				<?php 
				    $webinar_language = get_field( 'webinar_language' );

				    if( is_array($webinar_language) && count($webinar_language) ) {
				    	if($webinar_language[0] != 'french')
				    		continue;
				    	$count++;
				?>
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
							              <div class="start_cource_button"><a href="<?php the_permalink(); ?>">Cliquez ici</a></div>
							        </div>
							    </div>
							</div>
						</div>
			    <?php } ?>

	    	<?php } ?>

		<?php } if($count == 0) { ?>
			<div class="no_post">Il n'y a pas eu de post à venir ici</div>
		<?php } ?>	

		    <div class="french_title">Webinaires précédents</div>
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
											//'relation' => 'AND',
									        array(
									            'key' => 'ac_event_start_date',
									            'value' => $today,
									            'compare' => '<=',
									        )
									    ),
									)
								);
			if ( $webinar_posts -> have_posts() ) { ?>
			<?php while ( $webinar_posts -> have_posts() ) { 
				          $webinar_posts -> the_post(); 
			?>
						
				<?php 
				 $webinar_language = get_field( 'webinar_language' );
				 if( $webinar_language ) { ?>
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
						              <div class="start_cource_button"><a href="<?php the_permalink(); ?>">Cliquez ici</a></div>
						        </div>
						    </div>
						</div>
					</div>
			
			    <?php } ?>
		    
		    <?php } ?>
			    
		    <?php } else { ?>
				<div class="no_post">Il n'y a pas eu de post précédent ici</div>
			<?php } ?>
	</div>
</div>
<?php get_footer(); ?>