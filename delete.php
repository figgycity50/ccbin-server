<?php
  if (!isset($_POST["id"])) {
    die("No ID supplied");
  }

  require_once("settings.php");
  
  $con = new mysqli($db_host, $db_user, $db_pass, $db_name);

  // Check connection
  if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
  }

  $id = urldecode($_POST["id"]);
  $response = file_get_contents("http://ccbin.blaizecraft.com/api.php?type=get&data=json&id=".$id);
  $paste_data = json_decode($response, true);

  session_start();

  if (strcmp($_SESSION["uname"], $paste_data["owner"]) != 0) {
    header('Location: index.php?id=' . $id . '&nyp=yes');
  }

  $qry = "DELETE FROM pastes WHERE id = ?;";
  $stmt = $con->prepare($qry);
  $stmt->bind_param("s", urldecode($_POST["id"]));
  if (!$stmt->execute()) {
    die("Database error");
  }

  header('Location: profile.php');
?>