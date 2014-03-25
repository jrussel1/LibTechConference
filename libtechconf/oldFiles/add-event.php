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

<br/><h2>Add Event </h2>
<p>Use this page to add a new event. </p>
<table><tr><td>Title:</td><td>
<form action="" method="post" name="add-event">
<input type="text" name="Title" title="Title" /></td></tr><tr><td>Start Date:</td><td>
<input type="text" name="Start" title="Start Date" value="YYYY-MM-DD" /></td></tr><tr><td>End Date:</td><td>
<input type="text" name="End" title="End Date" value="YYYY-MM-DD" /></td></tr><tr><td>Maximum Capacity:</td><td>
<input type="text" name="Capacity" title="Max Capacity" /></td></tr><tr><td>Event Activity Level:</td><td>
<select name="Type">
<?
$qry="SELECT * FROM jrussell_Lib.Event_Activity_Level";
	$result=mysql_query($qry);

	//Check whether the query was successful or not
	if($result) {
		while ( $row = mysql_fetch_array($result) ) {
		    echo("<option value='".$row["Event_Activity_Type"]."' />".$row["Event_Activity_Type"]."</option>");

		}
	}else {
		die("Query failed");
	}

?>
</select></td></tr><tr><td><input type="hidden" name="utility" value="add" /> <input type="hidden" name="Utility_Select" value="Go" />
<input type="submit" name="Submit" title="Submit" value="Submit" /></td></tr></table>
</form>
<?

	
	//Create query
	if($_POST['Submit']=="Submit"){
	$qry="INSERT INTO `jrussell_Lib`.`Event`(`Event_Title`,`Start_Date`,`End_Date`,`Max_Total_Capacity`,`Activity_Level`)
			VALUES('".$_POST['Title']."','".$_POST['Start']."','".$_POST['End']."','".$_POST['Capacity']."','".$_POST['Type']."')";
	$result=mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		$qry2="SELECT * FROM jrussell_Lib.Event";
		$result2=mysql_query($qry2);
		echo("<table><tr><td>Event_ID</td><td>Event_Title</td><td>Start_Date</td><td>End_Date</td><td>Max_Total_Capacity</td><td>Activity_Level</td></tr>");
		while ( $row = mysql_fetch_array($result2) ) {
		    echo("<tr><td>". $row["Event_ID"]."</td><td>". $row["Event_Title"]."</td><td>".$row["Start_Date"]."</td><td>".$row["End_Date"]."</td><td>".$row["Max_Total_Capacity"]."</td><td>".$row["Activity_Level"]."</td></tr>");

		}
		echo("</table>");
	}else {
		die("Query failed");
	}}
	?>
</body>
</html>
