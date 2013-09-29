<!DOCTYPE html>
<?php
	session_start();
	function curPageName() {
		return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
	}
?>
<html>
	<head>
		<title>CCbin</title>
		<!--CSS-->
		<link rel="stylesheet" href="css/reset.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/mobile.css">
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="css/core.css">
		<link rel="stylesheet prefetch" href="css/tomorrow-night.min.css">
		<!--JavaScript -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
		<script src="js/parsley.min.js"></script>
		<script src="js/autoresize.js"></script>
		<script src="js/highlight.pack.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
			  $('pre').each(function(i, e) {
				hljs.highlightBlock(e);
			  });
			});
			$('.dropdown-toggle').dropdown();
		    $('#loginBtn').click($('#myModal').modal('toggle'));
		    hljs.tabReplace = '    ';
		    hljs.initHighlightingOnLoad();
		</script>
		<link rel="shortcut icon" href="favicon.ico" />
	</head>
	<body>
		<nav class="navbar navbar-default">
			<a class="navbar-brand" href="index.php"><img src="logo.png" alt="CCbin"></a>

			<div class="navbar-right">
				<?php
				if (isset($_SESSION["email"])) {
				?>
				<ul class="dropdown" style="list-style-type: none;">
					<li class="dropdown">
					  <a data-toggle="dropdown" href="#" class="dropdown-toggle navbar-text" style="text-decoration: none;">
					  <img src="http://www.gravatar.com/avatar/<?php echo md5( strtolower( trim( $_COOKIE['login'] ) ) ); ?>?s=24&d=mm"> <?php echo $_SESSION["email"]; ?>
					   <b class="caret"></b>
					  </a>
						  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
							<li role="presentation"><a role="menuitem" tabindex="-1" href="todo.php">ToDo</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="pastes.php">My pastes</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="profile.php">My profile</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="index.php">New paste</a></li>
							<li role="presentation" class="divider"></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="logout.php">Log out</a></li>
							<li role="search">
								<form method="GET" action="search.php" id="search" class="navbar-form" role="search">
								<input id="speech-input-field" class="form-control" type="search" x-webkit-speech="" name="q" onwebkitspeechchange="$( '#search' ).submit();" style="display: inline; width: 100%">
								<input type="hidden" name="tts" value="0">
								</form>
							</li>
						</ul>
					</li>
				</ul>
				
				<?php
				} else {
				?>
				<ul class="nav navbar-nav" style="display:inline;">
				<li><a href="login.php">Log In</a></li>
				<li role="presentation"><a role="menuitem" tabindex="-1" href="todo.php">ToDo</a></li>
			</div>
		<?php
		}
		?>
		</nav>
		<?php
		if (file_exists('note.txt')) {
		  $note = file_get_contents('note.txt');
		  if (!$note = " ") {
		  echo '<div class="alert alert-success"><b>Note:</b> '.$note.'</a></div>';
		  }
		}
		?>
		<div class="wrapper"> <!-- wrapper start -->