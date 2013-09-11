<?php
$con = mysqli_connect("fdb3.biz.nf","1504774_ccbin","NtioNt10","1504774_ccbin");
$id = $_POST['id'];
$response = file_get_contents("http://figgycity50.kd.io/ccbin/api.php?type=get&data=json&id=".$id);
$paste_data = json_decode($response, true);
$result = mysqli_query($con,"SELECT * FROM users WHERE email='".$_COOKIE['login']."'");
$user_data = mysqli_fetch_array($result);
$owner = $user_data['username'];
if ($_COOKIE['login'] and $owner == $paste_data['owner']) {
mysqli_query($con,"UPDATE pastes SET contents = '".$_POST['paste']."' WHERE id='".$_POST['id']."'");
header('Location: index.php?id=' . $id);
} else {
header('Location: index.php?id=' . $id . '&nyp=yes');
}
?>