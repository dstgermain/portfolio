<?php 
$to = "info@danstgermain.com";
$subject = "Ten Movie Form";
$message =
"Customer name: ". $_POST['name']. "\r\n".
"Email: " . $_POST['email'] . "\r\n".
"Type: " . $_POST['type'] . "\r\n" . "\r\n".
"Message: " . $_POST['message'] . "\r\n" . "\r\n".
$from = $_POST['email'];
$headers = "From: $from" . "\r\n";
mail($to,$subject,$message,$headers);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Ten the Movie - Contact</title>
<link href="base.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationRadio.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationRadio.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
</head>

<body>
  <div id="wrapper">
    <div id="sideColumn"></div>
    <div id="mainContent">
      <div id="header">
        <div id="socialMedia">
        <div class="social brandico-twitter-bird"></div>
        <div class="social brandico-facebook"></div>
        </div><!-- END socialMedia -->
        <a href="index.html"><div id="headerBanner"></div></a>
        <div id="headerNav">
        <ul class="nav">
        <li><a href="index.html">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="cast.html">Cast</a></li>
        <li><a href="press.html">Press</a></li>
        <li><a href="contact.html" class="current">Contact</a></li>
        </ul>
        </div><!-- END headerNav -->
      </div><!-- END header -->
    <div id="pageContent">
     <div class="section">
      
      <h1>Thank you</h1>
      <p>
      Thank you, we will do our best to respond in a timely manor.
      </p>
      
     </div>
    </div>
    </div><!-- END mainContent -->
    <div class="clear"></div>
    <div id="footer">
      <div class="navArea">
        <ul class="nav">
        <li><a href="index.html">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="cast.html">Cast</a></li>
        <li><a href="press.html">Press</a></li>
        <li><a href="contact.html">Contact</a></li>
        </ul>
      </div>
    <span>&copy;2013 Ten the movie</span>
    </div><!-- END footer -->
  </div><!-- END wrapper -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {validateOn:["change"]});
var spryradio1 = new Spry.Widget.ValidationRadio("spryradio1", {validateOn:["change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "email", {validateOn:["change"]});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {validateOn:["blur"], minChars:10});
</script>
</body>
</html>
