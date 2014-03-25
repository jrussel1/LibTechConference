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
<title>Person</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="/libtechconf/resources/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" href="/libtechconf/resources/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<link href="loginmodule.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
function deletechecked()
{
    var answer = confirm("Are you sure you want to delete this entry?")
    if (answer){
        document.messages.submit();
    }
    
    return false;  
} 
</script>
</head>
<body>
<h1>Person</h1>
<? include("top-nav.php");	?>
<p>Select Person Utility.</p>
<form action="" method="post">
<select name="utility">
<option disabled="disabled" <?if(!isset($_POST['utility'])){echo("selected='selected'");}?>>Please select utility</option>
<option value="view" <?if(isset($_POST['utility'])&&$_POST['utility']=="view"){echo("selected='selected'");}?>>View People</option>
<option value="add" <?if(isset($_POST['utility'])&&$_POST['utility']=="add"){echo("selected='selected'");}?>>Add a new Person</option>
<option value="edit" <?if(isset($_POST['utility'])&&$_POST['utility']=="edit"){echo("selected='selected'");}?>>Edit People</option>
</select>
<input type="submit" value="Go" name="Utility_Select" />
</form>
<? 
if(isset($_POST['Utility_Select'])&&$_POST['utility']=="view"){
	include("view-people.php");
}else if(isset($_POST['Utility_Select'])&&$_POST['utility']=="add"){
	include("add-person.php");
}else if(isset($_POST['Utility_Select'])&&$_POST['utility']=="edit"){
	include("edit-people.php");
}
?>
</body>
</html>
<script> 

	$(document).ready(function() {

	/* This is basic - uses default settings */
	
	$("a#single_image").fancybox();
	
	/* Using custom settings */
	
	$("a#inline").fancybox({
		'hideOnContentClick': false
	});

	/* Apply fancybox to multiple items */
	
	$("a.group").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	false
	});
	
});
</script>