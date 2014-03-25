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

<br/><h2>Add Session </h2>
<p>Use this to add a new session to a section and event. </p>
<? 
	//Create query
	if($_POST['Submit']=="Submit"){				
		$qry="INSERT INTO `jrussell_Lib`.`Session`
		(`Session_Title`,`Session_Description`,`Session_Location`,`Difficulty_Level`,`Section_ID`,`Event_ID`,`Style`)
		VALUES
		('".$_POST["Title"]."',
		'".$_POST["Description"]."',
		'".$_POST["Location"]."',
		'".$_POST["Difficulty"]."',
		'".$_POST["Section"]."',
		'".$_POST["Event_ID"]."',
		'".$_POST["Style"]."');";
		$result=mysql_query($qry);
	
		//Check whether the query was successful or not
		if($result) {
			
			$id=mysql_insert_id();
			foreach($_POST['Target'] as $target){
			$qry5="INSERT INTO `jrussell_Lib`.`Session_Target`(`Session_ID`,`Audience`)VALUES(".$id.",'".$target."')";
		$result5=mysql_query($qry5);
			}
			if($result5) {
			$qry2="SELECT * FROM jrussell_Lib.Session";
			$result2=mysql_query($qry2);
			echo("<table><tr><td>Session_ID</td><td>Title</td><td>Description</td><td>Location</td><td>Difficulty_Level</td><td>Section_ID</td><td>Event_ID</td><td>Style</td><td>Target Audience</td></tr>");
			while ( $row2 = mysql_fetch_array($result2) ) {
		    	echo("<tr><td>". $row2["Session_ID"]."</td><td>". $row2["Session_Title"]."</td><td>".$row2["Session_Description"]."</td><td>".$row2["Session_Location"]."</td>
				<td>".$row2["Difficulty_Level"]."</td><td>".$row2["Section_ID"]."</td><td>".$row2["Event_ID"]."</td><td>".$row2["Style"]."</td><td>");
				$qry3="SELECT Audience FROM jrussell_Lib.Session_Target where Session_ID=".$row2["Session_ID"];
				$result3=mysql_query($qry3);
				if($result3) {$a="";
        			while ( $row3 = mysql_fetch_array($result3) ) {
        				$a=$a.$row3['Audience'].",";
				}
			}
				$a=substr($a,0,-1);
				echo($a."</td></tr>");
			}
			echo("</table>");
			}
		}else {
			die("Query failed");
		}
	}else if($_POST['Submit']="Selected"){ ?>
		<form action="" method="post" name="add-session"><input type="hidden" name="utility" value="add" /> <input type="hidden" name="Utility_Select" value="Go" />
		<table><tr><td>
        <select name="Event_ID" class="Event_ID"><option selected="selected" disabled="disabled">--Select Event--</option>
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
		</select></td></tr>
        <tr><td colspan="2"><select name="Section" class="Section">
			<option selected="selected">--Select Section--</option>
			</select></td></tr>
        
        <tr><td>Session Title:</td><td><input type="text" name="Title" title="Title" /></td></tr>
        <tr><td>Description:</td><td><input type="text" name="Description" title="Description"  /></td></tr>
        <tr><td>Location in Building:</td><td><input type="text" name="Location" title="Location" /></td></tr>
        <tr><td>Difficulty Level:</td>
        <td><select name="Difficulty" ><option selected="selected" disabled="disabled">--Select Difficulty Level--</option>
        <option value="Beginner">Beginner</option>
        <option value="Intermediate">Intermediate</option>
        <option value="Advanced">Advanced</option>
        </select></td></tr><tr><td>Session Style (Default Capacity):</td>
        <td><select name="Style" ><option selected="selected" disabled="disabled">--Select Session Style--</option>
        <? $qry4="SELECT * FROM jrussell_Lib.Session_Style;";
		$result4=mysql_query($qry4);
		if($result4) {
        	while ( $row4 = mysql_fetch_array($result4) ) {
				echo("<option value='".$row4["Style"]."' />".$row4["Style"]." (".$row4["Default_Capacity"].")</option>");			
				}
		}
		?>
        <tr><td>Target Auidence (Check at least one or more):</td></tr>
       <? $qry3="SELECT Audience FROM jrussell_Lib.Target_Audience;";
		$result3=mysql_query($qry3);
		if($result3) {
        	while ( $row3 = mysql_fetch_array($result3) ) {
        		echo("<tr><td>".$row3['Audience'].":</td><td><input type='checkbox' name='Target[]' value='".$row3['Audience']."' /></td></tr>");
			}
		}
		?>
		<tr><td><input type="submit" name="Submit" title="Submit" value="Submit" /></td></tr></table>
		</form>
<?
	
	
}
	
	

?>
</body>
</html>
