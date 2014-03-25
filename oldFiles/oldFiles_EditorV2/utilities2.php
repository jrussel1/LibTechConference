<?PHP
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
	
	
	if(isset($_POST['Table_Select'])){
		$tableName=$_POST['Table_Select'];
	} 
	

	?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
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
  <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>

<script type="text/javascript" src="/libtechconf/resources/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" href="/libtechconf/resources/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript" src="jquery.jeditable.js"></script>

<script type="text/javascript" charset="utf-8" src="/libtechconf/resources/DataTables-1.9.4/media/js/jquery.dataTables.min.js"></script>
  <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
 <link rel="stylesheet" href="/libtechconf/resources/DataTables-1.9.4/media/css/jquery.dataTables.css" />
<style type="text/css" title="currentStyle">
    body {
	font: 11px Verdana, Arial, Helvetica, sans-serif;
	color: #666666;
	margin: 0px;
	padding: 20px 10px 0px;
}
.textfield {
	font-size: 11px;
	color: #333333;
	background: #F7F7F7;
	border: 1px solid #CCCCCC;
	padding-left: 1px;
}
h1 {
	color: #F58409;
	margin: 0px 0px 5px;
	padding: 0px 0px 3px;
	font: bold 22px Verdana, Arial, Helvetica, sans-serif;
	border-bottom: 1px dashed #E6E8ED;
}
h2 {
	color: #0979D4;
	margin: 0px 0px 5px;
	padding: 0px 0px 3px;
	font: bold 15px Verdana, Arial, Helvetica, sans-serif;
}
a {
	color: #2D3954;
	font-size: 11px;
}
a:hover {
	color: #99CC00;
}
.err {
	color: #FF9900;
}
th {
	font-weight: bold;
	text-align: left;
}

.gray{background-color:#EEE; padding:2px;margin:1px;}
.wrap{padding:2px;margin:1px;}
.header{ vertical-align:bottom; padding-right:1em; }
.checkbox{text-align:right; padding-right:1em; }
	.row_selected td {
	background-color: #FE9C93 !important;
	}
	div#page_loader {
  position: fixed;
  top: 0;
  bottom: 0%;
  left: 0;
  right: 0%;
  width:100%;
  height:100%;
  background-color: white;
  z-index: 1;
  display:block;
}
#load{
top:45%;
left:40%;
position:fixed;	
}
</style>

</head>
<body>


