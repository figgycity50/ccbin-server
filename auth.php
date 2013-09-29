<?php
  if (!(isset($_POST["email"]) && isset($_POST["password"]))) {
    header("Location: login_fail.php");
  }

  require_once("settings.php");
  
  $con = new mysqli($db_host, $db_user, $db_pass, $db_name);

  // Check connection
  if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
  }

  $input_email = urldecode($_POST["email"]);
  $input_pass = urldecode($_POST["password"]);

  $hashed_email = hash("SHA512", $input_email);
  $hashed_pass = hash("SHA512", $input_pass);

  $qry = "SELECT username FROM users WHERE uid = ? AND password = ?;";
  $stmt = $con->prepare($qry);
  $stmt->bind_param("ss", $hashed_email, $hashed_pass);

  if (!$stmt->execute()) {
    header("Location: login_fail.php");
  }

  $stmt->bind_result($username);
  $stmt->fetch();
  $stmt->close();

  if ($username == null) {
    header("Location: login_fail.php");
  }

  session_start();

  $_SESSION["email"] = $input_email;
  $_SESSION["uname"] = $input_username;
?>