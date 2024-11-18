<?php
namespace snv\Theme;

class ContentHeader
{

    public function __construct()
    {
        $this->contentHeaderCustomField('page');
        $this->contentHeaderCustomField('post');
        $this->contentHeaderCustomField('product');
        $this->contentHeaderCustomField('vacature');

        add_action('contentheader', array($this, 'setHeader'));
    }

    // wp hack call for init
    public function theInit()
    {

    }

    /* returns the header by echoing */
    public function setHeader()
    {
        global $post;
        $id = $post->ID;

        // get the meta data
        $meta = get_post_meta($id);
	   //$banner = $meta['wpcf-banner_field'][0];
	   if($meta['wpcf-banner_field'][0] == "")
	   {
		    $banner = "/wp-content/themes/snv2015/images/default-banner.jpg";
	   }
	   else
	   {
		   $banner = $meta['wpcf-banner_field'][0];
	   }
	   
	   $seg_color = $meta['wpcf-posttype-segment-color'][0];
	   $bnr_icon = $meta['wpcf-banner-icon'][0];
	   $segment_banner = get_option('segment-banner');
	   $project_banner = get_option('project-banner');
	   $product_banner = get_option('product-banner');
	   
	   if($seg_color != '')
	   {
		   $opacity = "0.5";
	   } 
	   else
	   {
		    $opacity = "1";
	   }
        $typemeta = get_post_meta(get_the_id()); 
        $nieuwetitel = $typemeta['wpcf-nieuwe-titel'][0];
		$wpcf_su_title = $typemeta['wpcf-sub-title'][0];
		$button_link = $typemeta['button-link'][0];
        $uitlijnen = $typemeta['wpcf-header-afbeelding-uitlijnen'][0];

        if (empty($uitlijnen)) {
            $lijnuit = 'center';
        } elseif ($uitlijnen == 'links') {
            $lijnuit = 'left';
        } elseif ($uitlijnen == 'midden') {
            $lijnuit = 'center';
        } elseif ($uitlijnen == 'rechts') {
            $lijnuit = 'right';
        } else {
            $lijnuit = 'center';
        }

        if (!empty($nieuwetitel)) {
            $titleText = $nieuwetitel;
        } elseif (is_archive()) {
            $titleText = str_replace('Archives: ','',get_the_archive_title());
        } elseif (is_home()) {
            $titleText = 'Nieuws';
        } elseif (is_search()) {
            $titleText = 'Zoeken naar: ' . $_GET['s'];
        } elseif (is_404()) {
            $titleText = '404 - oeps, er ging iets fout..';
        } else {
            $titleText = get_the_title();
        }

        if (function_exists('yoast_breadcrumb')) {
            $broodkruimels = yoast_breadcrumb("","",false);
        } else {
            $broodkruimels = 'Yoast dut nie';
        }

        if (!isset($meta['_header_type'])) {
            $returnString .= '<div class="theHeaderImage" style="background:url('. $image_url_large[0] .'); background-position-x: ' . $lijnuit . ';"><div class="container"><h1 class="page_title">'. $titleText .'</h1></div></div>';
        }

        $header = $meta['_header_type'][0];

        $returnString = '<div class="paginaHeader" style="background-color:'.$seg_color.'">';

        if ($header === 'image') {
            $image = $meta['_header_image'][0];

            if(is_archive()) {
                $option = get_option( 'wpptm_behandeling' );
                $archiveafbeeldingurl = $option[ 'archive-afbeelding' ];
                if(!empty($archiveafbeeldingurl)) {
                    $image_url = $archiveafbeeldingurl;
                    $image_id = pippin_get_image_id($image_url);
                    $image_url_large =  wp_get_attachment_image_src($image_id, 'header-image-large');
                }else{
                    $image_url_large[0] = '/wp-content/themes/snv2015/images/default-banner.jpg';
                } 
            }elseif (!empty($image)) {
                $image_url_large = wp_get_attachment_image_src($image, 'header-image-large');  
            }else{
                $image_url_large[0] = '/wp-content/themes/snv2015/images/default-banner.jpg';
            }

            if (is_front_page()) {
				$home_titleText = "";
				$home_wpcf_su_title = "";
				$home_button_link = "";
				$returnString .= '<div id="home-slider">';
				if(get_field('banner_image_1')){
					if(get_field('banner_title_1')){
						$home_titleText = get_field('banner_title_1');
					}
					if(get_field('banner_sub_title_1')){
						$home_wpcf_su_title = get_field('banner_sub_title_1');
					}
					if(get_field('banner_link_1')){
						$home_button_link = get_field('banner_link_1');
					}
					$returnString .= '<div class="theHeaderImage item" style="background:url('. get_field('banner_image_1') .'); background-position-x: ' . $lijnuit . ';"><div class="vbottom"><div class="container"><h1 class="page_title">'. $home_titleText .'</h1><div class="banner-sub-title">'.$home_wpcf_su_title.'</div><div class="banner-btn"><a href="'.$home_button_link.'">Maak een afspraak</a></div></div></div></div>';
				}
				if(get_field('banner_image_2')){
					if(get_field('banner_title_2')){
						$home_titleText = get_field('banner_title_2');
					}
					if(get_field('banner_sub_title_2')){
						$home_wpcf_su_title = get_field('banner_sub_title_2');
					}
					if(get_field('banner_link_2')){
						$home_button_link = get_field('banner_link_2');
					}
					$returnString .= '<div class="theHeaderImage item" style="background:url('. get_field('banner_image_2') .'); background-position-x: ' . $lijnuit . ';"><div class="vbottom"><div class="container"><h1 class="page_title">'. $home_titleText .'</h1><div class="banner-sub-title">'.$home_wpcf_su_title.'</div><div class="banner-btn"><a href="'.$home_button_link.'">Maak een afspraak</a></div></div></div></div>';
				}
				if(get_field('banner_image_3')){
					if(get_field('banner_title_3')){
						$home_titleText = get_field('banner_title_3');
					}
					if(get_field('banner_sub_title_3')){
						$home_wpcf_su_title = get_field('banner_sub_title_3');
					}
					if(get_field('banner_link_3')){
						$home_button_link = get_field('banner_link_3');
					}
					$returnString .= '<div class="theHeaderImage item" style="background:url('. get_field('banner_image_3') .'); background-position-x: ' . $lijnuit . ';"><div class="vbottom"><div class="container"><h1 class="page_title">'. $home_titleText .'</h1><div class="banner-sub-title">'.$home_wpcf_su_title.'</div><div class="banner-btn"><a href="'.$home_button_link.'">Maak een afspraak</a></div></div></div></div>';
				}
				if(get_field('banner_image_4')){
					if(get_field('banner_title_4')){
						$home_titleText = get_field('banner_title_4');
					}
					if(get_field('banner_sub_title_4')){
						$home_wpcf_su_title = get_field('banner_sub_title_4');
					}
					if(get_field('banner_link_4')){
						$home_button_link = get_field('banner_link_4');
					}
					$returnString .= '<div class="theHeaderImage item" style="background:url('. get_field('banner_image_4') .'); background-position-x: ' . $lijnuit . ';"><div class="vbottom"><div class="container"><h1 class="page_title">'. $home_titleText .'</h1><div class="banner-sub-title">'.$home_wpcf_su_title.'</div><div class="banner-btn"><a href="'.$home_button_link.'">Maak een afspraak</a></div></div></div></div>';
				}
				$returnString .= '</div>';
				$returnString .= '<img src="/wp-content/themes/snv2015/images/watermark.png" class="slider-watermark" />';
				
                //$returnString .= '<div class="theHeaderImage" style="background:url('. $image_url_large[0] .'); background-position-x: ' . $lijnuit . ';"><div class="vbottom"><div class="container"><h1 class="page_title">'. $titleText .'</h1><div class="banner-sub-title">'.$wpcf_su_title.'</div><div class="banner-btn"><a href="'.$button_link.'">Maak een afspraak</a></div></div></div></div>';
            } else {
                
                if( get_post_type() == 'segment' ){
                    $returnString .= '<div class="theHeaderImage" style="background:url('. $image_url_large[0] .');opacity: '.$opacity.';; background-position-x: ' . $lijnuit . ';"></div><div class="vbottom segment-title"><div class="container"><h1 class="page_title" style="background-image:url('.$bnr_icon.');padding-left: 60px;background-repeat: no-repeat; background-position: left center;">'. $titleText .'</h1>' . $broodkruimels . '</div></div>';
                }else{
                    $returnString .= '<div class="theHeaderImage" style="background:url(/wp-content/themes/snv2015/images/default-banner.jpg); background-position-x: ' . $lijnuit . ';"><div class="vbottom"><div class="container"><h1 class="page_title">'. $titleText .'</h1>' . $broodkruimels . '</div></div></div>';
                }
            }
            // $returnString .= '<img src="'. $image_url[0] .'" alt=" ">';
        } else if ($header === 'shortcode') {
            $shortcode = $meta['_header_shortcode'][0];
            $returnString .= do_shortcode($shortcode);
        }
		else if (is_post_type_archive( 'segment' ))
		{
			 $returnString .= '<div class="theHeaderImage" style="background:url('.$segment_banner.'); background-position-x: ' . $lijnuit . ';"><div class="vbottom"><div class="container"><h1 class="page_title">Marktsegmenten</h1>' . $broodkruimels . '</div></div></div>';
		}
		else if (is_post_type_archive( 'projecten' ))
		{
			 $returnString .= '<div class="theHeaderImage" style="background:url('.$project_banner.'); background-position-x: ' . $lijnuit . ';"><div class="vbottom"><div class="container"><h1 class="page_title">Projecten</h1>' . $broodkruimels . '</div></div></div>';
		}
		else if (is_post_type_archive( 'producten' ))
		{

			 $returnString .= '<div class="theHeaderImage" style="background:url('.$product_banner.'); background-position-x: ' . $lijnuit . ';"><div class="vbottom"><div class="container"><h1 class="page_title">Producten</h1>' . $broodkruimels . '</div></div></div>';
		}
 
		else if( get_post_type() == 'segment' ) 
		{
			 $returnString .= '<div class="theHeaderImage" style="background:url('.$banner.');opacity: '.$opacity.'; background-position-x: ' . $lijnuit . ';"></div><div class="vbottom segment-title"><div class="container"><h1 class="page_title" style="background-image:url('.$bnr_icon.');padding-left: 60px;background-repeat: no-repeat; background-position: left center;">'. $titleText .'</h1>' . $broodkruimels . '</div></div>';
		}
		else if (( is_post_type_archive('projecten') ) || ( is_post_type_archive('nieuws') ) ){
			$returnString .= '<div class="theHeaderImage" style="background:url(/wp-content/uploads/2016/10/news-banner.jpg);"><div class="vbottom"><div class="container"><h1 class="page_title">'. $titleText .'</h1>' . $broodkruimels . '</div></div></div>';
         
    }
		else{
            $returnString .= '<div class="theHeaderImage" style="background:url('.$banner.');opacity: '.$opacity.'; background-position-x: ' . $lijnuit . ';"><div class="vbottom"><div class="container"><h1 class="page_title">'. $titleText .'</h1>' . $broodkruimels . '</div></div></div>';
        } 

        $returnString .= '</div>';

        echo $returnString;

        
    }

    /* creates the extra custom fields */
    public function contentHeaderCustomField($post_type)
    {
/*
        // create metaBox with select option
        $page = register_cuztom_post_type($post_type);
        $page->add_meta_box(
            'header',
            'Page Header Options',
            array(
                array(
                    'name' => 'type',
                    'label' => 'type header',
                    'description' => 'selecteer het type header',
                    'type' => 'select',
                    'options' => array(
                        'noHeader' => 'Geen header',
                        'image' => 'Afbeelding',
                        'shortcode' => 'Shortcode',
                    ),
                ),
                array(
                    'name' => 'shortcode',
                    'label' => 'shortcode',
                    'description' => 'geef de shortcode in ',
                    'type' => 'text',
                ),
                array(
                    'name' => 'image',
                    'label' => 'image',
                    'description' => 'Selecteer afbeelding',
                    'type' => 'image',
                ),
            )
        );
        */
    }
}
