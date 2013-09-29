<?php
  require_once("settings.php");
  
  $con = new mysqli($db_host, $db_user, $db_pass, $db_name);

  // Check connection
  if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
  }

  $type = $_GET["type"]

  if (strcmp($type, "get") == 0) {
    $qry = "SELECT * FROM pastes WHERE id = ?;";
    $stmt = $con->prepare($qry);
    $stmt->bind_param("s", $_GET["id"]);

    // TODO: Fetch array and return it
    // here is the old way it was done without prepared statements
    // $paste_data = mysqli_fetch_array($result);
    // if ($paste_data['title'] == "") $paste_data['title'] = "Untitled";
    // if ($_GET['data'] == 'json') {
    //    $json_paste = json_encode($paste_data);
    //    echo $json_paste;
    // } else {
    //     echo '{id='.$paste_data['id'].', name="'.$paste_data['name'].'", contents= "'.$paste_data['contents'].'"}';
    // }
  } elseif (strcmp($type, "make") == 0) {
    //make a paste id
    function get_random_string($valid_chars, $length)
    {
        // start with an empty random string
        $random_string = "";

        // count the number of chars in the valid chars string so we know how many choices we have
        $num_valid_chars = strlen($valid_chars);

        // repeat the steps until we've created a string of the right length
        for ($i = 0; $i < $length; $i++)
        {
            // pick a random number from 1 up to the number of valid chars
            $random_pick = mt_rand(1, $num_valid_chars);

            // take the random character out of the string of valid chars
            // subtract 1 from $random_pick because strings are indexed starting at 0, and we started picking at 1
            $random_char = $valid_chars[$random_pick-1];

            // add the randomly-chosen char onto the end of our string so far
            $random_string .= $random_char;
        }

        // return our finished random string
        return $random_string;
    }
    function fixcodeblocks($string) {
      // Create a new array to hold our converted string
      $newstring = array();
      
      // This variable will be true if we are currently between two code tags
      $code = false;
      
      // The total length of our HTML string
      $j = mb_strlen($string);
      
      // Loop through the string one character at a time
      for ($k = 0; $k < $j; $k++) {
        // The current character
        $char = mb_substr($string, $k, 1);
        
        if ($code) {
          // We are between code tags
          // Check for end code tag
          if (atendtag($string, $k)) {
            // We're at the end of a code block
            $code = false;
            
            // Add current character to array
            array_push($newstring, $char);
            
          } else {
            // Change special HTML characters
            $newchar = htmlspecialchars($char, ENT_QUOTES);
            
            // Add character code to array
            array_push($newstring, $newchar);
          }
        } else {
          // We are not between code tags
          // Check for start code tag
          if (atstarttag($string, $k)) {
            // We are at the start of a code block
            $code = true;
          }
          // Add current character to array
          array_push($newstring, $char);
        }
      }
      //Turn the new array into a string
      $newstring = join("", $newstring);
      
      // Return the new string
      return $newstring;
    }
    function atstarttag($string, $pos) {
      // Only check if the last 6 characters are the start code tag
      // if we are more then 6 characters into the string
      if ($pos > 4) {
        // Get previous 6 characters
        $prev = mb_substr($string, $pos - 5, 6);
        
        // Check for a match
        if ($prev == "<code>") {
          return true;
        } else {
          return false;
        }
      } else {
        return false;
      }
    }
    function atendtag($string, $pos) {
      // Get length of string
      $slen = mb_strlen($string);
      
      // Only check if the next 7 characters are the end code tag
      // if we are more than 6 characters from the end
      if ($pos + 7 <= $slen) {
        // Get next 7 characters
        $next = mb_substr($string, $pos, 7);
        
        // Check for a match
        if ($next == "</code>") {
          return true;
        } else {
          return false;
        }
      } else {
        return false;
      }
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
    $pattern = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

    $fixedpaste = textencode($_POST["paste"]);
    $username = $_SESSION["uname"];
    $code = get_random_string($pattern, 6);
    $time = time();

    $qry = "INSERT INTO pastes (privacy, time, id, name, contents, owner) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = $con->prepare($qry);
    $stmt->bind_param("ssssss", urldecode($_POST["privacy"]), $time, $code, urldecode($_POST["title"]), $fixedpaste, $username);
    if (!$stmt->execute()) {
      die("Paste creation failed! :(");
    }
    $stmt->close();
    if (isset($_POST["head"]) && strcmp(urldecode($_POST["head"]), "true") == 0) {
      header("Location: index.php?id=".$code);
    } else {
      echo $code;
    }
  }
?>
