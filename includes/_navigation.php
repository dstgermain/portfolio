<header>
		<div class="wrapper">
			<div id="header-branding">
				<div id="logo">
					<a href="index.php" class="logo-brand"><span></span><span></span></a>
					<span>Daniel St-Germain</span>
				</div><!-- end logo -->
				<div class="desktop-social-media">
					<ul class="nav-list">
						<?php include "_social_list.php"; ?>
					</ul>
				</div><!-- end desktop-social-media -->
				<div id="mobile-nav-btn" data-open="false">&#43;</div>
			</div><!-- end branding -->
			<nav class="desktop-main-navigation" role="navigation">
				<ul class="nav-list">
					<?php include "_navigation_list.php"; ?>
				</ul>
			</nav>
			<nav class="mobile-main-navigation" role="navigation">
				<ul class="nav-list">
					<?php include "_navigation_list.php" ?>
				</ul>
				<ul class="mobile-social-media">
					<?php include "_social_list.php"; ?>
				</ul>
			</nav>
		</div><!-- end .wrapper -->
	</header>