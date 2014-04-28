<?php 
$page = 'contact';
include 'includes/_header.php'; 
include 'includes/_navigation.php';
?>
<div id="main-content" role="main">
	<div class="wrapper">
		<div class="column-center">
		<form id="contact">
			<label>Name</label><input type="text" />
			<label>Number</label><input type="text" placeholder="555-555-5555" />
			<label>Email</label><input type="text" placeholder="example@ex.com"/>
			<label>Message</label><textarea></textarea>
			<button type="submit">Submit</button>
		</form>
		</div>
	</div>
</div>
<?php include 'includes/_footer.php'; ?>