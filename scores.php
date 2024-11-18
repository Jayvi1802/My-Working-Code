<h2>Scores</h2>
<ul id="tabs">
	<li><a id="live" class="active">In Progress</a></li>
    <li><a id="recent">Recent</a></li>
</ul>

<?php
	$curl = curl_init();
	$PROJ_KEY = 'RS_P_1531958797231329302';
	$API_KEY = 'RS5:bf07961c3573668f1887f5405a917787';
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
	    ) ,
	));

	$response = curl_exec($curl);
	curl_close($curl);

	if($response)
	{
		$result = json_decode($response);
		if(is_object($result))
		{
			$token = $result->data->token;
			$curl1 = curl_init();
			$API_TOKEN = $token;
			$ASSOCIATION_KEY = "c.board.acc.a936c"; // ACC
			curl_setopt_array($curl1, array(
				CURLOPT_URL => "https://api.sports.roanuz.com/v5/cricket/${PROJ_KEY}/association/${ASSOCIATION_KEY}/featured-tournaments/",
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
			$response1 = curl_exec($curl1);
			curl_close($curl1);
			$details = json_decode($response1);
			$tournaments = $details->data->tournaments;
			for($i=0 ; $i<count($tournaments) ; $i++){
				$curl2 = curl_init();
				$TOURNAMENT_KEY = $tournaments[$i]->key;
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
				if(is_object($matchesData))
				{
					if(isset($matchesData->data->matches) && is_array($matchesData->data->matches) && count($matchesData->data->matches))
					{
						$matches = $matchesData->data->matches;

						$liveArray = [];
						$recentArray = [];
						
						for($i=0 ; $i<count($matches) ; $i++)
						{						
							$isLive = $matches[$i]->play_status;
							if($isLive == "in_play"){
								$liveArray[] = $matches[$i];
							}	
							else if($isLive == "result"){
								$recentArray[] = $matches[$i];							
							}
						}
						
						echo '<div class="current_score" id="liveC">';
						echo '<div class="sliderBox">
							<div class="owl-carousel owl-theme">';

							if(count($liveArray) <= 0)
								echo '<div class="score_section"><span class="venue_name">No live match(s)</span></div>';
								for($i=0 ; $i<count($liveArray) ; $i++)
								{	
									$venueDetails = $liveArray[$i]->venue;
									$venueName = "";

									if($venueDetails)
									{
										$venueName = date('d M Y') . " " . $venueDetails->name . ", " . $venueDetails->country->name;
									}

									$inningsOrder = $liveArray[$i]->play->innings_order;
									$firstBat = explode("_", $inningsOrder[0]);
									$firstBatkey = $firstBat[0];
									$secondBat = explode("_", $inningsOrder[1]);
									$secondBatkey = $secondBat[0];

									$firstInning = $inningsOrder[0];
									$secondInning = $inningsOrder[1];
									$firstBatScore = $liveArray[$i]->play->innings->$firstInning->score_str; 
									$firstBatTeam = $liveArray[$i]->teams->$firstBatkey->name;
									$secondBatScore =$liveArray[$i]->play->innings->$secondInning->score_str;
									$secondBatTeam = $liveArray[$i]->teams->$secondBatkey->name;
				?>
									<div class="score_section">
										<span class="venue_name"><?php echo $venueName; ?></span>
											<div class="score_team">
												<span class="batting_team"><?php echo $firstBatTeam ?></span>
												<span class="score_main"><?php echo $firstBatScore ?></span>
												<br>
												<span class="bolwaling_team"><?php echo $secondBatTeam ?></span>
												<span class="score_main"><?php echo $secondBatScore ?></span>
											</div>
										<div class="view_details">
											<a href="<?php echo site_url('match-centre'); ?>" target="_blank">View Details</a>
										</div>
									</div>
				<?php
								}
														
							echo "</div></div></div>";
							echo '<div class="current_score" id="recentC">';
								echo '<div class="sliderBox">
									<div class="owl-carousel owl-theme">';
							if(count($recentArray) <= 0)
								echo '<div class="score_section"><span class="venue_name">No recent match(s)</span></div>';
								for($i=0 ; $i<count($recentArray) ; $i++)
								{
									if($recentArray[$i]->start_at_local >= strtotime("now"))
										continue;

									$venueDetails = $recentArray[$i]->venue;
									$venueName = "";

									if($venueDetails)
									{
										$venueName = date('d M Y') . " " . $venueDetails->name . ", " . $venueDetails->country->name;
									}

									$inningsOrder = $recentArray[$i]->play->innings_order;
									$firstBat = explode("_", $inningsOrder[0]);
									$firstBatkey = $firstBat[0];
									$secondBat = explode("_", $inningsOrder[1]);
									$secondBatkey = $secondBat[0];

									$firstInning = $inningsOrder[0];
									$secondInning = $inningsOrder[1];
									$firstBatScore = $recentArray[$i]->play->innings->$firstInning->score_str; 
									$firstBatTeam = $recentArray[$i]->teams->$firstBatkey->name;
									$secondBatScore = $recentArray[$i]->play->innings->$secondInning->score_str;
									$secondBatTeam = $recentArray[$i]->teams->$secondBatkey->name;

									$final_result = $recentArray[$i]->play->result->msg;
					?>
									<div class="item">
										<div class="score_section">
											<span class="venue_name"><?php echo $venueName; ?></span>
											<div class="score_team">
												<span class="batting_team"><?php echo $firstBatTeam ?></span>
												<span class="score_runs"><?php echo $firstBatScore ?></span>
												<br>
												<span class="bowling_team"><?php echo $secondBatTeam ?></span>
												<span class="score_runs"><?php echo $secondBatScore ?></span>
											</div>
											<span class="final_result"><?php echo $final_result; ?></span>
											<div class="view_details">
												<a href="<?php echo site_url('match-centre'); ?>" target="_blank">View Details</a>
											</div>
										</div>
									</div>
								<?php
								}
						echo "</div></div></div>";
					}
				}
			}
		}
	}
?>
<script type="text/javascript">
	jQuery(document).ready(function() {    
		jQuery('.sliderBox .owl-carousel').owlCarousel({
		    loop:false,
		    nav:false,
		    items: 1
		})
		tabEvent();
	});

	function tabEvent(){
		jQuery('#tabs li a:not(:first)').addClass('inactive');
		jQuery('#tabs li a:not(:first)').removeClass('active');
		jQuery('.current_score').hide();
		jQuery('.current_score:first').show();
    
		jQuery('#tabs li a').click(function(){
    		var t = jQuery(this).attr('id');
  			if(jQuery(this).hasClass('inactive')){  
			    jQuery('#tabs li a').addClass('inactive');
			    jQuery('#tabs li a').removeClass('active');           
			    jQuery(this).removeClass('inactive');
			    jQuery(this).addClass('active');
			    
			    jQuery('.current_score').hide();
			    jQuery('#'+ t + 'C').fadeIn('slow');
 			}
		});
	}
</script>