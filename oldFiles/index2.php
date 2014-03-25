<?php
	require_once('auth.php');
	require_once('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Utility Index</title>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>Welcome <?php echo $_SESSION['SESS_FIRST_NAME'];?></h1>
<? include("top-nav.php");	?>
<p>This is a password protected area only accessible to users with accounts set-up by the admin. </p>
<?
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	//Connect to mysql server
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
	<?php /*?>//Create query
	$qry="SELECT * FROM Past_Attendee";
	$result=mysql_query($qry);

	//Check whether the query was successful or not
	if($result) {
		echo("<table>");
		while ( $row = mysql_fetch_array($result) ) {
		    echo("<tr><td>" . $row["Attendee_ID"] ."</td><td>". $row["First_Name"]."</td><td>".$row["Last_Name"]."</td><td>".$row["Institution"]."</td></tr>");

		}
		echo("</table>");
	}else {
		die("Query failed");
	}
<?php */?>


</body>
</html>
