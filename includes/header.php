<?php
include("mysql_connect.php");
?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Exploring Cheese</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">



	<!-- Latest compiled and minified JavaScript -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


	<!-- Google Icons: https://material.io/tools/icons/
  also, check out Font Awesome or Glyphicons -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- Themes from https://bootswatch.com/ : Use the Themes dropdown to select a theme you like; copy/paste the bootstrap.css. Here, we have named the downloaded theme as a new file and can overwrite the default.  -->
	<!-- <link href="<?php echo BASE_URL ?>css/bootstrap-slate.css" rel="stylesheet"> -->


	<style type="text/css">
		body {
			display: grid;
			background: #f2efc7;
			justify-items: center;
		}

		#custom-navbar {
			background: #9f7e69;
			border-bottom: 2px solid black;
		}

		#custom-dropdown-menu {
			background: #9f7e69;
			border-bottom: 2px solid black;
		}

		#custom-dropdown-menu a:hover {
			color: black;
			font-weight: 700;
		}

		#custom-navbar a {
			color: #fff;
		}

		#custom-navbar a:hover {
			background: #9f7e69;
		}

		.custom-form {
			font-size: .6rem;
		}

		.custom-form-input {
			font-size: 1rem;
		}

		#filter-button {
			width: 100%;
			margin: auto;
			color: #000;
			background-color: #d2bba0;
		}

		.thumb {
			width: 111px;
			padding: 5px;
			height: 104px;
			overflow: hidden;
			font-size: 11px;
			margin: 8px;
			background-color: #fff;
			box-shadow: 0px 0px 2px #000;
			display: inline-block;
		}

		.thumb a {
			text-decoration: none;
		}

		.display-title {
			margin-top: -3.5rem;
			background:	#f2efc7;
			display: table;
			padding-left: 1rem;
			padding-right: .5rem;
			margin-bottom: -1rem;
		}

		.widget-styles {
			border: 2px solid black;
			border-radius: 6px;
			padding: 2rem 1rem 0.5rem 1rem;
			margin-top: 2rem;
		}

		.widget-title {
			margin-top: -3rem;
			background: #f2efc7;
			width: 7.5rem;
			padding-left: 1rem;
			padding-right: .5rem;
		}
	</style>
</head>

