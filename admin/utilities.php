<?PHP
require_once('auth.php');
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


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--suppress CheckValidXmlInScriptTagBody -->
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

    <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/resources/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" href="/resources/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
    <script type="text/javascript" src="js/jquery.jeditable.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/resources/DataTables-1.9.4/media/js/jquery.dataTables.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/center.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
    <link rel="stylesheet" href="/resources/DataTables-1.9.4/media/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="css/utilitiesStyle.css" />


</head>
<body>


<?
if(!isset($_POST['Table_Select'])){
    echo("<h1>Table Utility</h1>");
}
else{
    echo("<h1>".$tableName."</h1><div id='page_loader' ><img id='load' src='images/ajax-loader.gif' /></div>");
}
?>


<?

echo("<br/>
	<div style='float:right'><table><tr>
	<td style='padding-right:15px;'><a href='/admin/utilities.php'>Home</a></td>
	<td style='padding-right:15px;'><a href='/admin/logout.php'>Logout</a></td>
	<td style='padding-right:15px;'><a href='/admin/my_account.php'>Account Info</a></td>
	<td style='padding-right:15px;'><a href='/Library.jpg' target='_blank'>View LDS of Database</a></td>
	</tr></table>
	</div>

	<form action='' method='post'><select name='Table_Select'>");
if(!isset($_POST['Table_Select'])){
    echo("<option disabled='disabled' selected='selected'>Please select table</option>");
}
if($_SESSION['SESS_ACCESS']=="Admin"||!isset($_SESSION['SESS_ACCESS'])){
    $qryC="SHOW TABLES FROM ".DB_DATABASE."";
}
else if($_SESSION['SESS_ACCESS']=="User"){
    $qryC="SHOW TABLES FROM ".DB_DATABASE." where tables_in_".DB_DATABASE."='Session' OR tables_in_".DB_DATABASE."='Person'
	OR tables_in_".DB_DATABASE."='Institution' OR tables_in_".DB_DATABASE."='Session_Style';";
}else{
    $qryC="SHOW TABLES FROM ".DB_DATABASE."";
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
<a id='inlineADD' href='#form' ><button>Click to add a new row</button></a>
<a href='javascript:void(0)' id='delete'><button>Delete selected row</button></a>
");
}
if(isset($_POST['Submit'])&&$_POST['Submit']=='Submit'){

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
    if(!$result){
        die("Query failed-".$qry.var_dump($_POST));
    }

    if($_POST['Table_Select']=='members'&&isset($_POST['email']))
    {
        include("ajaxProcessing/newMemberEmail.php");
    }
}

if(isset($_POST['Table_Select'])&&($_POST['Table_Select']!="Session")&&($_POST['Table_Select']!="Person")){


    $qry="SELECT * FROM ".DB_DATABASE.".".$tableName;

    $result=mysql_query($qry);


    $colCount=0;
    //Check whether the query was successful or not
    if($result) {
        $colList="";
        $qryC="SHOW COLUMNS FROM ".DB_DATABASE.".".$tableName;
        echo("<table id='main' class='Display'><thead>");
        $resultC=mysql_query($qryC);
        if($result) {
            while ( $col = mysql_fetch_array($resultC) ) {
                $colCount=$colCount+1;
                echo("<th>".preg_replace('/_/',' ',$col['Field'])."</th>");
                $colList=$colList."'".$col['Field']."',";
            }
            echo("</thead> <tbody>");
            $colList=substr($colList, 0, -1);
        }
        $lastID=-1;
        while ( $row = mysql_fetch_array($result) ) {
            $qryC="SHOW COLUMNS FROM ".DB_DATABASE.".".$tableName;

            $resultC=mysql_query($qryC);
            if($result) {
                $IDCol="";
                $IDflag=False;
                while ( $col = mysql_fetch_array($resultC) ) {
                    if($IDflag==False){
                        $IDCol=$col['Field'];
                        $IDflag=True;
                        echo("<tr><td>".$row[$IDCol]."</td>");
                    }
                    else{
                        echo("<td class='edit' id='".$tableName."-".$col['Field']."-".$row[$IDCol]."-".$IDCol."'>".$row[$col['Field']]."</td>");
                        $lastID=$row[$IDCol];
                    }
                }
                echo("</tr>");
            }

        }
        echo("</tbody></table>");
        $qryC="SHOW COLUMNS FROM ".DB_DATABASE.".".$tableName;
        $resultC=mysql_query($qryC);
        if($result) {
            $IDflag=False;
            echo("<div style='display:none'>
						<div id='form'>
						<form name='inlineAdd' action='' method='post'> <input type='hidden' value='".$tableName."' name='Table_Select' />
						<table>");
            while ( $col = mysql_fetch_array($resultC) ) {
                if(!$IDflag){
                    if($tableName=='Session_Style'
                        ||$tableName=='Target_Audience'
                        ||$tableName=='Attendance_Type'
                        ||$tableName=='Session_Tags'){
                        echo("<tr><td>".$col['Field']."</td>
							<td><input type='text' name='".$col['Field']."' /></td></tr>");
                    }
                    else{
                        echo("<input type='hidden' name='".$col['Field']."' value='DEFAULT'  />");
                    }
                    $IDflag=True;
                }
                else{
                    echo("<tr><td>".$col['Field']."</td>
						<td><input type='text' name='".$col['Field']."' /></td></tr>");
                }

            }
        }
        echo("<tr><td><button type='button' name='Submit' value='Submit'>Submit</button></td></tr></table></form></div></div>");
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

if(isset($_POST['Table_Select'])){
?>
<div id="resultBox"><h3></h3></div>
<script type="text/javascript">
$(document).ready( function () {

    $("th").text().replace(/_/g, " ");

    $(".trigger").on('click',function(){
        $(".panel").toggle();
    });
    var mainTable = $('#main');
    var oTable = mainTable.dataTable( {
        "bProcessing": true,
        "bServerSide": true,
        "sDom": '<"H"lrpif>t<"F"lpif>',
        "sAjaxSource": "ajaxProcessing/server_side_processing.php",
        "fnServerParams": function ( aoData ) {
            aoData.push( { "name":"tableName", "value":"<? echo($tableName); ?>" } );
            aoData.push( { "name":"idCol", "value":"<? echo($IDCol); ?>" } );
            aoData.push( { "name":"columns", "value":JSON.stringify([<? echo($colList); ?>]) } );
        },
        "fnDrawCallback": function( oSettings ) {
            //var response = $.parseJSON(oSettings.jqXHR.responseText);
            $('td').addClass('edit');
            mainTable.find('tr td:first-child').removeClass('edit');
            <?
                if($tableName=="Person"||$tableName=="Session"){
                    echo("mainTable.find('tr td:last-child').removeClass('edit');");
                }
            ?>
            $("div#page_loader").hide();
            /* Apply the jEditable handlers to the table */
            oTable.$('.edit').editable( 'ajaxProcessing/edit_in_place_server.php', {
                "submitdata": function ( value ) {
                    return {
                        "tableName": "<? echo($tableName); ?>",
                        "rowID":$(this).parent().children(":nth-child(1)").text(),
                        "rowIDCol":mainTable.find("thead tr th:nth-child(1)").text().replace(/ /g,"_"),
                        "val": value,
                        "column": mainTable.find("thead tr th:nth-child("+(oTable.fnGetPosition( this )[2]+1)+")").text().replace(/ /g,"_")
                    };
                },
                "height": "14px",
                "width": "100%",
                'onblur' : 'submit'
            } );


            $('a.info').on("click", function (e) {
                //currentIndex uses in person and session functions
                //noinspection JSUnusedLocalSymbols
                var currentIndex = $(this).attr('id');
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: this.href,
                    data: {
                        "id":$(this).attr('id'),
                        "tableName":'<? echo($tableName);?>'
                    },
                    success: function (data) {
                        $.fancybox(data, {
                            // fancybox API options
                            fitToView: false,
                            width: 905,
                            height: 505,
                            autoSize: false,
                            hideOnContentClick: false,
                            onClose: function () {
                                parent.location.reload(true);
                            },
                            openEffect: 'none',
                            closeEffect: 'none'
                        }); // fancybox
                        <?PHP
                        if(isset($_POST['Table_Select']) && $_POST['Table_Select']=="Session"){
                            include("js/sessionFunctions.js");
                        }
                        else if(isset($_POST['Table_Select']) && $_POST['Table_Select']=="Person"){
                            include("js/personFunctions.js");
                        }
                        ?>
                    } // success
                }); // ajax
            }); // on
        }
    });


    $("a#inlineADD").fancybox({
        'hideOnContentClick': false,
        onClosed:function(){
            oTable.fnClearTable();
            oTable.fnDraw();
        }
    });
    $("#form").find("button[name=Submit]").on("click", function(e){
        e.preventDefault();
        var values = {};
        $.each($("form[name=inlineAdd]").serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });
        console.log(values);
        $.ajax({
            type: "POST",
            url: 'ajaxProcessing/mainUtilityInsert.php',
            data:values,
            success: function(data){
                var resultBox = $("#resultBox");
                resultBox.find("h3").html(data);
                resultBox.center();
                resultBox.fadeIn(1000,function(){
                    resultBox.delay(500).fadeOut(1000);
                });
            }
        });

    });

    mainTable.find("tbody tr").live('click', function() {
        if ( $(this).hasClass('row_selected') ) {
            $(this).removeClass('row_selected');
        }
        else {
            oTable.$('tr.row_selected').removeClass('row_selected');
            $(this).addClass('row_selected');
        }
    });

    /* Add a click handler for the delete row */
    $('#delete').on('click', function() {
        var anSelected = fnGetSelected( oTable );
        if ( anSelected.length !== 0 ) {
            $.post('ajaxProcessing/edit_in_place_server.php',<?
				if($tableName=='Session_Target'){
  				    echo("{
  				            data: anSelected[0].cells[0].textContent,
  				            table: '".$tableName."',
  				            IDCol: 'Session_ID',
  				            IDCol2: 'Audience',
				            id2: anSelected[0].cells[1].textContent
				          }");
				}elseif($tableName=='Session_Tags'){
  				    echo("{
  				            data: anSelected[0].cells[0].textContent,
  				            table: '".$tableName."',
  				            IDCol: 'Session_ID',
  				            IDCol2: 'Tag',
				            id2: anSelected[0].cells[1].textContent
				          }");
				}
				else{
					echo("{
					        data: anSelected[0].cells[0].textContent,
					        table: '".$tableName."',
					        IDCol: '".$IDCol."'
					      }");
				}
				 ?>

            );

            oTable.fnDeleteRow( anSelected[0] );
        }
    } );

    /* Init the table */
    oTable = mainTable.dataTable( );

} );

function fnClickAddRow() {
    $('#main').dataTable().fnAddData( [
        <?PHP
		echo($lastID+1);
		$qryC="SHOW COLUMNS FROM ".$tableName;
			$resultC=mysql_query($qryC);
			if($resultC) {
				$rr=mysql_num_fields($resultC);
				for($i=0;$i<=$rr;$i++){
			        echo(",'Click to edit'");
		        }
			}
		?>
    ] );
}
/* Get the rows which are currently selected */
function fnGetSelected( oTableLocal )
{
    return oTableLocal.$('tr.row_selected');
}


</script>
<? } ?>

</body>
</html>