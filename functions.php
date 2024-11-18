<?php

add_action( 'wp_enqueue_scripts', 'stm_enqueue_parent_styles' );

function stm_enqueue_parent_styles() {

	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('stm-theme-style') );
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap', false );

}

function homepage_memberslogo($params = array()) 
{
	include('template-parts/members-logo.php');
}

add_shortcode("homepage_memberslogo", "homepage_memberslogo");


function homepage_halloffame($params = array()) 
{
	include('template-parts/halloffame.php');
}
add_shortcode("homepage_halloffame", "homepage_halloffame");

function homepage_bestplayer($params = array()) 
{
	include('template-parts/best-player-season.php');
}
add_shortcode("homepage_bestplayer", "homepage_bestplayer");

function upcoming_matches_homepage($params = array()) 
{
	include('template-parts/upcoming-matches-homepage.php');
}
add_shortcode("upcoming_matches_homepage", "upcoming_matches_homepage");

function tournament_stats_homepage($params = array()) 
{
	include('template-parts/tournament-stats-homepage.php');
}
add_shortcode("tournament_stats_homepage", "tournament_stats_homepage");

function scores_homepage($params = array()) 
{
	include('template-parts/scores.php');
}
add_shortcode("scores_homepage", "scores_homepage");

function partners_homepage($params = array()) 
{
	include('template-parts/partners.php');
}
add_shortcode("partners_homepage", "partners_homepage");

