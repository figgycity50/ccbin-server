<?php
//load header
include_once 'header.php';
?>
<div class="jumbotron">
  <div class="container">
    <h1>Sign in to CCBin</h1>
    <p>Don't have account?</p>
    <p><a class="btn btn-primary btn-lg" href="register.php">Register</a></p>
  </div>
</div>
<form method="POST" action="auth.php">
<input type="email" placeholder="Email..." class="form-control" style="width: 25%" name="email"><br>
<input type="password" placeholder="Password..." class="form-control" style="width: 25%" name="password"><br>
<input type="submit" value="Login" class="btn btn-primary">
</form>