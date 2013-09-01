<?php
$con=mysqli_connect("localhost","root","NtioNt10","ccbin");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
// Prepare variables and hash.
$uid = hash("SHA512", $_POST['email']);
$hashp = hash("SHA512", $_POST['password']);
// Check for data in the tables.
//git?<<<<<<< HEAD
$result = mysqli_query($con,"SELECT * FROM users WHERE uid='".$uid."' AND password='".$hashp."'");
//git?=======
//git? >>>>>>> 55377a097b9016d780fd31e2fc841a0f247339c3
$user_data = mysqli_fetch_array($result);
if ($user_data) {
    setcookie("login",$_POST['email']);
    header("Location: index.php");
} else {
    header("Location: login_fail.php");
}
?>