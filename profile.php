<?php
include_once 'header.php';
if ($_GET['email']) {
    $email = $_GET['email'];   
} else {
    $email = $_COOKIE['login'];
}
$con = mysqli_connect("localhost","root","NtioNt10","ccbin");

$result = mysqli_query($con,"SELECT * FROM users WHERE email='".$email."'");
$user_data = mysqli_fetch_array($result);

?>
<div class="row">
 <div class="col-md-1">
   &nbsp;<img src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( $email ) ) ); ?>?d=mm" style="display: inline;">
 </div>
 <div class="col-md-4">
 <h2 style="display: inline;"><?php echo $email; ?></h2><br>
 <h3><?php echo $user_data['username']; ?></h3>
 </div>
</div>
<div class="row">
<div class="col-md-1"></div>
<div class="col-md-8">
<?php
$pastes = mysqli_query($con,"SELECT * FROM pastes WHERE owner = '".$user_data['username']."'");

echo "<table border='1' class='table table-bordered'>
<tr>
<th>Title</th>
</tr>";

while($row = mysqli_fetch_array($pastes))
  {
  echo "<tr>";
  echo '<td><a href="index.php?id=' . $row['id'] . '">' . $row['name'] . "</a></td>";
  echo "</tr>";
  }
echo "</table>";
?>
</div>
</div>