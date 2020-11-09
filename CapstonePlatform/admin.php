<!DOCTYPE html>
<html lang="en">

<!--Basic header information-->
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="generator" content="Mobirise v4.9.7, mobirise.com">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<link rel="shortcut icon" href="assets/images/ontariotechuniversity-primary-colour-rgb-150ppi-218x77.jpg" type="image/x-icon">
	<meta name="description" content="Capstone Management">

	<title>Admin Panel</title>
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

<?php 
	require_once "config.php";

	session_start();

	// if the user is not logged in or has insufficient permissions, redirect them
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false || !isset($_SESSION["perms"]) || intval($_SESSION["perms"]) != 2)
	{
		header("location: /mob/index.php");
		exit;
	}

	$submenu = isset($_GET['menu']) ? intval($_GET['menu']) : 0; 

	// if the user wants to add something
	if(isset($_GET['add']))
	{
		$add = intval($_GET['add']);
		$count = 1;
		
		if($add == 0)
		{
			// parse the email input for multiple emails
			$email = explode(",", $_POST['email']);
			$count = count($email);
			
			for($i = 0; $i < $count; $i++)
			{
				// prepared statement to insert
				$stmt = $link->prepare("INSERT INTO users (username, password, permissions) VALUES (?, ?, ?)");
				$stmt->bind_param("sss", $username, $password, $perms);
				
				// sanitize inputs
				$username = sanitizeMySQL($link, $email[$i]);
				$password = sanitizeMySQL($link, generatePassword(strlen($username)));
				$perms = sanitizeMySQL($link, $_POST['perms']);
				
				$stmt->execute();
				$stmt->close();

				// send a message to the emails with their username/password
				$subject = "Capstone Registration";

				$message = "You have been registered for UOIT's capstone program. Please find your login details below.<br><br>";
				$message .= "<b>Username: </b>" . $username;
				$message .= "<br><b>Password: </b>" . $password;
				
				$header = "From:capstone@uoit.net \r\n";
				$header .= "Cc:capstone@uoit.net \r\n";
				$header .= "MIME-Version: 1.0\r\n";
				$header .= "Content-type: text/html\r\n";

				mail($username, $subject, $message, $header);
			}
		}
		else if($add == 1)
		{
			// prepared statement to insert
			$stmt = $link->prepare("INSERT INTO projects (year, program, title, info, members, supervisor, external_url, video) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssssssss", $year, $program, $title, $info, $members, $supervisor, $url, $video);
			
			// sanitize inputs
			$year = sanitizeMySQL($link, $_POST['year']);
			$program = sanitizeMySQL($link, $_POST['program']);
			$title = sanitizeMySQL($link, $_POST['title']);
			$info = sanitizeMySQL($link, $_POST['info']);
			$members = sanitizeMySQL($link, $_POST['members']);
			$supervisor = sanitizeMySQL($link, $_POST['supervisor']);
			$url = sanitizeMySQL($link, $_POST['url']);
			$video = sanitizeMySQL($link, $_POST['video']);
			
			$stmt->execute();
			$stmt->close();
		}
		else if($add == 2)
		{
			// prepared statement to insert
			$stmt = $link->prepare("INSERT INTO suggestions (name, description, program, supervisor) VALUES (?, ?, ?, ?)");
			$stmt->bind_param("ssss", $name, $desc, $program, $supervisor);
			
			// sanitize inputs
			$name = sanitizeMySQL($link, $_POST['name']);
			$desc = sanitizeMySQL($link, $_POST['description']);
			$program = sanitizeMySQL($link, $_POST['program']);
			$supervisor = sanitizeMySQL($link, $_POST['supervisor']);
			
			$stmt->execute();
			$stmt->close();
		}
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

<!-- admin navigation menu -->
<section class="header4 cid-rlYqeIBrl5" id="header4-1q">
	<div class="container">
		<br>
		<h1 class="text-center">Admin Control</h1>
		<br>
		<ul class="nav justify-content-center nav-pills">
			<li class="nav-item">
				<a class="nav-link <?php if($submenu == 0) echo active ?>" href="admin.php?menu=0">Users</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php if($submenu == 1) echo active ?>" href="admin.php?menu=1">Projects</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php if($submenu == 2) echo active ?>" href="admin.php?menu=2">Suggestions</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php if($submenu == 3) echo active ?>" href="view.php?menu=3">Messages</a>
			</li>
		</ul>
		<br>
		<ul class="nav justify-content-center nav-pills">
			<li class="nav-item">
				<a class="nav-link active" href="admin.php?menu=<?php echo $submenu?>">Add</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="delete.php?menu=<?php echo $submenu?>">Delete</a>
			</li>
			<li class="nav-item">
				<a class="nav-link disabled" href="edit.php?menu=<?php echo $submenu?>">Edit</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="view.php?menu=<?php echo $submenu?>">View</a>
			</li>
		</ul>
		<br><br>
		<?php
		// display a form based on what the user wants to add(users, projects, suggestions)
		if($submenu == 0)
		{
			echo "<h2>Add user:</h2>
			<form method='post' action='admin.php?menu=" . $submenu . "&add=0'>
				<input type='text' name='email' class='form-control' placeholder='email' /><br>
				<input type='text' name='perms' class='form-control' placeholder='permissions' value='0'/><br>
				<p>*Add multiple emails by seperating them with a comma</p>
				<p>*For permissions: 0 = student, 1 = coordinator, 2 = admin</p><br>
				<div class='col-md-12 input-group-btn align-center'><input type='submit' name='' class='btn btn-primary btn-form display-3' value='Submit'>
			</form>";
		}
		else if($submenu == 1)
		{
			echo "<h2>Add Project:</h2>
			<form method='post' action='admin.php?menu=" . $submenu . "&add=1'>
				<input type='text' name='year' class='form-control' placeholder='year' /><br>
				<input type='text' name='program' class='form-control' placeholder='program' /><br>
				<input type='text' name='title' class='form-control' placeholder='title' /><br>
				<input type='text' name='info' class='form-control' placeholder='info' /><br>
				<input type='text' name='members' class='form-control' placeholder='members' /><br>
				<input type='text' name='supervisor' class='form-control' placeholder='supervisor' /><br>
				<input type='text' name='url' class='form-control' placeholder='url' /><br>
				<input type='text' name='video' class='form-control' placeholder='video' /><br>
				<div class='col-md-12 input-group-btn align-center'><input type='submit' name='' class='btn btn-primary btn-form display-3' value='Submit'>
			</form>";
		}
		else if($submenu == 2)
		{
			echo "<h2>Add Suggestion:</h2>
			<form method='post' action='admin.php?menu=" . $submenu . "&add=2'>
				<input type='text' name='name' class='form-control' placeholder='name' /><br>
				<input type='text' name='description' class='form-control' placeholder='description' /><br>
				<input type='text' name='program' class='form-control' placeholder='program' /><br>
				<input type='text' name='supervisor' class='form-control' placeholder='supervisor' /><br>
				<div class='col-md-12 input-group-btn align-center'><input type='submit' name='' class='btn btn-primary btn-form display-3' value='Submit'>
			</div></form>";
		}

		// display the most recent entry in the database
		if(isset($_GET['add']))
		{
			echo "<br><br><br><br>";
			echo "<h4>Latest " . $count . " additions:</h4>";
			
			if($add == 0)
			{
				// display results in html table format
				echo "<div class='container container-table'><div class='table-responsive'><table class='table table-striped table-hover'>
				<tr>
					<th>Id</th>
					<th>Username</th>
					<th>Permissions</th>
					<th>Date</th>
				</tr>";

				$result = mysqli_query($link, "SELECT * FROM users ORDER BY created_at DESC LIMIT $count;");
				while($row = mysqli_fetch_array($result))
				{
					echo "<tr>";
					echo "<td>" . $row['id'] . "</td>";
					echo "<td>" . $row['username'] . "</td>";
					echo "<td>" . $row['permissions'] . "</td>";
					echo "<td>" . $row['created_at'] . "</td>";
					echo "</tr>";
				}
				
				echo "</table></div></div>";
			}
			else if($add == 1)
			{
				$result = mysqli_query($link, "SELECT * FROM projects ORDER BY date DESC LIMIT $count;");

				// display results in html table format
				echo "<div class='container container-table'><div class='table-responsive'><table class='table table-striped table-hover'>
				<tr>
					<th>Id</th>
					<th>Year</th>
					<th>Program</th>
					<th>Title</th>
					<th>Info</th>
					<th>Members</th>
					<th>Supervisor</th>
					<th>Website</th>
					<th>Video</th>
					<th>Date</th>
				</tr>";

				while($row = mysqli_fetch_array($result))
				{
					echo "<tr>";
					echo "<td>" . $row['id'] . "</td>";
					echo "<td>" . $row['year'] . "</td>";
					echo "<td>" . $row['program'] . "</td>";
					echo "<td>" . $row['title'] . "</td>";
					echo "<td>" . $row['info'] . "</td>";
					echo "<td>" . $row['members'] . "</td>";
					echo "<td>" . $row['supervisor'] . "</td>";
					echo "<td>" . $row['external_url'] . "</td>";
					echo "<td>" . $row['video'] . "</td>";
					echo "<td>" . $row['date'] . "</td>";
					echo "</tr>";
				}
				
				echo "</table></div></div>";
			}
			else if($add == 2)
			{
				$result = mysqli_query($link, "SELECT * FROM suggestions ORDER BY created_at DESC LIMIT $count;");

				// display results in html table format
				echo "<div class='container container-table'><div class='table-responsive'><table class='table table-striped table-hover'>
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Description</th>
					<th>Program</th>
					<th>Supervisor</th>
					<th>Date</th>
				</tr>";

				while($row = mysqli_fetch_array($result))
				{
					echo "<tr>";
					echo "<td>" . $row['id'] . "</td>";
					echo "<td>" . $row['name'] . "</td>";
					echo "<td>" . $row['description'] . "</td>";
					echo "<td>" . $row['program'] . "</td>";
					echo "<td>" . $row['supervisor'] . "</td>";
					echo "<td>" . $row['created_at'] . "</td>";
					echo "</tr>";
				}
				
				echo "</table></div></div>";
			}
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
<script src="assets/dropdown/js/script.min.js"></script>
<script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
<script src="assets/theme/js/script.js"></script>

<div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i class="mbr-arrow-up-icon mbr-arrow-up-icon-cm cm-icon cm-icon-smallarrow-up"></i></a></div>

</body>
</html>