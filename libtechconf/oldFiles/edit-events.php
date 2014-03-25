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
	
	$tableName="Session";

echo("<br/><h2>".$tableName."</h2>

<p>Use this to view and edit ".$tableName.". </p>");



	
	$qry="SELECT * FROM jrussell_Lib.".$tableName;

	$result=mysql_query($qry);
	

	//Check whether the query was successful or not
	if($result) {
		$qryC="SHOW COLUMNS FROM jrussell_Lib.".$tableName;
		$top="<table><tr>";
		$resultC=mysql_query($qryC);
		if($result) {
			
			while ( $col = mysql_fetch_array($resultC) ) {
				$top=$top."<td>".$col['Field']."</td>";
				}
			$top=$top."</tr>";
			echo($top);
		}
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
						$table=$table."<td><span class='editme1' id='".$tableName."-".$col['Field']."-".$row[$IDCol]."'>".$row[$col['Field']]." </span></td>";
					}
				}
				$table=$table."</tr>";
				
			}
		    echo($table);

		}
		echo("</table>");
	}else {
		die("Query failed");
	}
	

	?>



</body>
</html>