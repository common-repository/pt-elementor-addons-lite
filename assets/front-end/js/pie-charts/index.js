(function ($) {
    var WidgetLAEPiechartsHandler = function ($scope, $) {
        $scope.find('.pt-piechart .pt-percentage').each(function () {
            var track_color = $(this).data('track-color');
            var bar_color = $(this).data('bar-color');
            $(this).easyPieChart({
                animate: 2000,
                lineWidth: 10,
                barColor: bar_color,
                trackColor: track_color,
                scaleColor: false,
                lineCap: 'square',
                size: 220
            });
        });
    };
	 var WidgetLAEPiechartsHandlerOnScroll = function ($scope, $) {
        $scope.waypoint(function (direction) {
            WidgetLAEPiechartsHandler($(this), $);
        }, {
            offset: $.waypoints('viewportHeight') - 100,
            triggerOnce: true
        });
    };
    // Make sure you run this code under Elementor..
    $(window).on('elementor/frontend/init', function () {
         elementorFrontend.hooks.addAction('frontend/element_ready/Pt-pie-charts.default', WidgetLAEPiechartsHandler);
    });
})(jQuery);