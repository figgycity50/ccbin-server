<?php
include_once 'header.php';

$con = mysqli_connect("localhost","root","NtioNt10","ccbin");

$result = mysqli_query($con,"SELECT * FROM users WHERE email='".$_COOKIE['login']."'");
$user_data = mysqli_fetch_array($result);

?>
<div class="row">
 <div class="col-md-1">
   &nbsp;<img src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( $_COOKIE['login'] ) ) ); ?>" style="display: inline;">
 </div>
 <div class="col-md-4">
 <h2 style="display: inline;"><?php echo $_COOKIE['login']; ?></h2><br>
 <h3><?php echo $user_data['username']; ?></h3>
 </div>
</div>