<?php
require_once 'db.php';
$id = $_POST['id'];
$response = file_get_contents("http://ccbin.blaizecraft.com/api.php?type=get&data=json&id=".$id);
$paste_data = json_decode($response, true);
$result = mysqli_query($con,"SELECT * FROM users WHERE email='".$_COOKIE['login']."'");
$user_data = mysqli_fetch_array($result);
$owner = $user_data['username'];
if ($_COOKIE['login'] and $owner == $paste_data['owner']) {
mysqli_query($con,"DELETE FROM pastes WHERE id='".$_POST['id']."'");
header('Location: profile.php');
} else {
header('Location: index.php?id=' . $id . '&nyp=yes');
}
?>