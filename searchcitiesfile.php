<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Eastbrook
 */

$filter_location = '';


if (isset($_GET['location'])) {
	header('Location: ../locations/' . $_GET['location']);
}

$cities_posts = get_posts(array(
	'post_type'				=> 'locations',
	'post_status'			=> 'publish',
	'posts_per_page'		=> -1
));

$city_names = [];
$city_url_names = [];

foreach ($cities_posts as $city) {
	array_push($city_names, get_field('city', $city->ID));
	array_push($city_url_names, strtolower(str_replace(' ', '-', get_field('city', $city->ID))) . '-' . strtolower(get_field('state', $city->ID)));
}

$city_list = array_combine($city_names, $city_url_names);
ksort($city_list);

?>


<article id="available post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	$search_img  = get_the_post_thumbnail_url(get_the_ID(), 'full');
	?>
	<section class="available__search">
		<form class="search" method="get" action="">
			<fieldset>
				<label for="location">Cities</label>
				<select id="location" name="location" class="search__select select2">
					<option value="" selected>Where do you want to live?</option>
					<?php foreach ($city_list as $city => $url) : ?>
						<option value="<?php echo $url; ?>"><?php echo $city; ?></option>
					<?php endforeach; ?>
				</select>
			</fieldset>
			<button type="submit"><img class="icon-search" src="/wp-content/themes/eastbrook/assets/images/icon-search.svg"></button>
		</form>
		<div class="background-image">
			<img src="<?php echo get_field('city_page_header_image', 'option'); ?>" alt="'Eastbrook Homes Cities">
		</div>
	</section>

	<section class="available__intro">
		<?php
		$title = get_field('title');
		if ($title) : ?>
			<h1 class="available__title ebTitle">
				<div class="ebLede"><?php echo esc_html($title['title_lede']); ?></div>
				<?php echo esc_html($title['main_title']); ?>
			</h1>
		<?php endif; ?>
		<div class="available__introCopy"><?php the_field('intro_copy'); ?></div>

	</section>

	<?php
	$cities_posts = get_posts(array(
		'post_type'				=> 'locations',
		'post_status'			=> 'publish',
		'posts_per_page'		=> -1
	));

	if ($cities_posts) {
		$city_objects_array = [];
		$city_name_array = [];
		foreach ($cities_posts as $key => $city) {
			// Only add cities if they have listings.
			if (get_field('listings', $city->ID)) {
				array_push($city_objects_array, $city);
				array_push($city_name_array, get_the_title($city->ID));
			}
		}
		$alphabetized_cities_array = array_combine($city_name_array, $city_objects_array);
		ksort($alphabetized_cities_array);

	?>
		<ul class="featuredLinks">
			<?php
			foreach ($alphabetized_cities_array as $city_name => $city_object) {
				$image = get_the_post_thumbnail_url($city_object->ID, 'eb_1440px');
				$title = get_the_title($city_object->ID);
				$link_url = get_permalink($city_object->ID);

			?>
				<li class="featuredLinks__item">
					<a href="<?php echo $link_url; ?>" class="featuredLinks__link" style="background-image: url(<?php echo esc_url($image); ?>);">
						<span class="featuredLinks__name"><?php echo esc_html($title); ?></span>
					</a>
				</li>
			<?php
			}
			?>
		</ul>
	<?php
	}

	?>

	<?php
	if (have_rows('map_cta_title')) :
		while (have_rows('map_cta_title')) : the_row();
	?>
			<section class="yourCanvas">
				<div class="yourCanvas__content">
					<h2 class="yourCanvas__title ebTitle">
						<div class="ebLede"><?php the_sub_field('title_lede') ?></div>
						<?php the_sub_field('title') ?>
					</h2>
					<div class="yourCanvas__copy">
						<?php the_field('map_cta_copy');
						$link = get_field('map_cta_button');
						if ($link) :
							$link_url = $link['url'];
							$link_title = $link['title'];
							$link_target = $link['target'] ? $link['target'] : '_self';
						?>
							<a class="button" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
						<?php endif; ?>
						<?php 
						$link2 = get_field('map_cta_button_2');
						if ($link2) :
							$link2_url = $link2['url'];
							$link2_title = $link2['title'];
							$link2_target = $link2['target'] ? $link2['target'] : '_self';
						?>
							<a class="button" href="<?php echo esc_url($link2_url); ?>" target="<?php echo esc_attr($link2_target); ?>"><?php echo esc_html($link2_title); ?></a>
						<?php endif; ?>
					</div>
				</div>
				<?php
				$image = get_field('map_cta_image');
				if (!empty($image)) : ?>
					<div class="yourCanvas__image">
						<img class="yourCanvas__img" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
					</div>
				<?php endif; ?>
			</section>
	<?php endwhile;
	endif;
	?>

	<?php
	if (have_rows('experience_steps')) :
	?>
		<section class="experience">
			<h2 class="experience__title ebTitle">
				<?php the_field('experience_title') ?>
			</h2>
			<ul class="experience__steps">
				<?php while (have_rows('experience_steps')) : the_row();
					$image = get_sub_field('step_icon');
				?>
					<li class="experience__step">
						<?php if (!empty($image)) : ?>
							<img class="experience__stepImg" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
						<?php endif; ?>
						<h4 class="experience__stepTitle"><?php the_sub_field('step_title'); ?></h4>
						<div class="experience__stepCopy"><?php the_sub_field('step_copy'); ?></div>
					</li>
				<?php endwhile; ?>
			</ul>
		</section>
	<?php endif; ?>

	<?php
	if (get_field('show_quick_answers_section')) :
		get_template_part('template-parts/partial', 'quick-answers');
	endif;
	?>


	<?php if (have_rows('blog_links_three_column_feature')) :
		while (have_rows('blog_links_three_column_feature')) : the_row();
			$bgColor = get_sub_field('background_color') ? '_dark' : '_light';
			$threecolTitle = get_sub_field('big_title');
			$threecolTitleLede = get_sub_field('small_title');
			$linksList = get_sub_field('links');

			render_3col($linksList, $threecolTitle, $threecolTitleLede, $bgColor);
		endwhile;
	endif;
	?>


	<?php if (have_rows('three_column_feature')) :
		while (have_rows('three_column_feature')) : the_row();
			$bgColor = get_sub_field('background_color') ? '_dark' : '_light';
			$threecolTitle = get_sub_field('big_title');
			$threecolTitleLede = get_sub_field('small_title');
			$linksList = get_sub_field('links');

			render_3col($linksList, $threecolTitle, $threecolTitleLede, $bgColor);
		endwhile;
	endif;
	?>


	<?php
	if (get_field('show_testimonials_slider')) :
		get_template_part('template-parts/partial', 'testimonials');
	endif;
	?>

</article><!-- #post-<?php the_ID(); ?> -->