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

<br/><h2>Add Person </h2>
<p>Use this to add a new Person manually. </p>
<? 
	//Create query
	if($_POST['Submit']=="Submit"){				
		$qry="INSERT INTO `jrussell_Lib`.`Person`
		(`Person_First_Name`,`Person_Last_Name`,`Person_Address`,`Person_City`,
		`Person_State`,`Person_Title`,`Person_Email`,`Person_Phone`,`Person_Zip`)
		VALUES
		('".$_POST["Person_First_Name"]."',
		'".$_POST["Person_Last_Name"]."',
		'".$_POST["Person_Address"]."',
		'".$_POST["Person_City"]."',
		'".$_POST["Person_State"]."',
		'".$_POST["Person_Title"]."',
		'".$_POST["Person_Email"]."',
		'".$_POST["Person_Phone"]."',
		'".$_POST["Person_Zip"]."');";
		$result=mysql_query($qry);
	
		//Check whether the query was successful or not
		if($result) {
			$id=mysql_insert_id();
			$qry="INSERT INTO `jrussell_Lib`.`Registration`
			(`Event_ID`,`Person_ID`,`Attendance_Type`)
			VALUES
			('".$_POST["Event_ID"]."',
			'".$id."',
			'".$_POST["Attendance_Type"]."'
			);";
			
			$result=mysql_query($qry);
			
			if($result) {
				if($_POST["Committee_Title"]!=""&&$_POST["Committee_Title"]!=NULL){
				$qry="INSERT INTO `jrussell_Lib`.`Committee_Member`
				(`Committee_Member_Title`,`Person_ID`)
				VALUES
				('".$_POST["Committee_Title"]."',
				'".$id."'
				);";
				
				$result=mysql_query($qry);
				}
				if($result) {
				echo("Success!<br><br>");
			}else {
				die("Query failed ".mysql_error());
			}
			}else {
				die("Query failed ".mysql_error());
			}
			
			
		}else {
			die("Query failed - ".mysql_error());
		}
	} ?>
		<form action="" method="post" name="add-session"><input type="hidden" name="utility" value="add" /> <input type="hidden" name="Utility_Select" value="Go" />
		<table><tr><td>
        <select name="Event_ID"><option selected="selected" disabled="disabled">--Select Event--</option>
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
        
        
        <tr><td>First Name:</td><td><input type="text" name="Person_First_Name" title="Person_First_Name" /></td></tr>
        <tr><td>Last Name:</td><td><input type="text" name="Person_Last_Name" title="Person_Last_Name"  /></td></tr>
        <tr><td>Job Title:</td><td><input type="text" name="Person_Title" title="Person_Title" /></td></tr>
        <tr><td>Email:</td><td><input type="text" name="Person_Email" title="Person_Email" /></td></tr>
        <tr><td>Street Address:</td><td><input type="text" name="Person_Address" title="Person_Address" /></td></tr>
        <tr><td>City:</td><td><input type="text" name="Person_City" title="Person_City" /></td></tr>
        <tr><td>State:</td><td><input type="text" name="Person_State" title="Person_State" /></td></tr>
        <tr><td>Zipcode:</td><td><input type="text" name="Person_Zip" title="Person_Zip" /></td></tr>
        <tr><td>Phone Number:</td><td><input type="text" name="Person_Phone" title="Person_Phone" /></td></tr>
        
        
        <tr><td><h2>Registration</h2></td></tr>
        <tr><td>Attendance Type:</td><td><select name="Attendance_Type" >
        <option selected="selected" disabled="disabled" value="">--Select Attendance Type--</option>
       <? $qry3="SELECT Attendance_Type FROM jrussell_Lib.Attendance_Type;";
		$result3=mysql_query($qry3);
		if($result3) {
        	while ( $row3 = mysql_fetch_array($result3) ) {
        		echo("<option value='".$row3['Attendance_Type']."'>".$row3['Attendance_Type']."</option>");
			}
		}
		?>
        </select></td></tr>
        <tr><td>If the person is a Committee Member:</td></tr><tr><td>Committee Member Title</td>
        <td><input type="text" name="Committee_Title" title="Committee_Title" /></td></tr>
		<tr><td><input type="submit" name="Submit" title="Submit" value="Submit" /></td></tr></table>
		</form>

</body>
</html>
