<?php 
  $args = array( 
	'post_type' => 'sp_team', 
	'posts_per_page' => 100 
);
   
   $the_query = new WP_Query( $args ); ?>

	<div class="stm-image-carousel members_carousel">
		<div class="owl-carousel owl-theme">
            <?php
				if ( $the_query->have_posts() )
				{
					while ( $the_query->have_posts() )
					{
						$the_query->the_post();
						$image = get_the_post_thumbnail_url( get_the_ID(), 'small' );
			?>
				<div class="item"><img src="<?php echo $image ?>" alt="<?php the_title(); ?>" /></div>
			<?php
				}
			 }
			?>
	 	</div>
  	</div>

<script type="text/javascript">
jQuery(document).ready(function() {
		jQuery('.members_carousel .owl-carousel').owlCarousel({
	    loop:true,
	    margin:20,
	    nav:true,
	    responsive:{
	        0:{
	            items:4
	        },
	        600:{
	            items:5
	        },
	        1000:{
	            items:10
	        }
	    }
	})
	jQuery( ".owl-prev").html('<i class="fa fa-angle-left"></i>');
 	jQuery( ".owl-next").html('<i class="fa fa-angle-right"></i>');
});
</script>