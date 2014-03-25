<?
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

$update_value = $_POST['update_value'];
$element_id = $_POST['element_id'];
$original = $_POST['original_html'];

$element = explode("-", $element_id);

$table = $element['0'];
$col = $element['1'];
$row_id = $element['2'];
$col_id = $element['3'];

$sql = "UPDATE ".$table." SET ".$col."='".$update_value."' WHERE ".$col_id."='".$row_id."'";
$result = mysql_query($sql); 

if($result){
	echo $update_value;
	}
else{ die(mysql_error().$sql);}


?>