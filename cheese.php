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



<div class="row container">
	<div class="col-8" style="height:609px;overflow:scroll;overflow-y:scroll;overflow-x:hidden;">
	<div class="widget-styles">
	
		<?php


		$cid = $_GET['cid'];


		// HERE IS THE DEFAULT QUERY: IF NO IF/THENS BELOW ARE TRUE THEN THIS QUERY WILL STAND; OTHERWISE, IT WILL BE OVERWRITTEN
		$result = mysqli_query($con, "SELECT * FROM cheese_db WHERE cid = '$cid'"); // SHOW EVERYTHING


		// HANDLING NO RESULTS FROM A QUERY
		if (mysqli_num_rows($result) == 0) {
			echo "<h1>Nothing to Show</h1>";
		}

		while ($row = mysqli_fetch_array($result)) {

			$cheese = $row['cheese'];
			echo "<h2 class=\"display-title\">$cheese</h2><br />";
			$image_file = $row['image_file'];
			echo "<img src=\"images/display/$image_file\" /><br />";


			echo "<b>Milk:</b> " . $row['type'] . "<br />";
			echo "<b>Country:</b> " . $row['country'] . "<br />";
			echo "<b>Classification:</b> " . $row['classification'] . "<br />";
			if ($row['age'] != 0) {
				echo "<b>Age:</b> " . $row['age'] . " months<br />";
			}
			if ($row['price'] != 0) {
				echo "<b>Price:</b> $" . $row['price'] . "/Lb<br />";
			}
			echo "<b>Description:</b> " . $row['description'] . "<br />";
			$returnToLastQuery = "<p><b><a href=\"" . $_SERVER['HTTP_REFERER'] . "\">Back</a></b></p>";
			echo $returnToLastQuery;
			// IF A USER DECIDES TO VIEW THIS ONE ITEM IN FULL DETAIL, PERHAPS WE COULD CONSIDER THIS AS "POPULAR" AND START RECORDING "HITS"
			mysqli_query($con, "UPDATE cheese_db SET viewed = viewed +1 WHERE cid = '$cid'") or die(mysqli_error($con));
		}

		?>
</div>
		<?php
		include("includes/footer.php");
		?>