<?php
if ($_GET['id']) {
    $response = file_get_contents("http://figgycity50.kd.io/ccbin/api.php?type=get&data=json&id=".$_GET['id']);
    $paste_data = json_decode($response, true);
    header('Content-Type: text/plain');
    if($_GET['mode'] == title) echo $paste_data['name'];
    else echo $paste_data['contents'];
} else {
    echo 'Error: Paste ID is invalid.';
}