<? echo("Post:::::<br/>");echo(var_dump($_POST));
echo("<br/>Session:::::<br/>");echo(var_dump($_SESSION));
echo("<br/>Query:::::<br/>");echo("SHOW TABLES FROM ".DB_DATABASE." where tables_in_".DB_DATABASE."='Session' OR tables_in_".DB_DATABASE."='Person'
	OR tables_in_".DB_DATABASE."='Institution' OR tables_in_".DB_DATABASE."='Session_Style';");
	if(!isset($_POST['Table_Select'])){
		echo("<h1>Table Utility</h1>");
	} 
	else{
		echo("<h1>".$tableName."</h1><div id='page_loader' ><img id='load' src='ajax-loader.gif' /></div>");
	}
?>


<?

echo("<table><tr><td><a href='/libtechconf/admin/utilities.php'>Home</a></td><td>");
echo("<a href='/libtechconf/admin/logout.php'>Logout</a></td></tr></table>
<div style='float:right'><a href='/libtechconf/Library.jpg' target='_blank'>View LDS of Database</a></div>");

echo("<form action='' method='post'><select name='Table_Select'>");
if(!isset($_POST['Table_Select'])){
	echo("<option disabled='disabled' selected='selected'>Please select table</option>");
}
if($_SESSION['SESS_ACCESS']=="Admin"||!isset($_SESSION['SESS_ACCESS'])){
$qryC="SHOW TABLES FROM ".DB_DATABASE."";
}
else if($_SESSION['SESS_ACCESS']=="User"){
	$qryC="SHOW TABLES FROM ".DB_DATABASE." where tables_in_".DB_DATABASE."='Session' OR tables_in_".DB_DATABASE."='Person'
	OR tables_in_".DB_DATABASE."='Institution' OR tables_in_".DB_DATABASE."='Session_Style';";
}
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
echo("<p>Use this to view and edit tables.</p><br/><br/><h2>".$tableName."</h2>
<a id='inline' href='#form' ><button>Click to add a new row</button></a>
<a href='javascript:void(0)' id='delete'><button>Delete selected row</button></a>
");
}
	if($_POST['Submit']=='Submit'){		
		
		$qry="INSERT INTO `".DB_DATABASE."`.`".$tableName."` (";
		$qryC="SHOW COLUMNS FROM ".DB_DATABASE.".".$tableName;
			$resultC=mysql_query($qryC);
			if($resultC) {

				while ( $col = mysql_fetch_array($resultC) ) {
					$qry=$qry."`".$col['Field']."`,";
				}
				$qry=rtrim($qry, ",");
			}
		
		$qry=$qry.")VALUES(";
		$qryC="SHOW COLUMNS FROM ".DB_DATABASE.".".$tableName;
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
		die("Query failed-".$qry.var_dump($_POST));
	}
	
	}

	if(isset($_POST['Table_Select'])&&($_POST['Table_Select']!="Session")&&($_POST['Table_Select']!="Person")){
			
	
	$qry="SELECT * FROM ".DB_DATABASE.".".$tableName;

	$result=mysql_query($qry);
	
	
	$colCount=0;
	//Check whether the query was successful or not
	if($result) {
		$qryC="SHOW COLUMNS FROM ".DB_DATABASE.".".$tableName;
		$top="<table id='main' class='Display'><thead>";
		$resultC=mysql_query($qryC);
		if($result) {
			
			while ( $col = mysql_fetch_array($resultC) ) {	$colCount=$colCount+1;
				$top=$top."<th>".preg_replace('/_/',' ',$col['Field'])."</th>";
				}
			$top=$top."</thead> <tbody>";
			echo($top);
		}
		$lastID;
		while ( $row = mysql_fetch_array($result) ) {
			$qryC="SHOW COLUMNS FROM ".DB_DATABASE.".".$tableName;
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
			
			$qryC="SHOW COLUMNS FROM ".DB_DATABASE.".".$tableName;
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
								if($tableName=='Session_Style'||$tableName=='Target_Audience'||$tableName=='Attendance_Type'){
									echo("<tr><td>".$col['Field']."</td>
									<td><input type='text' name='".$col['Field']."' /></td></tr>");
								}
								else{
									echo("<tr><td>".$col['Field']."</td>
									<td><input type='text' name='".$col['Field']."' value='".($lastID+1)."' disabled='disabled' />
									<input type='hidden' name='".$col['Field']."' value='".($lastID+1)."'  /></td></tr>");
								}
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
	else if(isset($_POST['Table_Select'])&&($_POST['Table_Select']=="Session")){
			
	
	include("sessions.php");
	
	
	}
	if(isset($_POST['Table_Select'])&&($_POST['Table_Select']=="Person")){
			
	
	include("persons.php");
	
	
	}
	
	


?>
</body>
</html>
<?
	if(isset($_POST['Table_Select'])){
?>
<script>
$(document).ready( function () {
	
	$("th").text().replace(/_/g, " ");
	
	$(".trigger").click(function(){
        $(".panel").toggle();
    });
	//$("div#page_loader").show();
	var oTable = $('#main').dataTable( {
    "fnDrawCallback": function( oSettings ) {
      $("div#page_loader").hide();
    }
  } );
     <?			
	 if(isset($_POST['Table_Select'])&&($_POST['Table_Select']=="Session")){	
		 include("session_func.php");		//Session functions 
	 }
	 if(isset($_POST['Table_Select'])&&($_POST['Table_Select']=="Person")){
		 include("person_func.php");		//Person functions 
		
	 }
	 
    ?>
	/* Apply the jEditable handlers to the table */
    oTable.$('.edit').editable( 'edit_in_place_server.php', {
		"submitdata": function ( value, settings ) {
            return {
                "id": $(this).attr('id'),
				"val": value,
                "column": oTable.fnGetPosition( this )[2]
            };
        },
        "height": "14px",
        "width": "100%",
		'onblur' : 'submit'
    } );
	
	$("a#inline").fancybox({
		'hideOnContentClick': false,
			'onClose': function () { 
                parent.location.reload(true);
            }
	});
	
	 $("#main tbody tr").live('click', function( e ) {
        if ( $(this).hasClass('row_selected') ) {
            $(this).removeClass('row_selected');
        }
        else {
            oTable.$('tr.row_selected').removeClass('row_selected');
            $(this).addClass('row_selected');
        }
    });
     
    /* Add a click handler for the delete row */
    $('#delete').click( function( e ) {
        var anSelected = fnGetSelected( oTable );
        if ( anSelected.length !== 0 ) {
			$.post('edit_in_place_server.php',<?
				if($tableName=='Session_Target'){
  				echo("{data: anSelected[0].cells[0].textContent, table: '".$tableName."', IDCol: 'Session_ID', IDCol2: 'Audience',
				 id2: anSelected[0].cells[1].textContent} ");
				 $sql = "Delete from Session_Target where Session_ID = 11 and Audience = Academic;";
				}
				else{
					echo("{data: anSelected[0].cells[0].textContent, table: '".$tableName."', IDCol: '".$IDCol."'} ");
				}
				 ?>
  				
			);
			
            oTable.fnDeleteRow( anSelected[0] ); 
        }
    } );
     
    /* Init the table */
    oTable = $('#main').dataTable( );

 
 

} );

function fnClickAddRow() {
    $('#main').dataTable().fnAddData( [
        <? 
		echo($lastID+1);
		$qryC="SHOW COLUMNS FROM ".DB_DATABASE.".".$tableName;
			$resultC=mysql_query($qryC);
			if($resultC) {
				$rr=mysql_num_fields($resultC);
			}
		for($i=0;$i<=$rr;$i++){
			echo(",'Click to edit'");
		}
		?> ] );
	}
	/* Get the rows which are currently selected */
function fnGetSelected( oTableLocal )
{
    return oTableLocal.$('tr.row_selected');
}


</script>
<? } ?>