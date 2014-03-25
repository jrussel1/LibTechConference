<?PHP
	require_once('../auth.php');
	require_once('../config.php');
		$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
if(isset($_POST['value'])){
	$update_value = mysql_real_escape_string($_POST['value']);
	$table = $_POST['tableName'];
	$col = $_POST['column'];
	$row_id = $_POST['rowID'];
	$idCol = $_POST['rowIDCol'];
	
	if($col=="Institution_ID"){
		$qry="SELECT `Institution_ID` FROM `Institution` WHERE `Institution_ID`=".$update_value.";";
		$result=mysql_query($qry);
		
		if($result) {
			$num_results = mysql_num_rows($result); 
			if ($num_results > 0){ 
				$sql = "UPDATE ".$table." SET `".$col."`='".$update_value."' WHERE `".$idCol."`='".$row_id."';";
				$result = mysql_query($sql);
			}
			else{
				die("INVALID ID - Please enter one that exists");
			}
		}
	}
	else{
		$sql = "UPDATE ".$table." SET `".$col."`='".$update_value."' WHERE `".$idCol."`='".$row_id."';";
		$result = mysql_query($sql); 
	}
	if($result){
		echo($update_value);
		}
	else{ 
		die(mysql_error().$sql);
	}
}else if(isset($_POST['data'])){
	if(isset($_POST['IDCol2'])){
		$sql = "DELETE FROM ".$_POST['table']." WHERE `".$_POST['IDCol']."`='".$_POST['data']."' AND `".$_POST['IDCol2']."`='".$_POST['id2']."'";
	}
	else{
		$sql = "DELETE FROM `".$_POST['table']."` WHERE `".$_POST['IDCol']."` = '".$_POST['data']."';";
	}
	$result = mysql_query($sql); 
	if($result){
		echo($sql);
	}
	else{ 
		die(mysql_error());
	}
}