<?php
session_start();
if (isset($_SESSION['username'])) {
	// echo "Logged In.";
} else {
	//when using redirect, make sure that everything else works first. If not, remove redirect to debug.
	// echo "Not Logged In.";
	header("Location:welcome.php");
}
include("includes/header.php");
?>

<div class="row container mt-3">
	<div class="col-8" style="height:609px;overflow:scroll;overflow-y:scroll;overflow-x:hidden;">
	<div class="widget-styles">
	
		<h2 class="display-title">Explore the Many Cheeses!</h2><br />
		<?php

		// HERE IS THE DEFAULT QUERY: IF NOTHING BELOW THEN THIS QUERY WILL STAND; OTHERWISE, IT WILL BE OVERWRITTEN
		$sql = "SELECT * FROM cheese_db"; // SHOW EVERYTHING

		$displayby = $_GET['displayby'];
		$displayvalue = $_GET['displayvalue'];

		if ($displayby && $displayvalue) {
			if($displayby == "text"){
				$sql = "SELECT * FROM cheese_db WHERE cheese LIKE '%$displayvalue%'";
				echo "<h4 style=\"padding-left:2rem;color:brown;\">Cheese that matches your search '$displayvalue'.</h4>";

			}
			else{
				$sql = "SELECT * FROM cheese_db WHERE $displayby LIKE '$displayvalue'";
				if($displayby == "classification"){
					echo "<h4 style=\"padding-left:2rem;color:brown;\">These are all the $displayvalue cheeses.</h4>";
				}
					if($displayby == "type"){
						echo "<h4 style=\"padding-left:2rem;color:brown;\">These cheeses are made with $displayvalue milk.</h4>";
					}
			}
		}

		$min = $_GET['min'];
		$max = $_GET['max'];
		if ($displayby == "age" && $min && $max) {
			// $sql = "SELECT * FROM dogs WHERE...";
			$sql = "SELECT * FROM cheese_db WHERE age BETWEEN $min AND $max"; // SHOW ONLY DOGS FROM ID RANGE
			echo "<h4 style=\"padding-left:2rem;color:brown;\">These cheeses have been aged for $min to $max months.</h4>";
		}

		if ($displayby == "price" && $min && $max) {
			// $sql = "SELECT * FROM dogs WHERE...";
			$sql = "SELECT * FROM cheese_db WHERE price BETWEEN $min AND $max"; // SHOW ONLY DOGS FROM ID RANGE
			echo "<h4 style=\"padding-left:2rem;color:brown;\">These cheeses are priced from $$min to $$max.</h4>";
		}

		$result = mysqli_query($con, $sql); //OK. Let's run whatever query we have set above.


		if (!$result) { // THIS IS ONE WAY TO DEAL WITH A BAD QUERY SOMEHOW; WILL NOT SECURE OUR DB, BUT WILL DEGRADE GRACEFULLY FOR USER.
			echo "\n<p>Bad Query</p>\n";
			include("footer.php");
			exit();
		}
		// HANDLING NO RESULTS FROM A QUERY
		if (mysqli_num_rows($result) == 0) {
			echo "<h1>Nothing to Show</h1>";
		}
		// DISPLAY RESULTS: Only relevant results thumbnails should be displayed.
		if(!$displayby){
			echo "<h4 style=\"padding-left:2rem;color:brown;\">These are all the current cheeses.</h4>";
		}
		while ($row = mysqli_fetch_array($result)) {
			$cheese = $row['cheese'];
			$cid = $row['cid'];
			$image_file = $row['image_file'];
			echo "\n<div class=\"thumb\">";
			echo "<a href=\"cheese.php?cid=$cid\"><img src=\"images/squares80/$image_file\" /></a><br />";
			echo "<a href=\"cheese.php?cid=$cid\">$cheese</a><br />\n";
			echo "\n</div>";
		}

		?>
</div>




		<?php
		include("includes/footer.php");
		?>