<?php
$con=mysqli_connect("localhost","root","NtioNt10","ccbin_pastes");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
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
 echo '<h1>'.$pdata['name'].'</h1>';
 echo '<div class="paste"><pre><code>'.$pdata['contents'].'</code></pre></div>';
 echo '<a class="btn btn-primary" href="raw.php?id='.$_GET['id'].'">Raw</a>';
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