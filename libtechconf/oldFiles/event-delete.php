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
<br/><h2>Delete Events</h2>

<p>Use this to remove events. </p>
<? 
if($_POST['Submit']=='Submit'){

	$qry2="SELECT Event_ID FROM jrussell_Lib.Event";

	$result2=mysql_query($qry2);
	if($result2) {
		while ( $row2 = mysql_fetch_array($result2) ) {	
			
				if($_POST[$row2['Event_ID']]=="Delete"){
				$qry4="DELETE FROM `libtechc_registration`.`Event` WHERE Event_ID=".$row2['Event_ID'].";";
				
				$result4=mysql_query($qry4);
					if($result4) {	
						echo("Query Success!!");
					}else{echo(mysql_error());}
				}
		}
	}else{die("Query failed");}
	}
?>
<form action="" method="post"> <input type="hidden" name="utility" value="delete" /> <input type="hidden" name="Utility_Select" value="Go" />
<?

	$qry="SELECT * FROM jrussell_Lib.Event";

	$result=mysql_query($qry);
	
	
	

	//Check whether the query was successful or not
	if($result) {
		
		echo("<table><tr><td>Event_ID</td><td>Event_Title</td><td>Delete?</td></tr>");
		while ( $row = mysql_fetch_array($result) ) {
			
		    echo("<tr><td>". $row["Event_ID"]."</td>
			<td>".$row["Event_Title"]."</td>
			<td>
			<select name='".$row["Event_ID"]."'>
			<option value='No' selected='selected'>No Change</option>
			<option value='Delete'>Delete</option>
			</select></td></tr>");

		}
		echo("<tr><td><input type='Submit' name='Submit' value='Submit'/></td></tr></table>");
	}else {
		die("Query failed");
	}
	

	?>



</body>
</html>