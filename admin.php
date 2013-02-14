<?php 
include ('library.php');
if (!check_login()) {
	// redirect
		$loc = 'Location: index.php';
		header($loc);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo(TITLE . " :: " . ADMIN) ?></title>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="style.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<script src="http://code.jquery.com/jquery-1.8.0.js"></script>
<script src="js/bootstrap.js"></script>
</head>
<body>
<div class='navbar navbar-inverse navbar-fixed-top'>
<?php
	$id = $_GET['id'];
	$menu = render_menu($id);
	echo $menu;
?>
 </div>
 <div class="container"  style="margin-top:80px">
	<div class="hero-unit span9">
		<h1>Admin Page</h1>
		<p>View bride / groom's guest lists here!</p>
	</div>
</div>
</body>
</html>