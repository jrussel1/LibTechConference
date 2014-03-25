<?PHP
///////// Start of insert handlers
if(isset($_POST['Add_Session'])&&isset($_POST['pers'])){
	foreach($_POST['Add_Session'] as $ses){
		$q="INSERT IGNORE INTO `".DB_DATABASE."`.`Presenter_Of_Session` (`Session_ID`, `Presenter_ID`) VALUES ( ".$ses.",".$_POST['pers']." );";
		$resultS=mysql_query($q);
		if($resultS) {  
			//Do nothing?
		}
		else{
			die(mysql_error());
			}
	}
	//Empty post varibale to reset page
	$_POST=NULL;
	$_POST['Table_Select']="Person";
}
	
if(isset($_POST['Add_Session_Attending'])&&isset($_POST['pers'])){
	foreach($_POST['Add_Session_Attending'] as $ses){
			
		$q="INSERT IGNORE INTO `".DB_DATABASE."`.`Person_Of_Session` (`Session_ID`, `Person_ID`) VALUES ( ".$ses.",".$_POST['pers']." );";
		$resultAS=mysql_query($q);
		if($resultAS) {  
			//Do nothing? Maybe add a callback for these
		}
		else{
			die(mysql_error());
		}
	}
	//Empty post varibale to reset page
	$_POST=NULL;
	$_POST['Table_Select']="Person";
}
///////// End of insert handlers
///////// Start of main page viewing
$qry="SELECT * FROM ".DB_DATABASE.".Person,".DB_DATABASE.".Institution where Person.Institution_ID=Institution.Institution_ID";

$result_ShowTable=mysql_query($qry);


$colCount=0;
//Check whether the query was successful or not
if($result_ShowTable) {
	
	include("showTable.php");
	
	
	echo("</tbody></table>");
		
	$qryC="SHOW COLUMNS FROM ".DB_DATABASE.".".$tableName;
	$table="<table>";
	$resultC=mysql_query($qryC);
	if($result_ShowTable) {
		$IDflag=False;
		echo("<div style='display:none'>
				<div id='form'>
				<form action='' method='post'>
					<input type='hidden' value='".$tableName."' name='Table_Select' />
					<table>");
		while ( $col = mysql_fetch_array($resultC) ) {
			if(!$IDflag){
                echo("<input type='hidden' name='".$col['Field']."' value='DEFAULT'  />");
				$IDflag=True;
			}
			else{
				echo("<tr>
						<td>".$col['Field']."</td>
						<td><input type='text' name='".$col['Field']."' /></td>
					</tr>");
			}
			
		}			
	}else{
		die(mysql_error());
	}
	echo("<tr>
			<td><input type='submit' name='Submit' value='Submit'/></td>
		</tr>
		</table>
		</form>
		</div></div>");
		////////
	
	 
	///////
}else {
	die("Query failed".$qry);
}