<?php 
$page = 'contact';
include 'includes/_header.php'; 
include 'includes/_navigation.php';
?>
<div id="main-content" role="main">
	<div class="wrapper">
		<div class="column-center">
		<form id="contact">
			<label>Name *</label><input type="text" name="name" data-type="name"/>
			<label>Number *</label><input type="text" name="phone" placeholder="555-555-5555" data-type="phone" />
			<label>Email *</label><input type="text" name="email" placeholder="example@ex.com" data-type="email"/>
			<label>Message</label><textarea name="message"></textarea>
			<small>Please keep this under 200 words</small>
			<button type="submit">Submit</button>
		</form>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js"></script>
<script type="text/javascript" src="_script/validation.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	"use strict";
	$("#contact").isvalid();
	$("#contact").submit(function(e){
		e.preventDefault();
		var valid =  $(this).isvalid({"checkValid":"true"}),
			dataString = $(this).serialize();
		if (valid) {
			$("#main-content").block({ message: "Please wait.." });
			$.ajax({
				type: "POST",
		        url: "send-mail.php",
		        data: dataString,
		        success: function(data){
					$("#main-content").unblock();
					$("#contact").animate({"opacity":"0.3"},"slow",function(){
						$(".column-center").append(data).click(function(){
							$(".block-out").animate({"opacity":"0"},"slow",function(){
								$(".block-out").remove();
								$("#contact").animate({"opacity":"1"},"slow");
							});
						});
					});
		        },
		        error: function(){
					$("#main-content").unblock();
					$("#contact").animate({"opacity":"0.3"},"slow",function(){
						$(".column-center").append('<div class="block-out"><h3>Woops!</h3><p class="send-error">Something went wrong, please try again later or email me <a href="mailto:dst.germain48@gmail.com">directly</a>.</p></div>').click(function(){
							$(".block-out").animate({"opacity":"0"},"slow",function(){
								$(".block-out").remove();
								$("#contact").animate({"opacity":"1"},"slow");
							});
						});
					});
		        }
			});
		}
	});
});
</script>
<?php include 'includes/_footer.php'; ?>