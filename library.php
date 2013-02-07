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

		$qry = sprintf("SELECT password, role FROM weddingPlanner WHERE email='%s'", mysql_real_escape_string($uname));
		$qry_res = mysql_query($qry) or die ("There was an error selecting a row from user table.<br />".mysql_error());

		// if there is a row extracted, there is a user id that matches the input by the user
		if (mysql_num_rows($qry_res) == 1) {
			$row = mysql_fetch_array($qry_res);
			// holds values from the extracted row
			$encrypted_pw = $row[0];
			$role = $row[1];
			// compare the encrypted password
			if ($encrypted_pw == $pword) {
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
		$menu_html =  "<div class='navbar-inner'><div class='container'><a class='brand' href='admin.php'>Simon and Jenny's Wedding</a><ul class='nav'><li><a href='admin.php'>Front Page</a></li>";

		if ($id == 'bride') {
      		$menu_html = $menu_html."<li class='active'><a href='guest_list.php?id=bride'>View Bride's List</a></li><li><a href='guest_list.php?id=groom'>View Groom's List</a></li><li><a href='#'>View No Show List</a></li>";
      	}
      	if ($id == 'groom') {
      		$menu_html = $menu_html."<li><a href='guest_list.php?id=bride'>View Bride's List</a></li><li class='active'><a href='guest_list.php?id=groom'>View Groom's List</a></li><li><a href='#'>View No Show List</a></li>";	
      	}
  		$menu_html = $menu_html. "</ul>";
  		$menu_html = $menu_html."<ul class='nav pull-right'><li><a href='logout.php'><i class='icon-off'></i>&nbsp;Logout</a></li></ul></div></div>";
  		return $menu_html;
	}
	function fillinTable($id) {
		$sql = "select firstName, lastName, email, plusGuest, isVegetarian from weddingPlanner where reference = '$id' and isAttending = '1' and role = '1'";
	  	$result = mysql_query($sql);
	  	$html_table_contents = '';
	  	if ($result) {
	  		while ($row = mysql_fetch_array($result)) {
	  			$name = $row['lastName'].",".$row['firstName'];
	  			$guest = '';
	  			$isVegetarian = '';

	  			if ($row['plusGuest'] == '1') {
	  				$guest = YES;
	  			} else {
	  				$guest = NO;
	  			}

	  			if ($row['isVegetarian'] == '1') {
	  				$isVegetarian = YES;
	  			} else {
	  				$isVegetarian = NO;
	  			}

	  			$html_table_contents = $html_table_contents."<tr><td>".$name."</td><td>".$row['email']."</td><td>".$guest."</td><td>".$isVegetarian."</td><td></tr>";
	  		}
	  	}
	  	return $html_table_contents;
	}
?>