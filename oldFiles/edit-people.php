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

<br/><h2>Edit People</h2>

<p>Use this to edit people's information. </p>
<? 
if($_POST['Submit']=='Submit'){						
	$qry3="UPDATE `jrussell_Lib`.`Person` SET
			`Person_ID` = '".$_POST['Person_ID']."',
			`Person_First_Name` = '".$_POST[$_POST['Person_ID'].'_Person_First_Name']."',
			`Person_Last_Name` = '".$_POST[$_POST['Person_ID'].'_Person_Last_Name']."',
			`Person_Address` = '".$_POST[$_POST['Person_ID'].'_Person_Address']."',
			`Person_City` = '".$_POST[$_POST['Person_ID'].'_Person_City']."',
			`Person_State` = '".$_POST[$_POST['Person_ID'].'_Person_State']."',
			`Person_Zip` = '".$_POST[$_POST['Person_ID'].'_Person_Zip']."',
			`Person_Title` = '".$_POST[$_POST['Person_ID'].'_Person_Title']."',
			`Person_Email` = '".$_POST[$_POST['Person_ID'].'_Person_Email']."',
			`Person_Phone` = '".$_POST[$_POST['Person_ID'].'_Person_Phone']."'
			WHERE Person_ID='".$_POST['Person_ID']."';";
			$result3=mysql_query($qry3);
			if($result3) {
			   
			   $qry="Select Person_ID FROM jrussell_Lib.Registration WHERE Person_ID='".$_POST['Person_ID']."';";
			   $result=mysql_query($qry);
			   if(mysql_num_rows($result)>0){
				    $qry="UPDATE `jrussell_Lib`.`Registration` SET 
					`Event_ID` = '".$_POST[$_POST['Person_ID'].'_Event_ID']."',
					`Person_ID` = '".$_POST['Person_ID']."',
					`Attendance_Type` = '".$_POST[$_POST['Person_ID'].'_Attendance_Type']."'
					WHERE Person_ID='".$_POST['Person_ID']."';";
			   		$result=mysql_query($qry);
					if($result){
						$qry5="Select Person_ID FROM jrussell_Lib.Committee_Member WHERE Person_ID=".$_POST['Person_ID'].";";
						$result5=mysql_query($qry5);
						if(mysql_num_rows ($result5)>0){
							$qry="UPDATE `jrussell_Lib`.`Committee_Member` SET 
							`Person_ID` = '".$_POST['Person_ID']."',
							`Committee_Member_Title` = '".$_POST[$_POST['Person_ID'].'_Committee_Member_Title']."'
							WHERE Person_ID='".$_POST['Person_ID']."';";
							$result=mysql_query($qry);
						}else{
							$qry8="INSERT IGNORE INTO `jrussell_Lib`.`Committee_Member`
						          (`Committee_Member_Title`,`Person_ID`)
						          VALUES('".$_POST[$_POST['Person_ID'].'_Committee_Member_Title']."',
						          '".$_POST['Person_ID']."');";
						    $result8=mysql_query($qry8);	  if(!$result8){die('Invalid query: 1' . mysql_error());}
							}
					}else{die('Invalid query: 2' . mysql_error());}
			   }else{
				   $qry8="INSERT IGNORE INTO `jrussell_Lib`.`Registration`
						  (`Event_ID`,`Person_ID`,`Attendance_Type`)
						  VALUES('".$_POST[$_POST['Person_ID'].'_Event_ID']."',
						  '".$_POST['Person_ID']."',
						  '".$_POST[$_POST['Person_ID'].'_Attendance_Type']."');";
						  $result8=mysql_query($qry8);	  if(!$result8){die('Invalid query: 3' . mysql_error()."<br><br>".$qry8);}
				   }
			}else{die('Invalid query: 4' . mysql_error());}

}else if($_POST['Delete']=="Delete"){
	$qry4="DELETE FROM `jrussell_Lib`.`Person` WHERE Person_ID=".$_POST['Person_ID']."";
	$result4=mysql_query($qry4);
	
}

 
echo("<table style='border-spacing:0px;'>
<tr>
<td class='header'><strong>Person_ID</strong></td>
<td class='header'><strong>First_Name</strong></td>
<td class='header'><strong>Last_name</strong></td>
<td class='header'><strong>Job_Title</strong></td>
<td class='header'><strong>Email</strong></td>
<td class='header'><strong>Phone</strong></td>
<td class='header'><strong>Person_Address</strong></td>
<td class='header'><strong>Person_City</strong></td>
<td class='header'><strong>Person_State</strong></td>
<td class='header'><strong>Person_Zip</strong></td>
<td class='header'><strong>Attendance_Type</strong></td>
<td class='header'><strong>Committee Member Title?</strong></td>
</tr>");

$qry0="SELECT Person.*,Registration.*,Event.Event_ID,Event.Event_Title
					FROM jrussell_Lib.Person,jrussell_Lib.Registration,jrussell_Lib.Event
					WHERE Person.Person_ID=Registration.Person_ID and Registration.Event_ID=Event.Event_ID order by Person.Person_ID ASC";
$result0=mysql_query($qry0);

$g=0;$gray;
while ( $row0 = mysql_fetch_array($result0) ) {
	$g++;
	if($g%2!=0) $gray=" class='gray'";else $gray=" class='wrap'";
	echo("<tr".$gray.">
				<td".$gray.">".$row0["Person_ID"]."</td>
				<td".$gray.">".$row0["Person_First_Name"]."</td>
				<td".$gray.">".$row0["Person_Last_Name"]."</td>
				<td".$gray.">".$row0["Person_Title"]."</td>
				<td".$gray.">".$row0["Person_Email"]."</td>
				<td".$gray.">".$row0["Person_Phone"]."</td>
				<td".$gray.">".$row0["Person_Address"]."</td>
				<td".$gray.">".$row0["Person_City"]."</td>
				<td".$gray.">".$row0["Person_State"]."</td>
				<td".$gray.">".$row0["Person_Zip"]."</td>
				<td".$gray.">".$row0["Attendance_Type"]."</td><td>");
				$qry3="SELECT Person_ID,Committee_Member_Title FROM jrussell_Lib.Committee_Member where Person_ID=".$row0["Person_ID"];
				$result3=mysql_query($qry3);
				if($result3) {
        			while ( $row3 = mysql_fetch_array($result3) ) {
        				echo($row3['Committee_Member_Title']);
				}
			}
				
				echo("</td>");
	echo("<td><a id='inline' href='#Form_". $row0["Person_ID"]."'><button type='button'>Edit</button></a></td>
	</tr>");
}
echo("</table>");

	
	
	
$qry="SELECT Person.*,Registration.*,Event.Event_ID,Event.Event_Title,Committee_Member.Committee_Member_Title
					FROM jrussell_Lib.Person,jrussell_Lib.Registration,jrussell_Lib.Event,jrussell_Lib.Committee_Member
					WHERE Person.Person_ID=Registration.Person_ID and Registration.Event_ID=Event.Event_ID";

$result=mysql_query($qry);
	
	
	


		
if($result) {	
	while ( $row = mysql_fetch_array($result) ) {
		echo("<div style='display:none'>
			<div id='Form_".$row["Person_ID"]."'>
			<form action='' method='post'> 
			<input type='hidden' name='utility' value='edit' /> 
			<input type='hidden' name='Utility_Select' value='Go' />
			<input type='hidden' value='".$row["Person_ID"]."' name='Person_ID' />
			<table>");
		echo("<tr><td>Person_ID</td><td>".$row["Person_ID"]."</td></tr>
			<tr><td>First Name:</td><td><input type='text' name='".$row["Person_ID"]."_Person_First_Name' title='Person_First_Name' value='".$row['Person_First_Name']."'/></td></tr>
        <tr><td>Last Name:</td><td><input type='text' name='".$row["Person_ID"]."_Person_Last_Name' title='Person_Last_Name'  value='".$row['Person_Last_Name']."'/></td></tr>
        <tr><td>Job Title:</td><td><input type='text' name='".$row["Person_ID"]."_Person_Title' title='Person_Title' value='".$row['Person_Title']."'/></td></tr>
        <tr><td>Email:</td><td><input type='text' name='".$row["Person_ID"]."_Person_Email' title='Person_Email' value='".$row['Person_Email']."'/></td></tr>
        <tr><td>Street Address:</td><td><input type='text' name='".$row["Person_ID"]."_Person_Address' title='Person_Address' value='".$row['Person_Address']."'/></td></tr>
        <tr><td>City:</td><td><input type='text' name='".$row["Person_ID"]."_Person_City' title='Person_City' value='".$row['Person_City']."'/></td></tr>
        <tr><td>State:</td><td><input type='text' name='".$row["Person_ID"]."_Person_State' title='Person_State' value='".$row['Person_State']."'/></td></tr>
        <tr><td>Zipcode:</td><td><input type='text' name='".$row["Person_ID"]."_Person_Zip' title='Person_Zip' value='".$row['Person_Zip']."'/></td></tr>
        <tr><td>Phone Number:</td><td><input type='text' name='".$row["Person_ID"]."_Person_Phone' title='Person_Phone' value='".$row['Person_Phone']."'/></td></tr>
		<tr><td>Event_Title:</td><td>");
		$qry2="SELECT Event_ID,Event_Title FROM jrussell_Lib.Event";
		$result2=mysql_query($qry2);
		if($result2) {echo("<select name='".$row["Person_ID"]."_Event_ID'>");
			while ( $row2 = mysql_fetch_array($result2) ) {
				echo("<option value='".$row2["Event_ID"]."'");
		
				if($row['Event_ID']==$row2["Event_ID"]){
					echo(" selected='selected'>".$row2["Event_Title"]."</option>");
					}
				else{
					echo(">".$row2["Event_Title"]."</option>");
					}
			}
			echo("</select>");
		}else {
			die("Query failed");
		}
		echo("</td></tr>");
		
						
		echo("<tr><td>Attendance Type:</td><td><select name='".$row["Person_ID"]."_Attendance_Type' >
        ");
       
	   $qry3="SELECT Attendance_Type FROM jrussell_Lib.Attendance_Type;";
		$result3=mysql_query($qry3);
		if($result3) {$boo=false;
        	while ( $row3 = mysql_fetch_array($result3) ) {
        		echo("<option value='".$row3['Attendance_Type']."' ");
				if($row['Attendance_Type']==$row3['Attendance_Type']){ echo("selected='selected'");$boo=true;}
				echo(">".$row3['Attendance_Type']."</option>");
			}
			if(!$boo){echo("<option selected='selected' disabled='disabled' value=''>--Select Attendance Type--</option>");}
			
		}
		$qry5="Select Committee_Member_Title FROM jrussell_Lib.Committee_Member WHERE Person_ID='".$row['Person_ID']."';";
		$result5=mysql_query($qry5);
		
        echo("</select></td></tr>
		<tr><td>If the person is a Committee Member:</td></tr>
		<tr><td>Committee Member Title</td>
		<td><input type='text' name='".$row["Person_ID"]."_Committee_Member_Title' title='".$row["Person_ID"]."_Committee_Member_Title' value='");
		while ( $row5 = mysql_fetch_array($result5) ) {echo($row5["Committee_Member_Title"]);}
		echo("'/></td></tr>");
		
			
	
		echo("<tr><td><input type='submit' name='Delete' value='Delete' onClick='return deletechecked();'/></td>
				<td colspan='5' align='right'>
				<div style='float:right'><input type='submit' name='Submit' value='Submit'/></form></div>
				</td></tr></table></div></div>");
	}
		
}else {
	die("Query failed-here");
}
	
mysql_close($link);
	?>
