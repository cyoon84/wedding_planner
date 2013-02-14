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
					<div class="span5 left"><input type="text" class="input-block-level" placeholder="E-Mail Address" name="emailadd" <?php if ($row["email"] != NULL) { ?> value="<?php echo $row["email"];?>"<?php } ?>/></div>
				</div>
				<div class="row">
					<div class="span3 right">Phone Number</div>
					<div class="span5 left"><input type="text" class="input-block-level" placeholder="Phone Number (xxx-xxx-xxxx)" name="phone" <?php if ($row["phone"] != NULL) { ?> value="<?php echo $row["phone"];?>"<?php } ?>/></div>
				</div>
				<div class="row">
					<div class="span3 right">Attending?</div>
					<div class="span5 left">
						<select id="attending" class="span2">
							<option value="1">Yes</option>
							<option value="0">No</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="span3 right">Vegetarian?</div>
					<div class="span5 left">						
						<select id="vegetarian" class="span2">
							<option value="1">Yes</option>
							<option value="0">No</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="span3 right">Bringing Guest?</div>
					<div class="span5 left">
						<select id="guest" class="span2">
							<option value="1">Yes</option>
							<option value="0">No</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="span3 right">Guest of</div>
					<div class="span5 left">						
						<select id="reference" class="span2">
							<option value="groom">Groom</option>
							<option value="bride">Bride</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="btn-group">
						<button class="btn btn-large btn-primary" type="submit">Submit</button>&nbsp;&nbsp;
						<a href="index.php" class="btn btn-largbtn-primary">Cancel</a>
					</div>
				</div>
			</form>
		</div>
    </body>
</html>
<?php print_footer(); ?>