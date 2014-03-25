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

<br/><h2>View Events</h2>
<p>View events here. </p>

<?

	$qry="SELECT * FROM jrussell_Lib.Event";

	$result=mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		$g=0;$gray;
		echo("<table><tr><td><strong>Event_ID</strong></td><td><strong>Event_Title</strong></td><td><strong>Start_Date</strong></td><td><strong>End_Date</strong></td><td><strong>Max_Total_Capacity</strong></td><td><strong>Activity_Level</strong></td></tr>");
		while ( $row = mysql_fetch_array($result) ) {
			$g++;
		    if($g%2!=0) $gray=" class='gray'";else $gray=" class='wrap'";
				
		    echo("<tr".$gray.">
			<td".$gray.">". $row["Event_ID"]."</td>
			<td".$gray.">". $row["Event_Title"]."</td>
			<td".$gray.">".$row["Start_Date"]."</td>
			<td".$gray.">".$row["End_Date"]."</td>
			<td".$gray.">".$row["Max_Total_Capacity"]."</td>
			<td".$gray.">".$row["Activity_Level"]."</td></tr>");

		}
		echo("</table>");
	}else {
		die("Query failed");
	}
	?>
</body>
</html>
