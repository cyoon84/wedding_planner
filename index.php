<?php include('library.php');
$login_result = false;

if ($_POST) {
	if($login_result = login_to_db($_POST["uname"], $_POST["pw"]))
		mysql_close($db_con);
}
if ($login_result && $_SESSION["role"] == 1)
	header("Location: admin.php");
else if ($login_result && $_SESSION["role"] == 0)
	header("Location: guest.php");
else {
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <title><?php echo(TITLE . " :: " . LOGIN) ?></title>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="">
	    <meta name="author" content="Sanghyun Lee">
	    <meta name="author" content="Chulhee Yoon">

	    <!-- Le styles -->
	    <link href="css/bootstrap.css" rel="stylesheet">
	    <link href="css/bootstrap-responsive.css" rel="stylesheet">
	    <script src="http://code.jquery.com/jquery-1.8.0.js"></script>
	    <link href="style.css" rel="stylesheet">

	    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	    <!--[if lt IE 9]>
	      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	    <![endif]-->

	    <!-- Fav and touch icons -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
		<link rel="shortcut icon" href="ico/favicon.png">
	</head>

	<body>

		<div class="container">

			<form class="form-signin" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<h2 class="form-signin-heading"><?php echo LOGINHEADING ?></h2>
				<input type="text" class="input-block-level" placeholder="Email address" name="uname" />
				<input type="password" class="input-block-level" placeholder="Password" name="pw" />
				<div class="btn-group">
					<button class="btn btn-large btn-primary" type="submit">Sign in</button>
				</div>
				<?php if (!$login_result && $_POST) { ?>
				<div>&nbsp;</div>
				<div class="alert alert-error"><small><?php echo REENTER; ?></small></div>
				<?php } ?>
			</form>
		</div>
    
	    <?php print_footer(); ?>
	</body>
</html>
<?php
}
?>