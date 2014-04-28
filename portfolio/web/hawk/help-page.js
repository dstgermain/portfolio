// JavaScript Document
$(window).ready(function (){
	$('.title').click(function(){
		if (!$(this).hasClass('open')) {
		   $(this).next().animate({height:'50px'}, 200);
		   $(this).addClass('open').find('span').fadeOut(function() {
			   $(this).html('-').fadeIn()
		   });
		} else {
			$(this).next().animate({height:'0'}, 200);
			$(this).removeClass('open').find('span').fadeOut(function() {
			   $(this).html('+').fadeIn()
		   });
		}
	});
});