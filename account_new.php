<?php
require_once 'db.php';
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
// Prepare variables and hash.
if ($_POST['password'] == $_POST['rpassword'])
{
    $uid = hash("SHA512", $_POST['email']);
    $hashp = hash("SHA512", $_POST['password']);
    // Check for data in the tables.
    mysqli_query($con,"INSERT INTO users SET uid = '" . $uid . "', password = '" . $hashp . "', email = '" . $_POST['email'] . "', username = '" . $_POST['username'] . "'");
    setcookie("login",$_POST['email']);
    header("Location: success.php");
}
else header("Location: register_fail.php");
?>