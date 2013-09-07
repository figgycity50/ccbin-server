<?php
// CCBin by figgycity50

//set 1. load stuff
include_once 'header.php';

//step 1.5. create the ccbin_get function
function ccbin_get() {
 $id = $_GET['id'];
 $response = file_get_contents("http://figgycity50.kd.io/ccbin/api.php?type=get&data=json&id=".$id);
 $paste_data = json_decode($response, true);
 return $paste_data;
}
//step 2. check for an id in the url
if ($_GET['id']) {
    $pdata = ccbin_get();
    //var_dump($pdata);
    if ($pdata['owner'] == "") {
        $owner = "a guest user";
    } else {
        $owner = $pdata['owner'];
    }
    if ($pdata['time'] == "0") {
        $time = "before pastes tracked time";
    } else {
        $time = "on ".date("l d F Y", $pdata['time']);
    }
if ($_GET['nyp'] == "yes") {
    echo '<div class="alert alert-danger"><b>Error:</b> This paste does not belong to you.</div>';
}
 echo '<h1>'.$pdata['name'].'</h1><h4> by '.$owner.' | made '.$time.'</h4>';
 echo '<div class="paste"><pre><code>'.htmlspecialchars($pdata['contents']).'</code></pre></div>';
 echo '<a class="btn btn-primary" href="raw.php?id='.$_GET['id'].'">Raw</a> <a class="btn btn-success" id="copy" href="#">Copy</a> <a class="btn btn-warning" id="copy" href="edit.php?id='.$_GET['id'].'">Edit</a>';
} else {
    echo '<h1>New Paste</h1>';
    echo '<form method="POST" action="api.php"> Title:';
    echo '<input type="text" name="title"><br>';
    echo '<textarea name="paste" style="width:75%; height:500px;"></textarea><br>';
    echo '<input type="hidden" name="type" value="make">';
    echo '<input type="hidden" name="head" value="true">';
    echo '<input type="submit" class="btn btn-default" value="Create Paste">';
    echo '</form>';
}

?>