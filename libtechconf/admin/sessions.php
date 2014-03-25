<?PHP
///////// Start of SESSION insert handlers
if(isset($_POST['Add_Person'])&&isset($_POST['sess'])){
	
	foreach($_POST['Add_Person'] as $per){
		$q="INSERT IGNORE INTO `".DB_DATABASE."`.`Presenter` (`Person_ID`) VALUES ( ".$per." );";
		$resultP=mysql_query($q);
		if($resultP) {
			//Maybe add callback
		}
		else{
			die(mysql_error());
		}
		$q="INSERT IGNORE INTO `".DB_DATABASE."`.`Presenter_Of_Session` (`Session_ID`, `Presenter_ID`) VALUES ( ".$_POST['sess'].",".$per." );";
		$resultP=mysql_query($q);
		if($resultP) {
			//Maybe add callback  
		}
		else{
			die(mysql_error());
		}
	}
	
	$_POST=NULL;
	$_POST['Table_Select']="Session";
}
	
if(isset($_POST['Add_Person_Attending'])&&isset($_POST['sess'])){
	foreach($_POST['Add_Person_Attending'] as $per){
		$q="INSERT IGNORE INTO `".DB_DATABASE."`.`Person_Of_Session` (`Session_ID`, `Person_ID`) VALUES ( ".$_POST['sess'].",".$per." );";
		$resultP=mysql_query($q);
		if($resultP) {  
			//Maybe add callback
		}
		else{
			die(mysql_error());
		}
	}
	$_POST=NULL;
	$_POST['Table_Select']="Session";
}

if(isset($_POST['Add_Target'])&&isset($_POST['sess'])){
	foreach($_POST['Add_Target'] as $per){
		$q="INSERT IGNORE INTO `".DB_DATABASE."`.`Session_Target` (`Session_ID`, `Audience`) VALUES ( ".$_POST['sess'].",'".$per."' );";
		$resultP=mysql_query($q);
		if($resultP) {
			//Maybe add callback  
		}
		else{
			die(mysql_error());
		}
	}
	$_POST=NULL;
	$_POST['Table_Select']="Session";
}
///////// End of SESSION insert handlers



/*if($_SESSION['SESS_ACCESS']=="User"){
	$qry="SELECT * FROM ".DB_DATABASE.".".$tableName." WHERE Event_ID=".$_SESSION['SESS_EVENT'];
}
else{
	$qry="SELECT * FROM ".DB_DATABASE.".".$tableName;
}*/

$qry_selectAllFromSession="SELECT * FROM ".DB_DATABASE.".".$tableName;

$result_ShowTable=mysql_query($qry_selectAllFromSession);
$colCount=0;
//Check whether the query was successful or not
if($result_ShowTable) {
	
	include("showTable.php");
	

	
	 
	///////
	echo("</tbody></table>");
	
	$qry_ShowSession="SHOW COLUMNS FROM ".DB_DATABASE.".".$tableName.";";
	$result_ShowSession=mysql_query($qry_ShowSession);
	if($result_ShowSession) {
		$IDflag=False;
		echo("<div style='display:none'>
		<div id='form'>
		<form action='' method='post'> <input type='hidden' value='".$tableName."' name='Table_Select' />
		<table>");
		while ( $col = mysql_fetch_array($result_ShowSession) ) {
			if(!$IDflag){
                echo("<input type='hidden' name='".$col['Field']."' value='DEFAULT'  />");
				$IDflag=True;
			}
			else{
				echo("<tr><td>".$col['Field']."</td>");
					if(($col['Field']=="Session_Title"
					||$col['Field']=="Description"
					||$col['Field']=="Location")
					||$_SESSION['SESS_ACCESS']=="Admin"){
						echo("<td><input type='text' name='".$col['Field']."' /></td></tr>");
					}
					else{
						if($col['Field']=="Difficulty_Level"){
							echo("<td><select name='".$col['Field']."' >
							<option selected='selected' disabled='disabled'>--Select Difficulty Level--</option>
							<option value='Beginner'>Beginner</option>
							<option value='Intermediate'>Intermediate</option>
							<option value='Advanced'>Advanced</option>
							</select></td></tr>");
						}
						if($col['Field']=="Event_ID"&&$_SESSION['SESS_ACCESS']=="User"){
							echo("<td><input type='text' name='".$col['Field']."'  disabled='disabled' 
							value='".$_SESSION['SESS_EVENT']."' /><input type='hidden' name='".$col['Field']."' 
							value='".$_SESSION['SESS_EVENT']."' /></td></tr>");
						}
						if($col['Field']=="Section_ID"&&$_SESSION['SESS_ACCESS']=="User"){
							echo("<td><select name='".$col['Field']."' >
							<option selected='selected' disabled='disabled'>--Select Section--</option>");
							$qry_SelectAllFromSection="SELECT * FROM Section WHERE Event_ID=".$_SESSION['SESS_EVENT'];
							$result_SelectAllFromSection=mysql_query($qry_SelectAllFromSection);
							if($result_SelectAllFromSection) {
								while ( $row = mysql_fetch_array($result_SelectAllFromSection) ) {
									echo("<option value='".$row['Section_ID']."'>".$row['Section_Title']."</option>");
								}
							}
							echo("</select></td></tr>");
						}
						if($col['Field']=="Style"&&$_SESSION['SESS_ACCESS']=="User"){
							echo("<td><select name='".$col['Field']."' >
							<option selected='selected' disabled='disabled'>--Select Session Style--</option>");
							$qry_SelectAllFromSessionStyle="SELECT * FROM ".DB_DATABASE.".Session_Style;";
							$result_SelectAllFromSessionStyle=mysql_query($qry_SelectAllFromSessionStyle);
							if($result_SelectAllFromSessionStyle) {
								while ( $row4 = mysql_fetch_array($result_SelectAllFromSessionStyle) ) {
									echo("<option value='".$row4["Style"]."' />".$row4["Style"]." (".$row4["Default_Capacity"].")</option>");			
								}
							}
							echo("</select></td></tr>");
						}
					}
			}	
		}			
	}
	else{
		die(mysql_error());
	}
	echo("<tr><td><input type='submit' name='Submit' value='Submit'/></td></tr></table></form></div></div>");
	///////////
	echo("<div id='info_panel_container'></div>");
}else{
	die(mysql_error());
}