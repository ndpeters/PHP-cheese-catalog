<?php
include("../includes/mysql_connect.php"); // here we include the connection script; since this file(header.php) is included at the top of every page we make, the connection will then also be included. Also, config options like BASE_URL are also available to us.

session_start();
if (isset($_SESSION['PHP_Test_Secure'])) {
    // echo "Logged In.";
} else {
    //when using redirect, make sure that everything else works first. If not, remove redirect to debug.
    // echo "Not Logged In.";
    header("Location:login.php");
}

$cid = $_GET['id']; // page-setter variable

if (!is_numeric($cid)) {
    header("Location: edit.php");
} else {
    // echo $image_id;

    // Removing data in a DB: DELETE

    mysqli_query($con, "DELETE FROM cheese_db
        WHERE cid=$cid") or die(mysqli_error($con));

    header("Location: edit.php");
}
