<!DOCTYPE html>
<html>
<head>
	<!-- UI made with Mobirise-->
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="generator" content="Mobirise v4.9.7, mobirise.com">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<link rel="shortcut icon" href="assets/images/ontariotechuniversity-primary-colour-rgb-150ppi-218x77.jpg" type="image/x-icon">
	<meta name="description" content="Capstone Management">

	<title>Profile</title>
	<link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
	<link rel="stylesheet" href="assets/tether/tether.min.css">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="assets/dropdown/css/style.css">
	<link rel="stylesheet" href="assets/socicon/css/styles.css">
	<link rel="stylesheet" href="assets/theme/css/style.css">
	<link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
</head>

<body>

<!--navigation menu-->
<section class="menu cid-rlSd2b5l0d" once="menu" id="menu1-0">
	<nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-toggleable-sm">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="menu-logo">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="index.php">
                         <img src="assets/images/ontariotechuniversity-primary-colour-rgb-150ppi-218x77.jpg" alt="Mobirise" title="" style="height: 3.8rem;">
                    </a>
                </span>
                <span class="navbar-caption-wrap"><a class="navbar-caption text-black display-4" href="">Capstone Assistance and Management Platform</a></span>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
				<li class="nav-item">
                    <a class="nav-link link text-black display-4" href="index.php">
                        <span class="mbri-home mbr-iconfont mbr-iconfont-btn"></span>
                        Home
					</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link link text-black display-4" href="about.php">
                        <span class="mbri-search mbr-iconfont mbr-iconfont-btn"></span>
                        About
					</a>
                </li>
				<li class="nav-item"><a class="nav-link link text-black display-4" href="archive.php">
					<span class="mbri-database mbr-iconfont mbr-iconfont-btn"></span>
                        Arli>
				<li class="nav-item">
					<a class="nav-link link text-black display-4" href="contact.php">
					<span class="mbri-letter mbr-iconfont mbr-iconfont-btn">
					</span>Contact</a>
				</li>
				<?php
					session_start();

					if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
					{
						echo "<li class='nav-item'>
								<a class='nav-link link text-black display-4' href='projectIdeas.php'>
								<span class='mbri-idea mbr-iconfont mbr-iconfont-btn'>
								</span>Project Ideas</a>
							</li>
							<li class='nav-item'>
								<a class='nav-link link text-black display-4' href='profile.php'>
									<span class='mbri-user mbr-iconfont mbr-iconfont-btn'></span>
									Profile
								</a>
							</li>";
							
						if($_SESSION["perms"] && intval($_SESSION["perms"]) == 2)
						{
							echo "<li class='nav-item'>
								<a class='nav-link link text-black display-4' href='admin.php'>
									<span class='mbri-edit mbr-iconfont mbr-iconfont-btn'></span>
									Admin
								</a>
							</li>";
						}
						
						echo "<li class='nav-item'>
								<a class='nav-link link text-black display-4' href='logout.php'>
									<span class='mbri-logout mbr-iconfont mbr-iconfont-btn'></span>
									Logout
								</a>
							</li>";
					}
					else
					{
						echo "<li class='nav-item'>
								<a class='nav-link link text-black display-4' href='portal.php'>
									<span class='mbri-user mbr-iconfont mbr-iconfont-btn'></span>
									Login
								</a>
							</li>";
					}
				?>		
			</ul>
        </div>
    </nav>
</section>

<!-- profile information -->
<section class="features11 cid-rlYkbbmDnW" id="features11-1n">
    <div class="container">   
        <div class="col-md-12">
            <div class="media-container-row">
                <div class="mbr-figure m-auto" style="width: 50%;">
                    <img src="assets/images/background9.jpg" alt="Mobirise" title="">
                </div>
                <div class=" align-left aside-content">
                    <h2 class="mbr-title pt-2 mbr-fonts-style display-2">
						<?php
						// display access level
                        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
						{
							if($_SESSION["perms"] && intval($_SESSION["perms"]) == 2)
							{
								echo "Admin";
							}
							else if($_SESSION["perms"] && intval($_SESSION["perms"]) == 1)
							{
								echo "Coordinator";
							}
							else
							{
								echo "Student";
							}
						}
						?>
					</h2>
                    <div class="mbr-section-text">
                        <p class="mbr-text mb-5 pt-3 mbr-light mbr-fonts-style display-5">
						<?php
						// display email
                        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
						{
							if($_SESSION["username"])
							{
								echo "Email: " . $_SESSION["username"];
							}
							else
							{
								echo "Email: N/A";
							}
						}
						?>
						</p>
                    </div>
                </div>
            </div>
        </div> 
    </div>          
</section>

<!-- footer -->
<section once="footers" class="cid-rlSXfR4HtF" id="footer7-z">
    <div class="container">
        <div class="media-container-row align-center mbr-white">
            <div class="row row-links">
                <ul class="foot-menu">
					<li class="foot-menu-item mbr-fonts-style display-7">
						<a class="text-white mbr-bold" href="index.php">
							Home
						</a>
					</li>
					<li class="foot-menu-item mbr-fonts-style display-7">
						<a class="text-white mbr-bold" href="contact.php">
							Contact
						</a>
					</li>
				</ul>
            </div>
            <div class="row row-copirayt">
                <p class="mbr-text mb-0 mbr-fonts-style mbr-white align-center display-7">
                    © University of Ontario Institute of Technology 2019
                </p>
            </div>
        </div>
    </div>
</section>

<script src="assets/web/assets/jquery/jquery.min.js"></script>
<script src="assets/popper/popper.min.js"></script>
<script src="assets/tether/tether.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/smoothscroll/smooth-scroll.js"></script>
<script src="assets/dropdown/js/script.min.js"></script>
<script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
<script src="assets/theme/js/script.js"></script>

<div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i class="mbr-arrow-up-icon mbr-arrow-up-icon-cm cm-icon cm-icon-smallarrow-up"></i></a></div>

</body>
</html>