(function ($) {

    var WidgetBlogPostGridHandler = function ($scope, $) {
        if ($().isotope === undefined) {
            return;
        }

        var container = $scope.find('.pt-portfolio');

        if (container.length === 0) {
            return; // no items to filter or load and hence don't continue
        }

        // layout Isotope after all images have loaded

        var htmlContent = $scope.find('.js-isotope');

      

        var isotopeOptions = htmlContent.data('isotope-options');

        $(htmlContent).isotope({
            // options

            itemSelector: isotopeOptions['itemSelector'],

            layoutMode: isotopeOptions['layoutMode']
        });

        /* -------------- Taxonomy Filter --------------- */

        $scope.find('.pt-taxonomy-filter .pt-filter-item a').on('click', function (e) {
            e.preventDefault();

            var selector = $(this).attr('data-value');

            $(container).isotope({ filter: selector });

            $(this)
                .closest('.pt-taxonomy-filter')
                .children()
                .removeClass('pt-active');

            $(this)
                .closest('.pt-filter-item')
                .addClass('pt-active');

            return false;
        });
    };

    // Make sure you run this code under Elementor..

    $(window).on('elementor/frontend/init', function () {
        
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/Pt-blog-post-grid.default',
            WidgetBlogPostGridHandler
        );
    });

})(jQuery);