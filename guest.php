<?php include('library.php');
if (!check_login()) {
	// redirect
	$loc = 'Location: index.php';
	header($loc);
}
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

		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.css" rel="stylesheet">
		<script src="http://code.jquery.com/jquery-1.8.0.js"></script>
		<link href="style.css" rel="stylesheet">
		<link href="css/bootstrap.css" rel="stylesheet">

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
			<div class="btn-group">
				<form method="post" action="logout.php">
	        		<button class="btn btn-large btn-primary" type="submit">Log Out</button>
	        	</form>
    		</div>
    	</div>
    </body>
</html>
<?php print_footer(); ?>