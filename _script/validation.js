// Author: Daniel St. Germain
// Date: April 28, 2014
// Description: validation
// ** Please do not use without permission ** 

$.fn.isvalid = function (attr) {
	"use strict";

	var form = $(this).attr("id"),
		formid = "#" + form,
		_form = $(this),
		isvalid = true;

	_form.find("[data-type]").each(function(){
		var $input = $(this),
			type = $input.data("type"),
			value = "",
			regx = "";

		switch (type) {
			case "name":
				regx = /^[\w+\D+\s]{2,}$/;
				break;
			case "phone":
				regx = /^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/;
				break;
			case "email":
				regx = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
		}
		$input.on("blur", function (){
			value = $input.val();
			checkInput($input, value, regx);
		});
		$input.on("keyup", function(){
			value = $input.val();
			checkInput($input, value, regx);
		});
	});

	function checkInput($input, value, regx){
		if (regx.test(value)) {
			if ($input.hasClass("error")) {
				$input.removeClass("error");
				$input.next(".ex").remove();
			}
			$input.addClass("valid");
			if (!$input.next().hasClass("check")) {
				$input.after("<div class=\"check\">&#x2713;</div>");
			}
		} else {
			if ($input.hasClass("valid")) {
				$input.removeClass("valid");
				$input.next(".check").remove();
			}
			$input.addClass("error");
			if (!$input.next().hasClass("ex")) {
				$input.after("<div class=\"ex\">&#x2717;</div>");
			}
		}
	}
	function checkValidation(_form){
		$(formid).find("[data-type]").each( function () {
			var $input = $(this),
				type = $input.data("type"),
				value = $input.val(),
				regx = /0/;

			switch (type) {
				case "name":
					regx = /^[A-Za-z]{2,20}$/;
					break;
				case "phone":
					regx = /^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/;
					break;
				case "email":
					regx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			}

			var isval = regx.test(value) ? true : false;
			if(isval) {
				if ($input.hasClass("error")) {
					$input.removeClass("error");
					$input.next(".ex").remove();
				}
				$input.addClass("valid");
				if (!$input.next().hasClass("check")) {
					$input.after("<div class=\"check\">&#x2713;</div>");
				}
			} else {
				if ($input.hasClass("valid")) {
					$input.removeClass("valid");
					$input.next(".check").remove();
				}
				$input.addClass("error");
				if (!$input.next().hasClass("ex")) {
					$input.after("<div class=\"ex\">&#x2717;</div>");
				}
			}
		});
	}
	if (typeof(attr) !== "undefined") {
		if(attr.hasOwnProperty("checkValid")){
			checkValidation(_form);
		}
	}

	if ($(".error").length) {
		return false;
	}
	return true;
};