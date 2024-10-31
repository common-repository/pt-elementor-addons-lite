/*=================================*/
/* 38. Advanced Menu
	/*=================================*/
	var AdvancedMenu = function($scope, $) {
		var $indicator_class = $(".pt-advanced-menu-container", $scope).data(
			"indicator-class"
		);
		var $dropdown_indicator_class = $(
			".pt-advanced-menu-container",
			$scope
		).data("dropdown-indicator-class");
		var $horizontal = $(".pt-advanced-menu", $scope).hasClass(
			"pt-advanced-menu-horizontal"
		);
	
		if ($horizontal) {
			// insert indicator
			$(".pt-advanced-menu > li.menu-item-has-children", $scope).each(
				function() {
					$("> a", $(this)).append(
						'<span class="' + $indicator_class + '"></span>'
					);
				}
			);
			$(".pt-advanced-menu > li ul li.menu-item-has-children", $scope).each(
				function() {
					$("> a", $(this)).append(
						'<span class="' + $dropdown_indicator_class + '"></span>'
					);
				}
			);
	
			// insert responsive menu toggle, text
			$(".pt-advanced-menu-horizontal", $scope)
				.before('<span class="pt-advanced-menu-toggle-text"></span>')
				.after(
					'<button class="pt-advanced-menu-toggle"><span class="eicon-menu-bar"></span></button>'
				);
	
			// responsive menu slide
			$(".pt-advanced-menu-container", $scope).on(
				"click",
				".pt-advanced-menu-toggle",
				function(e) {
					e.preventDefault();
					$(this)
						.siblings(".pt-advanced-menu-horizontal")
						.css("display") == "none"
						? $(this)
								.siblings(".pt-advanced-menu-horizontal")
								.slideDown(300)
						: $(this)
								.siblings(".pt-advanced-menu-horizontal")
								.slideUp(300);
				}
			);
	
			// clear responsive props
			$(window).on("resize load", function() {
				if (window.matchMedia("(max-width: 991px)").matches) {
					$(".pt-advanced-menu-horizontal", $scope).addClass(
						"pt-advanced-menu-responsive"
					);
					$(".pt-advanced-menu-toggle-text", $scope).text(
						$(
							".pt-advanced-menu-horizontal .current-menu-item a",
							$scope
						)
							.eq(0)
							.text()
					);
				} else {
					$(".pt-advanced-menu-horizontal", $scope).removeClass(
						"pt-advanced-menu-responsive"
					);
					$(
						".pt-advanced-menu-horizontal, .pt-advanced-menu-horizontal ul",
						$scope
					).css("display", "");
				}
			});
		}
	
		$(".pt-advanced-menu > li.menu-item-has-children", $scope).each(
			function() {
				// indicator position
				var $height = parseInt($("a", this).css("line-height")) / 2;
				$(this).append(
					'<span class="pt-advanced-menu-indicator ' +
						$indicator_class +
						'" style="top:' +
						$height +
						'px"></span>'
				);
	
				// if current, keep indicator open
				// $(this).hasClass('current-menu-ancestor') ? $(this).addClass('pt-advanced-menu-indicator-open') : ''
			}
		);
	
		$(".pt-advanced-menu > li ul li.menu-item-has-children", $scope).each(
			function(e) {
				// indicator position
				var $height = parseInt($("a", this).css("line-height")) / 2;
				$(this).append(
					'<span class="pt-advanced-menu-indicator ' +
						$dropdown_indicator_class +
						'" style="top:' +
						$height +
						'px"></span>'
				);
	
				// if current, keep indicator open
				// $(this).hasClass('current-menu-ancestor') ? $(this).addClass('pt-advanced-menu-indicator-open') : ''
			}
		);
	
		// menu indent
		$(
			".pt-advanced-menu-dropdown-align-left .pt-advanced-menu-vertical li.menu-item-has-children"
		).each(function() {
			var $padding_left = parseInt($("a", $(this)).css("padding-left"));
	
			$("ul li a", this).css({
				"padding-left": $padding_left + 20 + "px"
			});
		});
	
		$(
			".pt-advanced-menu-dropdown-align-right .pt-advanced-menu-vertical li.menu-item-has-children"
		).each(function() {
			var $padding_right = parseInt($("a", $(this)).css("padding-right"));
	
			$("ul li a", this).css({
				"padding-right": $padding_right + 20 + "px"
			});
		});
	
		// menu toggle
		$(".pt-advanced-menu", $scope).on(
			"click",
			".pt-advanced-menu-indicator",
			function(e) {
				e.preventDefault();
				$(this).toggleClass("pt-advanced-menu-indicator-open");
				$(this).hasClass("pt-advanced-menu-indicator-open")
					? $(this)
							.siblings("ul")
							.slideDown(300)
					: $(this)
							.siblings("ul")
							.slideUp(300);
			}
		);
	};
	
	jQuery(window).on("elementor/frontend/init", function() {
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/pt-advance-menu.default",
			AdvancedMenu
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_readypt-advance-menu.skin-one",
			AdvancedMenu
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/pt-advance-menu.skin-two",
			AdvancedMenu
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/pt-advance-menu.skin-three",
			AdvancedMenu
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/pt-advance-menu.skin-four",
			AdvancedMenu
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/pt-advance-menu.skin-five",
			AdvancedMenu
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_readypt-advance-menu.skin-six",
			AdvancedMenu
		);
		elementorFrontend.hooks.addAction(
			"frontend/element_ready/pt-advance-menu.skin-seven",
			AdvancedMenu
		);
	});
	