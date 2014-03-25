<?PHP
	$colList="";
	$IDCol="";
	$IDflag=False;
	$qryC="SHOW COLUMNS FROM ".DB_DATABASE.".".$tableName;
	echo("<table id='main' class='Display'><thead>");
	$resultC=mysql_query($qryC);
	if($result_ShowTable) {
		while ( $col = mysql_fetch_array($resultC) ) {	
			if($IDflag==False){ 
				$IDCol=$col['Field']; 
				$IDflag=True;
			}
			$colCount=$colCount+1;
			echo("<th>".preg_replace('/_/',' ',$col['Field'])."</th>");
			$colList=$colList."'".$col['Field']."',";
		}
		echo("<th>More Info</th></thead> <tbody>");
		$colList=substr($colList, 0, -1);
	}
	else{
		die(mysql_error());
	}
	
	
	
	
	/*$lastID;
	$ids= "";
	while ( $row = mysql_fetch_array($result_ShowTable) ) {
		$qryC="SHOW COLUMNS FROM ".DB_DATABASE.".".$tableName;
		
		$resultC=mysql_query($qryC);
		if($resultC) {
			$IDCol;
			$IDflag=False;
			while ( $col = mysql_fetch_array($resultC) ) {
				if($IDflag==False){ 
					$IDCol=$col['Field']; 
					$IDflag=True; 
					echo("<tr><td>".$row[$IDCol]."</td>");
					}
				else{
					/*if($_SESSION['SESS_ACCESS']=="Admin"&&($col['Field']!="Event_ID"&&$_SESSION['SESS_ACCESS']=="Admin")){
						$table=$table."<td class='edit' id='".$tableName."-".$col['Field']."-".$row[$IDCol]."-".$IDCol."'>".$row[$col['Field']]."</td>";
						$lastID=$row[$IDCol];
					}
					else{
						$table=$table."<td id='".$tableName."-".$col['Field']."-".$row[$IDCol]."-".$IDCol."'>".$row[$col['Field']]."</td>";
						$lastID=$row[$IDCol];
					}*/
					/*echo("<td class='edit' id='".$tableName."-".$col['Field']."-".$row[$IDCol]."-".$IDCol."'>".$row[$col['Field']]."</td>");
					$lastID=$row[$IDCol];
				}
			}
			echo("<td><a id='inline' href='#InfoPanel_".$lastID."' ><button>More Info</button></a></td></tr>");
			$ids=$lastID."-".$ids;
		}
		else{
			die(mysql_error());
		}
		
	}*/
