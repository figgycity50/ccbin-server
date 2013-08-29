<?php
if ($_GET['id']) {
    $response = file_get_contents("http://figgycity50.kd.io/ccbin/api.php?type=get&data=json&id=".$_GET['id']);
    $paste_data = json_decode($response, true);
    echo '<pre style="word-wrap: break-word; white-space: pre-wrap;">'.$paste_data['contents'].'</pre>';
} else {
    echo 'Error: Paste ID is invalid.';
}