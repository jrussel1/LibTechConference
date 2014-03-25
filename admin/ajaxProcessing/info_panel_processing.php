<?PHP
require_once('../auth.php');
require_once('../../resources/config_local.php');
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
	
	if(isset($_POST['tableName'])){
		$tableName=$_POST['tableName'];
	} 
	
$ID=$_POST['id'];



if(isset($_POST['tableName'])&&($_POST['tableName']=="Session")){
	$pCols = Array();
	$qry_showPerson="SHOW COLUMNS FROM Person;";
	$result_showPerson=mysql_query($qry_showPerson);
	while ( $column = mysql_fetch_array($result_showPerson) ) {
		array_push($pCols, Array("Column" => $column["Field"],"Table" => "Person"));
	}

			
	$topRow="<thead><tr>";				
	foreach( $pCols as $column ) {		
		$topRow=$topRow."<th>".preg_replace('/_/',' ',$column['Column'])."</th>";				
	}
	$topRow=$topRow."</tr></thead>";
	
	
	
	
		
	echo(utf8_encode("
	<div id='InfoPanel_".$ID."'>
	<h2 style='border-bottom:1px solid #D3D6FF !important;'>Presenters of Session</h2>
	<table id='ViewP' class='Display'>".$topRow));
	
	$qry_SelectLots="SELECT DISTINCT
					`Presenter_Of_Session`.`Session_ID`,
					`Person`.`Person_ID`, 
					`Person`.`Person_First_Name`, 
					`Person`.`Person_Last_Name`, 
					`Person`.`Person_Address`, 
					`Person`.`Person_City`, 
					`Person`.`Person_State`, 
					`Person`.`Person_Institution`, 
					`Person`.`Person_Email`, 
					`Person`.`Person_Zip`, 
					`Person`.`Person_Title`, 
					`Person`.`Person_Phone`, 
					`Person`.`Institution_ID`
					FROM `Presenter_Of_Session`
					JOIN `Person`
					ON 
					`Presenter_Of_Session`.`Presenter_ID`= `Person`.`Person_ID`
					AND 
					`Presenter_Of_Session`.`Session_ID`=".$ID.";";	
	$result_SelectLots=mysql_query($qry_SelectLots);
	if($result_SelectLots){
		while ( $rowInfo = mysql_fetch_array($result_SelectLots) ) {
			
			$flagg=false;
			echo(utf8_encode("<tr>"));
			foreach( $pCols as $column ) {	
				$qry_ShowIndex="SHOW INDEX FROM ".$column['Table']." where Key_name='PRIMARY'";
				$result_ShowIndex=mysql_query($qry_ShowIndex);
				if($result_ShowIndex){
					while ( $d = mysql_fetch_array($result_ShowIndex) ) {	
					  $dCol=$d['Column_name'];
					}
				}
			 
				if(!$flagg){				
					echo(utf8_encode("<td id='".$column['Table']."-".$column['Column']."-".$rowInfo[$dCol]."-".$dCol."'>			
					".$rowInfo[$column['Column']]."</td>"));		  
					$flagg=true;
				}else{
					echo(utf8_encode("<td class='edit' id='".$column['Table']."-".$column['Column']."-".$rowInfo[$dCol]."-".$dCol."'>
					".$rowInfo[$column['Column']]."</td>"));
				}
			}
			echo(utf8_encode("</tr>"));
				  
		}		  
	}else{
		die(mysql_error());
	}
	echo(utf8_encode("</table>  
	<br/><br/><br/>
	<div id='trigger' style='float:left;'>
	<button class='cT'>Add Presenters</button>
	</div>
	<div id='deleteP' style='float:right;'>
	<button>Delete Selected Presenters</button>
	</div>
	<div id='panel' style='display:none'>
	<form action='' method='post' >
	<table id='AddP' class='Display'><thead><th>Add</th>"));
	
	$qry_showPerson="SHOW COLUMNS FROM Person;";
	$result_showPerson=mysql_query($qry_showPerson);
	if($result_showPerson) {
		while ( $rower1 = mysql_fetch_array($result_showPerson) ) {
			echo(utf8_encode("<th>".preg_replace('/_/',' ',$rower1['Field'])."</th>"));
		}
	}
	echo(utf8_encode("</thead>"));
	
	$qry_SelectAllFromPerson="SELECT * FROM Person;";
	$result_SelectAllFromPerson=mysql_query($qry_SelectAllFromPerson);
	if($result_SelectAllFromPerson) {
		while ( $rower = mysql_fetch_array($result_SelectAllFromPerson) ) {
			$qry_showPerson="SHOW COLUMNS FROM Person;";
			$result_showPerson=mysql_query($qry_showPerson);
			if($result_showPerson) {
				echo(utf8_encode("<tr><td><input type='checkbox' value='".$rower['Person_ID']."' name='Add_Person[]' /></td>"));
				while ( $rower1 = mysql_fetch_array($result_showPerson) ) {
					echo(utf8_encode("<td>".$rower[$rower1['Field']]."</td>"));
				}
			}
			echo(utf8_encode("</tr>"));
		}
	}else{
		die(mysql_error());
	}
	echo(utf8_encode("</table><br/>
<input type='hidden' value='".$tableName."' name='Table_Select' />
	<input type='hidden' value='".$ID."' name='sess' />
	<input type='submit' name='SubmitP' value='Submit'/>
	</form></div>
	<br/><br/>
	<h2 style='border-bottom:1px solid #D3D6FF !important;'>People Attending</h2>
	<table id='ViewAP' class='Display'><thead>"));
	$qry_showPerson="SHOW COLUMNS FROM Person;";
	$result_showPerson=mysql_query($qry_showPerson);
	if($result_showPerson) {
		while ( $rower1 = mysql_fetch_array($result_showPerson) ) {
			echo(utf8_encode("<th>".preg_replace('/_/',' ',$rower1['Field'])."</th>"));
		}
	}
	echo(utf8_encode("</thead>"));
	$qry_SelectFromPPPoS="SELECT * FROM Person,Session,Person_Of_Session 
	WHERE Person_Of_Session.Session_ID=Session.Session_ID
	AND Person_Of_Session.Person_ID=Person.Person_ID
	AND Session.Session_ID=".$ID.";";
	$result_SelectFromPPPoS=mysql_query($qry_SelectFromPPPoS);
	if($result_SelectFromPPPoS) {
		while ( $rower = mysql_fetch_array($result_SelectFromPPPoS) ) {
			$qry_showPerson="SHOW COLUMNS FROM Person;";
			$result_showPerson=mysql_query($qry_showPerson);
			if($result_showPerson) {
				echo(utf8_encode("<tr>"));
				while ( $rower1 = mysql_fetch_array($result_showPerson) ) {
					echo(utf8_encode("<td>".$rower[$rower1['Field']]."</td>"));
				}
			}
			else{
				die(mysql_error());
			}
			echo(utf8_encode("</tr>"));
		}
	}
	else{
		die(mysql_error());
	}
	echo(utf8_encode("</table>
	<br/><br/><br/>
	<div id='triggerAP' style='float:left;'><button class='cT2'>
	Add People</button></div>
	<div id='deleteAP' style='float:right;'><button>
	Delete Selected People</button></div>
	<div id='panelAP' style='display:none'>
	<form action='' method='post' >
	<table id='AddAP' class='Display'><thead><th>Add</th>"));
	$qry_showPerson="SHOW COLUMNS FROM Person;";
	$result_showPerson=mysql_query($qry_showPerson);
	if($result_showPerson) {
		while ( $rower1 = mysql_fetch_array($result_showPerson) ) {
			echo(utf8_encode("<th>".preg_replace('/_/',' ',$rower1['Field'])."</th>"));
		}
	}
	echo(utf8_encode("</thead>"));
	
	$qry_SelectAllFromPerson="SELECT * FROM Person;";
	$result_SelectAllFromPerson=mysql_query($qry_SelectAllFromPerson);
	if($result_SelectAllFromPerson) {
		while ( $rower = mysql_fetch_array($result_SelectAllFromPerson) ) {
			$qry_showPerson="SHOW COLUMNS FROM Person;";
			$result_showPerson=mysql_query($qry_showPerson);
			if($result_showPerson) {
				echo(utf8_encode("<tr><td><input type='checkbox' value='".$rower['Person_ID']."' name='Add_Person_Attending[]' /></td>"));
				while ( $rower1 = mysql_fetch_array($result_showPerson) ) {
					echo(utf8_encode("<td>".$rower[$rower1['Field']]."</td>"));
				}
			}
			echo(utf8_encode("</tr>"));
		}
	}else{
		die(mysql_error());
	}
	echo(utf8_encode("</table><br/>
<input type='hidden' value='".$tableName."' name='Table_Select' />
	<input type='hidden' value='".$ID."' name='sess' />		
	<input type='submit' name='SubmitAP' value='Submit'/>
	</form></div>
	<br/><br/>
	<h2 style='border-bottom:1px solid #D3D6FF !important;'>Targeted Groups</h2>
	<table id='ViewTar' class='Display'><thead>"));
	$qry_ShowTargetAudience="SHOW COLUMNS FROM Target_Audience;";
	$result_ShowTargetAudience=mysql_query($qry_ShowTargetAudience);
	if($result_ShowTargetAudience) {
		while ( $rower1 = mysql_fetch_array($result_ShowTargetAudience) ) {
			echo(utf8_encode("<th>".preg_replace('/_/',' ',$rower1['Field'])."</th>"));
		}
	}
	echo(utf8_encode("</thead>"));
	$qry_SelectAllSessionTarget="SELECT * FROM Session_Target WHERE Session_ID=".$ID.";";
	$result_SelectAllSessionTarget=mysql_query($qry_SelectAllSessionTarget);
	if($result_SelectAllSessionTarget) {
		while ( $rower = mysql_fetch_array($result_SelectAllSessionTarget) ) {
			$qry_ShowTargetAudience="SHOW COLUMNS FROM Target_Audience;";
			$result_ShowTargetAudience=mysql_query($qry_ShowTargetAudience);
			if($result_ShowTargetAudience) {
				echo(utf8_encode("<tr>"));
				while ( $rower1 = mysql_fetch_array($result_ShowTargetAudience) ) {
					echo(utf8_encode("<td>".$rower[$rower1['Field']]."</td>"));
				}
			}
			else{
				die(mysql_error());
			}
			echo(utf8_encode("</tr>"));
		}
	}
	else{
		die(mysql_error());
	}
	echo(utf8_encode("</table>
	<br/><br/><br/>
	<div id='triggerTar' style='float:left;'>
	<button class='cT3'>Add Targeted Groups</button>
	</div>
	<div id='deleteTar' style='float:right;'>
	<button>Delete Selected Targets</button>
	</div>
	<div id='panelTar' style='display:none'>
	<form action='' method='post' >
	<table id='AddTar' class='Display'>
	<thead><th>Add</th>"));
	$qry_ShowTargetAudience="SHOW COLUMNS FROM Target_Audience;";
	$result_ShowTargetAudience=mysql_query($qry_ShowTargetAudience);
	if($result_ShowTargetAudience) {
		while ( $rower1 = mysql_fetch_array($result_ShowTargetAudience) ) {
			echo(utf8_encode("<th>".preg_replace('/_/',' ',$rower1['Field'])."</th>"));
		}
	}
	else{
		die(mysql_error());
	}
	echo(utf8_encode("</thead>"));
	$qry_SelectAllTargetAudience="SELECT * FROM Target_Audience";
	$result_SelectAllTargetAudience=mysql_query($qry_SelectAllTargetAudience);
	if($result_SelectAllTargetAudience) {
		while ( $rower = mysql_fetch_array($result_SelectAllTargetAudience) ) {
			$qry_ShowTargetAudience="SHOW COLUMNS FROM Target_Audience;";
			$result_ShowTargetAudience=mysql_query($qry_ShowTargetAudience);
			if($result_ShowTargetAudience) {
				echo(utf8_encode("<tr><td><input type='checkbox' value='".$rower['Audience']."' name='Add_Target[]' /></td>"));
				while ( $rower1 = mysql_fetch_array($result_ShowTargetAudience) ) {
					echo(utf8_encode("<td>".$rower[$rower1['Field']]."</td>"));
				}
			}
			else{
				die(mysql_error());
			}
			echo(utf8_encode("</tr>"));
		}
	}
	echo(utf8_encode("</table><br/><input type='submit' name='SubmitTar' value='Submit'/>
	
<input type='hidden' value='".$tableName."' name='Table_Select' />
	<input type='hidden' value='".$ID."' name='sess' /></form></div>
	</div>"));
}
else if(isset($_POST['tableName'])&&($_POST['tableName']=="Person")){////////////////////////////////////////////////////////////////////////////////////////
	
	$qryCol="SHOW COLUMNS FROM ".DB_DATABASE.".Session;";
	$resultCol=mysql_query($qryCol);
	if($resultCol) {
						
		$topRow=$topRow."<thead><tr>";
						
		while ( $column = mysql_fetch_array($resultCol) ) {
						
			$topRow=$topRow."<th>".preg_replace('/_/',' ',$column['Field'])."</th>";
							
		}
		$topRow=$topRow."</tr></thead>";
	}
	else{
		die(mysql_error());
	}
	
		
		
	echo(utf8_encode("<div id='InfoPanel_".$ID."'>
	<h2 style='border-bottom:1px solid #D3D6FF !important;'>Sessions as Presenter</h2>
	<table id='ViewS' class='Display'>".$topRow));
	$qryInfo="Select Distinct * from `Session`,`Presenter`,`Presenter_Of_Session`,`Person` 
	where Person.Person_ID=".$ID."
	and Presenter_Of_Session.Presenter_ID=".$ID."
	and Session.Session_ID=Presenter_Of_Session.Session_ID
	and Person.Person_ID=Presenter.Person_ID;";
	$resultInfo=mysql_query($qryInfo);
	if($resultInfo){
		while ( $rowInfo = mysql_fetch_array($resultInfo) ) { 
		  /*if(isset($_SESSION['ACCESS'])&&$_SESSION['ACCESS']!="Admin"){ 
			  if(isset($_SESSION['EVENT'])&&$rowInfo['Event_ID']!=$_SESSION['EVENT']){
				  continue;		//Skips rows with events from other events that the person may happen to be signed up for within the system
			  }
		  }*/
			$qryCol="SHOW COLUMNS FROM ".DB_DATABASE.".Session;";
			$resultCol=mysql_query($qryCol);
			if($resultCol) {
				$flagg=false;
				echo(utf8_encode("<tr>"));
			
				while ( $column = mysql_fetch_array($resultCol) ) {
					$q="SHOW INDEX FROM Session where Key_name='PRIMARY'";
					$r=mysql_query($q);
					if($r){
						while ( $d = mysql_fetch_array($r) ){ 
							$dCol=$d['Column_name'];
						}
					}
					
					if(!$flagg){
						echo(utf8_encode("<td id='Session-".$column['Field']."-".$rowInfo[$dCol]."-".$dCol."'>".$rowInfo[$column['Field']]."</td>"));					
						$flagg=true;
					}else{
						if($column['Field']=="Event_ID"&&$_SESSION['ACCESS']!="Admin"){
							echo(utf8_encode("<td id='Session-".$column['Field']."-".$rowInfo[$dCol]."-".$dCol."'>
							".$rowInfo[$column['Field']]."</td>"));
						}else{
							echo(utf8_encode("<td class='edit' id='Session-".$column['Field']."-".$rowInfo[$dCol]."-".$dCol."'>
							".$rowInfo[$column['Field']]."</td>"));
						}
					}
				}				
				echo(utf8_encode("</tr>"));
			}else{
				die("HERE!!!".$qryInfo);
			}	
		}	
	}else{
		die($qryCol);
	}
	echo(utf8_encode("</table>
	<br/><br/><br/>
	<div id='trigger' style='float:left;'>
		<button class='cT'>Add Sessions</button>
	</div>
	<div id='deleteS' style='float:right;'>
		<button>Delete Selected Sessions</button>
	</div>
	<div id='panel' style='display:none'>
	<form action='' method='post' >
	<table id='AddS' class='Display'><thead><th>Add</th>"));
	$query1="SHOW COLUMNS FROM Session";
	$resulter1=mysql_query($query1);
	if($resulter1) {
		while ( $rower1 = mysql_fetch_array($resulter1) ) {
			echo(utf8_encode("<th>".preg_replace('/_/',' ',$rower1['Field'])."</th>"));
		}
	}
	echo(utf8_encode("</thead>"));
	
	$query="SELECT * FROM ".DB_DATABASE.".Session";
	$resulter=mysql_query($query);
	if($resulter) {
		while ( $rower = mysql_fetch_array($resulter) ) {
			$query1="SHOW COLUMNS FROM ".DB_DATABASE.".Session";
			$resulter1=mysql_query($query1);
			if($resulter1) {
				echo(utf8_encode("<tr><td><input type='checkbox' value='".$rower['Session_ID']."' name='Add_Session[]' /></td>"));
				while ( $rower1 = mysql_fetch_array($resulter1) ) {
					echo(utf8_encode("<td>".$rower[$rower1['Field']]."</td>"));
				}
			}
			echo(utf8_encode("</tr>"));
		}
	}else{
		die(mysql_error());
	}
	echo(utf8_encode("</table><br/><input type='hidden' value='".$tableName."' name='Table_Select' />
	
	<input type='hidden' value='".$ID."' name='pers' />
				<input type='submit' name='SubmitS' value='Submit'/>
		</form>
	</div>
	<br/><br/>	
	<h2 style='border-bottom:1px solid #D3D6FF !important;'>Sessions Attending</h2>
	<table id='ViewAS' class='Display'>
	<thead>"));
	$qry_showPerson="SHOW COLUMNS FROM Session;";
	$result_showPerson=mysql_query($qry_showPerson);
	if($result_showPerson) {
		while ( $rower1 = mysql_fetch_array($result_showPerson) ) {
			echo(utf8_encode("<th>".preg_replace('/_/',' ',$rower1['Field'])."</th>"));
		}
	}
	echo(utf8_encode("</thead>"));
	
	
	$query="SELECT * FROM Session,Person_Of_Session,Person 
	WHERE Person_Of_Session.Session_ID=Session.Session_ID
	AND Person_Of_Session.Person_ID=Person.Person_ID
	AND Person.Person_ID=".$ID.";";   
	$resulter=mysql_query($query);
	if($resulter) {
		while ( $rower = mysql_fetch_array($resulter) ) {
			$query1="SHOW COLUMNS FROM ".DB_DATABASE.".Session";
			$resulter1=mysql_query($query1);
			if($resulter1) {
				echo(utf8_encode("<tr>"));
				while ( $rower1 = mysql_fetch_array($resulter1) ) {
					echo(utf8_encode("<td>".$rower[$rower1['Field']]."</td>"));
				}
			}
			echo(utf8_encode("</tr>"));
		}
	}
	echo(utf8_encode("</table><br/><br/><br/>
	<div id='triggerAS' style='float:left;'><button class='cT2'>
	Add Sessions</button></div>
	<div id='deleteAS' style='float:right;'><button>
	Delete Selected Sessions</button></div>
	<div id='panelAS' style='display:none'>
	<form action='' method='post' >
	<table id='AddAS' class='Display'><thead><th>Add</th>"));
	$query1="SHOW COLUMNS FROM Session";
	$resulter1=mysql_query($query1);
	if($resulter1) {
		while ( $rower1 = mysql_fetch_array($resulter1) ) {
			echo(utf8_encode("<th>".preg_replace('/_/',' ',$rower1['Field'])."</th>"));
		}
	}
	echo(utf8_encode("</thead>"));
	
	$query="SELECT * FROM ".DB_DATABASE.".Session";
	$resulter=mysql_query($query);
	if($resulter) {
		while ( $rower = mysql_fetch_array($resulter) ) {
			$query1="SHOW COLUMNS FROM ".DB_DATABASE.".Session";
			$resulter1=mysql_query($query1);
			if($resulter1) {
				echo(utf8_encode("<tr><td><input type='checkbox' value='".$rower['Session_ID']."' name='Add_Session_Attending[]' /></td>"));
				while ( $rower1 = mysql_fetch_array($resulter1) ) {
					echo(utf8_encode("<td>".$rower[$rower1['Field']]."</td>"));
				}
			}
			echo(utf8_encode("</tr>"));
		}
	}else{
		die(mysql_error());
	}
	echo(utf8_encode("</table><br/>
<input type='hidden' value='".$tableName."' name='Table_Select' />
	
	<input type='hidden' value='".$ID."' name='pers' />
	<input type='submit' name='SubmitAS' value='Submit'/>
	</form></div>	
	</div>"));
		
									  
}
