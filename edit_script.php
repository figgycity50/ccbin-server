<?php
$con = mysqli_connect("localhost","root","NtioNt10","ccbin");
$id = $_POST['id'];
 $response = file_get_contents("http://figgycity50.kd.io/ccbin/api.php?type=get&data=json&id=".$id);
 $paste_data = json_decode($response, true);
$result = mysqli_query($con,"SELECT * FROM users WHERE email='".$_COOKIE['login']."'");
$user_data = mysqli_fetch_array($result);
$owner = $user_data['username'];
if ($owner == $paste_data['owner']) {
mysqli_query($con,"UPDATE pastes SET contents = '".$_POST['paste']."' WHERE id='".$_POST['id']."'");
header('Location: index.php?id=' . $id);
} else {
  echo 'Why are you trying to edit someone else\'s paste? It is kinda rude.';  
}
?>