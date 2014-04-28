$(document).ready(function(){
	"use strict";
	$("#mobile-nav-btn").on("click", function(){
		var $this = $(this),
			openState = $this.data("open"),
			$nav = $(".mobile-main-navigation");
		if(!openState) {
			$this.html("&times;").addClass("active");
			$nav.animate({top:"60px"}, "slow");
			$this.data("open", true);
		} else {
			$this.html("&#43;").removeClass("active");
			$nav.animate({top:"-400px"}, "slow");
			$this.data("open", false);
		}
	});
});
