<div class="select_tour">Select Tournament</div>
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
			$curl = curl_init();
			$API_TOKEN = $token;
			$ASSOCIATION_KEY = "c.board.acc.a936c"; // ACC
			curl_setopt_array($curl, array(
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

			$response = curl_exec($curl);
			curl_close($curl);
			$response = json_decode($response, true);
			
			if($response && isset($response['data']) && isset($response['data']['tournaments'])){
				$tournaments = $response['data']['tournaments'];
			?>
			<select name="tournament" id="tournament_stats" onchange="updateTable(this)">
			<?php 
				foreach ($tournaments as $tournament) {
					if(isset($tournament['point_system']) && $tournament['point_system'] == 'tournament_based'){
			?>
				<option value="<?php echo $tournament['key'] ?>"><?php echo $tournament['name'] ?></option>
			<?php 	}
				} 
			} 
			?>
			</select>
			<?php 
			if($response && isset($response['data']) && isset($response['data']['tournaments'])){
				$tournaments = $response['data']['tournaments'];
				foreach ($tournaments as $tournament) {
					if(isset($tournament['point_system']) && $tournament['point_system'] == 'tournament_based'){
		
						$curl = curl_init();
						$TOURNAMENT_KEY = $tournament['key'];
						curl_setopt_array($curl, array(
							CURLOPT_URL => "https://api.sports.roanuz.com/v5/cricket/${PROJ_KEY}/tournament/${TOURNAMENT_KEY}/points/",
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
			?>
			<div id="<?php echo $TOURNAMENT_KEY; ?>" style="display: none;" class="resp-table">
				<div id="resp-table-body">
					<div class="resp-table-row first_row"> 
						<div class="table-body-cell">
							Team 
						</div>
						<div class="table-body-cell">
							W 
						</div>
						<div class="table-body-cell">
							L
						</div>
						<div class="table-body-cell">
							NR
						</div>
						<div class="table-body-cell">
							PTS
						</div>
					</div>
					<?php
						$response = curl_exec($curl);
						$response = json_decode($response,true);
						if($response && isset($response['data'])){
							$points = $response['data']['rounds'][0]['groups'][0]['points'];
							if(!empty($points)){
								foreach ($points as $point) {
					?>
					<div class="resp-table-row second_row" id="<?php echo $response['data']['tournament']['key'] ?>">
						<div class="table-body-cell team">
							<?php echo $point['team']['name']; ?>
						</div>
						<div class="table-body-cell won">
							<?php echo $point['won']; ?>
						</div>
						<div class="table-body-cell lost">
							<?php echo $point['lost']; ?>
						</div>
						<div class="table-body-cell net_run_rate">
							<?php echo $point['no_result']; ?>
						</div>
						<div class="table-body-cell points">
							<?php echo $point['points']; ?>
						</div>
					</div>
					<?php		}
							}
							else{
					?>
					<div class="resp-table-row second_row" id="<?php echo $response['data']['tournament']['key'] ?>">
						<p>Points are yet to be updated</p>
					</div>
					<?php
							}
						} 
					?>
				</div>
			</div>
				<?php	}
				}

			}
		}
	}
?>
<script type="text/javascript">
	function updateTable(ele){
		var tournament = jQuery(ele).val();
		jQuery('.resp-table').hide();
		jQuery('#'+tournament).show();
	}

	jQuery( document ).ready(function() {
	    jQuery('#tournament_stats').trigger('change');
	});
</script>