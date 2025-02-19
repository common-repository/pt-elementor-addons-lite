var FlipCarousel3D = function($scope, $) {
    var $this = $(".pt-flip-carousel", $scope);

    var style = $this.data("style"),
        start = $this.data("start"),
        fadeIn = $this.data("fadein"),
        loop = $this.data("loop"),
        autoplay = $this.data("autoplay"),
        pauseOnHover = $this.data("pauseonhover"),
        spacing = $this.data("spacing"),
        click = $this.data("click"),
        scrollwheel = $this.data("scrollwheel"),
        touch = $this.data("touch"),
        buttons = $this.data("buttons"),
        buttonPrev = $this.data("buttonprev"),
        buttonNext = $this.data("buttonnext");

    $this.flipster({
        style: style,
        start: start,
        fadeIn: fadeIn,
        loop: loop,
        autoplay: autoplay,
        pauseOnHover: pauseOnHover,
        spacing: spacing,
        click: click,
        scrollwheel: scrollwheel,
        tocuh: touch,
        buttons: buttons,
        buttonPrev: '<i class="flip-custom-nav ' + buttonPrev + '"></i>',
        buttonNext: '<i class="flip-custom-nav ' + buttonNext + '"></i>'
    });
};

jQuery(window).on("elementor/frontend/init", function() {
    elementorFrontend.hooks.addAction(
        "frontend/element_ready/pt-flip-carousel.default",
        FlipCarousel3D
    );
});
