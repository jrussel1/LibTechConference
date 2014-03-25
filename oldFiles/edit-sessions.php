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
	$qry3="UPDATE `jrussell_Lib`.`Session` SET
			`Session_ID` = '".$_POST['Session_ID']."',
			`Session_Title` = '".$_POST[$_POST['Session_ID'].'_Session_Title']."',
			`Session_Description` = '".$_POST[$_POST['Session_ID'].'_Description']."',
			`Session_Location` = '".$_POST[$_POST['Session_ID'].'_Location']."',
			`Difficulty_Level` = '".$_POST[$_POST['Session_ID'].'_Difficulty']."',
			`Section_ID` = '".$_POST[$_POST['Session_ID'].'_Section']."',
			`Event_ID` = '".substr($_POST[$_POST['Session_ID'].'_Event_ID'],0,strpos($_POST[$_POST['Session_ID'].'_Event_ID'],"_"))."',
			`Style` = '".$_POST[$_POST['Session_ID'].'_Style']."'
			WHERE Session_ID='".$_POST['Session_ID']."';";
			$result3=mysql_query($qry3);
			if($result3) {
			  if($_POST[$_POST['Session_ID'].'_Target'][0]!=NULL||$_POST[$_POST['Session_ID'].'_Target'][0]!="") 
			  {
				  foreach($_POST[$_POST['Session_ID'].'_Target'] as $i) 
				  {
					  	$qry8="Select Session_ID FROM `jrussell_Lib`.`Session_Target` WHERE Session_ID='".$_POST['Session_ID']."' and Audience = '".$i."';";
						
					  	$result8=mysql_query($qry8);	if(!$result8){die('Invalid query: ' . mysql_error());}
						$num_rows = mysql_num_rows($result8);
					  	if(!$num_rows)
						{
						  $qry8="INSERT IGNORE INTO `jrussell_Lib`.`Session_Target`
						  (`Session_ID`,`Audience`)
						  VALUES('".$_POST['Session_ID']."',
						  '".$i."');";
						  $result8=mysql_query($qry8);	  if(!$result8){die('Invalid query: ' . mysql_error());}
					 	 }
			 	 	}
					
			  }
			  
				$check_control=array();
				$check_control=unserialize($_POST['check_control']);
				$remove=array();
				if($_POST[$_POST['Session_ID'].'_Target'][0]!=NULL||$_POST[$_POST['Session_ID'].'_Target'][0]!="")
				{
					foreach($check_control as $c)	
					{		
						if(array_search($c,$_POST[$_POST['Session_ID'].'_Target'])>-1)
						{
						}
						else
						{
						array_push($remove,$c);
						}
					}
				}
				else
				{
					$remove=$check_control;
				}
				foreach($remove as $r)	
				{
						$qry8="DELETE FROM `jrussell_Lib`.`Session_Target` WHERE Session_ID='".$_POST['Session_ID']."' and Audience = '".$r."';";
					  	$result8=mysql_query($qry8);	
				}
			   
			}else{die('Invalid query: ' . mysql_error());}

}else if($_POST['Delete']=="Delete"){
	$qry4="DELETE FROM `jrussell_Lib`.`Session` WHERE Session_ID=".$_POST['Session_ID']."";
	$result4=mysql_query($qry4);
	
}

 
echo("<table style='border-spacing:0px;'>
<tr><td class='header'><strong>Session_ID</strong></td>
<td class='header'><strong>Session_Title</strong></td>
<td class='header'><strong>Description</strong></td>
<td class='header'><strong>Location</strong></td>
<td class='header'><strong>Difficulty_Level</strong></td>
<td class='header'><strong>Event_Title</strong></td>
<td class='header'><strong>Section_Title</strong></td>
<td class='header'><strong>Style</strong></td>
<td class='header'><strong>Target Audience</strong></td></tr>");

$qry0="SELECT Session.*,Event.Event_Title,Section.Section_Title FROM jrussell_Lib.Session,jrussell_Lib.Event,jrussell_Lib.Section where Session.Event_ID=Event.Event_ID and Session.Section_ID=Section.Section_ID order by Session_ID ASC";
$result0=mysql_query($qry0);

$g=0;$gray;
while ( $row0 = mysql_fetch_array($result0) ) {
	$g++;
	if($g%2!=0) $gray=" class='gray'";else $gray=" class='wrap'";
	echo("<tr".$gray.">");
	echo("<td".$gray.">". $row0["Session_ID"]."</td>
	<td".$gray.">". $row0["Session_Title"]."</td>
	<td".$gray.">".$row0["Description"]."</td>
	<td".$gray.">".$row0["Location"]."</td>
	<td".$gray.">".$row0["Difficulty_Level"]."</td>
	<td".$gray.">".$row0["Event_Title"]."</td>
	<td".$gray.">".$row0["Section_Title"]."</td>
	<td".$gray.">".$row0["Style"]."</td>
	<td".$gray.">");
	$qry4="SELECT Audience FROM jrussell_Lib.Session_Target where Session_ID=".$row0["Session_ID"];
	$result4=mysql_query($qry4);
	if($result4) {
		$a="";
		while ( $row4 = mysql_fetch_array($result4) ) {
			$a=$a.$row4['Audience'].",";
		}
	}
	$a=substr($a,0,-1);
	echo($a."</td>");
	echo("<td><a id='inline' href='#Form_". $row0["Session_ID"]."'><button type='button'>Edit</button></a></td>
	</tr>");
}
echo("</table>");

	
	
	
$qry="SELECT * FROM jrussell_Lib.Session";

$result=mysql_query($qry);
	
	
	


		
if($result) {	
	while ( $row = mysql_fetch_array($result) ) {
		echo("<div style='display:none'>
			<div id='Form_".$row["Session_ID"]."'>
			<form action='' method='post'> 
			<input type='hidden' name='utility' value='edit' /> 
			<input type='hidden' name='Utility_Select' value='Go' />
			<input type='hidden' value='".$row["Session_ID"]."' name='Session_ID' />
			<table>");
		echo("<tr><td>Session_ID</td><td>". $row["Session_ID"]."</td></tr>
			<tr><td>Session_Title</td><td><input type='text' name='".$row["Session_ID"]."_Session_Title' value='".$row["Session_Title"]."' /></td></tr>
			<tr><td>Description</td><td><input type='text' name='".$row["Session_ID"]."_Description' value='".$row["Description"]."' /></td></tr>
			<tr><td>Location</td><td><input type='text' name='".$row["Session_ID"]."_Location' value='".$row["Location"]."' /></td></tr>
			<tr><td>Difficulty_Level</td><td><select name='".$row["Session_ID"]."_Difficulty' ><option selected='selected' disabled='disabled'>--Select Difficulty Level--</option>
			<option value='Beginner'"); if($row['Difficulty_Level']=="Beginner"){echo(" selected='selected'");}echo(">Beginner</option>
			<option value='Intermediate'"); if($row['Difficulty_Level']=="Intermediate"){echo(" selected='selected'");}echo(">Intermediate</option>
			<option value='Advanced'"); if($row['Difficulty_Level']=="Advanced"){echo(" selected='selected'");}echo(">Advanced</option>
			</select>
			</td> </tr>
			<tr><td>Event_Title</td><td>");
		$qry2="SELECT Event_ID,Event_Title FROM jrussell_Lib.Event";
		$result2=mysql_query($qry2);
		if($result2) {echo("<select name='".$row["Session_ID"]."_Event_ID' class='Event_ID2'>");
			while ( $row2 = mysql_fetch_array($result2) ) {
				echo("<option value='".$row2["Event_ID"]."_".$row["Session_ID"]."'");
		
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
				
		echo("<tr><td>Section_Title</td><td><select name='".$row["Session_ID"]."_Section' class='Section_".$row['Session_ID']."'>");
						
		$id=$row['Event_ID'];
		$qry2=mysql_query("Select Section_ID,Section_Title FROM jrussell_Lib.Section where Event_ID='".$id."'");
		echo("<option value='NULL' disabled='disabled'>Select a Section</option>");
		while($row2=mysql_fetch_array($qry2))
		{
			if($row2['Section_ID']==$row["Section_ID"]){
				echo ("<option value='".$row2['Section_ID']."' selected='selected'>"
				.$row2['Section_Title']."</option>");
			}else{
				echo ("<option value='".$row2['Section_ID']."'>".$row2['Section_Title']
				."</option>");
			}
		}
						
		echo("</select></td></tr><tr><td>Session Style (Default Capacity):</td><td><select name='".$row["Session_ID"]."_Style' >");
				
		$qry4="SELECT * FROM jrussell_Lib.Session_Style;";
		$result4=mysql_query($qry4);
		if($result4) {
			while ( $row4 = mysql_fetch_array($result4) ) {
				echo("<option value='".$row4["Style"]."' ");
				if($row['Style']==$row4["Style"]){
					echo(" selected='selected'");
					}
				echo("/>".$row4["Style"]." (".$row4["Default_Capacity"].")</option>");			
			}
		}
		echo("</td></tr>
				<tr><td>&nbsp;</td></tr><tr><td>Target Auidience:</td></tr>");
		$qry4="SELECT Audience FROM jrussell_Lib.Session_Target where Session_ID=".$row["Session_ID"];
			$result4=mysql_query($qry4);
			if($result4) {$check_control= array(); $p=0;
				$a=array();
				$aa=0;
				while ( $row4 = mysql_fetch_array($result4) ) {
					$check_control[$p]=$row4['Audience'];$p++;
					$a[$aa]=$row4['Audience'];
					$aa++;
				}
			}
		$qry3="SELECT Audience FROM jrussell_Lib.Target_Audience;";
		$result3=mysql_query($qry3);
		if($result3) { 
			while ( $row3 = mysql_fetch_array($result3) ) {
				
				echo("<tr><td>".$row3['Audience'].":</td><td><input type='checkbox' name='".$row["Session_ID"]."_Target[]' value='".$row3['Audience']."' ");
				foreach($a as $check){
					if($row3['Audience']==$check){
							echo("checked='checked'");
					}
				}
				echo("/></td></tr>");
			}
			echo("<input type='hidden' name='check_control' value='".serialize($check_control)."' /> ");
		}
				
	
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
