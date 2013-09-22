<?php
require_once 'db.php';

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

$id = $_POST['id'];
$response = file_get_contents("http://ccbin.blaizecraft.com/api.php?type=get&data=json&id=".$id);
$paste_data = json_decode($response, true);
$result = mysqli_query($con,"SELECT * FROM users WHERE email='".$_COOKIE['login']."'");
$user_data = mysqli_fetch_array($result);
$owner = $user_data['username'];
if ($_COOKIE['login'] and $owner == $paste_data['owner']) {
mysqli_query($con,"UPDATE pastes SET contents = '".textencode(textdecode($_POST['paste']))."' WHERE id='".$_POST['id']."'");
header('Location: index.php?id=' . $id);
} else {
header('Location: index.php?id=' . $id . '&nyp=yes');
}
?>