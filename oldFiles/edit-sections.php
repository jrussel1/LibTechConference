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
<br/><h2>Edit Sections</h2>

<p>Use this to edit sections of events. </p>
<? 
if($_POST['Submit']=='Submit'){

	$qry2="SELECT Section_ID FROM jrussell_Lib.Section";

	$result2=mysql_query($qry2);
	if($result2) {
		while ( $row2 = mysql_fetch_array($result2) ) {	
			if($_POST[$row2['Section_ID']]=="Update"){
				$qry3="UPDATE `jrussell_Lib`.`Section` SET
						`Section_Title` = '".$_POST[$row2['Section_ID'].'_Title']."',
						`Time` = '".$_POST[$row2['Section_ID'].'_Time']."',
						`Day` = '".$_POST[$row2['Section_ID'].'_Day']."',
						`Building` = '".$_POST[$row2['Section_ID'].'_Building']."',
						`Event_ID` = '".$_POST[$row2['Section_ID'].'_Event_ID']."'
						WHERE Section_ID=".$row2['Section_ID']."";
						$result3=mysql_query($qry3);
						if($result3) {
							echo("Query Success!!");
						}else{die("Query failed");}
			}else if($_POST[$row2['Section_ID']]=="Delete"){
				$qry4="DELETE FROM `jrussell_Lib`.`Section` WHERE Section_ID=".$row2['Section_ID']."";
				$result4=mysql_query($qry4);
				if($result4) {	
					echo("Query Success!!");
				}else{die("Query failed");}
			}
		}
	}else{die("Query failed");}
	}else{
?>
<form action="" method="post"> <input type="hidden" name="utility" value="edit" /> <input type="hidden" name="Utility_Select" value="Go" />
<?

	$qry="SELECT * FROM jrussell_Lib.Section";

	$result=mysql_query($qry);
	
	
	

	//Check whether the query was successful or not
	if($result) {
		
		echo("<table><tr><td>Section_ID</td><td>Section_Title</td><td>Time</td><td>Day</td><td>Building</td><td>Event_Title</td></tr>");
		while ( $row = mysql_fetch_array($result) ) {
			
		    echo("<tr><td>". $row["Section_ID"]."</td>
			<td><input type='text' name='".$row["Section_ID"]."_Title' value='".$row["Section_Title"]."' /></td>
			<td><input type='text' name='".$row["Section_ID"]."_Time' value='".$row["Time"]."' /></td>
			<td><input type='text' name='".$row["Section_ID"]."_Day' value='".$row["Day"]."' /></td>
			<td><input type='text' name='".$row["Section_ID"]."_Building' value='".$row["Building"]."' /></td>
			<td>");
			$qry2="SELECT Event_ID,Event_Title FROM jrussell_Lib.Event";
			$result2=mysql_query($qry2);
			if($result2) {echo("<select name='".$row["Section_ID"]."_Event_ID'>");
				while ( $row2 = mysql_fetch_array($result2) ) {
		    		echo("<option value='".$row2["Event_ID"]."'");
			
					if($row['Event_ID']==$row2["Event_ID"]){
						echo(" selected='selected'>".$row2["Event_Title"]."</option>");}
					else{
						echo(">".$row2["Event_Title"]."</option>");}
				}echo("</select>");
			}else {
				die("Query failed");
			}
			echo("</td><td>
			<select name='".$row["Section_ID"]."'>
			<option value='No' selected='selected'>No Change</option>
			<option value='Update'>Update</option>
			<option value='Delete'>Delete</option>
			</select></td></tr>");

		}
		echo("<tr><td><input type='Submit' name='Submit' value='Submit'/></td></tr></table>");
	}else {
		die("Query failed");
	}
	
}
	?>



</body>
</html>