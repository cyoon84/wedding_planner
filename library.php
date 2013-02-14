<?php
	// connects to the database
	$db_name = "fssto651_weddingPlanner";
	$db_username = "fssto651";
	$db_pwd = "Fsstoronto123";
	$db_con = mysql_connect("localhost", $db_username, $db_pwd) or die("There was an error connecting");

	mysql_select_db($db_name) or die("There was an error in selecting the database.");

	session_start();

	define('TITLE', 'Simon and Jenny\'s Wedding');
	define('LOGIN', 'Log In');
	define('RSVP', 'RSVP');
	define('GUESTMGR', 'Guest Manager');
	define('TY', 'Thank You');
	define('VIEW', 'View Guests');
	define('GR', 'Groom');
	define('BR', 'Bride');
	define('NOTATND', 'Not Attending');
	define('NOANSW', 'Not Answered');
	define('ADMIN', 'Admin Page');
	define('LOGINHEADING', 'RSVP');
	define('REENTER', 'Invalid E-Mail Address or password. <br />Please try again.');
	define('YES', 'Yes');
	define('NO', 'No');
	
	/* Functions for Log In Start */

	// checks if there exists a session id uname and returns result
	function check_login() {
		return isset($_SESSION["uname"]);
	}

	// log in procedure

	function login_to_db($uname, $pword) {
		$success = false;
		$role = 0;

		// extracts a row from users table that matches user name from the input.
		// the input has been securely enhanced by using mysql_real_escape_string()

		$qry = sprintf("SELECT password, role FROM guestList WHERE refId='%s'", mysql_real_escape_string($uname));
		$qry_res = mysql_query($qry) or die ("There was an error selecting a row from user table.<br />".mysql_error());

		// if there is a row extracted, there is a user id that matches the input by the user
		if (mysql_num_rows($qry_res) == 1) {
			$row = mysql_fetch_array($qry_res);
			// holds values from the extracted row
			$encrypted_pw = $row["password"];
			$role = $row["role"];
			// compare the encrypted password
			if ($encrypted_pw == md5($pword)) {
				$success = true;
				// sets the attempt to true, and stores session values accordingly
				setcookie ("PHPSESSID", session_id(), time() + 600);
				$_SESSION["uname"] = $uname;
				$_SESSION["role"] = $role;
			}
		}
		// otherwise, login attempt failed
		return $success;
	}

	/* Functions for Log In End */

	/* Printing footer */
	function print_footer() {
		$content = "<div id=\"footer\">";
		$content .= "\n\t\t\tCopyright &copy; 2013 SLCY";
		$content .= "\n\t\t</div>\n";
		echo $content;
	}

	/* rendering menu at admin page */
	function render_menu($id) {
		$menu_html =  "<div class='navbar-inner'><div class='container'><a class='brand' href='admin.php'>Simon and Jenny's Wedding</a><ul class='nav'><li><a href='admin.php'><i class='icon-home'></i>&nbsp;Front Page</a></li>";

  		$menu_html = $menu_html. 

  		                      "<li class='dropdown'>
                        <a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class='icon-list'></i>&nbsp;View Lists <b class='caret'></b></a>
                        <ul class='dropdown-menu'>
                          <li><a href='guest_list.php?id=bride'>Bride's List</a></li>
                          <li><a href='guest_list.php?id=groom'>Groom's list</a></li>
                          <li class='divider'></li>
                          <li><a href='guest_list.php?id=noShow'>No show list</a></li>
                          <li><a href='guest_list.php?id=noAnswer'>No answer list</a></li>

                        </ul>
                      </li></ul>";
  		$menu_html = $menu_html."<ul class='nav pull-right'><li><a href='logout.php'><i class='icon-off'></i>&nbsp;Logout</a></li></ul></div></div>";
  		return $menu_html;
	}
	
	function fillinTable($id) {
		if ($id == 'bride' || $id == 'groom') {
			$sql = "select a.firstName, a.lastName, b.phone, b.email, b.attending, b.bringGuest, b.guestFName, b.guestLName, b.vegetarian, b.guestVeg from guestList a inner join guestResponse b on a.refId = b.refId where a.role = '0' and a.guestOf ='$id' and b.attending = '1'";
	  	} else {
	  		if ($id == 'noShow') {
	  			$sql = "select a.firstName, a.lastName, b.phone, b.email, b.attending, b.bringGuest, b.guestFName, b.guestLName, b.vegetarian, b.guestVeg from guestList a inner join guestResponse b on a.refId = b.refId where a.role = '0' and b.attending = '0'";
	  		} 
	  		if ($id == 'noAnswer') {
	  			$sql = "SELECT firstName, lastName FROM guestList WHERE role=0 AND refId NOT IN (SELECT refId FROM guestResponse)";
	  		}
	  	}
	  	$result = mysql_query($sql);
	  	$html_table_contents = '';
	  	if ($result) {
	  		while ($row = mysql_fetch_array($result)) {
	  			$name = $row['lastName'].",".$row['firstName'];
	  			$guest_name = $row['guestLName'].",".$row['guestFName'];
	  			$guest = '';
	  			$isVegetarian = '';
	  			$guestVegetarian = '';

	  			if ($row['bringGuest'] == '1') {
	  				$guest = YES;
	  			} else {
	  				$guest = NO;
	  			}

	  			if ($row['vegetarian'] == '1') {
	  				$isVegetarian = YES;
	  			} else {
	  				$isVegetarian = NO;
	  			}

				if ($row['guestVeg'] == '1') {
	  				$guestVegetarian = YES;
	  			} else {
	  				$guestVegetarian = NO;
	  			}
	  			if ($id == 'bride' || $id == 'groom') {
	  				$html_table_contents = $html_table_contents."<tr><td>".$name."</td><td>".$row['email']."</td><td>".$guest."</td><td>".$guest_name."</td><td>".$isVegetarian."</td><td>".$guestVegetarian."</td></tr>";
	  			} else {
	  				if ($id == 'noShow') {
	  					$html_table_contents = $html_table_contents."<tr><td>".$name."</td><td>".$row['email']."</td></tr>";
	  				}
	  				if ($id == 'noAnswer') {
	  					$html_table_contents = $html_table_contents."<tr><td>".$name."</td></tr>";
	  				}

	  			}	
	  		}
	  	}
	  	return $html_table_contents;
	}

	function validate() {
		$content = "";
		$flag = FALSE;
		if (trim($_POST["fname"]) == "" || trim($_POST["lname"]) == "" || trim($_POST["emailadd"]) == "" || 
			trim($_POST["pwd"]) == "" || trim($_POST["cpwd"]) == "" || trim($_POST["phone"]) == "") {
			$content .= "Please fill in all fields.<br />";
			$flag = TRUE;
		}
		if ($_POST["pwd"] != $_POST["cpwd"]) {
			$content .= "Please confirm your password correctly.<br />";
			$flag = TRUE;
		}
		if (!filter_var($_POST["emailadd"], FILTER_VALIDATE_EMAIL)) {
			$content .= "Please enter a valid email address.<br />";
			$flag = TRUE;
		}
		if ($flag)
			return $content;
		else
			return NULL;
	}

	/*
	 * Retrieves whether the user is given permission to bring guest or not.
	 */
	function retrieve_bringGuest($userId) {

		$qry = sprintf("SELECT bringGuest FROM guestList WHERE refId='%s'", mysql_real_escape_string($userId));
	  	$qry_res = mysql_query($qry) or die ("There was an error selecting a row from user table.<br />".mysql_error());
	  	$res = NULL;

	  	// retrieve the user's bringGuest result and return
	  	if (mysql_num_rows($qry_res) == 1) {
	  		$row = mysql_fetch_array($qry_res);
	  		$res = $row["bringGuest"];
	  	}
	  	return $res;
	}

	function retrieve_guest($userId) {
		$qry = sprintf("SELECT firstName, lastName, phone, email, attending, r.bringGuest, guestFName, guestLName, vegetarian, guestVeg FROM guestList LEFT JOIN guestResponse r USING (refId) WHERE refId='%s'", mysql_real_escape_string($userId));
		$qry_res = mysql_query($qry) or die ("There was an error selecting a row from user table.<br />".mysql_error());

	  	// retrieve the user's bringGuest result and return
	  	if (mysql_num_rows($qry_res) == 1) {
	  		$row = mysql_fetch_array($qry_res);
	  		return $row;
	  	} else {
	  		return NULL;
	  	}
	}
?>