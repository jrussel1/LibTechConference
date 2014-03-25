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
	
	
	if(isset($_POST['Table_Select'])){
		$tableName=$_POST['Table_Select'];
	} 
	

	?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>
<?
	if(!isset($_POST['Table_Select'])){
		echo("Table Utility");
	} 
	else{
		echo($tableName);
	}
?></title>
<link href="../loginmodule.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../jquery.js"></script>
<script type="text/javascript" src="../jquery.editinplace.packed.js"></script>
<script type="text/javascript" src="edit.js"></script>
<script type="text/javascript" charset="utf-8" src="/libtechconf/resources/DataTables-1.9.4/media/js/jquery.dataTables.js"></script>
<style type="text/css" title="currentStyle">
    @import "/libtechconf/resources/DataTables-1.9.4/media/css/jquery.dataTables.css";
</style>

</head>
<body>
<h1><?
	if(!isset($_POST['Table_Select'])){
		echo("Table Utility");
	} 
	else{
		echo($tableName);
	}
?></h1>


<?

echo("<table><tr><td><a href='/libtechconf/oldFiles/Editor/'>Home</a></td><td>");
echo("<a href='/libtechconf/logout.php'>Logout</a></td></tr></table>
<div style='float:right'><a href='/libtechconf/Library.jpg' target='_blank'>View LDS of Database</a></div>");
echo("<form action='' method='post'><select name='Table_Select'>");
if(!isset($_POST['Table_Select'])){
	echo("<option disabled='disabled' selected='selected'>Please select table</option>");
}
$qryC="SHOW TABLES FROM jrussell_Lib";
			$resultC=mysql_query($qryC);
			if($resultC) {
				while ( $tableNames = mysql_fetch_array($resultC) ) {
					echo("<option value='".$tableNames[0]."'"); 
					if(isset($_POST['Table_Select'])&&$_POST['Table_Select']==$tableNames[0]){
						echo("selected='selected'");
					}
					echo(">".$tableNames[0]."</option> ");
				}
			}
echo("</select><input type='submit' value='Go' name='submit'/>
</form>");


echo("<p>Use this to view and edit tables.</p><br/><br/><h2>".$tableName."</h2>

");



	if(isset($_POST['Table_Select'])){
			
	
	$qry="SELECT * FROM jrussell_Lib.".$tableName;

	$result=mysql_query($qry);
	
	$colCount=0;
	//Check whether the query was successful or not
	if($result) {
		$qryC="SHOW COLUMNS FROM jrussell_Lib.".$tableName;
		$top="<table id='main' class='Display'><thead><tr>";
		$resultC=mysql_query($qryC);
		if($result) {
			
			while ( $col = mysql_fetch_array($resultC) ) {	$colCount=$colCount+1;
				$top=$top."<td>".$col['Field']."</td>";
				}
			$top=$top."</tr></thead> <tbody>";
			echo($top);
		}
		$lastID;
		while ( $row = mysql_fetch_array($result) ) {
			$qryC="SHOW COLUMNS FROM jrussell_Lib.".$tableName;
			$table="";
			$resultC=mysql_query($qryC);
			if($result) {
				$IDCol;
				$IDflag=False;
				while ( $col = mysql_fetch_array($resultC) ) {
					if($IDflag==False){ $IDCol=$col['Field']; $IDflag=True; $table="<tr><td>".$row[$IDCol]."</td>";}
					else{
						$table=$table."<td><span class='editme1' id='".$tableName."-".$col['Field']."-".$row[$IDCol]."-".$IDCol."'>".$row[$col['Field']]."</span></td>";
						$lastID=$row[$IDCol];
					}
				}
				$table=$table."</tr>";
				
			}
		    echo($table);

		}
		echo("</tbody></table>");
	}else {
		die("Query failed".$qry);
	}
	
	}
	?>



</body>
</html>
<script>
$(document).ready( function () {
    $('#main').dataTable();
} );


</script>