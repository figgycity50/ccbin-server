<!DOCTYPE html>
<html>
<head>
<title>CCbin</title>
<!--bootstrap stuff-->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
<!-- add our mobile css -->
<link rel="stylesheet" href="mobile.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="//code.jquery.com/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

<!--reference highlight.js -->
<link rel="stylesheet" href="../css/googlecode.css">
<script src="../js/highlight.pack.js"></script>
<script>
  $('.dropdown-toggle').dropdown();
  $('#loginBtn').click($('#myModal').modal('toggle'));
  hljs.tabReplace = '    ';
  hljs.initHighlightingOnLoad();
  </script>
  
<!--Icon-->
<link rel="shortcut icon" href="favicon.ico" />
</head>
<body>
<nav class="navbar navbar-default">
<a class="navbar-brand" href="index.php"><img src="logo.png" alt="CCbin"></a>
<div class="pull-right">
<?php
if ($_COOKIE['login']) {
?>
<div class="dropdown">
  <!-- Link or button to toggle dropdown -->
  <a data-toggle="dropdown" href="#" class="dropdown-toggle navbar-text" style="text-decoration: none;">
  <img src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( $_COOKIE['login'] ) ) ); ?>?s=24&d=mm"> <?php echo $_COOKIE['login']; ?>
  </a>
  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
    <li role="presentation"><a role="menuitem" tabindex="-1" href="pastes.php">My pastes</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="profile.php">My profile</a></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="index.php">New paste</a></li>
    <li role="presentation" class="divider"></li>
    <li role="presentation"><a role="menuitem" tabindex="-1" href="logout.php">Log out</a></li>
  </ul>
</div>
<?php
} else {
?>
<ul class="nav navbar-nav">
<li><a href="login.php">Log In</a></li>
</div>
<?php
}
?>
</nav>
