// JavaScript Document
$(window).ready(function (){
	$('#sort-by div').click(function(){
		var sort = $(this).attr('sort-value');
		window.location = "?sortID=" + sort;
	});
});