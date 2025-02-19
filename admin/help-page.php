<?php
/**
 * Get some constants ready for paths when your plugin grows
 *
 * @author Param Themes
 *
 * @package Get some constants ready for paths when your plugin grows.
 */

	?>
	

<div class="main-h2-heading">
			<?php if (is_plugin_active('pt-elementor-addons-pro/pt-elementor-addons-pro.php')) { ?>
			<h2 class='page-welcome'>PT Elementor <span>Addons Lite/Pro Settings</span></h2>
			<?php } else { ?>
			<h2 class='page-welcome'>PT Elementor <span>Addons Lite Settings</span></h2>
			
			<?php } ?>
			</div>
<div class="wrap">
	<div id="icon-plugins" class="icon32"></div>
	<!-- <h2><?php _e( 'PT Plugin Base', 'ptbase' ); ?></h2> -->

	<div class="pt-help-page">		
		<div class="content alignleft">
			
			<div id="pt-help-content">

					<h3 id="demo"></h3>
					<div class="pt-settings-tabs">
			    	<ul class="pt-tabs">
				      	<li><a href="#elements"><i class="fa fa-cubes"></i> Elements</a></li>
				      	<li><a href="#go-pro"><i class="fa fa-bolt"></i> Go Premium</a></li>
			    	</ul>
			    	<div id="elements" class="pt-settings-tab active">
				      	<div class="row">
					<form id="pt-plugin-base-form" action="options.php" method="POST">
						
				      		<?php settings_fields( 'pt_setting' ); ?>
							<?php  do_settings_sections( 'pt-plugin-base' ); ?>
				      		
							
							
							<input type="submit" id="smbt" class="smbt" value="<?php _e( 'Save', 'ptbase' ); ?>" />
					</form> <!-- end of #pttemplate-form -->
					
					</div>
				      	</div>
				</div>
				<div class="pt-settings-tabs">
					<div id="go-pro" class="pt-settings-tab">
			    		<div class="row go-premium">
			      			<div class="col-half">
			      				<h4>Why upgrade to Premium Version?</h4>
			      				<p>The premium version helps us to continue development of the product incorporating even more features and enhancements.</p>

			      				<p>You will also get world class support from our dedicated team, 24/7.</p>

			      				<a href="#" target="_blank" class="button eael-btn eael-license-btn">Get Premium Version</a>
			      			</div>
			      			<div class="col-half">
			      			
			      			</div>
			      		</div>
			    	</div>
					</div>
			</div>

			<footer class='pt-footer'>
			</footer>

		</div>
		<div class="right">
		<div class="sidebar alignright">
			<h2>Show Your Love! </h2>
			<div class="border-bottom"></div>
			<div class="social-icon">
				<a href="https://www.facebook.com/sharer/sharer.php?u=https%3A//wordpress.org/plugins/pt-elementor-addons-lite/" target="_blank"><i class="fa fa-facebook-square"  aria-hidden="true"></i></a>
				<a href="https://twitter.com/home?status=https%3A//wordpress.org/plugins/pt-elementor-addons-lite/" target="_blank"><i class="fa fa-twitter-square"  aria-hidden="true"></i></a>
				<a href="https://plus.google.com/share?url=https%3A//wordpress.org/plugins/pt-elementor-addons-lite/" target="_blank"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a>
				<a href="https://www.linkedin.com/shareArticle?mini=true&url=https%3A//wordpress.org/plugins/pt-elementor-addons-lite/&title=&summary=&source=" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
				<a href="https://pinterest.com/pin/create/button/?url=&media=https%3A//wordpress.org/plugins/pt-elementor-addons-lite/&description=" target="_blank"><i class="fa fa-pinterest-square" aria-hidden="true"></i></a>
			</div>
		</div>
		<div class="sidebar alignright">
			<h2>Get Support & Follow Us</h2>
			<div class="border-bottom1"></div>
			<div class="social-icon">
				<a href="https://wordpress.org/support/plugin/pt-elementor-addons-lite" target="_blank"><i class="fa fa-wordpress" aria-hidden="true"></i></a>
				<a href="https://www.facebook.com/groups/335254883593121/ " target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
				<a href="https://twitter.com/ParamThemes" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
				
			</div>
			
		</div>
		<div class="sidebar alignright blue">
			<h2>Sign Up & Get Support,Updates & Special Offers</h2>
			<div class="border-bottom2"></div>
			<div class="social-icon">
				<!-- Begin MailChimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
<style type="text/css">
	#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
	/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
	   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup">
<form action="https://paramthemes.us16.list-manage.com/subscribe/post?u=33649b428a1a2da34f85f4b0e&amp;id=2159683b58" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    <div id="mc_embed_signup_scroll">
	
<div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
<div class="mc-field-group">
	<label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
</label>
	<input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
</div>
<p>Powered by <a href="http://eepurl.com/dsNXzD" title="MailChimp - email marketing made easy and fun">MailChimp</a></p>
	<div id="mce-responses" class="clear">
		<div class="response" id="mce-error-response" style="display:none"></div>
		<div class="response" id="mce-success-response" style="display:none"></div>
	</div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_33649b428a1a2da34f85f4b0e_2159683b58" tabindex="-1" value=""></div>
    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
    </div>
</form>
</div>
<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
<!--End mc_embed_signup-->
			</div>
			
		</div>
		</div>
	</div>
	
</div>

<script>

	$( "#smbt" ).click(function() {
	deleteMember();
	});
	function deleteMember() {
		swal({
    title: "Settings Saved!",
    type: "success",
	showCancelButton: false,
  showConfirmButton: false
})
	}
	$( '.pt-tabs li a' ).on( 'click', function(e) {
		e.preventDefault();
		$( '.pt-tabs li a' ).removeClass( 'active' );
		$(this).addClass( 'active' );
		var tab = $(this).attr( 'href' );
		$( '.pt-settings-tab' ).removeClass( 'active' );
		$( '.pt-settings-tabs' ).find( tab ).addClass( 'active' );
	});

	$( '.pt-get-pro' ).on( 'click', function() {
		swal({
	  		title: '<h2><span>Go</span> Premium',
	  		type: 'warning',
	  		html:
	    		'Purchase our <b><a href="#" rel="nofollow">premium version</a></b> to unlock these pro components!',
	  		showCloseButton: true,
	  		showCancelButton: false,
	  		focusConfirm: true,
		});
		
	} );

</script>