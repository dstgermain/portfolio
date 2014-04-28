<?php 
if (!isset($page_title)) {
     $page_title = 'Suannah and Dan';
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $page_title ?></title>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script type="text/javascript">
    WebFontConfig = {
      google: { families: ['Neuton:300:latin', 'Mr+De+Haviland::latin', 'Open+Sans+Condensed:300:latin'] }
    };
    (function () {
      var wf = document.createElement('script');
      wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
        '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
      wf.type = 'text/javascript';
      wf.async = 'true';
      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(wf, s);
    })(); </script>
	<style type="text/css">
	@import url("http://weloveiconfonts.com/api/?family=fontawesome");
	</style>
  <link rel="stylesheet" type="text/css" href="content/bootstrap/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="content/Site.min.css">
</head>
<body>
  <div id="wrapper">
    <div id="user-login">
    <?php 
      echo '<span>Welcome';
        if (isset($_SESSION['first_name'])) {
          echo ", {$_SESSION['first_name']}! <a href='logout.php'>(sign out?)</a> <a href='change_password.php' class='fontawesome-cogs'></a>";
        } else {
          echo ", <a href='login.php'>login?</a>";
        }
      echo '</span>';
    ?>
    </div>
	<div class="clear"></div>
    <header class="navbar">
      <div class="corner left"></div>
      <div class="repeat top"></div>
      <div class="corner right"></div>
      <div class="clear"></div>
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <span id="top-text">The Wedding of</span>
        <h1>Susannah Plaster <span>&amp;</span> Daniel St. Germain</h1>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <?php include "navigation.php" ?>
        </ul>
      </div>
      <div class="clear"></div>
    </header>
    <div class="clear"></div>
    <div class="body-content">
      <div id="content-section">