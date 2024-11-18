<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header1">
		<div class="container"><div class="row"><div class="col-lg-12 col-sm-12 col-xs-12 col-md-12"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></div></div></div>
	</header><!-- .entry-header -->

	<?php //twentysixteen_post_thumbnail(); ?>

	<div class="entry-content1">
		<?php
		the_content();

		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
		?>
	</div><!-- .entry-content -->

	

</article><!-- #post-## -->
