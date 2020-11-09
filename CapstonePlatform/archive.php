<!DOCTYPE html>
<html  >
<head>
	<!-- UI made with Mobirise-->
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="generator" content="Mobirise v4.9.7, mobirise.com">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<link rel="shortcut icon" href="assets/images/uoit-rgb-primary-logo-1-216x121.jpg" type="image/x-icon">
	<meta name="description" content="Capstone Management">

	<title>Archive</title>
	<link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
	<link rel="stylesheet" href="assets/tether/tether.min.css">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="assets/socicon/css/styles.css">
	<link rel="stylesheet" href="assets/dropdown/css/style.css">
	<link rel="stylesheet" href="assets/theme/css/style.css">
	<link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
	<style>
	nav > div a.nav-item.nav-link
	{
		border: none;
		padding: 18px 25px;
		color:#fff;
		background:#272e38;
		border-radius:0;
	}

	nav > div a.nav-item.nav-link:hover,
	nav > div a.nav-item.nav-link:focus
	{
		border: none;
		background: rgb(0, 119, 202);
		color:#fff;
		border-radius:0;
		transition:background 0.20s linear;
	}
	</style>
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
                        Archive
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link link text-black display-4" href="contact.php">
						<span class="mbri-letter mbr-iconfont mbr-iconfont-btn"></span>
						Contact
					</a>
				</li>
				<?php
					session_start();

					// only add project ideas, logout and profile if logged in
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
							
						// if the user is admin, add an admin option
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

<!-- title text -->
<section class="header1 cid-rlTdRprFa0 mbr-parallax-background" id="header1-19">
    <div class="mbr-overlay" style="opacity: 0.6; background-color: rgb(0, 119, 202);"></div>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="mbr-white col-md-10">
                <h1 class="mbr-section-title align-center mbr-bold pb-3 mbr-fonts-style display-1">
					Capstone Project Archive
				</h1>
                <p class="mbr-text align-center pb-3 mbr-fonts-style display-5">
					View capstone projects from previous years
				</p>
			</div>
        </div>
    </div>
</section>

<!-- project year navigation -->
<section class="header4 cid-rlYqeIBrl5" id="header4-1q">
	<div class="container">
		<nav>
			<div class="nav justify-content-center nav-pills nav-fill">
				<?php
					require_once "config.php";
					
					$year = 0; 
					if(isset($_GET['year']))
					{
						$year = sanitizeMySQL($link, $_GET['year']);
						
						if(!is_numeric($year))
						{
							$year = 0;
						}
					}
					
					// get all the years and display them
					$result = mysqli_query($link, "SELECT DISTINCT year FROM projects ORDER BY year DESC");
					
					while($row = mysqli_fetch_array($result))
					{
						if($year == 0 || $_GET['year'] == $row['year'])
						{
							echo "<li class='nav-item'>
								<a class='nav-item nav-link active' href='archive.php?year=" . $row['year'] . "'>" . $row['year'] . "</a>
							</li>";
							
							$year = $row['year'];
						}
						else 
						{
							echo "<li class='nav-item'>
								<a class='nav-item nav-link' href='archive.php?year=" . $row['year'] . "'>" . $row['year'] . "</a>
							</li>";
						}
					}
				?>
			</div>
		</nav>
	</div>
</section>
	
<!-- project cards and information -->
<section class="services5 cid-rlTgwW13ZF" id="services5-1b">
    <div class="container">
		<?php
			// select all the projects for the year selected
			$result = mysqli_query($link, "SELECT * FROM projects WHERE year = $year ORDER BY date ASC;");

			$i = 0;
			while($row = mysqli_fetch_array($result))
			{
				if($i == 0 || $i % 2 == 0)
				{
					echo "<div class='row'>";
				}
				
				// display the projects in cards
				echo "<div class='col-sm-6'>
					<div class='card text-dark bg-light  mb-3'>
						<div class='card-header'><b>" . $row['title'] . "</b></div>
						<div class='card-body'>	
							<div class='embed-responsive embed-responsive-16by9'>
								<iframe class='embed-responsive-item' src='" . $row['video'] . "'></iframe>
							</div>
							<br>
							<br>
							<p class='card-text text-dark'>
								<b>Program:</b> " . $row['program'] . "
								<br>
								<b>Description:</b> " . $row['info'] . "
								<br>
								<br>
								<b>Members:</b> " . $row['members'] . "
								<br>
								<b>Supervisor:</b> " . $row['supervisor'] . "
								<br>
								<br>
								<a href='" . $row['external_url'] . "'>More...</a>
							</p>
						</div>
					</div>
				</div>";

				if($i % 2 != 0)
				{
					echo "</div>";
				}
				
				$i++;
			}
		?>
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
<script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
<script src="assets/mbr-tabs/mbr-tabs.js"></script>
<script src="assets/parallax/jarallax.min.js"></script>
<script src="assets/dropdown/js/script.min.js"></script>
<script src="assets/theme/js/script.js"></script>

<div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i class="mbr-arrow-up-icon mbr-arrow-up-icon-cm cm-icon cm-icon-smallarrow-up"></i></a></div>

</body>
</html>