( function( $ ) {


	var hotspotInterval = [];
	var hoverFlag = false;
	var isElEditMode = false;
	window.is_fb_loggedin = false;
	window.is_google_loggedin = false;

	

	/*
	 *
	 * Radio Button Switcher JS Function.
	 *
	 */
	var WidgetptContentToggleHandler = function( $scope, $ ) {

		if ( 'undefined' == typeof $scope ) {
			return;
		}

		var $this           = $scope.find( '.pt-rbs-wrapper' );
		var node_id 		= $scope.data( 'id' );
		var rbs_section_1   = $scope.find( ".pt-rbs-section-1" );
		var rbs_section_2   = $scope.find( ".pt-rbs-section-2" );
		var main_btn        = $scope.find( ".pt-main-btn" );
		var switch_type     = main_btn.attr( 'data-switch-type' );
		var rbs_label_1   	= $scope.find( ".pt-sec-1" );
		var rbs_label_2   	= $scope.find( ".pt-sec-2" );
		var current_class;
		
		switch ( switch_type ) {
			case 'round_1':
				current_class = '.pt-switch-round-1';
				break;
			case 'round_2':
				current_class = '.pt-switch-round-2';
				break;
			case 'rectangle':
				current_class = '.pt-switch-rectangle';
				break;
			case 'label_box':
				current_class = '.pt-switch-label-box';
				break;
			default:
				current_class = 'No Class Selected';
				break;
		}

		var rbs_switch      = $scope.find( current_class );

		if( rbs_switch.is( ':checked' ) ) {
			rbs_section_1.hide();
			rbs_section_2.show();
		} else {
			rbs_section_1.show();
			rbs_section_2.hide();
		}

		rbs_switch.on('click', function(e){
	        rbs_section_1.toggle();
	        rbs_section_2.toggle();
	    });

		/* Label 1 Click */
		rbs_label_1.on('click', function(e){
			// Uncheck
			rbs_switch.prop("checked", false);
			rbs_section_1.show();
			rbs_section_2.hide();

	    });

	    /* Label 2 Click */
		rbs_label_2.on('click', function(e){
			// Check
			rbs_switch.prop("checked", true);
			rbs_section_1.hide();
			rbs_section_2.show();
	    });
	};



	$( window ).on( 'elementor/frontend/init', function () {

		if ( elementorFrontend.isEditMode() ) {
			isElEditMode = true;
		}

		

		elementorFrontend.hooks.addAction( 'frontend/element_ready/pt-content-switcher.default', WidgetptContentToggleHandler );


		if( isElEditMode ) {

			elementor.channels.data.on( 'element:after:duplicate element:after:remove', function( e, arg ) {
				$( '.elementor-widget-pt-ba-slider' ).each( function() {
					WidgetptContentToggleHandler( $( this ), $ );
				} );
			} );
		}

	});

} )( jQuery );
