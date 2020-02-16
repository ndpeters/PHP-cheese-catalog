<?php
// retrieve the user submitted data and echo to test.
// $username = $_POST['username'];
// $password = $_POST['password'];

include("/home/npeters5/data/data.php");
if (isset($_POST['mysubmit'])) {
	// echo "submitted";
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	// echo "$username, $password";
	if (($username == $username_good) && (password_verify($password, $pw_enc))) {
		session_start();
		$_SESSION['PHP_Test_Secure'] = session_id();

		header("Location:insert.php"); // redirect user

		// $msg = "SUCCESS!";


	} else {
		if ($username != "" && $password != "") {
			$msg = "Incorrect Login";
		} else {
			$msg = "Please enter a username & password.";
		}
	} //\username, pw good
}
include("../includes/header.php");

// echo "$username_good, $pw_enc";

?>

<div class="row container">
	<div class="col-8" style="height:609px;overflow:scroll;overflow-y:scroll;overflow-x:hidden;">

		<h1>Register</h1>
		<br />
		<br />



  <form method="post" action="register.php">
  	<?php include('../registration/errors.php'); ?>
  	<div class="form-group">
  	  <label>Username</label>
  	  <input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="form-group">
  	  <label>Email</label>
  	  <input class="form-control" type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="form-group">
  	  <label>Password</label>
  	  <input class="form-control" type="password" name="password_1">
  	</div>
  	<div class="form-group">
  	  <label>Confirm password</label>
  	  <input class="form-control" type="password" name="password_2">
  	</div>
  	<div class="form-group">
  	  <button type="submit" class="btn btn-info" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>



		<?php
		include("../includes/footer.php");
		?>