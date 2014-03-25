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
<br/><h2>Edit Events</h2>

<p>Use this to edit events. </p>
<? 
if($_POST['Submit']=='Submit'){

	$qry2="SELECT Event_ID FROM jrussell_Lib.Event";

	$result2=mysql_query($qry2);
	if($result2) {
		while ( $row2 = mysql_fetch_array($result2) ) {	
			
				$qry3="UPDATE `jrussell_Lib`.`Event` SET
						`Activity_Level` = '".$_POST[$row2['Event_ID'].'_Activity_Level']."'
						WHERE Event_ID=".$row2['Event_ID']."";
						$result3=mysql_query($qry3);
						if($result3) {
							echo("");
						}else{echo("Query failed");}
			
		}
	}else{die("Query failed");}
	}
?>
<form action="" method="post"> <input type="hidden" name="utility" value="activity" /> <input type="hidden" name="Utility_Select" value="Go" />
<?

	$qry="SELECT * FROM jrussell_Lib.Event";

	$result=mysql_query($qry);
	
	
	

	//Check whether the query was successful or not
	if($result) {
		
		echo("<table><tr><td>Event_ID</td><td>Event_Title</td><td>Activity_Level</td></tr>");
		while ( $row = mysql_fetch_array($result) ) {
			
		    echo("<tr><td>". $row["Event_ID"]."</td>
			<td>".$row["Event_Title"]."</td>
			<td>");
			$qry2="SELECT * FROM jrussell_Lib.Event_Activity_Level";
			$result2=mysql_query($qry2);
			if($result2) {echo("<select id='Event-Activity_Level-".$row["Event_ID"]."' name='".$row["Event_ID"]."_Activity_Level'>");
				while ( $row2 = mysql_fetch_array($result2) ) {
		    		echo("<option value='".$row2["Event_Activity_Type"]."'");
			
					if($row['Activity_Level']==$row2["Event_Activity_Type"]){
						echo(" selected='selected'>".$row2["Event_Activity_Type"]."</option>");}
					else{
						echo(">".$row2["Event_Activity_Type"]."</option>");}
				}echo("</select>");
			}else {
				die("Query failed");
			}
			echo("</td></tr>");

		}
		echo("<tr><td><input type='Submit' name='Submit' value='Submit'/></td></tr></table>");
	}else {
		die("Query failed");
	}
	

	?>



</body>
</html>