<?php
  require_once("settings.php");

  // Check all post data is present
  if (!(isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["rpassword"]))) {
    header("Location: register_fail.php");
  }

  // get all post data and decode it
  $input_username = urldecode($_POST["username"]);
  $input_email = urldecode($_POST["email"]);
  $input_password = urldecode($_POST["password"]);
  $input_rpassword = urldecode($_POST["rpassword"]);

  // make sure the passwords match
  if (strcmp($input_password, $input_rpassword) != 0) {
    header("Location: register_fail.php");
  }

  $hashed_email = hash("SHA512", $input_email);
  $hashed_pass = hash("SHA512", $input_password);

  // create a new mysql connection - variables are taken from settings.php
  $con = new mysqli($db_host, $db_user, $db_pass, $db_name);

  // make sure the connection established
  if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
  }

  // check if the username is already in use
  // create a prepared statement
  $qry = "SELECT COUNT(username) FROM users WHERE username = ?;";
  $stmt = $con->prepare($qry);
  // bind the input into the prepared statement
  $stmt->bind_param("s", $input_username);
  if (!$stmt->execute()) {
    header("Location: register_fail.php");
  }

  // bind the returned data to variables
  $stmt->bind_result($usernameCount);
  $stmt->fetch();
  // make sure its a unique username
  if ($usernameCount != 0) {
    header("Location: register_fail.php");
  }
  $stmt->close();

  // check if the email is already in use
  $qry = "SELECT COUNT(email) FROM user WHERE email = ?;";
  $stmt = $con->prepare($qry);
  $stmt->bind_param("s", );
  if (!$stmt->execute()) {
    header("Location: register_fail.php");
  }
  $stmt->bind_result($emailCount);
  $stmt->fetch();
  if ($emailCount != 0) {
    header("Location: register_fail.php");
  }
  $stmt->close();


  // create the user, TODO: You may have to tweak the order of these to reflect order in your db, cannot remember if that matters or not
  $qry = "INSERT INTO users (uid, password, email, username) VALUES (?, ?, ?, ?);";
  $stmt = $con->prepare($qry);
  $stmt->bind_param("ssss", $hashed_email, $hashed_pass, $input_email, $input_username);

  if (!$stmt->execute()) {
    header("Location: register_fail.php");
  }

  session_start();

  $_SESSION["email"] = $input_email;
  $_SESSION["uname"] = $input_username;

  header("Location: success.php");
?>