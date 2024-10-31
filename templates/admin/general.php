<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/fontawesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div id="general" class="pt-settings-tab <?php echo ( ( $flag ) ? '' : 'active' ); ?>">
	<div class="row pt-admin-general-wrapper">
		<div class="pt-admin-general-inner">
			<div class="pt-admin-block-wrapper">
					<?php
						//do_action( 'add_admin_license_markup' );
					?>
					<div class="pt-admin-block pt-admin-block-banner">
							<h1><a href="http://www.paramthemes.com/" target="_blank">PT ADDONS FOR ELEMENTOR</a></h1>
							<h4>FOR ELEMENTOR</h4>
							<p>A <strong>Unique</strong> and <strong>Fast Loading</strong> Library of Elements for Elementor, <br /> Helps to build <strong>stunning websites</strong> in <strong>LESSER</strong> Time</p>
					</div><!--preview image end-->
					<!-- <div class="pt-admin-block pt-admin-block-support">
						<header class="pt-admin-block-header">
							<div class="pt-admin-block-header-icon">
								<img src="<?php echo PT_PLUGIN_URL . 'assets/admin/images/help.svg'; ?>" alt="pt-addons-get-help">
							</div>
							<h4 class="pt-admin-title"><?php _e( 'Need Help?', 'pt-addons-elementor' ); ?></h4>
						</header>
						<div class="pt-admin-block-content">
						<div class="sidebar alignright blue">
												<h1 style="text-align: center;color:#fff">Sign Up & Get Support,Updates & Special Offers</h1>
												<div class="border-bottom2"></div>
												<div class="social-icon"></div>
						</div>
					</div>
					</div>-->

					<div class="pt-admin-block pt-admin-block-contribution">
						<header class="pt-admin-block-header">
							<div class="pt-admin-block-header-icon">
								<img src="<?php echo PT_PLUGIN_URL . 'assets/admin/images/customer-support.svg'; ?>" alt="">
							</div>
							<h4 class="pt-admin-title"><?php _e( 'Get Support & Follow Us', 'pt-addons-elementor' ); ?></h4>
						</header>
						<div class="pt-admin-block-content">
							<div class="social-icon">
								<a href="https://wordpress.org/support/plugin/pt-addons-for-elementor" target="_blank"><i class="fa-brands fa-wordpress"></i></i></a>
								<a href="https://www.facebook.com/groups/335254883593121/ " target="_blank"><i class="fa-brands fa-facebook-square"></i></a>
								<a href="https://twitter.com/v2_websolutions" target="_blank"><i class="fa-brands fa-twitter-square" ></i></a>

							</div>
						</div>
					</div>

					<div class="pt-admin-block pt-admin-block-review">
						<header class="pt-admin-block-header">
							<div class="pt-admin-block-header-icon">
								<img src="<?php echo PT_PLUGIN_URL . 'assets/admin/images/heart.svg'; ?>" alt="rate-pt-addons">
							</div>
							<h4 class="pt-admin-title"><?php _e( 'Show your Love', 'pt-addons-elementor' ); ?></h4>
						</header>
						<div class="pt-admin-block-content">
							<div class="social-icon">
								<a href="https://www.facebook.com/sharer/sharer.php?u=https%3A//wordpress.org/plugins/pt-addons-for-elementor/" target="_blank"><i class="fa-brands fa-facebook-square"></i></a>
								<a href="https://twitter.com/home?status=https%3A//wordpress.org/plugins/pt-addons-for-elementor/" target="_blank"><i class="fa-brands fa-twitter-square"></i></a>
								<a href="https://www.linkedin.com/shareArticle?mini=true&url=https%3A//wordpress.org/plugins/pt-addons-for-elementor/&title=&summary=&source=" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
								<a href="https://pinterest.com/pin/create/button/?url=&media=https%3A//wordpress.org/plugins/pt-addons-for-elementor/&description=" target="_blank"><i class="fa-brands fa-pinterest-square"></i></a>
							</div>
						</div>
					</div>

			</div><!--admin block-wrapper end-->
		</div>

		<div class="pt-admin-sidebar">
			<div class="pt-sidebar-block">
				<div class="pt-admin-sidebar-logo">
					<img src="<?php echo PT_PLUGIN_URL . '/assets/admin/images/pt-elelmentor-addon-logo.png'; ?>" alt="pt-addons-for-elementor">
				</div>
				<!-- <div class="pt-admin-sidebar-cta">
					<?php
					if ( ! defined( 'PT_PRO_PLUGIN_BASENAME' ) ) {
						printf( __( '<a href="%s" target="_blank">Upgrade to Pro</a>', 'pt-addons-elementor' ), 'http://www.paramthemes.com' );
					} else {
						do_action( 'pt_manage_license_action_link' );
					}
					?>
				</div> -->
			</div>
		</div>


	</div><!--Row end-->

</div>
