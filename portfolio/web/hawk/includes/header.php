<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width">
<title>Hawk Concepts :: <?php echo $page_title; ?></title>
<link rel="stylesheet" type="text/css" href="reset.css">
<link rel="stylesheet" type="text/css" href="site.css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<body>
<div id="page-wrapper">
  <header>
    <div id="header">
      <div id="logo">Hawk Concepts</div>
      <nav>
        <ul id="help-info">
        <li>Customer Service</li>
        <li>|</li>
        <li>em. info@hawkconcepts.com</li>
        <li>|</li>
        <li>ph. 1.555.555.5555</li>
        </ul>
        <form id="searchform" name="searchform" method="post" action="search.php">  
<label><input type="text" name="search" id="search" placeholder="Search.." required/> </label> 
<input type="submit" name="submit" id="submit" value="" /> </form>
        <ul id="header-navigation">
          <li><a href="index.php" <?php if ($thisPage=="home") echo " class=\"current\""; ?>>Home</a></li>
          <li><a href="featured.php" <?php if ($thisPage=="featured") echo " class=\"current\""; ?>>Featured</a></li>
          <li><a href="master.php" <?php if ($thisPage=="catalog") echo " class=\"current\""; ?>>Catalog</a></li>
          <li><a href="about.php" <?php if ($thisPage=="about") echo " class=\"current\""; ?>>About</a></li>
          <li><a href="contact.php" <?php if ($thisPage=="contact") echo " class=\"current\""; ?>>Contact</a></li>
        </ul>
      </nav>
    </div>
    <!--end header--> 
  </header>