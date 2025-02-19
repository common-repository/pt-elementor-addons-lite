

var PTImageComparisonHandler = function($scope, $) {
	var $containerID  = $scope.find(".pt-img-comp-container").eq(0),
	    $offset       = $containerID.data("offset"),
	    $orientation  = $containerID.data("orientation"),
	    $beforeLabel  = $containerID.data("before_label"),
	    $afterLabel   = $containerID.data("after_label"),
	    $overlay      = $containerID.data("overlay"),
	    $slideOnHover = $containerID.data("onhover"),
		$slideOnClick = $containerID.data("onclick");
	
	$containerID.twentytwenty({
		default_offset_pct   : $offset || 0.7,
		orientation          : $orientation || "horizontal",
		before_label         : $beforeLabel || "Before",
		after_label          : $afterLabel || "After",
		no_overlay           : $overlay == "yes" ? false    : true,
		move_slider_on_hover : $slideOnHover == "yes" ? true: false,
		move_with_handle_only: true,
		click_to_move        : $slideOnClick == "yes" ? true: false
	});
};


jQuery(window).on("elementor/frontend/init", function() {
	elementorFrontend.hooks.addAction(
		"frontend/element_ready/pt-img-compare.default",
		PTImageComparisonHandler
	);
});
