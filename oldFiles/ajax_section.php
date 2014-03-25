
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
if(isset($_POST['Event_ID']))
{
$id=$_POST['Event_ID'];
$qry=mysql_query("Select Section_ID,Section_Title FROM jrussell_Lib.Section where Event_ID='$id'");
echo("<option selected='selected' value='1 OR 1=1'>All Sections</option>");
while($row=mysql_fetch_array($qry))
{

echo '<option value="'.$row['Section_ID'].'">'.$row['Section_Title'].'</option>';

}
}

?>