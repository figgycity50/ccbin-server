<?php
include_once 'header.php';
if ($_GET['email']) {
    $email = $_GET['email'];   
} else {
    $email = $_COOKIE['login'];
}
require_once 'db.php';

$result = mysqli_query($con,"SELECT * FROM users WHERE email='".$email."'");
$user_data = mysqli_fetch_array($result);
?>
<div class="row">
<div class="col-md-1"></div>
<div class="col-md-8">
<?php
$pastes = mysqli_query($con,"SELECT * FROM pastes WHERE name LIKE '%".$_GET['q']."%'");

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