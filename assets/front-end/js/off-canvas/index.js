/*=================================*/
/* 35. Pricing Tooltip
/*=================================*/

(function($) {

	window.PTOffcanvasContent = function( $scope ) {
		
		this.node                 = $scope;
		this.wrap                 = $scope.find('.pt-offcanvas-content-wrap');
		this.content              = $scope.find('.pt-offcanvas-content');
		this.button               = $scope.find('.pt-offcanvas-toggle');
		this.settings             = this.wrap.data('settings');
		this.id                   = this.settings.content_id;
		this.transition           = this.settings.transition;
		this.esc_close            = this.settings.esc_close;
		this.body_click_close     = this.settings.body_click_close;
		this.direction            = this.settings.direction;
		this.duration             = 500;

		this.destroy();
		this.init();
	};

	PTOffcanvasContent.prototype = {
		id: '',
		node: '',
		wrap: '',
		content: '',
		button: '',
		settings: {},
		transition: '',
		duration: 400,
		initialized: false,
		animations: [
			'slide',
			'slide-along',
			'reveal',
			'push',
		],

		init: function () {
			if ( ! this.wrap.length ) {
				return;
			}

			$('html').addClass('pt-offcanvas-content-widget');

			if ( $('.pt-offcanvas-container').length === 0 ) {
				if ( 'push' === this.transition ) {
					$('body').prepend( this.content );
					$('body').wrapInner( '<div class="pt-offcanvas-container" />' );
				} else {
					$('body').wrapInner( '<div class="pt-offcanvas-container" />' );
					this.content.insertBefore('.pt-offcanvas-container');
				}
			}

			if ( this.wrap.find('.pt-offcanvas-content').length > 0 ) {
				if ( 'push' === this.transition ) {
					if ( $('.pt-offcanvas-container > .pt-offcanvas-content-' + this.id).length > 0 ) {
						$('.pt-offcanvas-container > .pt-offcanvas-content-' + this.id).remove();
					}
					$('.pt-offcanvas-container').prepend( this.wrap.find('.pt-offcanvas-content') );
				} else {
					if ( $('.pt-offcanvas-container > .pt-offcanvas-content-' + this.id).length > 0 ) {
						$('.pt-offcanvas-container > .pt-offcanvas-content-' + this.id).remove();
					}
					if ( $('body > .pt-offcanvas-content-' + this.id ).length > 0 ) {
						$('body > .pt-offcanvas-content-' + this.id ).remove();
					}
					$('body').prepend( this.wrap.find('.pt-offcanvas-content') );
				}
			}

			this.bindEvents();
		},

		destroy: function() {
			this.close();

			this.animations.forEach(function( animation ) {
				if ( $('html').hasClass( 'pt-offcanvas-content-' + animation ) ) {
					$('html').removeClass( 'pt-offcanvas-content-' + animation )
				}
			});

			if ( $('body > .pt-offcanvas-content-' + this.id ).length > 0 ) {
				//$('body > .pt-offcanvas-content-' + this.id ).remove();
			}
		},

		bindEvents: function () {
			this.button.on('click', $.proxy( this.toggleContent, this ));

			$('body').delegate( '.pt-offcanvas-content .pt-offcanvas-close', 'click', $.proxy( this.close, this ) );

            if ( this.esc_close === 'yes' ) {
                this.closeESC();
            }
            if ( this.body_click_close === 'yes' ) {
                this.closeClick();
            }
		},

		toggleContent: function() {
			if ( ! $('html').hasClass('pt-offcanvas-content-open') ) {
				this.show();
			} else {
				this.close();
			}
		},

		show: function() {
			$('.pt-offcanvas-content-' + this.id).addClass('pt-offcanvas-content-visible');
			// init animation class.
			$('html').addClass( 'pt-offcanvas-content-' + this.transition );
			$('html').addClass( 'pt-offcanvas-content-' + this.direction );
			$('html').addClass('pt-offcanvas-content-open');
			$('html').addClass('pt-offcanvas-content-' + this.id + '-open');
			$('html').addClass('pt-offcanvas-content-reset');
		},

		close: function() {
			$('html').removeClass('pt-offcanvas-content-open');
			$('html').removeClass('pt-offcanvas-content-' + this.id + '-open');
			setTimeout($.proxy(function () {
				$('html').removeClass('pt-offcanvas-content-reset');
				$('html').removeClass( 'pt-offcanvas-content-' + this.transition );
                $('html').removeClass( 'pt-offcanvas-content-' + this.direction );
				$('.pt-offcanvas-content-' + this.id).removeClass('pt-offcanvas-content-visible');
			}, this), 500);
		},

		closeESC: function() {
			var self = this;

			if ( '' === self.settings.esc_close ) {
				return;
			}

			// menu close on ESC key
			$(document).on('keydown', function (e) {
				if (e.keyCode === 27) { // ESC
					self.close();
				}
			});
		},

		closeClick: function() {
			var self = this;

			$(document).on('click', function(e) {
				if ( $(e.target).is('.pt-offcanvas-content') || $(e.target).parents('.pt-offcanvas-content').length > 0 || $(e.target).is('.pt-offcanvas-toggle') || $(e.target).parents('.pt-offcanvas-toggle').length > 0 ) {
					return;
				} else {
					self.close();
				}
			});
		}
	};

})(jQuery);

var PTOffcanvas = function($scope, $) {
	new window.PTOffcanvasContent($scope);
};
jQuery(window).on("elementor/frontend/init", function() {
	elementorFrontend.hooks.addAction(
		"frontend/element_ready/pt-off-canvas.default",
		PTOffcanvas
	);
});

