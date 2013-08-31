<?php
$con=mysqli_connect("localhost","root","NtioNt10","ccbin_users");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
// Prepare variables and hash.
$uid = hash("SHA512", $_POST['email']);
$hashp = hash("SHA512", $_POST['passwd']);
// Check for data in the tables.
mysqli_query($con,"INSERT INTO table SET uid = '" . $uid . "', password = '" . $hashp . "', email = '" . $_POST['email'] . "', username = '" . $_POST['username'] . "'");
setcookie("login",$_POST['email']);
    header("Location: success.php");
?>