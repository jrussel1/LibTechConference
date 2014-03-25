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

<br/><h2>View People</h2>
<p>Use this to view People. </p>
<table style='border-spacing:0px;'><tr><td colspan="8" align="right">Filter by Event:</td><td colspan="8">
<form action="" method="post"><input type="hidden" name="utility" value="view" /> <input type="hidden" name="Utility_Select" value="Go" />

<select name="Filter">
<option value="1 OR 1=1" <?if(!isset($_POST['Filter'])){echo("selected='selected'");}?>>All Events</option>
<?
		$qry="SELECT Event_ID,Event_Title FROM jrussell_Lib.Event";
		$result=mysql_query($qry);

		//Check whether the query was successful or not
		if($result) {
			while ( $row = mysql_fetch_array($result) ) {
				if(isset($_POST['Filter'])&&$_POST['Filter']==$row["Event_ID"]){
			    	echo("<option value='".$row["Event_ID"]."' selected='selected'/>".$row["Event_Title"]."</option>");
				}else{
					echo("<option value='".$row["Event_ID"]."' />".$row["Event_Title"]."</option>");
				}
			}
		}else {
			die("Query failed");
		}

?>
		</select>
        
        <input type="submit" value="Go" name="Go" /></form>
</td></tr><tr><td></td></tr>
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
</tr>
<? 
	if(!isset($_POST['Filter'])){
			$qry2="SELECT Person.*,Registration.*,Event.Event_ID,Event.Event_Title
					FROM jrussell_Lib.Person,jrussell_Lib.Registration,jrussell_Lib.Event
					WHERE Person.Person_ID=Registration.Person_ID and Registration.Event_ID=Event.Event_ID;";
			$result2=mysql_query($qry2);
			$g=0;$gray;
			while ( $row2 = mysql_fetch_array($result2) ) {
				$g++;
		    	if($g%2!=0) $gray=" class='gray'";else $gray=" class='wrap'";
				
		    	echo("<tr".$gray.">
				<td".$gray.">".$row2["Person_ID"]."</td>
				<td".$gray.">".$row2["Person_First_Name"]."</td>
				<td".$gray.">".$row2["Person_Last_Name"]."</td>
				<td".$gray.">".$row2["Person_Title"]."</td>
				<td".$gray.">".$row2["Person_Email"]."</td>
				<td".$gray.">".$row2["Person_Phone"]."</td>
				<td".$gray.">".$row2["Person_Address"]."</td>
				<td".$gray.">".$row2["Person_City"]."</td>
				<td".$gray.">".$row2["Person_State"]."</td>
				<td".$gray.">".$row2["Person_Zip"]."</td>
				<td".$gray.">".$row2["Attendance_Type"]."</td><td>");
				$qry3="SELECT Person_ID,Committee_Member_Title FROM jrussell_Lib.Committee_Member where Person_ID=".$row2["Person_ID"];
				$result3=mysql_query($qry3);
				if($result3) {
        			while ( $row3 = mysql_fetch_array($result3) ) {
        				echo($row3['Committee_Member_Title']);
				}
			}
				
				echo("</td></tr>");
			}
	}else{	
		$qry3="SELECT Person.*,Registration.*,Event.Event_ID,Event.Event_Title
					FROM jrussell_Lib.Person,jrussell_Lib.Registration,jrussell_Lib.Event
					WHERE Person.Person_ID=Registration.Person_ID and Registration.Event_ID=Event.Event_ID and (Registration.Event_ID =".$_POST['Filter'].");";
			$result3=mysql_query($qry3);
			$g=0;$gray;
			while ( $row3 = mysql_fetch_array($result3) ) {
				$g++;
		    	if($g%2!=0) $gray=" class='gray'";else $gray=" class='wrap'";
		    	echo("<tr".$gray.">
				<td".$gray.">".$row3["Person_ID"]."</td>
				<td".$gray.">".$row3["Person_First_Name"]."</td>
				<td".$gray.">".$row3["Person_Last_Name"]."</td>
				<td".$gray.">".$row3["Person_Title"]."</td>
				<td".$gray.">".$row3["Person_Email"]."</td>
				<td".$gray.">".$row3["Person_Phone"]."</td>
				<td".$gray.">".$row3["Person_Address"]."</td>
				<td".$gray.">".$row3["Person_City"]."</td>
				<td".$gray.">".$row3["Person_State"]."</td>
				<td".$gray.">".$row3["Person_Zip"]."</td>
				<td".$gray.">".$row3["Attendance_Type"]."</td>
				<td".$gray.">");
				$qry4="SELECT Person_ID,Committee_Member_Title FROM jrussell_Lib.Committee_Member where Person_ID=".$row2["Person_ID"];
				$result4=mysql_query($qry4);
				if($result4) {
        			while ( $row4 = mysql_fetch_array($result4) ) {
        				$a=$row4['Committee_Member_Title'];
				}
			}
				
				echo($a."</td></tr>");
			}
			
	}
			echo("</table>");
		
?>
</body>
</html>
