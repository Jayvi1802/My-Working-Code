<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

		</div><!-- .site-content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
          <div class="container">
            <div class="row">
              <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
			  	<ul class="social-icon">
					<?php if(get_option('facebook')){ ?>
					<li><a href="<?php echo get_option('facebook'); ?>" title="" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
					<?php } ?>
					<?php if(get_option('twitter')){ ?>
					<li><a href="<?php echo get_option('twitter'); ?>" title="" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					<?php } ?>
					<?php if(get_option('linkedIn')){ ?>
					<li><a href="<?php echo get_option('linkedIn'); ?>" title="" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
					<?php } ?>
					<?php if(get_option('pinterest')){ ?>
					<li><a href="<?php echo get_option('pinterest'); ?>" title="" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
					<?php } ?>
					<?php if(get_option('googleplus')){ ?>
					<li><a href="<?php echo get_option('googleplus'); ?>" title="" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
					<?php } ?>
					<?php if(get_option('youtube')){ ?>
					<li><a href="<?php echo get_option('youtube'); ?>" title="" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
					<?php } ?>
					<?php if(get_option('vimeo')){ ?>
					<li><a href="<?php echo get_option('vimeo'); ?>" title="" target="_blank"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>
					<?php } ?>
					<?php if(get_option('instagram')){ ?>
					<li><a href="<?php echo get_option('instagram'); ?>" title="" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
					<?php } ?>
					<?php if(get_option('tumblr')){ ?>
					<li><a href="<?php echo get_option('tumblr'); ?>" title="" target="_blank"><i class="fa fa-tumblr" aria-hidden="true"></i></a></li>
					<?php } ?>
					<?php if(get_option('flickr')){ ?>
					<li><a href="<?php echo get_option('flickr'); ?>" title="" target="_blank"><i class="fa fa-flickr" aria-hidden="true"></i></a></li>
					<?php } ?>
				</ul>
			  </div>
            </div>
          </div>
		</footer><!-- .site-footer -->
        <div class="site-info"><div class="container"><div class="row"><div class="col-lg-12 col-sm-12 col-xs-12 col-md-12">
				<?php
					/**
					 * Fires before the twentysixteen footer text for footer customization.
					 *
					 * @since Twenty Sixteen 1.0
					 */
					do_action( 'twentysixteen_credits' );
				?>
				</div></div></div>
			</div><!-- .site-info -->
	</div><!-- .site-inner -->
</div><!-- .site -->

<?php wp_footer(); ?>
<script type="text/javascript" src="/wp-content/themes/sterility/owl-carousel/owl.carousel.min.js"></script>
<script>
	jQuery(document).ready(function() {
	 
	  jQuery("#home-slider").owlCarousel({
	 
		  navigation : true, // Show next and prev buttons
		  navigationText: [
			  "<i class='fa fa-angle-left'></i>",
			  "<i class='fa fa-angle-right'></i>"
			  ],
			
		  slideSpeed : 300,
		  paginationSpeed : 400,
		  singleItem:true
	 
	  });
	 
	});
</script> 
<script type="text/javascript">
/*var owl = jQuery("#owl-wrap").data('owlCarousel');

if( jQuery('html').hasClass('no-backgroundsize') )
{
	jQuery(window).load(function() {
		window.setTimeout(function() {
			owl.reinit();
		}, 250);
	});
}*/
</script>
</body>
</html>
