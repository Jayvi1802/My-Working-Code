<?php /* Template Name: Course Iframe */
get_header(); 
$id = $_GET['id'];
?>
<div class="course_title">
   <div class="container">
	 <div class="row">
		 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h2><?php echo get_the_title($id);?></h2>
		 </div>
	</div>
  </div>
</div>
<div class="container">
	<div class="row">
	  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    <?php 
			echo get_post_meta($id, 'iframe_code', true);
		?>
	  </div>
	</div>
  </div>
<?php get_footer(); ?>