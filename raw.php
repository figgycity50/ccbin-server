<?php
if ($_GET['id']) {
    $response = file_get_contents("http://figgycity50.kd.io/ccbin/api.php?type=get&data=json&id=".$_GET['id']);
    $paste_data = json_decode($response, true);
    echo $paste_data['contents'];
} else {
    echo 'Error: Paste ID is invalid.';
}
