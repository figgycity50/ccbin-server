<?php
$con=mysqli_connect("localhost","root","NtioNt10","ccbin");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
// Prepare variables and hash.
$uid = hash("SHA512", $_POST['email']);
$hashp = hash("SHA512", $_POST['passwd']);
// Check for data in the tables.
$result = mysqli_query($con,"SELECT * FROM users WHERE uid='".$uid."' AND password='".$passwd."'");
$user_data = mysqli_fetch_array($result);
if (!$user_data) {
    header("Location: login_fail.php");
} else {
    setcookie("login",$_POST['email']);
    header("Location: index.php");
}
?>