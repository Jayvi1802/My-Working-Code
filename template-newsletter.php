<?php
    /* Template Name: Newsletter */
    get_header();
    the_post();
?>
<div class="container newsletter_main">
	<div class="row">
		
		<div class="filter_post_by_year">
			<select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
			  <option value=""><?php echo esc_attr( __( 'Select Year' ) ); ?></option> 
			  <?php wp_get_archives( array( 'type' => 'yearly', 'format' => 'option') ); ?>
			</select>
		</div>
		
		<?php 

			$args = array(
			    'post_type' => 'post',
			    'post_status' => 'publish',
			    'category_name' => 'newsletter',
			    'posts_per_page' => 100,
			    'order' => 'ASC'
			);

			$arr_posts = new WP_Query( $args );

						if ( $arr_posts->have_posts() ) :
						  
						    while ( $arr_posts->have_posts() ) :
						        $arr_posts->the_post();

			?>
								
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="newsletter_grid">
											<a href="<?php the_permalink(); ?>">
												<div class="newsimage"><?php the_post_thumbnail(); ?></div>
												<h1><?php the_title(); ?></h1>
												<p><?php echo substr(strip_tags($post->post_content), 0, 100) ."...";?></p>
											</a>
										</div>
									</div>

			<?php
						    endwhile;
						endif;
			?>

	</div>
</div>
<?php get_footer(); ?>
