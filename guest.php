<?php include('library.php');
if (!check_login()) {
	// redirect
	$loc = 'Location: index.php';
	header($loc);
}
echo 'Hello! welcome!';
?>
    <?php print_footer(); ?>