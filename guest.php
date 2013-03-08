<?php include('library.php'); 
$userId = $_SESSION["uname"];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo(TITLE . " :: " . RSVP) ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="Sanghyun Lee">
		<meta name="author" content="Chulhee Yoon">

		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.css" rel="stylesheet">
		<script src="http://code.jquery.com/jquery-1.8.0.js"></script>
		<script src="js/weddingPlanner.js"></script>
		<link href="style.css" rel="stylesheet">

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
			<?php $row = retrieve_guest($userId); ?>
			<form class="form-signin2" action="save.php" method="post">
    			<div class="row">
					<div class="span3 right">Guest Name</div>
					<div class="span5 left"><p class="input-block-level"><?php echo $row["lastName"] . ", " . $row["firstName"] ?></p></div>
				</div>
				<div class="row">
					<div class="span3 right">E-Mail Address</div>
					<div class="span4 left"><input type="text" class="input-block-level" placeholder="E-Mail Address" name="emailadd" <?php if ($row["email"]) { ?> value="<?php echo $row["email"];?>"<?php } ?>/></div>
				</div>
				<div class="row">
					<div class="span3 right">Phone Number</div>
					<div class="span4 left"><input type="text" class="input-block-level" placeholder="Phone Number (xxx-xxx-xxxx)" name="phone" <?php if ($row["phone"]) { ?> value="<?php echo $row["phone"];?>"<?php } ?>/></div>
				</div>
				<div class="row">
					<div class="span3 right">Attending?</div>
					<div class="span5 left">
						<select id="attending" name="attending" class="span2">
							<option value="1" <?php if ($row["attending"] != NULL && $row["attending"] == 1) { ?>selected="selected"<?php } ?>>Yes</option>
							<option value="0" <?php if ($row["attending"] != NULL && $row["attending"] == 0) { ?>selected="selected"<?php } ?>>No</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="span3 right">Vegetarian?</div>
					<div class="span5 left">						
						<select id="vegetarian" name="vegetarian" class="span2">
							<option value="1" <?php if ($row["vegetarian"] != NULL && $row["vegetarian"] == 1) { ?>selected="selected"<?php } ?>>Yes</option>
							<option value="0" <?php if ($row["vegetarian"] != NULL && $row["vegetarian"] == 0) { ?>selected="selected"<?php } ?>>No</option>
						</select>
					</div>
				</div>
				<?php $bringGuest = retrieve_bringGuest($userId);
				if($bringGuest[0] == 1) { ?>
				<div class="row">
					<div class="span3 right">Bringing Companion?</div>
					<div class="span5 left">
						<select id="guest" name="guest" class="span2">
							<option value="1" <?php if ($row["r.bringGuest"] != NULL && $row["r.bringGuest"] == 1) { ?>selected="selected"<?php } ?>>Yes</option>
							<option value="0" <?php if ($row["r.bringGuest"] != NULL && $row["r.bringGuest"] == 0) { ?>selected="selected"<?php } ?>>No</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="span3 right">Name of the Companion</div>
					<div class="span4 left">
						<input type="text" class="input-block-level" placeholder="John Doe" name="guestName" <?php if ($row["guestName"]) { ?> value="<?php echo $row["guestName"];?>"<?php } ?>/>
					</div>
				</div>
				<div class="row">
					<div class="span3 right">Is Your Companion Vegetarian?</div>
					<div class="span5 left">						
						<select id="guestVeg" name="guestVeg" class="span2">
							<option value="1" <?php if ($row["guestVeg"] != NULL && $row["guestVeg"] == 1) { ?>selected="selected"<?php } ?>>Yes</option>
							<option value="0" <?php if ($row["guestVeg"] != NULL && $row["guestVeg"] == 0) { ?>selected="selected"<?php } ?>>No</option>
						</select>
					</div>
				</div>
				<?php } ?>
				<div class="row">
					<div class="span3 right">&nbsp;</div>
					<div class="span5 left btn-group">
						<button class="btn btn-large btn-primary" type="submit">Save</button>&nbsp;&nbsp;
						<button class="btn btn-large btn-primary" type="submit" formaction="logout.php">Cancel</button>
					</div>
				</div>
				<div class="row">
					<div class="span9">
						Message goes here.
					</div>
				</div>
			</form>
		</div>
    </body>
</html>
<?php print_footer(); ?>