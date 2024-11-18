<?php 
	$args = array(
	  'post_type' => 'partners' ,
	  'posts_per_page' => 30
	); 
	$q = new WP_Query($args);
	$posts = ($q->posts);
?>

<div class="partner_section">
	<h2 class="partner">Our partners</h2>
	<ul>
	<?php  
		if(is_array($posts) && count($posts)) {
			for($i=0 ; $i<count($posts) ; $i++) {
	?>
		<li><img src="<?php echo $field = get_field( 'partner_logo', $posts[$i]->ID ); ?>" alt="<?php echo $posts[$i]->post_title ; ?>"></li>
	<?php } 
			} 
			else 
			{
				echo "No Partners found.";
			}
	?>
	</ul>
</div>

<?php 
	$args = array(
	  'post_type' => 'brodcastpartners' ,
	  'posts_per_page' => 30
	); 
	$q = new WP_Query($args);
	$posts = ($q->posts);
?>
<div class="brodcast_partners">
<h2 class="broadcast_partner">Broadcast partners</h2>
	<ul>
	<?php  
		if(is_array($posts) && count($posts)) {
			for($i=0 ; $i<count($posts) ; $i++) {
	?>
		<li><img  src="<?php echo $field = get_field( 'broadcast_partners_logo', $posts[$i]->ID ); ?>" alt="<?php echo $posts[$i]->post_title ; ?>"></li>
	<?php }
			}
			else
			{
				echo "No Broadcast Partners found.";
			}
	?>
	</ul>
</div>