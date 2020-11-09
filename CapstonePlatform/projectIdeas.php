<!DOCTYPE html>
<html>
<head>
	<!-- UI made with Mobirise-->
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="generator" content="Mobirise v4.9.7, mobirise.com">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<link rel="shortcut icon" href="assets/images/uoit-rgb-primary-logo-1-216x121.jpg" type="image/x-icon">
	<meta name="description" content="Capstone Management">

	<title>Project Ideas</title>
	<link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
	<link rel="stylesheet" href="assets/tether/tether.min.css">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="assets/socicon/css/styles.css">
	<link rel="stylesheet" href="assets/dropdown/css/style.css">
	<link rel="stylesheet" href="assets/theme/css/style.css">
	<link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
</head>

<?php 
	require_once "config.php";

	session_start();

	// if the user is not logged in or has insufficient permissions, redirect them
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false || !isset($_SESSION["perms"]) || intval($_SESSION["perms"]) < 0)
	{
		header("location: /mob/index.php");
		exit;
	}
	
	$username = $_SESSION["username"];
	
	// check if the user wants to join a group
	if(isset($_GET['join']))
	{
		$group = sanitizeMySQL($link, $_GET['join']);
		
		$result = mysqli_query($link, "SELECT * FROM groups WHERE id = '$group';");
	
		// only join groups that are not full
		if($result->num_rows < 4)
		{
			$result = mysqli_query($link, "SELECT * FROM groups WHERE email = '$username';");
		
			// make sure user isn't already in a group
			if($result->num_rows == 0)
			{
				$stmt = $link->prepare("INSERT INTO groups (project, email) VALUES (?, ?);");
				$stmt->bind_param("ss", $group, $username);

				$stmt->execute();
				$stmt->close();
			}
		}
	}
	else if(isset($_GET['leave']))
	{
		// leave a group
		$sql = "DELETE FROM groups WHERE email = '$username';";
		mysqli_query($link, $sql);
	}
?>

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
                    Capstone Project Ideas
				</h1>
                <p class="mbr-text align-center pb-3 mbr-fonts-style display-5">
					View the following list of potential capstone projects and select your preferences
				</p>
            </div>
        </div>
    </div>
</section>

<!-- body content -->
<section class="services5 cid-rlTgwW13ZF" id="services5-1b">
    <div class="container">
        <div class="row">
			<?php
				require_once "config.php";
			
				// check if user has joined a group
				$result = mysqli_query($link, "SELECT * FROM groups WHERE email = '$username';");
		
				$joinedGroup = false;
				if($result->num_rows > 0)
				{
					$joinedGroup = true;
				}
				
				// get all project suggestions
				$result = mysqli_query($link, "SELECT * FROM suggestions ORDER BY created_at ASC");

				// create cards for the suggestions
				while($row = mysqli_fetch_array($result))
				{
					$id = $row['id'];
					
					// get the group members for the current group
					$result2 = mysqli_query($link, "SELECT * FROM groups WHERE project = '$id';");

					$members = 0;
					$names = "";
					$currentGroup = false;
					
					while($row2 = mysqli_fetch_array($result2))
					{
						$names .= $row2['email'] . "<br>";
						$members++;
						
						if(strcmp($username, $row2['email']) == 0)
						{
							$currentGroup = true;
						}
					}
					
					if($members < 1)
					{
						$names = "N/A";
					}
					
					// format cards based on the info
					echo "<div class='card px-3 col-12'>
						<div class='card-wrapper media-container-row media-container-row'>
							<div class='card-box'>
								<div class='top-line pb-3'>
									<h4 class='card-title mbr-fonts-style display-5'>
										" . $row['name'] . "
									</h4>";
					// add leave button if in the current group
					if($joinedGroup && $currentGroup)
					{
						echo "
									<div class='mbr-section-btn align-center'>
										<a href='projectIdeas.php?leave=$id' class='btn btn-md btn-secondary display-4'>Leave</a>
									</div>";
					}
					// add join button if not in the group and it's not full
					else if(!$joinedGroup && $members < 4)
					{
						echo "
									<div class='mbr-section-btn align-center'>
										<a href='projectIdeas.php?join=$id' class='btn btn-md btn-secondary display-4'>Join</a>
									</div>";
					}
					echo "
								</div>
								<div class='bottom-line'>
									<p>
										<b>Program:</b> " . $row['program'] . "
									<br>
										<b>Supervisor:</b> " . $row['supervisor'] . "
									<br><br>
										<b>Description:</b> " . $row['description'] . "
									<br><br>
										<b>Members:</b> <br>" . $names . "
									</p>
								</div>
							</div>
						</div>
					</div>";
				}
			?>
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
<script src="assets/parallax/jarallax.min.js"></script>
<script src="assets/dropdown/js/script.min.js"></script>
<script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
<script src="assets/smoothscroll/smooth-scroll.js"></script>
<script src="assets/theme/js/script.js"></script>

<div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i class="mbr-arrow-up-icon mbr-arrow-up-icon-cm cm-icon cm-icon-smallarrow-up"></i></a></div>

</body>
</html>