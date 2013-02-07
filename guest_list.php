<?php include('library.php');
if (!check_login()) {
	// redirect
		$loc = 'Location: index.php';
		header($loc);
}


?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo(TITLE . " :: View Guest Lists") ?></title>
<meta charset='UTF-8'>
<link href='css/bootstrap.css' rel='stylesheet'>
<link href='style.css' rel='stylesheet'>
<link href='css/bootstrap-responsive.css' rel='stylesheet'>
<script src='http://code.jquery.com/jquery-1.8.0.js'></script>
<script src='js/bootstrap.js'></script>
</head>
<body>
<div class='navbar navbar-inverse navbar-fixed-top'>
<?php
	$id = $_GET['id'];
	$menu = render_menu($id);
	echo $menu;
?>
</div>

<div class="container" style="margin-top:70px">
 <div id="contentArea" class="span12">
	  <h1>View guest list - <small>for 
	  	<?php 
	  		if ($id == 'bride') {
	  			echo BR;
	  		}
	  		if ($id == 'groom') {
	  			echo GR;
	  		}
	  		if ($id == 'noShow') {
	  			echo NOTATND;
	  		}
	  	?>
	  </small></h1>

	  <table class="table" id="guestTable">
	  <thead>
	  	<th style="width:30%">Name</th>
	  	<th style="width:30%">E-mail</th>
	  	<th style="width:20%">Bringing Guest?</th>
	  	<th style="width:20%">Vegetarian?</th>

	  </thead>
	  <tbody>
	  	<?php
	  		echo fillinTable($id);

	  	?>
	  </tbody>
	</table>
</div>
</div>
</body>
</html>