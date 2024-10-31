<div id="license" class="pt-settings-tab <?= (($flag) ? 'active' : '') ?>">
    <div class="row license">
        <div class="col-half">
            <div class="pt-admin-block-wrapper">
            <?php
						do_action( 'add_pt_admin_license_markup' );
					//if ( ! defined( 'PT_PRO_PLUGIN_BASENAME' ) ) :
						?>
            </div><!--admin block-wrapper end-->
        </div>
    </div>
</div>