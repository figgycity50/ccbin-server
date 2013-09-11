<?php
// CCBin by figgycity50

//set 1. load stuff
include_once 'header.php';

//step 1.5. create the ccbin_get function
function ccbin_get() {
 $id = $_GET['id'];
 $con = mysqli_connect("fdb3.biz.nf","1504774_ccbin","NtioNt10","1504774_ccbin");
 $result = mysqli_query($con,"SELECT * FROM pastes WHERE id='".$id."'");
 $paste_data = mysqli_fetch_array($result);
 $resul2 = mysqli_query($con,"SELECT * FROM users WHERE email='".$_COOKIE['login']."'");
 $user_data = mysqli_fetch_array($resul2);
 if ($paste_data['privacy'] == "private" and $user_data['username'] != $paste_data['owner']) {
    return "private";
 }
 return $paste_data;
}
//step 2. check for an id in the url
if ($_GET['id']) {
    $pdata = ccbin_get();
    //var_dump($pdata);
    if ($pdata == "private") {
    echo '<div class="alert alert-danger"><b>Error:</b> This paste is private and does not belong to you.</a></div>';
    exit;
    }
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
    echo '<input type="text" name="title" class="form-control"><br>';
    echo '<select name="privacy">';
    echo '<option value="private" active>Private</option>';
    echo '<option value="public">Public</option>';
    echo '</select>';
    echo '<textarea name="paste" style="width:100%; height:100%; resize: none;" class="form-control"></textarea><br>';
    echo '<input type="hidden" name="type" value="make">';
    echo '<input type="hidden" name="head" value="true">';
    echo '<input type="submit" class="btn btn-default" value="Create Paste">';
    echo '</form>';
}

?>