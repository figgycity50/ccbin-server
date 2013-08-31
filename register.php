<?php
//load header
include_once 'header.php';
?>
<div class="jumbotron">
  <div class="container">
    <h1>Sign up for CCBin</h1>
    <p>You will not regret it.</p>
  </div>
</div>
<form method="POST" action="account_new.php">
<input type="text" placeholder="Username..." class="form-control" style="width: 25%" name="username"><br>
<input type="email" placeholder="Email..." class="form-control" style="width: 25%" name="email"><br>
<input type="password" placeholder="Password..." class="form-control" style="width: 25%" name="password"><br>
<input type="submit" value="Login" class="btn btn-primary">
</form>