function create_partners_posttype() 
{  
    register_post_type( 'partners',
        array(
            'labels' => array(
                'name' => __( 'Partners' ),
                'singular_name' => __( 'Partner' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'partners'),
            'show_in_rest' => true,
			'menu-icon' => "dashicons-awards",
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_partners_posttype' );

function create_brodcast_partners_posttype() 
{  
    register_post_type( 'brodcastpartners',
        array(
            'labels' => array(
                'name' => __( 'Broadcast Partners' ),
                'singular_name' => __( 'Broadcast Partner' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'brodcastpartners'),
            'show_in_rest' => true,
  			'menu-icon' => "dashicons-megaphone",
        )
    );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_brodcast_partners_posttype' );


function wpb_custom_new_menu() {
  register_nav_menus(
    array(
      'footer-menu' => __( 'Footer Menu' ),
      'bottom-menu' => __( 'Bottom Menu' )
    )
  );
}
add_action( 'init', 'wpb_custom_new_menu' );

function colorpicker_field_add_new_category( $taxonomy ) {

  ?>

    <div class="form-field term-colorpicker-wrap">
        <label for="term-colorpicker">Category Color</label>
        <input name="_category_color" value="#ffffff" class="colorpicker" id="term-colorpicker" />
        <p>This is the field description where you can tell the user how the color is used in the theme.</p>
    </div>

  <?php

}
add_action( 'category_add_form_fields', 'colorpicker_field_add_new_category' );

function colorpicker_field_edit_category( $term ) {

    $color = get_term_meta( $term->term_id, '_category_color', true );
    $color = ( ! empty( $color ) ) ? "#{$color}" : '#ffffff';

  ?>

    <tr class="form-field term-colorpicker-wrap">
        <th scope="row"><label for="term-colorpicker">Severity Color</label></th>
        <td>
            <input name="_category_color" value="<?php echo $color; ?>" class="colorpicker" id="term-colorpicker" />
            <p class="description">This is the field description where you can tell the user how the color is used in the theme.</p>
        </td>
    </tr>

  <?php


}
add_action( 'category_edit_form_fields', 'colorpicker_field_edit_category' ); 

function save_termmeta( $term_id ) {

    // Save term color if possible
    if( isset( $_POST['_category_color'] ) && ! empty( $_POST['_category_color'] ) ) {
        update_term_meta( $term_id, '_category_color', sanitize_hex_color_no_hash( $_POST['_category_color'] ) );
    } else {
        delete_term_meta( $term_id, '_category_color' );
    }

}
add_action( 'created_category', 'save_termmeta' );  // Variable Hook Name
add_action( 'edited_category',  'save_termmeta' );  // Variable Hook Name

function category_colorpicker_enqueue( $taxonomy ) {

    if( null !== ( $screen = get_current_screen() ) && 'edit-category' !== $screen->id ) {
        return;
    }

    // Colorpicker Scripts
    wp_enqueue_script( 'wp-color-picker' );

    // Colorpicker Styles
    wp_enqueue_style( 'wp-color-picker' );

}
add_action( 'admin_enqueue_scripts', 'category_colorpicker_enqueue' );

function colorpicker_init_inline() {

    if( null !== ( $screen = get_current_screen() ) && 'edit-category' !== $screen->id ) {
        return;
    }

  ?>

    <script>
        jQuery( document ).ready( function( $ ) {

            $( '.colorpicker' ).wpColorPicker();

        } ); // End Document Ready JQuery
    </script>

  <?php

}
add_action( 'admin_footer', 'colorpicker_init_inline', 20 );

/* Homepage Banner - Live API */
function live_score_banner($params = array()) 
{
	include('template-parts/live_score_banner.php');
}
add_shortcode("live_score_banner", "live_score_banner");

function live_score_from_api($params = array()) 
{
	include('template-parts/live_score.php');
}
add_shortcode("live_score_from_api", "live_score_from_api");

function my_enqueue() {
    wp_enqueue_script('ajax-script', get_stylesheet_directory_uri() . '/custom-ajax.js', array('jquery'));
    wp_localize_script('ajax-script', 'custom_ajax_url', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action( 'wp_enqueue_scripts', 'my_enqueue' );

/* Custom Ajax */
function data_custom_ajax(){
	$curl = curl_init();
	$PROJ_KEY = 'RS_P_1531958797231329302';
	$API_KEY = 'RS5:bf07961c3573668f1887f5405a917787';
	$TOURNAMENT_KEY = $_POST['text'];
	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.sports.roanuz.com/v5/core/${PROJ_KEY}/auth/",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => "{\n    \"api_key\": \"${API_KEY}\"\n}",
		CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json"
		),
	));
	$response = curl_exec($curl);
	curl_close($curl);
	if(($response) && ($TOURNAMENT_KEY != "tournament"))
	{
		$result2 = json_decode($response);
		if(is_object($result2))
		{
			$token = $result2->data->token;
			$curl2 = curl_init();
			$API_TOKEN = $token;
			curl_setopt_array($curl2, array(
				CURLOPT_URL => "https://api.sports.roanuz.com/v5/cricket/${PROJ_KEY}/tournament/${TOURNAMENT_KEY}/featured-matches/",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_HTTPHEADER => array(
					"rs-token: ${API_TOKEN}"
				),
			));
			$response2 = curl_exec($curl2);
			curl_close($curl2);
			
			$matchesData = json_decode($response2);
			$matches = $matchesData->data->matches;
			for($i=0 ; $i<count($matches) ; $i++)
			{		
				// Match Type
				$matchType = "";
				if(strpos(strtolower($matches[$i]->sub_title), 'odi') !== false){
					$matchType = "ODI";
				}
				else if(strpos(strtolower($matches[$i]->sub_title), 'test') !== false){
					$matchType = "TEST";
				}
				else if(strpos(strtolower($matches[$i]->sub_title), 't20') !== false){
					$matchType = "T20";
				}
				else{
					$matchType = $matches[$i]->sub_title;								
				}

				// Match Status
				$matchStatus = "";
				if($matches[$i]->status == "completed"){
					$matchStatus = "Match Completed";
				}
				else if($matches[$i]->status == "started"){
					$matchStatus = "In Progress";
				}
				else if($matches[$i]->status == "not_started"){
					$matchStatus = "Yet to Start";
				}

				$matchTime = date('h:i A', strtotime(date("Y-m-d H:i:s", substr($matches[$i]->start_at, 0, 10))));
				$matchDate = date("d M Y", substr($matches[$i]->start_at, 0, 10));
				$venueName = $matches[$i]->venue->name.", ".$matches[$i]->venue->country->code;
				$teamDetails = $matches[$i]->teams;		
				if($teamDetails){
					if(($matches[$i]->toss->winner == "a") && ($matches[$i]->toss->elected == "bat")){
						$battingFirst = $teamDetails->a->name;
						$battingSecond = $teamDetails->b->name;
						$scoreFirst = $matches[$i]->play->innings->a_1->score_str;
						$scoreSecond = $matches[$i]->play->innings->b_1->score_str;
					}
					else if(($matches[$i]->toss->winner == "b") && ($matches[$i]->toss->elected == "bat")){
						$battingFirst = $teamDetails->b->name;
						$battingSecond = $teamDetails->a->name;
						$scoreFirst = $matches[$i]->play->innings->b_1->score_str;
						$scoreSecond = $matches[$i]->play->innings->a_1->score_str;
					}
					else if(($matches[$i]->toss->winner == "b") && ($matches[$i]->toss->elected == "bowl")){
						$battingFirst = $teamDetails->a->name;
						$battingSecond = $teamDetails->b->name;
						$scoreFirst = $matches[$i]->play->innings->a_1->score_str;
						$scoreSecond = $matches[$i]->play->innings->b_1->score_str;
					}
					else if(($matches[$i]->toss->winner == "a") && ($matches[$i]->toss->elected == "bowl")){
						$battingFirst = $teamDetails->b->name;
						$battingSecond = $teamDetails->a->name;
						$scoreFirst = $matches[$i]->play->innings->b_1->score_str;
						$scoreSecond = $matches[$i]->play->innings->a_1->score_str;
					}
				}
			$json_result ='
			<div class="vc_row wpb_row vc_row-fluid score-bg">
				<div class="wpb_column vc_column_container vc_col-sm-3 col-md-3">
					<div class="vc_column-inner">
						<div class="wpb_wrapper">
							<div class="wpb_raw_code wpb_content_element wpb_raw_html" >
								<div class="wpb_wrapper">
									<ul class="d-flexul match-com">
										<li class="d-flex">
											<h5>'.$matchType.'</h5>
											<h6>'.$matchStatus.'</h6>
										</li>
										<li>
											<p>'.$matchDate.' - '.$matchTime.'</p>
										</li>
										<li>
											<p>'.$venueName.'</p>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="wpb_column vc_column_container vc_col-sm-6 col-md-6">
					<div class="vc_column-inner">
						<div class="wpb_wrapper">
							<div class="wpb_raw_code wpb_content_element wpb_raw_html" >
								<div class="wpb_wrapper">
									<ul class="d-flexul">
										<li>
											<div class="logo-match-ct">
												<p>'.$battingFirst.'</p>
											</div>
											<div>
												<h4 class="mt-score">'.$scoreFirst.'</h4>
											</div>
										</li>
										<li>
											<span>VS</span>
										</li>
										<li>
											<div class="logo-match-ct">
												<!--<img src="https://accnew.noesis.dev/wp-content/uploads/2016/05/srilanka_logo.png">-->
												<p>'.$battingSecond.'</p>
											</div>
											<div>
												<h4 class="yet-to-bat">'.$scoreSecond.'</h4>
											</div>
										</li>
									</ul>
									<h3 class="match-over-ct">'.$matches[$i]->play->result->msg.'</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="wpb_column vc_column_container vc_col-sm-3 col-md-3">
					<div class="vc_column-inner">
						<div class="wpb_wrapper">';
						if(!empty($matches[$i]->play->live)){
							$json_result .='<div class="vc_btn3-container btn-watch-live vc_btn3-inline">
								<a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-modern vc_btn3-color-mulled-wine" href="#" title="">WATCH LIVE</a>
							</div>';
						}
						$json_result .='<div class="vc_btn3-container  btn-match-center vc_btn3-inline" >
								<a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-modern vc_btn3-color-pink" href="'.site_url('live-score?key='.$matches[$i]->key).'" title="">MATCH CENTER</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>';
				$jsonArray[] = $json_result;
			}
		}
	}
	else{
		$result2 = json_decode($response);
		if(is_object($result2))
		{
			$token = $result2->data->token;
			$curl2 = curl_init();
			$API_TOKEN = $token;
			curl_setopt_array($curl2, array(
				CURLOPT_URL => "https://api.sports.roanuz.com/v5/cricket/${PROJ_KEY}/featured-matches/",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_HTTPHEADER => array(
					"rs-token: ${API_TOKEN}"
				),
			));
			$response2 = curl_exec($curl2);
			curl_close($curl2);
			
			$matchesData = json_decode($response2);
			$matches = $matchesData->data->matches;
			for($i=0 ; $i<count($matches) ; $i++)
			{		
				// Match Type
				$matchType = "";
				if(strpos(strtolower($matches[$i]->sub_title), 'odi') !== false){
					$matchType = "ODI";
				}
				else if(strpos(strtolower($matches[$i]->sub_title), 'test') !== false){
					$matchType = "TEST";
				}
				else if(strpos(strtolower($matches[$i]->sub_title), 't20') !== false){
					$matchType = "T20";
				}
				else{
					$matchType = $matches[$i]->sub_title;								
				}

				// Match Status
				$matchStatus = "";
				if($matches[$i]->status == "completed"){
					$matchStatus = "Match Completed";
				}
				else if($matches[$i]->status == "started"){
					$matchStatus = "In Progress";
				}
				else if($matches[$i]->status == "not_started"){
					$matchStatus = "Yet to Start";
				}

				$matchTime = date('h:i A', strtotime(date("Y-m-d H:i:s", substr($matches[$i]->start_at, 0, 10))));
				$matchDate = date("d M Y", substr($matches[$i]->start_at, 0, 10));
				$venueName = $matches[$i]->venue->name.", ".$matches[$i]->venue->country->code;
				$teamDetails = $matches[$i]->teams;		
				if($teamDetails){
					if(($matches[$i]->toss->winner == "a") && ($matches[$i]->toss->elected == "bat")){
						$battingFirst = $teamDetails->a->name;
						$battingSecond = $teamDetails->b->name;
						$scoreFirst = $matches[$i]->play->innings->a_1->score_str;
						$scoreSecond = $matches[$i]->play->innings->b_1->score_str;
					}
					else if(($matches[$i]->toss->winner == "b") && ($matches[$i]->toss->elected == "bat")){
						$battingFirst = $teamDetails->b->name;
						$battingSecond = $teamDetails->a->name;
						$scoreFirst = $matches[$i]->play->innings->b_1->score_str;
						$scoreSecond = $matches[$i]->play->innings->a_1->score_str;
					}
					else if(($matches[$i]->toss->winner == "b") && ($matches[$i]->toss->elected == "bowl")){
						$battingFirst = $teamDetails->a->name;
						$battingSecond = $teamDetails->b->name;
						$scoreFirst = $matches[$i]->play->innings->a_1->score_str;
						$scoreSecond = $matches[$i]->play->innings->b_1->score_str;
					}
					else if(($matches[$i]->toss->winner == "a") && ($matches[$i]->toss->elected == "bowl")){
						$battingFirst = $teamDetails->b->name;
						$battingSecond = $teamDetails->a->name;
						$scoreFirst = $matches[$i]->play->innings->b_1->score_str;
						$scoreSecond = $matches[$i]->play->innings->a_1->score_str;
					}
				}
				$json_result ='
				<div class="vc_row wpb_row vc_row-fluid score-bg">
					<div class="wpb_column vc_column_container vc_col-sm-3 col-md-3">
						<div class="vc_column-inner">
							<div class="wpb_wrapper">
								<div class="wpb_raw_code wpb_content_element wpb_raw_html" >
									<div class="wpb_wrapper">
										<ul class="d-flexul match-com">
											<li class="d-flex">
												<h5>'.$matchType.'</h5>
												<h6>'.$matchStatus.'</h6>
											</li>
											<li>
												<p>'.$matchDate.' - '.$matchTime.'</p>
											</li>
											<li>
												<p>'.$venueName.'</p>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="wpb_column vc_column_container vc_col-sm-6 col-md-6">
						<div class="vc_column-inner">
							<div class="wpb_wrapper">
								<div class="wpb_raw_code wpb_content_element wpb_raw_html" >
									<div class="wpb_wrapper">
										<ul class="d-flexul">
											<li>
												<div class="logo-match-ct">
													<p>'.$battingFirst.'</p>
												</div>
												<div>
													<h4 class="mt-score">'.$scoreFirst.'</h4>
												</div>
											</li>
											<li>
												<span>VS</span>
											</li>
											<li>
												<div class="logo-match-ct">
													<!--<img src="https://accnew.noesis.dev/wp-content/uploads/2016/05/srilanka_logo.png">-->
													<p>'.$battingSecond.'</p>
												</div>
												<div>
													<h4 class="yet-to-bat">'.$scoreSecond.'</h4>
												</div>
											</li>
										</ul>
										<h3 class="match-over-ct">'.$matches[$i]->play->result->msg.'</h3>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="wpb_column vc_column_container vc_col-sm-3 col-md-3">
						<div class="vc_column-inner">
							<div class="wpb_wrapper">';
							if(!empty($matches[$i]->play->live)){
								$json_result .='<div class="vc_btn3-container btn-watch-live vc_btn3-inline">
									<a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-modern vc_btn3-color-mulled-wine" href="#" title="">WATCH LIVE</a>
								</div>';
							}
							$json_result .='<div class="vc_btn3-container  btn-match-center vc_btn3-inline" >
									<a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-rounded vc_btn3-style-modern vc_btn3-color-pink" href="'.site_url('live-score?key='.$matches[$i]->key).'" title="">MATCH CENTER</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>';
				$jsonArray[] = $json_result;
			}
		}
	}
	echo json_encode(array("data_result" => $jsonArray));
	die;
}
add_action('wp_ajax_nopriv_data_custom_ajax', 'data_custom_ajax');
add_action('wp_ajax_data_custom_ajax', 'data_custom_ajax');