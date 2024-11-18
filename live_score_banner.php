<?php
	$liveArray = [];
	$curl = curl_init();
	$PROJ_KEY = 'RS_P_1531958797231329302';
	$API_KEY = 'RS5:bf07961c3573668f1887f5405a917787';
	$MATCH_KEY = $_GET['key'];
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
	
	if($response){
		$result1 = json_decode($response);
		if(is_object($result1))
		{
			$token = $result1->data->token;
			$curl1 = curl_init();
			$API_TOKEN = $token;
			//$ASSOCIATION_KEY = "c.board.acc.a936c"; // ACC
			$ASSOCIATION_KEY = "c.board.bcci.b13f0"; // BCCI
			
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
				$matchData = json_decode($response2);
				$matches = $matchData->data->matches;
				for($j=0 ; $j<count($matches) ; $j++)
				{
					$isLive = $matches[$j]->play->live;
					if($isLive){
						$liveArray[] = $matches[$j];
					}
				}
			}
?>
<section class="banner-slider">
	<div class="livescoreTag">LIVE</div>
	<div class="owl-carousel owl-theme">
		<?php 
			foreach($liveArray as $key => $value){
				$inningsOrder = $value->play->innings_order;
				
				// Team Keys
				$firstBatKey = $inningsOrder[0];
				$secondBatKey = $inningsOrder[1];
				
				// Team Name
				$first = explode("_", $inningsOrder[0]);
				$firstBat = $first[0];
				$second = explode("_", $inningsOrder[1]);
				$secondBat = $second[0];
		?>
		<div class="item">
			<div class="col-md-3 col-xs-6 match_teams">
				<div class="team1">
					<h4><?php echo $value->teams->$firstBat->name; ?></h4>
				</div>
				<span>VS</span>
				<div class="team2">
					<h4><?php echo $value->teams->$secondBat->name; ?></h4>
				</div>
			</div>
			<div class="col-md-3 col-xs-6 match_score">
				<div class="team1">
					<h4><?php echo $value->play->innings->$firstBatKey->score->runs."/".$value->play->innings->$firstBatKey->wickets; ?></h4>
					<p>
					<?php 
					if(empty($value->play->innings->$firstBatKey->overs[1])){
						$overs = $value->play->innings->$firstBatKey->overs[0];
					}
					else{
						$overs = $value->play->innings->$firstBatKey->overs[0].".".$value->play->innings->$firstBatKey->overs[1];
					}
					echo $overs." OV  CRR: ".$value->play->innings->$firstBatKey->score->run_rate;
					?>
					</p>
				</div>
				<div class="team2">
					<h4><?php echo $value->play->innings->$secondBatKey->score->runs."/".$value->play->innings->$secondBatKey->wickets; ?></h4>
					<p>
					<?php 
					if(empty($value->play->innings->$secondBatKey->overs[1])){
						$overs = $value->play->innings->$secondBatKey->overs[0];
					}
					else{
						$overs = $value->play->innings->$secondBatKey->overs[0].".".$value->play->innings->$secondBatKey->overs[1];
					}
					echo $overs." OV  CRR: ".$value->play->innings->$secondBatKey->score->run_rate;
					?>
					</p>
				</div>
			</div>
			<div class="col-md-3 match_details">
				<div class="series">
					<p>Series: <?php echo $value->tournament->name; ?></p>
				</div>
				<div class="venue">
					<p>Venue: <?php echo $value->venue->name.", ".$value->venue->city.", ".$value->venue->country->name; ?></p>
				</div>
				<div class="datetime">
					<p>Date &amp; Time: <?php echo date("d M y - H:i", substr($value->start_at, 0, 10)); ?></p>
				</div>
			</div>
			<div class="col-md-3 match_link">
				<a href="<?php echo site_url('live-score?key='.$value->key); ?>" target="_blank" class="red_button">Match Centre</a>
			</div>
		</div>
		<?php } ?>
	</div>
</section>
<?php
		}
	}
?>
<script type="text/javascript">
	jQuery(document).ready(function() {  
		setTimeout(function(){
			jQuery('.banner-slider .owl-carousel').owlCarousel({
				loop: true,
				nav: true,
				dots: false,
				autoplay: true,
				autoplayTimeout: 7000,
				items: 1,
				stagePadding: 0,
				singleItem: true,
			});
		}, 500);
	});
</script>