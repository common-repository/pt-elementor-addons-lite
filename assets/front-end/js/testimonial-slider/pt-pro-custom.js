/**

 * PT Elementor Addons Pro : Custom Javascript code goes here.

 *

 * @Pt Custom Javascript

 * @package Elementor.

 * @summary Custom Javascript code for Elements.

 * Provides some feature.

 *

 * The extra line between the end of the @pt Custom docblock

 * and the file-closure is important.

 */



(function($) {



    var PTTestimonialsSlider = function($scope, $) {



        var slider_elem = $scope.find('.pt-testimonials-slider').eq(0);



        var settings = slider_elem.data('settings');



        slider_elem.flexslider({

            selector: ".pt-slides > .pt-slide",

            animation: settings['slide_animation'],

            direction: settings['slide_direction'],

            slideshowSpeed: settings['slideshow_speed'],

            animationSpeed: settings['animation_speed'],

            namespace: "pt-flex-",

            pauseOnAction: settings['pause_on_action'],

            pauseOnHover: settings['pause_on_hover'],

            controlNav: settings['control_nav'],

            directionNav: settings['direction_nav'],

            prevText: "<span></span>",
            // prevText: "Previous",

            nextText: "<span></span>",

            smoothHeight: false,

            animationLoop: true,

            slideshow: true,

            easing: "swing",

            controlsContainer: "pt-testimonials-slider"

        });

    };



    // Make sure you run this code under Elementor..

    $(window).on('elementor/frontend/init', function() {

        elementorFrontend.hooks.addAction('frontend/element_ready/pt-slider-testimonial.default', PTTestimonialsSlider);

    });



})(jQuery);