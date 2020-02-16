<?php
include("includes/header.php");
?>

<div class="row container mt-3">
	<div class="col-8" style="height:609px;overflow:scroll;overflow-y:scroll;overflow-x:hidden;font-size:0.8rem;">
	<div class="widget-styles">
	
		<h2 class="display-title">Explore the Many Cheeses!</h2><br />

<h5>What is this?</h5>
<p style="padding-left:2rem;">This is a catalog of different cheese from around the world. I have added many filters and custom widgets to assit you in discovering new cheeses.</p>
<p style="padding-left:2rem;">This project uses multiple tables; I have added a registration table to store users information. Once a user has registered, they can view all the different cheeses. However, if the user wishes to edit, add, or delete, they must be logged in as an admin.</p>
<p style="padding-left:2rem;">Below are a few features that can be found on this project.</p>
<ul style="font-size:0.8rem;">
<li><strong>Login/Register function added.</strong> <p style="padding:0.5rem 1rem;">Users that register will have their information stored in a seperate table. Additionally, all passwords are stored are encrypted rather than plain text.</p></li>
<li><strong>Custom Range selector added.</strong> <p style="padding:0.5rem 1rem;">A minimum value can be selected on the left slider, while a max is selcted on the right. The filter will return cheeses that are within the given range.</p></li>
<li><strong>Custom Partial Search.</strong> <p style="padding:0.5rem 1rem;">I created my own search form to query cheese by their name. This also works if the cheese contains a partial string.</p></li>
</ul>

<p style="color:red;"><strong>You must sign in or register!</strong></p>
<div class="row">
<a href="<?php BASE_URL; ?>admin/login.php">
<button class="btn btn-success pr-3 pl-3 mr-2 ml-4">Login</button>
</a>
<a href="<?php BASE_URL; ?>admin/register.php">
<button class="btn btn-info">Register</button>
</a>
</div>
		
</div>




		<?php
		include("includes/footer.php");
		?>