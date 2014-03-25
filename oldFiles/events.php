<?php
	require_once('auth.php');
	require_once('config.php');
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Events</title>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.editinplace.packed.js"></script>
<script type="text/javascript" src="edit.js"></script>

</head>
<body>
<h1>Events</h1>
<? include("top-nav.php");	?>
<p>Select Event Utility.</p>
<form action="" method="post">
<select name="utility">
<option disabled="disabled" <?if(!isset($_POST['utility'])){echo("selected='selected'");}?>>Please select utility</option>
<option value="add" <?if(isset($_POST['utility'])&&$_POST['utility']=="add"){echo("selected='selected'");}?>>Add a new Event</option>
<option value="activity" <?if(isset($_POST['utility'])&&$_POST['utility']=="activity"){echo("selected='selected'");}?>>Change Activity Level</option>
<!--<option value="delete" <?if(isset($_POST['utility'])&&$_POST['utility']=="delete"){echo("selected='selected'");}?>>Delete Events</option>-->
</select>
<input type="submit" value="Go" name="Utility_Select" />
</form>
<? 
if(isset($_POST['Utility_Select'])&&$_POST['utility']=="add"){
	include("add-event.php");
}else if(isset($_POST['Utility_Select'])&&$_POST['utility']=="activity"){
	include("activity-events.php");
}else if(isset($_POST['Utility_Select'])&&$_POST['utility']=="delete"){
	include("event-delete.php");
}else{
	include("edit-events.php");
}
?>
</body>
</html>
