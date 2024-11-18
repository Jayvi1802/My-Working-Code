<div class="container-fluid">
    

    <form method="post" action="options.php">
        <?php settings_fields('contact-settings-group'); ?>

        <?php // algemene info ?>
        <div class="admin-table">
            <h3 class="customH3">Contact Information - General</h3>
            
            <div class="inputHolder">
                    <div class="lefty">
                        Logo
                    </div>
                    <div class="righty">
            <input class="hidden" type="text" id="image_location" name="home-logo" id="logo_field" value="<?php echo esc_attr( get_option('home-logo') ); ?>">
                        <input data-name="algemeen" class="onetarek-upload-button button" type="button" value="Upload Logo" /><br>

                        <img id="algemeen_logo_show" src="<?php echo esc_attr( get_option('home-logo') ); ?>" alt="">
                    </div>
            </div>
			
			<div class="inputHolder">
                    <div class="lefty">
                        Favicon
                    </div>
                    <div class="righty">
            <input class="hidden" type="text" id="image_location" name="favicon" id="logo_field" value="<?php echo esc_attr( get_option('favicon') ); ?>">
                        <input data-name="algemeen" class="onetarek-upload-button button" type="button" value="Upload Favicon" /><br>

                        <img id="algemeen_logo_show" src="<?php echo esc_attr( get_option('favicon') ); ?>" alt="">
                    </div>
            </div>
			<div class="clear"></div>
            <div class="row">

                <div class="col-xs-12 col-sm-6">
                        <h2>Contact Information</h2>

                        <div class="row">
                            <div class="col-xs-5">
                                E-mail
                            </div>
                            <div class="col-xs-7">
                                <input type="text" name="email" value="<?php echo esc_attr( get_option('email') ); ?>" placeholder="E-mail">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Telephone
                            </div>
                            <div class="col-xs-7">
                                <input type="text" name="telephone" value="<?php echo esc_attr( get_option('telephone') ); ?>" placeholder="Telephone Number">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Address
                            </div>
                            <div class="col-xs-7">
                                <input type="text" name="address1" value="<?php echo esc_attr( get_option('address1') ); ?>" placeholder="Address Line 1">
								<input type="text" name="address2" value="<?php echo esc_attr( get_option('address2') ); ?>" placeholder="Address Line 2">
								<input type="text" name="address3" value="<?php echo esc_attr( get_option('address3') ); ?>" placeholder="Address Line 3">
                            </div>
                        </div>
						
						<div class="row">
                            <div class="col-xs-5">
                                City
                            </div>
                            <div class="col-xs-7">
                                <input type="text" name="city" value="<?php echo esc_attr( get_option('city') ); ?>" placeholder="City">
                            </div>
                        </div>
						
						<div class="row">
                            <div class="col-xs-5">
                                State
                            </div>
                            <div class="col-xs-7">
                                <input type="text" name="state" value="<?php echo esc_attr( get_option('state') ); ?>" placeholder="State">
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-xs-5">
                                postcode
                            </div>
                            <div class="col-xs-7">
                                <input type="text"   name="postcode"  value="<?php echo esc_attr( get_option('postcode') ); ?>" placeholder="postcode">
                                <input type="hidden" name="latitude"  value="">
                                <input type="hidden" name="longitude" value="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Country
                            </div>
                            <div class="col-xs-7">
                                <input type="text" name="country" value="<?php echo esc_attr( get_option('country') ); ?>" placeholder="Country">
                            </div>
                        </div>
                </div>
				
				<div class="col-xs-12 col-sm-6">
                        <h2>Copy Rights</h2>

                        <div class="row">
                            <div class="col-xs-5">
                                
                            </div>
                            <div class="col-xs-7">
								<input type="text" name="copy-rights" value="<?php echo esc_attr( get_option('copy-rights') ); ?>" placeholder="Copy Rights">
                            </div>
                        </div>
                </div>

                <div class="col-xs-12 col-sm-6">
                        <h2>Social Media Options</h2>

                        <?php 
                        $smOptions = explode(',', SOCIAL_MEDIA_OPTIONS);
                        foreach ($smOptions as $channel)  : ?>

                            <div class="row">
                                <div class="col-xs-5">
                                    <?php echo $channel ?> Page URL
                                </div>
                                <div class="col-xs-7">
                                    <input type="text" name="<?php echo $channel ?>" value="<?php echo esc_attr( get_option($channel) ); ?>" placeholder="<?php echo $channel ?> URL">
                                </div>
                            </div>
                        <?php endforeach; ?>
                </div>
				
				<div class="col-xs-12 col-sm-6">
                        <h2>Google Analytics Code</h2>

                        <div class="row">
                            <div class="col-xs-5">
                                
                            </div>
                            <div class="col-xs-7">
								<textarea name="google-analytics-code" placeholder="Google Analytics Code"><?php echo esc_attr( get_option('google-analytics-code') ); ?></textarea>
                            </div>
                        </div>
                </div>
                
				
				<div class="col-xs-12 col-sm-6">
                        <h2>Map</h2>

                        <div class="row">
                            <div class="col-xs-5">
                                
                            </div>
                            <div class="col-xs-7">
								<textarea name="map" placeholder="Map"><?php echo esc_attr( get_option('map') ); ?></textarea>
                            </div>
                        </div>
                </div>
				
				<div class="col-xs-12 col-sm-6">
                        <h2>Inner Page Default Banner</h2>

                        <div class="row">
                            <div class="col-xs-5">
                                
                            </div>
                            <div class="col-xs-7">
								 <input class="hidden" type="text" id="image_location" name="inner-default-banner" id="logo_field" value="<?php echo esc_attr( get_option('inner-default-banner') ); ?>">
                        <input data-name="algemeen" class="onetarek-upload-button button" type="button" value="Upload Banner" /><br>

                        <img id="algemeen_logo_show" src="<?php echo esc_attr( get_option('inner-default-banner') ); ?>" alt="">
                            </div>
                        </div>
                </div>
				
				<div class="col-xs-12 col-sm-6">
                        <h2>Extra Fields</h2>

                        <div class="row">
                            <div class="col-xs-5">
                                Extra Field 1
                            </div>
                            <div class="col-xs-7">
								 <input type="text" name="extra-field1" value="<?php echo esc_attr( get_option('extra-field1') ); ?>" placeholder="Extra Field 1">
                            </div>
                        </div>
						<div class="row">
                            <div class="col-xs-5">
                                Extra Field 2
                            </div>
                            <div class="col-xs-7">
								 <input type="text" name="extra-field2" value="<?php echo esc_attr( get_option('extra-field2') ); ?>" placeholder="Extra Field 2">
                            </div>
                        </div>
						<div class="row">
                            <div class="col-xs-5">
                                Extra Field 3
                            </div>
                            <div class="col-xs-7">
								 <input type="text" name="extra-field3" value="<?php echo esc_attr( get_option('extra-field3') ); ?>" placeholder="Extra Field 3">
                            </div>
                        </div>
						<div class="row">
                            <div class="col-xs-5">
                                Extra Field 4
                            </div>
                            <div class="col-xs-7">
								 <input type="text" name="extra-field4" value="<?php echo esc_attr( get_option('extra-field4') ); ?>" placeholder="Extra Field 4">
                            </div>
                        </div>
						<div class="row">
                            <div class="col-xs-5">
                                Extra Field 5
                            </div>
                            <div class="col-xs-7">
								 <input type="text" name="extra-field5" value="<?php echo esc_attr( get_option('extra-field5') ); ?>" placeholder="Extra Field 5">
                            </div>
                        </div>
						<div class="row">
                            <div class="col-xs-5">
                                Extra Field 6
                            </div>
                            <div class="col-xs-7">
								 <input type="text" name="extra-field6" value="<?php echo esc_attr( get_option('extra-field6') ); ?>" placeholder="Extra Field 6">
                            </div>
                        </div>
						<div class="row">
                            <div class="col-xs-5">
                                Extra Field 7
                            </div>
                            <div class="col-xs-7">
								 <input type="text" name="extra-field7" value="<?php echo esc_attr( get_option('extra-field7') ); ?>" placeholder="Extra Field 7">
                            </div>
                        </div>
						<div class="row">
                            <div class="col-xs-5">
                                Extra Field 8
                            </div>
                            <div class="col-xs-7">
								 <input type="text" name="extra-field8" value="<?php echo esc_attr( get_option('extra-field8') ); ?>" placeholder="Extra Field 8">
                            </div>
                        </div>
						<div class="row">
                            <div class="col-xs-5">
                                Extra Field 9
                            </div>
                            <div class="col-xs-7">
								 <input type="text" name="extra-field9" value="<?php echo esc_attr( get_option('extra-field9') ); ?>" placeholder="Extra Field 9">
                            </div>
                        </div>
						<div class="row">
                            <div class="col-xs-5">
                                Extra Field 10
                            </div>
                            <div class="col-xs-7">
								 <input type="text" name="extra-field10" value="<?php echo esc_attr( get_option('extra-field10') ); ?>" placeholder="Extra Field 10">
                            </div>
                        </div>
                </div>
                
                
                
            </div>
        </div>

      <?php /*?>  <div class="admin-table">
                <h3 class="customH3">Thema opties</h3>
                <?php echo do_action('templateChildInformationOptions'); ?>
        </div><?php */?>

        <?php submit_button(); ?>

    </form>
</div>
<style type="text/css">
input[type="text"], select, textarea {
    width: 100%;
    max-width: 330px;
}
</style>