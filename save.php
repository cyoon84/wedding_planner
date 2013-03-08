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
	$qry = sprintf("SELECT refId FROM guestResponse WHERE refId='%s'", mysql_real_escape_string($_SESSION["uname"]));
	$qry_res = mysql_query($qry) or die ("There was an error selecting a row from user table.<br />".mysql_error());
	
	if (mysql_num_rows($qry_res) == 1) {
		$qry = sprintf("SELECT bringGuest FROM guestList WHERE refId='%s'", mysql_real_escape_string($_SESSION["uname"]));
		$qry_res = mysql_query($qry) or die ("There was an error selecting a row from user table.<br />".mysql_error());
		$row = mysql_fetch_array($qry_res);
		
		$db_statement = "UPDATE guestResponse SET ";
		$db_statement .= "phone='" . $_POST["phone"] . "', ";
		$db_statement .= "email='" . $_POST["emailadd"] . "', ";
		$db_statement .= "attending=" . $_POST["attending"] . ", ";
		$db_statement .= "vegetarian=" . $_POST["vegetarian"];
		if ($row["bringGuest"] == 1) {
			$db_statement .= ", ";
			$db_statement .= "bringGuest=";
			if ($_POST["attending"] == 1) {
				$db_statement .= $_POST["guest"];
			} else {
				$db_statement .= "0";
			}
			$db_statement .= ", guestName=";
			if ($_POST["attending"] == 1) {
				$db_statement .= "'" . $_POST["guestName"] . "'";
			} else {
				$db_statement .= "NULL";
			}
			$db_statement .= ", guestVeg=";
			if ($_POST["attending"] == 1) {
				$db_statement .= $_POST["guestVeg"];
			} else {
				$db_statement .= "NULL";
			}
		}
		$db_statement .= " WHERE refId='" . $_SESSION["uname"] . "'";
	} else {
		$qry = sprintf("SELECT bringGuest FROM guestList WHERE refId='%s'", mysql_real_escape_string($_SESSION["uname"]));
		$qry_res = mysql_query($qry) or die ("There was an error selecting a row from user table.<br />".mysql_error());
		$row = mysql_fetch_array($qry_res);
		
		$db_statement = "INSERT INTO guestResponse (refId, phone, email, attending, vegetarian";
		if ($row["bringGuest"] == 1) {
			$db_statement .= ", bringGuest, guestName, guestVeg";
		}
		$db_statement .= ") ";
		$db_statement .= "VALUES ('" . $_SESSION["uname"] . "', '";
		$db_statement .= $_POST["phone"] . "', '";
		$db_statement .= $_POST["emailadd"] . "', ";
		$db_statement .= $_POST["attending"] . ", ";
		$db_statement .= $_POST["vegetarian"];
		if ($row["bringGuest"] == 1) {
			$db_statement .= ", ";
			if ($_POST["attending"] == 1) {
				$db_statement .= $_POST["guest"];
			} else {
				$db_statement .= "0";
			}
			$db_statement .= ", ";
			if ($_POST["attending"] == 1) {
				$db_statement .= "'" . $_POST["guestName"] . "'";
			} else {
				$db_statement .= "NULL";
			}
			$db_statement .= ", ";
			if ($_POST["attending"] == 1) {
				$db_statement .= $_POST["guestVeg"];
			} else {
				$db_statement .= "NULL";
			}
		}
		$db_statement .= ")";
	}
	$db_add_res = mysql_query($db_statement);
	if ($db_add_res)
		// if insert is complete, redirect to view page
		header('Location: index.php');
	else
		// If the insert statement has failed in any way, display the following in error window
		$error_content = "An error has occurred while inserting/updating the table. please check again.";
} else {
	echo "<script language='JavaScript'>";
    echo "window.alert('" . $error_content . "');\n";
    echo "window.location.href='guest.php';\n";
    echo "</script>";
}?>