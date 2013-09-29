<?php
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

  if (isset($_GET["id"])) {
    $response = file_get_contents("http://ccbin.blaizecraft.com/api.php?type=get&data=json&id=".$_GET['id']);
    $paste_data = json_decode($response, true);
    header('Content-Type: text/plain');
    if($_GET['mode'] == title)
      echo $paste_data['name'];
    else
      echo textdecode($paste_data['contents']);
  } else {
      echo 'Error: Paste ID is invalid.';
  }
?>