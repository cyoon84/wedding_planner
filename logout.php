<?php include('library.php');
	$loc = 'Location: index.php';
	if (!check_login()) {
	// redirect
		header($loc);
	}
	session_unset();
	setcookie("PHPSESSID", "", time() - 3600, "/");
	session_destroy();
	header($loc);
 ?>
