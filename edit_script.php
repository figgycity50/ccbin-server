<?php
  if (!(isset($_POST["id"]) && isset($_POST["paste"]))) {
    die("Missing information");
  }

  require_once("settings.php");
  
  $con = new mysqli($db_host, $db_user, $db_pass, $db_name);

  // Check connection
  if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
  }

  function textencode($encodetext){ 
    $encodevaule=""; 
    for($i=0;$i<strlen($encodetext);$i++){ 
      $teil=hexdec(rawurlencode(substr($encodetext, $i, 1))); 
      if($teil<32||$teil>1114111){ 
        $encodevaule.=substr($encodetext, $i, 1); 
      }else{ 
        $encodevaule.="&#".$teil.";"; 
      } 
    } 
    return $encodevaule; 
  } 

  function textdecode($decodetext){ 
    $decodevaule=""; 
    for($i=0;$i<strlen($decodetext);$i++){ 
      $teil=rawurlencode(substr($decodetext, $i, 1)); 
      if($teil<32||$teil>1114111){ 
        $decodevaule.=substr($decodetext, $i, 1); 
      }else{ 
        $decodevaule.="&#".$teil.";"; 
      } 
    } 
    return html_entity_decode($decodevaule, ENT_QUOTES); 
  }

  session_start();

  $id = urldecode($_POST['id']);
  $response = file_get_contents("http://ccbin.blaizecraft.com/api.php?type=get&data=json&id=".$id);
  $paste_data = json_decode($response, true);

  $qry = "SELECT username FROM users WHERE email = ?;";
  $stmt = $con->prepare($qry);
  $stmt->bind_param("s", $_SESSION["email"]);

  if (!$stmt->execute()) {
    die("Failed to get paste");
  }
  $stmt->bind_result($db_uname);
  $stmt->fetch();
  $stmt->close();

  if ($db_uname != null && strcmp($_SESSION["uname"], $paste_data["owner"]) == 0) {
    $qry = "UPDATE pastes SET contents = ? WHERE id = ?;";
    $stmt = $con->prepare($qry);
    $stmt->bind_param("ss", textencode(textdecode($_POST['paste'])), $id);

    if (!$stmt->execute()) {
      die("Failed to update paste");
    }

    $stmt->close();
    
    header('Location: index.php?id=' . $id);
  } else {
    header('Location: index.php?id=' . $id . '&nyp=yes');
  }
?>