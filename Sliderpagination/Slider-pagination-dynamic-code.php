<?php 

add_shortcode("engagement_post_type_shortcode", "engagement_post_type_shortcode");

function engagement_post_type_shortcode($attr) {
    if (is_admin()) {
        return;
    }

    $max_posts = 8;
    if (isset($attr['max_posts']) && !empty($attr['max_posts']) && is_numeric($attr['max_posts'])) {
        $max_posts = $attr['max_posts'];
    }

    $args = array(
        'post_type'      => 'engagement_post_type',
        'posts_per_page' => $max_posts,
        'orderby'        => 'date',
        'order'          => 'DESC'
    );

    $project_query = new WP_Query($args);
    $project_posts = $project_query->get_posts();

    // Extract post titles for JavaScript
    $project_titles = array();
    foreach ($project_posts as $prPost) {
        $project_titles[] = get_the_title($prPost);
    }

    wp_enqueue_script("charming", get_stylesheet_directory_uri() . '/js/charming.js', array('jquery'), '', true);
    wp_enqueue_script("twin-max", get_stylesheet_directory_uri() . '/js/TweenMax.min.js', array('jquery'), '', true);
    wp_enqueue_script("qc-engagement-slider", get_stylesheet_directory_uri() . '/js/engagement-slider.js', array('jquery'), '1.1', true);

    // Pass post titles to JavaScript
    wp_localize_script("qc-engagement-slider", 'qc_engagement_obj', array("is_mobile" => wp_is_mobile() ? 'true' : 'false', "postTitles" => $project_titles));

    ob_start();

    if (!empty($project_posts)) {
        ?>
        <div class="swiper-container slideshow">
            <div class="swiper-wrapper">
                <?php
                foreach ($project_posts as $key => $prPost) {
                    $post_text = wp_strip_all_tags($prPost->post_content);
                    $trimmed_post_text = mb_substr($post_text, 0, 55);
                    ?>
                    <div class="swiper-slide slide">
                        <div class="slide-image">
                            <img class="project-img" src="<?php echo get_the_post_thumbnail_url($prPost); ?>"
                                 alt="<?php echo get_the_title($prPost); ?>">
                            <div class="project-content">
                                <h2><?php echo get_the_title($prPost); ?></h2>
                                <p><?php echo get_the_excerpt($prPost); ?></p>
                                <a href="<?php echo get_permalink($prPost); ?>"><?php _e('En Savoir Plus', 'demers'); ?><i
                                        class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <h2 class="project-heading">Ils nous distinguent<br>et nous rendent<br>meilleurs</h2>
            <div class="slideshow-pagination"></div>
        </div>
        <?php
    }

    return ob_get_clean();
}
?>

