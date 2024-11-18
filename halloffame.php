<?php 
     $args = array(
     'post_type' => 'post' ,
     'orderby' => 'date' ,
     'order' => 'DESC' ,
     'posts_per_page' => 10,
     'cat' => '66',
     'paged' => get_query_var('paged')
); 
     $q = new WP_Query($args);
     $posts = ($q->posts);
?>
<div class="hall_of_section">
   <h2>Hall Of Fame</h2>
    <div class="owl-carousel owl-theme">	
	<?php  
	if(is_array($posts) && count($posts)) {
	   for($i=0 ; $i<count($posts) ; $i++) {
	?>
	   <div class="item">
		<div class="hallof_section">
		   <div class="hallofimage">
		      <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $posts[$i]->ID ), 'single-post-thumbnail' ); ?>
			  <img src="<?php echo $image[0]; ?>">
		   </div>
		   <div class="halloftitle"><?php echo $posts[$i]->post_title; ?></div>
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
		jQuery('.hall_of_section .owl-carousel').owlCarousel({
	    loop:true,
	    margin:20,
	    nav:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:3
	        },
	        1000:{
	            items:4
	        }
	    }
	})
	jQuery( ".owl-prev").html('<i class="fa fa-angle-left"></i>');
 	jQuery( ".owl-next").html('<i class="fa fa-angle-right"></i>');
});
</script>