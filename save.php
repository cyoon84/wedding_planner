<?php 
include ('library.php');
if (!check_login()) {
	// redirect
		$loc = 'Location: index.php';
		header($loc);
}
?>
<?php
if ($_POST)
	$error_content = validate();

// inserts into the table inventory if the validation is passed
if (is_null($error_content) && $_POST) {
	$db_statement = "SELECT * FROM weddingPlanner WHERE ";
	$db_statement .= "email='" + $_POST["emailadd"] . "'";
	$db_select_res = mysql_query($db_statement);
	if ($db_select_res) {
		$db_statement = "UPDATE weddingPlanner SET ";
		$db_statement .= "firstName='" . $_POST["fname"] . "', ";
		$db_statement .= "lastName='" . $_POST["lname"] . "', ";
		$db_statement .= "email='" . $_POST["emailadd"] . "', ";
		$db_statement .= "password='" . $_POST["pwd"] . "', ";
		$db_statement .= "phone='" . $_POST["phone"] . "', ";
		$db_statement .= "isattending=" . $_POST["isAttending"] . ", ";
		$db_statement .= "plusGuest=" . $_POST["plusGuest"] . ", ";
		$db_statement .= "isVegetarian=" . $_POST["isVegetarian"] . ", ";
		$db_statement .= "reference='" . $_POST["reference"] . "' ";
		$db_statement .= "WHERE email=" . $_POST["emailadd"];
	} else {
		$db_statement = "INSERT INTO weddingPlanner (firstName, lastName, email, password, phone, isattending, plusGuest, isVegetarian, reference) ";
		$db_statement .= "VALUES ('" . $_POST["fname"] . "', '";
		$db_statement .= $_POST["lname"] . "', '";
		$db_statement .= $_POST["emailadd"] . "', '";
		$db_statement .= md5($_POST["pwd"]) . "', '";
		$db_statement .= $_POST["phone"] . "', ";
		$db_statement .= $_POST["isAttending"] . ", ";
		$db_statement .= $_POST["plusGuest"] . ", ";
		$db_statement .= $_POST["isVegetarian"] . ", '";
		$db_statement .= $_POST["reference"] . "')";
	}
	$db_add_res = mysql_query($db_statement);
	if ($db_add_res)
		// if insert is complete, redirect to view page
		header('Location: login.php');
	else
		// If the insert statement has failed in any way, display the following in error window
		$error_content = "An error has occurred while inserting/updating the table. please check again.";
} ?>