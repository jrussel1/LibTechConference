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

<br/><h2>Add Section </h2>
<p>Use this to add a new section to an event. </p>
<? 
	//Create query
	if($_POST['Submit']=="Submit"){
		$qry="INSERT INTO `jrussell_Lib`.`Section`(`Time`,`Day`,`Building`,`Event_ID`,`Section_Title`)
			VALUES('".$_POST['Time']."','".$_POST['Day']."','".$_POST['Building']."','".$_POST['Event_ID']."','".$_POST['Title']."')";
		$result=mysql_query($qry);
	
		//Check whether the query was successful or not
		if($result) {
			$qry2="SELECT * FROM jrussell_Lib.Section";
			$result2=mysql_query($qry2);
			echo("<table><tr><td>Section_ID</td><td>Section_Title</td><td>Time</td><td>Day</td><td>Building</td><td>Event_ID</td></tr>");
			while ( $row2 = mysql_fetch_array($result2) ) {
		    	echo("<tr><td>". $row2["Section_ID"]."</td><td>". $row2["Section_Title"]."</td><td>". $row2["Time"]."</td><td>".$row2["Day"]."</td><td>".$row2["Building"]."</td><td>".$row2["Event_ID"]."</td></tr>");
			}
			echo("</table>");
		}else {
			echo(var_dump($_POST));
			die("Query failed");
			
		}
	}else if($_POST['Submit']="Selected"){ ?>
		<form action="" method="post" name="add-section"><input type="hidden" name="utility" value="add" /> <input type="hidden" name="Utility_Select" value="Go" />
		<table><tr><td>
        <select name="Event_ID">
<?
		$qry="SELECT Event_ID,Event_Title FROM jrussell_Lib.Event";
		$result=mysql_query($qry);

		//Check whether the query was successful or not
		if($result) {
			while ( $row = mysql_fetch_array($result) ) {
			    echo("<option value='".$row["Event_ID"]."' />".$row["Event_Title"]."</option>");
			}
		}else {
			die("Query failed");
		}

?>
		</select></td></tr><tr><td>Title:</td><td>
		<input type="text" name="Title" title="Title" /></td></tr>
        <tr><td>Time (24-hour clock):</td><td>
		<input type="text" name="Time" title="Time" value="HH:MM"/></td></tr><tr><td>Day:</td><td>
		<input type="text" name="Day" title="Day" value="YYYY-MM-DD" /></td></tr><tr><td>Building:</td><td>
		<input type="text" name="Building" title="Building" /></td></tr>
		<tr><td>
		<input type="submit" name="Submit" title="Submit" value="Submit" /></td></tr></table>
		</form>
<?
	
	
}
	
	

?>
</body>
</html>