<body>
	<nav id="custom-navbar" class="navbar navbar-expand-md mb-4 fixed-top">
		<a class="navbar-brand" href="<?php echo BASE_URL ?>index.php"><i class="material-icons" style="font-size:36px">home</i></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="navbar-nav mr-auto">

				<li class="nav-item active">
					<!-- This is a placeholder link. You will need to change this to link to your files. -->
					<a class="nav-link" href="<?php echo BASE_URL ?>index.php">Explore</a>
				</li>
				<?php
				if (isset($_SESSION['username']) && $_SESSION['username'] == 'admin'): ?> 
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin</a>
					<div id="custom-dropdown-menu" class="dropdown-menu" aria-labelledby="dropdown01">
						<a class="dropdown-item" href="<?php echo BASE_URL ?>admin/insert.php">Insert</a>
						<a class="dropdown-item" href="<?php echo BASE_URL ?>admin/edit.php">Edit</a>
					</div>
				</li>
			<?php endif; ?>
			</ul>
			<ul class="navbar-nav ml-auto">
			<?php
			if(isset($_SESSION['username'])){
				echo "<h5 style=\"color:yellow;\" class=\"nav-link\"><span style=\"font-size:1rem;color:white;padding-right:0.3rem;\">You are currently logged on as </span>  <strong>" .
				$_SESSION['username'] .
						"</strong> <span style=\"color:white;\">-</span> </h5>";
			}
			?>
				<li class="nav-item active">
					<?php
					// if (isset($_SESSION['PHP_Test_Secure'])) {
					// 	echo "<a class=\"nav-link\" href=\"" .
					// 		BASE_URL .
					// 		"admin/logout.php\">Logout</a>";
					// }
					if (!isset($_SESSION['username'])) {
						echo "<a class=\"nav-link\" href=\"" .
							BASE_URL .
							"admin/login.php\"><b>Login</b></a>";
					} else {
						echo "<a class=\"nav-link\" href=\"" .
						BASE_URL .
						"admin/logout.php?logout='1'\"><b>Logout</b></a>";
					}
					?>
				</li>
			</ul>
		</div>
	</nav>
	<div style="margin-top: 5rem !important;" class="row mb-3 container">
		<div class="col-4 pl-4">

			<h3>Filter by Price range: </h3>
			<br />
			<?php
			$displayby = $_GET['displayby'];
			if ($displayby == 'price') {
				// echo $displayby;
				$price_min = $_GET['min'];
				$price_max = $_GET['max'];
			}
			?>

			<form class="custom-form" method="get" action="<?php echo BASE_URL; ?>index.php">
				<style>
					.custom-textbox {
						border: none;
						margin-top: -0.4rem;
						background: lightgoldenrodyellow;
					}
				</style>
				<input type="text" name="displayby" value="price" hidden>
				<input type="range" name="min" min="1" max="100" value="<?php if ($price_min) {
																			echo $price_min;
																		} ?>" onmousemove="updateTextMin(this.value);">
				<input type="range" name="max" min="1" max="100" value="<?php if ($price_max) {
																			echo $price_max;
																		} ?>" onmousemove="updateTextMax(this.value);">
				<div style="display:flex">
					<label style="padding:0 0.5rem;" for="textMin">Min $ </label>
					<input class="custom-textbox" style="width:2rem;margin-right:0.2rem;" type="text" id="textMin" value="<?php if ($price_min) {
																																echo $price_min;
																															} ?>" readonly>
					<label style="padding:0 0.5rem;" for="textMax">Max $ </label>
					<input class="custom-textbox" style="width:2rem;" type="text" id="textMax" value="<?php if ($price_max) {
																											echo $price_max;
																										} ?>" readonly>
				</div>
				<br />
				<input class="custom-form-input" type="submit">
			</form>
		</div>

		<div class="col-4 pl-4 pr-4">

		<h3>Search by Name: </h3>
			<br />
			<?php
			$displayby = $_GET['displayby'];
			$displayvalue = $_GET['displayvalue'];
			if ($displayby == 'text') {
        echo $displayvalue;
        
			}
			?>

			<form class="custom-form" method="get" action="<?php echo BASE_URL; ?>index.php">
				<input class="form-control" type="text" name="displayby" value="text" hidden>
				<input class="form-control w-75" type="text" name="displayvalue">
				<br />
				<input class="form-control btn btn-success w-75" type="submit" value="Search">
			</form>

			</div>


		<div class="col-2">
			<?php
			echo "<h4>Discover</h4>";

			$randomCheese = mysqli_query($con, "SELECT * FROM cheese_db ORDER BY RAND() LIMIT 1");
			while ($row = mysqli_fetch_array($randomCheese)) {
				$cheese = $row['cheese'];
				$cid = $row['cid'];
				$imageFile = $row['image_file'];
				echo "<a href=\"" . BASE_URL . "cheese.php?cid=$cid\"><img src=\"" . BASE_URL . "images/thumbs100/$imageFile\"><br/>$cheese</a>" . "<br />";
			}
			?>
		</div>
		<div class="col-2">
			<?php
			echo "<h4>Favorite</h4>";

			//// there is an UPDATE query in index.php that sets this column value, and we just ORDER BY popularity DESC here to get most popular views
			$randomCheese = mysqli_query($con, "SELECT * FROM cheese_db ORDER BY viewed DESC LIMIT 1");
			while ($row = mysqli_fetch_array($randomCheese)) {
				$cheese = $row['cheese'];
				$cid = $row['cid'];
				$imageFile = $row['image_file'];
				echo "<a href=\"" . BASE_URL . "cheese.php?cid=$cid\"><img src=\"" . BASE_URL . "images/thumbs100/$imageFile\"><br/>$cheese</a>" . "<br />";
			}
			?>

			<script>
				function updateTextMin(val) {
					document.getElementById('textMin').value = val;
				}

				function updateTextMax(val) {
					document.getElementById('textMax').value = val;
				}
			</script>


		</div>
	</div>