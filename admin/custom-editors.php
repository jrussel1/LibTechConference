﻿<?PHP
require_once('../resources/config_local.php');
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
	

	?> <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head><meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="shortcut icon" type="image/ico" href="http://www.sprymedia.co.uk/media/images/favicon.ico">
		<title>Using DataTable with Editable plugin - Custom Column Editors</title>
		<style type="text/css" title="currentStyle">
			@import "media/css/demo_page.css";
			@import "media/css/demo_table.css";
			@import "media/css/demo_validation.css";
			@import "media/css/themes/base/jquery-ui.css";
			@import "media/css/themes/smoothness/jquery-ui-1.7.2.custom.css";
		</style>

        <script src="media/js/jquery-1.4.4.min.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="media/js/jquery.jeditable.js" type="text/javascript"></script>
        <script src="media/js/jquery-ui.js" type="text/javascript"></script>
        <script src="media/js/jquery.validate.js" type="text/javascript"></script>
        <script src="media/js/jquery.dataTables.editable.js" type="text/javascript"></script>

		<script type="text/javascript" charset="utf-8">
			$(document).ready( function () {
			$('#main').dataTable().makeEditable( {
									sUpdateURL: function ( value, settings ) {
            							return {
											sUpdateURL: "edit_in_place_server.php",
											onblur: 'submit',
											data:"{'id': "+$(this).attr('id')+",'val': value}"
           									 };
        								}								

										});
				
			} );
		</script>

	</head>




<body id="dt_example">
		<div id="container">
			<div id="demo">
<?


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

if(isset($_POST['Table_Select'])){

}
	if($_POST['Submit']=='Submit'){		
		
		$qry="INSERT INTO `jrussell_Lib`.`".$tableName."` (";
		$qryC="SHOW COLUMNS FROM jrussell_Lib.".$tableName;
			$resultC=mysql_query($qryC);
			if($resultC) {

				while ( $col = mysql_fetch_array($resultC) ) {
					$qry=$qry."`".$col['Field']."`,";
				}
				$qry=rtrim($qry, ",");
			}
		
		$qry=$qry.")VALUES(";
		$qryC="SHOW COLUMNS FROM jrussell_Lib.".$tableName;
			$resultC=mysql_query($qryC);
			if($resultC) {

				while ( $col = mysql_fetch_array($resultC) ) {
					$qry=$qry."'".$_POST[$col['Field']]."',";
				}
				$qry=rtrim($qry, ",");
				$qry=$qry.")";
			}
		$result=mysql_query($qry);
		if($result){
			
			}
		else {
		die("Query failed".$qry);
	}
	
	}

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
				$top=$top."<th>".$col['Field']."</th>";
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
						$table=$table."<td class='edit' id='".$tableName."-".$col['Field']."-".$row[$IDCol]."-".$IDCol."'>".$row[$col['Field']]."</td>";
						$lastID=$row[$IDCol];
					}
				}
				$table=$table."</tr>";
				
			}
		    echo($table);

		}
		echo("</tbody></table>");
			
			$qryC="SHOW COLUMNS FROM jrussell_Lib.".$tableName;
			$table="<table>";
			$resultC=mysql_query($qryC);
			if($result) {
				$IDflag=False;
				echo("<div style='display:none'>
							<div id='form'>
							<form action='' method='post'> <input type='hidden' value='".$tableName."' name='Table_Select' />
							<table>");
				while ( $col = mysql_fetch_array($resultC) ) {
							if(!$IDflag){
							echo("<tr><td>".$col['Field']."</td>
							<td><input type='text' name='".$col['Field']."' value='".($lastID+1)."' disabled='disabled' /></td></tr>");
							$IDflag=True;
							}
							else{
								echo("<tr><td>".$col['Field']."</td>
								<td><input type='text' name='".$col['Field']."' /></td></tr>");
							}
					
				}			
			}
		    echo("<tr><td><input type='submit' name='Submit' value='Submit'/></td></tr></table></form></div></div>");
			
	}else {
		die("Query failed".$qry);
	}
	
	
	}
	
	
	?>

			</div>
			

		</div>
	</body>


</html>