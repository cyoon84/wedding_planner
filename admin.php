
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
<div class='navbar navbar-inverse'>
  <div class='navbar-inner'>
    <a class='brand' href='#'>Simon and Jenny's Wedding</a>
    <ul class='nav'>
      <li class='active'><a href='admin.php'>Front Page</a></li>
      <li><a href='guest_list.php?id=bride'>View Bride's List</a></li>
      <li><a href='guest_list.php?id=groom'>View Groom's List</a></li>
      <li><a href='#'>View No Show List</a></li>
    </ul>
 </div>

	<div class="hero-unit span9" id="display">
	  <h1>Admin Page</h1>
	  <p>View bride / groom's guest lists here!</p>
	  <p>

	  </p>
	</div>
</body>
</html>