$(document).ready(function(){
if($("[data-edit]").length > 0) {
$("[data-edit-info]").hide();
}
var click = 0;
$("[data-edit]").bind("click", function(){
if (click == 0){
$(this).next().fadeIn();
$(this).addClass("open");
click = 1;
} else {
$(this).next().fadeOut();
$(this).removeClass("open");
click = 0;
}
});
});
