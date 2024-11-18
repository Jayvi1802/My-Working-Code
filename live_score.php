<?php
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

if($response)
{
	$result1 = json_decode($response);
	if(is_object($result1))
	{
		$token = $result1->data->token;
		$curl1 = curl_init();
		$API_TOKEN = $token;
		curl_setopt_array($curl1, array(
			CURLOPT_URL => "https://api.sports.roanuz.com/v5/cricket/${PROJ_KEY}/match/${MATCH_KEY}/",
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
		$isLive = $details->data->play->live;
?>
<ul class="nav nav-tabs ulist-css">
	<li class="nav-item active">
	  <a class="nav-link active" data-toggle="tab" href="#home"><?php if(!empty($isLive)) { ?>Live<?php }?> Commentary</a>
	</li>
	<li class="nav-item">
	  <a class="nav-link" data-toggle="tab" href="#scorecard">Scorecard</a>
	</li>
<!-- 	<li class="nav-item">
	  <a class="nav-link" data-toggle="tab" href="#teams">Teams</a>
	</li> -->
</ul>

<!-- Tab panes -->
<div class="tab-content">
	<div id="home" class="container tab-pane active p-0">
		<?php
			if(!empty($isLive)){				
				$match = $details->data->play->live;
				if(!empty($match->match_break)){
		?>
		<div class="container p-0">
			<div class="row">
      			<div class="col-md-12">
					<div class="table-sc-team">
						<p style="text-transform: capitalize;"><?php echo $match->match_break->reason; ?></p>
					</div>
				</div>
			</div>
		</div>
		<?php } else { ?>
		<div class="container p-0">
			<div class="row">
				<div class="col-md-9">
					<div class="table-sc-team">
						<h3>BATTER</h3>
						<div class="resp-table">
							<div id="resp-table-body">
								<div class="resp-table-row first_row"> 
									<div class="table-body-cell">
										Name 
									</div>
									<div class="table-body-cell">
										R 
									</div>
									<div class="table-body-cell">
										B
									</div>
									<div class="table-body-cell">
										4s
									</div>
									<div class="table-body-cell">
										6s
									</div>
									<div class="table-body-cell">
										SR
									</div>
								</div>
								<div class="resp-table-row second_row" id="">
									<div class="table-body-cell striker">
										<?php echo $match->recent_players->striker->name; ?>*
									</div>
									<div class="table-body-cell runs">
										<?php echo $match->recent_players->striker->stats->runs; ?>
									</div>
									<div class="table-body-cell balls">
										<?php echo $match->recent_players->striker->stats->balls; ?>
									</div>
									<div class="table-body-cell fours">
										<?php echo $match->recent_players->striker->stats->fours; ?>
									</div>
									<div class="table-body-cell sixes">
										<?php echo $match->recent_players->striker->stats->sixes; ?>
									</div>
									<div class="table-body-cell strike_rate">
										<?php echo $match->recent_players->striker->stats->strike_rate; ?>
									</div>
								</div>
								<div class="resp-table-row second_row" id="">
									<div class="table-body-cell team border-0">
										<?php echo $match->recent_players->non_striker->name; ?>
									</div>
									<div class="table-body-cell runs border-0">
										<?php echo $match->recent_players->non_striker->stats->runs; ?>
									</div>
									<div class="table-body-cell balls border-0">
										<?php echo $match->recent_players->non_striker->stats->balls; ?>
									</div>
									<div class="table-body-cell fours border-0">
										<?php echo $match->recent_players->non_striker->stats->fours; ?>
									</div>
									<div class="table-body-cell sixes border-0">
										<?php echo $match->recent_players->non_striker->stats->sixes; ?>
									</div>
									<div class="table-body-cell strike_rate border-0">
										<?php echo $match->recent_players->striker->stats->strike_rate; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- second table -->
					<div class="table-sc-team">
						<h3>BOWLER</h3>
						<div class="resp-table">
							<div id="resp-table-body">
								<div class="resp-table-row first_row"> 
									<div class="table-body-cell">
										Name 
									</div>
									<div class="table-body-cell">
										O 
									</div>
									<div class="table-body-cell">
										M
									</div>
									<div class="table-body-cell">
										R
									</div>
									<div class="table-body-cell">
										W
									</div>
									<div class="table-body-cell">
										ECO
									</div>
								</div>
								<div class="resp-table-row second_row" id="">
									<div class="table-body-cell bowler">
										<?php echo $match->recent_players->bowler->name; ?>*
									</div>
									<div class="table-body-cell overs">
										<?php 
											if(empty($match->recent_players->bowler->stats->overs[1])){
												echo $match->recent_players->bowler->stats->overs[0];
											}
											else{
												echo $match->recent_players->bowler->stats->overs[0].".".$match->recent_players->bowler->stats->overs[1];
											} 
										?>
									</div>
									<div class="table-body-cell maidens">
										<?php echo $match->recent_players->bowler->stats->maiden_overs; ?>
									</div>
									<div class="table-body-cell runs">
										<?php echo $match->recent_players->bowler->stats->runs; ?>
									</div>
									<div class="table-body-cell wicket">
										<?php echo $match->recent_players->bowler->stats->wickets; ?>
									</div>
									<div class="table-body-cell economy">
										<?php echo $match->recent_players->bowler->stats->economy; ?>
									</div>
								</div>
								<div class="resp-table-row second_row" id="">
									<div class="table-body-cell prev_bowler border-0">
										<?php echo $match->recent_players->prev_over_bowler->name; ?>
									</div>
									<div class="table-body-cell overs border-0">
										<?php echo $match->recent_players->prev_over_bowler->stats->overs[0]; ?>
									</div>
									<div class="table-body-cell maidens border-0">
										<?php echo $match->recent_players->prev_over_bowler->stats->maiden_overs; ?>
									</div>
									<div class="table-body-cell runs border-0">
										<?php echo $match->recent_players->prev_over_bowler->stats->runs; ?>
									</div>
									<div class="table-body-cell wickets border-0">
										<?php echo $match->recent_players->prev_over_bowler->stats->wickets; ?>
									</div>
									<div class="table-body-cell economy border-0">
										<?php echo $match->recent_players->prev_over_bowler->stats->economy; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<ul class="recent-list">
						<li class='p-0'>
							<strong>Recent:</strong>
						</li>
						<?php
							foreach($match->recent_overs_repr as $key => $value){
								$over = count($value->ball_repr);
								foreach($value->ball_repr as $k => $v){
									if(strpos($v, 'r') !== false){
										echo "<li> ".preg_replace('/\D/', '', $v)." </li>";
									}
									else if(strpos($v, 'b') !== false){
										echo "<li> ".preg_replace('/\D/', '', $v)." </li>";
									}
									else if(strpos($v, 'w') !== false){
										echo "<li> W </li>";
									}
								}
								if($over){
									echo "<li>  |  </li>";
								}
							}
						?>
					</ul>
      			</div>
      			<div class="col-md-3 p-0">
      				<div class="resp-table">
						<div>
							<div class="resp-table-row first_row mb-with"> 
								<div class="table-body-cell">
									Key Stats 
								</div>
							</div>
							<div class="resp-table-row second_row mb-with" id="">
								<div class="table-body-cell team prag-ct mb-with">
									<p><span>Partnerships:</span>7(17)</p>
									<br>
									<p><span>Last Wkt:</span>Mary Waldron</p>
									<p>lbw b Nadine de Klerk</p>
									<p>5(18 - 14/4 in 11.1 ov.)</p>
									<p><span>Last 5 overs:</span>8 runs, 1 wkts</p>
									<br>
									<p><span>Toss:</span>Ireland Women</p>
									<p>(Batting)</p>
								</div>
							</div>
						</div>
					</div>
      			</div>
			</div>
		</div>
		<!-- //////////// -->
		<div class="container">
			<div class="row">
				<div class="col-md-12 p-0">
					<h2 class="ind-live-sc">INDIA - 1st Innings - LIVE</h2>
				</div>
				<div class="col-md-12 p-0">
					<ul class="d-flex-livesc list-score-ct">
						<?php 
							$commentary = $details->data->play->related_balls;
							foreach($commentary as $value){
						?>
						<li>
							<div>
								<h5><?php echo $value->overs[0].".".$value->overs[1]; ?></h5>
								<h6>
									<span>
									<?php 
										if($value->team_score->is_wicket != ""){
											echo "W";
										}
										else{
											echo $value->team_score->runs;
										}
									?>
									</span>
								</h6>
							</div>
							<div>
								<p><?php echo $value->comment; ?></p>
							</div>
						</li>
						<?php } ?>
					</ul>
				</div>
				<div class="col-md-12 end-over-match">
					<div class="score-bd">
						<h5>END OF OVER 13</h5>
						<ul>
							<li>0</li>
							<li>0</li>
							<li>1</li>
							<li>4</li>
							<li>0</li>
							<li>0</li>
						</ul>
						<h4>Projected score for Ireland : 76 @ 1.54 PRO</h4>
					</div>

					<div class="score-mt">
						<p>IREw <span>20/4</span></p>
					</div>
				</div>
				<div class="col-md-12 end-over-match">
					<ul class="sc-player-ct">
						<li>
							<span>IREw Batting</span>
							<h3>sm kAVANAGH, 8 (21) S Machon, 2 (7)</h3>
						</li>
						<li>
							<span>SAw Bowling</span>
							<h3>A KHAKA, 5-3-6-1</h3>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<?php
				}	
			}else{
				$inningsOrder = $details->data->play->innings_order;
				$firstBat = explode("_", $inningsOrder[0]);
				$firstBatkey = $firstBat[0];
				$secondBat = explode("_", $inningsOrder[1]);
				$secondBatkey = $secondBat[0];
		?>
		<div class="container p-0">
			<div class="row">
				<div class="col-md-12">
					<div class="table-sc-team">
						<div class="resp-table">
							<?php
								$firstInning = $inningsOrder[0];
								$secondInning = $inningsOrder[1];
								$firstBatScore = $details->data->play->innings->$firstInning->score_str; 
								$firstBatTeam = $details->data->teams->$firstBatkey->code;
								$secondBatScore = $details->data->play->innings->$secondInning->score_str;
								$secondBatTeam = $details->data->teams->$secondBatkey->code;
							?>
							<h4 class="first-bat"><?php echo $firstBatTeam." - ".$firstBatScore; ?></h4>
							<h4 class="second-bat"><?php echo $secondBatTeam." - ".$secondBatScore; ?></h4>
							<div class="match-result">
								<p><?php echo $details->data->play->result->msg; ?></p>
								<div class="pom">
									<h6>Player of the Match</h6>
									<p>
									<?php
										$pomKey = $details->data->play->result->pom;
										if(count($pomKey) > 1){
											
										}
										else{
											if(empty($pomKey[0])){
												echo "-";
											}
											else{
												$playerKey = $pomKey[0];
												$playerName = $details->data->players->$playerKey->player->name;
												echo $playerName;	
											}
										} 
									?>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- //////////// -->
		<div class="container p-0">
			<div class="row">
				<div class="col-md-12 p-0">
					<ul class="d-flex-livesc list-score-ct">
						<?php 
							$commentary = $details->data->play->related_balls;
							foreach($commentary as $value){
						?>
						<li>
							<div>
								<h5><?php echo $value->overs[0].".".$value->overs[1]; ?></h5>
								<h6>
									<span>
									<?php 
										if($value->team_score->is_wicket != ""){
											echo "W";
										}
										else{
											echo $value->team_score->runs;
										}
									?>
									</span>
								</h6>
							</div>
							<div>
								<p><?php echo $value->comment; ?></p>
							</div>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
		<?php
			}
		?>
	</div>
	<div id="scorecard" class="container tab-pane fade">
		<div class="container p-0">
			<div class="row">
				<?php
					if(empty($isLive)){
						$firstBatTeam = $details->data->teams->$firstBatkey->name;
						$secondBatTeam = $details->data->teams->$secondBatkey->name;
				?>
      			<div class="col-md-12">
					<p><?php echo $details->data->play->result->msg; ?></p>
					<div class="table-sc-team">
						<h3><?php echo $firstBatTeam." Innings"; ?> <span class="pull-right"><?php echo $firstBatScore; ?></span></h3>
						<div class="resp-table">
							<div id="resp-table-body">
								<div class="resp-table-row first_row"> 
									<div class="table-body-cell">
										Batter 
									</div>
									<div class="table-body-cell">
										R 
									</div>
									<div class="table-body-cell">
										B
									</div>
									<div class="table-body-cell">
										4s
									</div>
									<div class="table-body-cell">
										6s
									</div>
									<div class="table-body-cell">
										SR
									</div>
								</div>
								<?php
									$firstBattingOrder = $details->data->play->innings->$firstInning->batting_order;
									foreach($firstBattingOrder as $v){
								?>
								<div class="resp-table-row second_row" id="">
									<div class="table-body-cell striker">
										<?php echo $details->data->players->$v->player->name; ?>
										<span class="dismissal">
											<?php echo $details->data->players->$v->score->{'1'}->batting->dismissal->msg; ?>
										</span>
									</div>
									<div class="table-body-cell runs">
										<?php echo $details->data->players->$v->score->{'1'}->batting->score->runs; ?>
									</div>
									<div class="table-body-cell balls">
										<?php echo $details->data->players->$v->score->{'1'}->batting->score->balls; ?>
									</div>
									<div class="table-body-cell fours">
										<?php echo $details->data->players->$v->score->{'1'}->batting->score->fours; ?>
									</div>
									<div class="table-body-cell sixes">
										<?php echo $details->data->players->$v->score->{'1'}->batting->score->sixes; ?>
									</div>
									<div class="table-body-cell strike_rate">
										<?php echo $details->data->players->$v->score->{'1'}->batting->score->strike_rate; ?>
									</div>
								</div>
								<?php } ?>
								<div class="resp-table-row extras">
									<div class="table-body-cell">
										Extras
									</div>
									<div class="table-body-cell">
										<?php
											$extras = $details->data->play->innings->$firstInning->extra_runs->extra;
											$bye = $details->data->play->innings->$firstInning->extra_runs->bye;
											$leg_bye = $details->data->play->innings->$firstInning->extra_runs->leg_bye;
											$wide = $details->data->play->innings->$firstInning->extra_runs->wide;
											$no_ball = $details->data->play->innings->$firstInning->extra_runs->no_ball;
											$penalty = $details->data->play->innings->$firstInning->extra_runs->penalty;
											
											// Print String
											echo $extras." (b ".$bye.", lb ".$leg_bye.", w ".$wide.", nb ".$no_ball.", p ".$penalty.")";
										?>
									</div>
								</div>
								<div class="resp-table-row total">
									<div class="table-body-cell">
										Total
									</div>
									<div class="table-body-cell">
										<?php 
											$runs = $details->data->play->innings->$firstInning->score->runs;
											$wickets = $details->data->play->innings->$firstInning->score->runs;
											if(empty($details->data->play->innings->$firstInning->overs[1])){
												$overs = $details->data->play->innings->$firstInning->overs[0];
											}
											else{
												$overs = $details->data->play->innings->$firstInning->overs[0].".".$details->data->play->innings->$firstInning->overs[1];
											}
											
											// Print String
											echo $runs." (".$bye." wkts, ".$overs." Ov)";
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- second table -->
					<div class="table-sc-team">
						<div class="resp-table">
							<div id="resp-table-body">
								<div class="resp-table-row first_row"> 
									<div class="table-body-cell">
										Bowler 
									</div>
									<div class="table-body-cell">
										O 
									</div>
									<div class="table-body-cell">
										M
									</div>
									<div class="table-body-cell">
										R
									</div>
									<div class="table-body-cell">
										W
									</div>
									<div class="table-body-cell">
										ECO
									</div>
								</div>
								<?php
									$firstBowlingOrder = $details->data->play->innings->$firstInning->bowling_order;
									foreach($firstBowlingOrder as $v){
								?>
								<div class="resp-table-row second_row" id="">
									<div class="table-body-cell bowler">
										<?php echo $details->data->players->$v->player->name; ?>
									</div>
									<div class="table-body-cell overs">
										<?php
											if(empty($details->data->players->$v->score->{'1'}->bowling->score->overs[1])){
												echo $details->data->players->$v->score->{'1'}->bowling->score->overs[0];
											}
											else{
												echo $details->data->players->$v->score->{'1'}->bowling->score->overs[0].".".$details->data->players->$v->score->{'1'}->bowling->score->overs[1];
											}
										?>
									</div>
									<div class="table-body-cell maidens">
										<?php echo $details->data->players->$v->score->{'1'}->bowling->score->maiden_overs; ?>
									</div>
									<div class="table-body-cell runs">
										<?php echo $details->data->players->$v->score->{'1'}->bowling->score->runs; ?>
									</div>
									<div class="table-body-cell wicket">
										<?php echo $details->data->players->$v->score->{'1'}->bowling->score->wickets; ?>
									</div>
									<div class="table-body-cell economy">
										<?php echo $details->data->players->$v->score->{'1'}->bowling->score->economy; ?>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="table-sc-team">
						<h3><?php echo $secondBatTeam." Innings"; ?> <span class="pull-right"><?php echo $secondBatScore; ?></span></h3>
						<div class="resp-table">
							<div id="resp-table-body">
								<div class="resp-table-row first_row"> 
									<div class="table-body-cell">
										Batter 
									</div>
									<div class="table-body-cell">
										R 
									</div>
									<div class="table-body-cell">
										B
									</div>
									<div class="table-body-cell">
										4s
									</div>
									<div class="table-body-cell">
										6s
									</div>
									<div class="table-body-cell">
										SR
									</div>
								</div>
								<?php
									$secondBattingOrder = $details->data->play->innings->$secondInning->batting_order;
									foreach($secondBattingOrder as $v){
								?>
								<div class="resp-table-row second_row" id="">
									<div class="table-body-cell striker">
										<?php echo $details->data->players->$v->player->name; ?>
										<span class="dismissal">
											<?php echo $details->data->players->$v->score->{'1'}->batting->dismissal->msg; ?>
										</span>
									</div>
									<div class="table-body-cell runs">
										<?php echo $details->data->players->$v->score->{'1'}->batting->score->runs; ?>
									</div>
									<div class="table-body-cell balls">
										<?php echo $details->data->players->$v->score->{'1'}->batting->score->balls; ?>
									</div>
									<div class="table-body-cell fours">
										<?php echo $details->data->players->$v->score->{'1'}->batting->score->fours; ?>
									</div>
									<div class="table-body-cell sixes">
										<?php echo $details->data->players->$v->score->{'1'}->batting->score->sixes; ?>
									</div>
									<div class="table-body-cell strike_rate">
										<?php echo $details->data->players->$v->score->{'1'}->batting->score->strike_rate; ?>
									</div>
								</div>
								<?php } ?>
								<div class="resp-table-row extras">
									<div class="table-body-cell">
										Extras
									</div>
									<div class="table-body-cell">
										<?php
											$extras = $details->data->play->innings->$secondInning->extra_runs->extra;
											$bye = $details->data->play->innings->$secondInning->extra_runs->bye;
											$leg_bye = $details->data->play->innings->$secondInning->extra_runs->leg_bye;
											$wide = $details->data->play->innings->$secondInning->extra_runs->wide;
											$no_ball = $details->data->play->innings->$secondInning->extra_runs->no_ball;
											$penalty = $details->data->play->innings->$secondInning->extra_runs->penalty;
											
											// Print String
											echo $extras." (b ".$bye.", lb ".$leg_bye.", w ".$wide.", nb ".$no_ball.", p ".$penalty.")";
										?>
									</div>
								</div>
								<div class="resp-table-row total">
									<div class="table-body-cell">
										Total
									</div>
									<div class="table-body-cell">
										<?php 
											$runs = $details->data->play->innings->$secondInning->score->runs;
											$wickets = $details->data->play->innings->$secondInning->score->runs;
											if(empty($details->data->play->innings->$secondInning->overs[1])){
												$overs = $details->data->play->innings->$secondInning->overs[0];
											}
											else{
												$overs = $details->data->play->innings->$secondInning->overs[0].".".$details->data->play->innings->$secondInning->overs[1];
											}
											
											// Print String
											echo $runs." (".$bye." wkts, ".$overs." Ov)";
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="fow">
						
					</div>
					<!-- second table -->
					<div class="table-sc-team">
						<div class="resp-table">
							<div id="resp-table-body">
								<div class="resp-table-row first_row"> 
									<div class="table-body-cell">
										Bowler 
									</div>
									<div class="table-body-cell">
										O 
									</div>
									<div class="table-body-cell">
										M
									</div>
									<div class="table-body-cell">
										R
									</div>
									<div class="table-body-cell">
										W
									</div>
									<div class="table-body-cell">
										ECO
									</div>
								</div>
								<?php
									$secondBowlingOrder = $details->data->play->innings->$secondInning->bowling_order;
									foreach($secondBowlingOrder as $v){
								?>
								<div class="resp-table-row second_row" id="">
									<div class="table-body-cell bowler">
										<?php echo $details->data->players->$v->player->name; ?>
									</div>
									<div class="table-body-cell overs">
										<?php
											if(empty($details->data->players->$v->score->{'1'}->bowling->score->overs[1])){
												echo $details->data->players->$v->score->{'1'}->bowling->score->overs[0];
											}
											else{
												echo $details->data->players->$v->score->{'1'}->bowling->score->overs[0].".".$details->data->players->$v->score->{'1'}->bowling->score->overs[1];
											}
										?>
									</div>
									<div class="table-body-cell maidens">
										<?php echo $details->data->players->$v->score->{'1'}->bowling->score->maiden_overs; ?>
									</div>
									<div class="table-body-cell runs">
										<?php echo $details->data->players->$v->score->{'1'}->bowling->score->runs; ?>
									</div>
									<div class="table-body-cell wicket">
										<?php echo $details->data->players->$v->score->{'1'}->bowling->score->wickets; ?>
									</div>
									<div class="table-body-cell economy">
										<?php echo $details->data->players->$v->score->{'1'}->bowling->score->economy; ?>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
      			</div>
				<?php
					}
				?>
			</div>
		</div>
	</div>
</div>
<?php
	} 
}
?>