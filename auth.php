<?php
$con=mysqli_connect("fdb3.biz.nf","1504774_ccbin","NtioNt10","1504774_ccbin");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
// Prepare variables and hash.
$uid = hash("SHA512", $_POST['email']);
$hashp = hash("SHA512", $_POST['password']);
// Check for data in the tables.
$result = mysqli_query($con,"SELECT * FROM users WHERE uid='".$uid."' AND password='".$hashp."'");
$user_data = mysqli_fetch_array($result);
if ($user_data) {
    setcookie("login",$_POST['email']);
    header("Location: index.php");
} else {
    header("Location: login_fail.php");
}
?>