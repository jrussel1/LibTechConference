<?

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


$tableName="Session";

//echo(var_dump($_SESSION));


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script type="text/javascript" src="/libtechconf/resources/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <script type="text/javascript" src="js/center.js"></script>
    <link rel="stylesheet" href="/libtechconf/resources/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
    <script type="text/javascript" src="../oldFiles/oldFiles_EditorV2/jquery.jeditable.js"></script>
    <script type="text/javascript" charset="utf-8" src="/libtechconf/resources/DataTables-1.9.4/media/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="/libtechconf/resources/DataTables-1.9.4/media/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="css/jquery-ui-1.10.3.custom.min.css">
    <link rel="stylesheet" href="css/reviewStyle.css">

    <script>
        $(function() {
            $( "#tabs" ).tabs();
        });
    </script>

</head>
<body>
<!--<div id='page_loader' ><img id='load' src='images/ajax-loader.gif' /></div>-->
<h1>Review Session Proposals</h1>
<div style='float:right'>
    <table><tr>
            <td style='padding-right:15px;'><a href='/libtechconf/admin/review.php'>Review Proposals</a></td>
            <td style='padding-right:15px;'><a href='/libtechconf/admin/my_account.php'>Account Info</a></td>
            <td style='padding-right:15px;'><a href='/libtechconf/admin/logout.php'>Logout</a></td>
        </tr></table>
</div>
<p>Use this interfaces to review and rate session proposals.</p><br/><br/>

<div id="tabs">
    <ul>
        <li><a href="#tabs-1"><h2>Need Review</h2></a></li>
        <li><a href="#tabs-2"><h2>Reviewed</h2></a></li>
    </ul>
    <div id="tabs-1">
        <?
        ///////// Start of main page viewing
        $qry_selectAllFromSession="SELECT * FROM `".DB_DATABASE."`.`Session` t1 WHERE NOT EXISTS
		(SELECT * FROM `".DB_DATABASE."`.`Review_Proposals` t2 WHERE t1.Session_ID = t2.Proposal_ID AND t2.Member_ID = '".$_SESSION['SESS_MEMBER_ID']."');";
        //$whereFilter="WHERE NOT EXISTS (SELECT * FROM ".DB_DATABASE.".Review_Proposals t2 WHERE t1.Session_ID = t2.Proposal_ID AND t2.Member_ID = '".$_SESSION['SESS_MEMBER_ID']."');";
        $result_ShowTable=mysql_query($qry_selectAllFromSession);
        $colCount=0;
        //Check whether the query was successful or not
        if($result_ShowTable) {

            $colList="";
            $IDCol="";
            $IDflag=False;
            $qryC="SHOW COLUMNS FROM ".DB_DATABASE.".".$tableName;
            echo("<table id='need' class='Display'><thead>");
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



            ///////
            echo("</tbody></table>");
        }
        ?>
    </div>
    <div id="tabs-2">
        <?
        ///////// Start of main page viewing
        $qry_selectAllFromSession="SELECT * FROM `".DB_DATABASE."`.`Session` t1 WHERE EXISTS
		(SELECT * FROM `".DB_DATABASE."`.`Review_Proposals` t2 WHERE t1.Session_ID = t2.Proposal_ID AND t2.Member_ID = '".$_SESSION['SESS_MEMBER_ID']."');";
        //$whereFilter="WHERE EXISTS (SELECT * FROM ".DB_DATABASE.".Review_Proposals t2 WHERE t1.Session_ID = t2.Proposal_ID AND t2.Member_ID = '".$_SESSION['SESS_MEMBER_ID']."');";
        $result_ShowTable=mysql_query($qry_selectAllFromSession);
        $colCount=0;
        //Check whether the query was successful or not
        if($result_ShowTable) {

            $colList="";
            $IDCol="";
            $IDflag=False;
            $qryC="SHOW COLUMNS FROM ".DB_DATABASE.".".$tableName;
            echo("<table id='done' class='Display'><thead>");
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



            ///////
            echo("</tbody></table>");
        }
        ?>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    $(document).ready( function () {

        $("th").text().replace(/_/g, " ");

        var needTable = $('#need');
        var oTable = needTable.dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "sDom": '<"H"lrpif>t<"F"lpif>',
            "sAjaxSource": "ajaxProcessing/server_side_processing.php",
            "fnServerParams": function ( aoData ) {
                aoData.push( { "name":"tableName", "value":"<? echo($tableName); ?>" } );
                aoData.push( { "name":"member_id", "value":"<? echo($_SESSION['SESS_MEMBER_ID']); ?>" } );
                aoData.push( { "name":"needReview", "value":"true" } );
                aoData.push( { "name":"idCol", "value":"<? echo($IDCol); ?>" } );
                aoData.push( { "name":"columns", "value":JSON.stringify([<? echo($colList); ?>]) } );
            },
            "fnDrawCallback": function( ) {
                //var response = $.parseJSON(oSettings.jqXHR.responseText);
                $('td').addClass('edit');
                needTable.find('tr td:first-child').removeClass('edit');
                needTable.find('tr td:last-child').removeClass('edit');
                $("div#page_loader").hide();
                /* Apply the jEditable handlers to the table */
                oTable.$('.edit').editable( 'ajaxProcessing/edit_in_place_server.php', {
                    "submitdata": function ( value ) {
                        return {
                            "tableName": "<? echo($tableName); ?>",
                            "rowID":$(this).parent().children(":nth-child(1)").text(),
                            "rowIDCol":needTable.find("thead tr th:nth-child(1)").text().replace(/ /g,"_"),
                            "val": value,
                            "column": needTable.find("thead tr th:nth-child("+(oTable.fnGetPosition( this )[2]+1)+")").text().replace(/ /g,"_")
                        };
                    },
                    "height": "14px",
                    "width": "100%",
                    'onblur' : 'submit'
                } );


                $('a.info').on("click", function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        cache: false,
                        url: this.href,
                        data: {
                            "id":$(this).attr('id'),
                            "member_id":"<? echo($_SESSION['SESS_MEMBER_ID']);?>"
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
                                closeEffect: 'none',
                                onClosed:function(){
                                    oTable.fnClearTable();
                                    oTable.fnDraw();
                                    oTable2.fnClearTable();
                                    oTable2.fnDraw();
                                }
                            });
                        } // success
                    }); // ajax
                }); // on

            }
        });
        /* Init the table */
        oTable = needTable.dataTable( );

        var doneTable = $('#done');
        var oTable2 = doneTable.dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "sDom": '<"H"lrpif>t<"F"lpif>',
            "sAjaxSource": "ajaxProcessing/server_side_processing.php",
            "fnServerParams": function ( aoData ) {
                aoData.push( { "name":"tableName", "value":"<? echo($tableName); ?>" } );
                aoData.push( { "name":"member_id", "value":"<? echo($_SESSION['SESS_MEMBER_ID']); ?>" } );
                aoData.push( { "name":"needReview", "value":"false" } );
                aoData.push( { "name":"idCol", "value":"<? echo($IDCol); ?>" } );
                aoData.push( { "name":"columns", "value":JSON.stringify([<? echo($colList); ?>]) } );
            },
            "fnDrawCallback": function( oSettings ) {
                //var response = $.parseJSON(oSettings.jqXHR.responseText);
                $('td').addClass('edit');
                doneTable.find('tr td:first-child').removeClass('edit');
                doneTable.find('tr td:last-child').removeClass('edit');
                $("div#page_loader").hide();
                /* Apply the jEditable handlers to the table */
                oTable2.$('.edit').editable( 'ajaxProcessing/edit_in_place_server.php', {
                    "submitdata": function ( value ) {
                        return {
                            "tableName": "<? echo($tableName); ?>",
                            "rowID":$(this).parent().children(":nth-child(1)").text(),
                            "rowIDCol":doneTable.find("thead tr th:nth-child(1)").text().replace(/ /g,"_"),
                            "val": value,
                            "column": doneTable.find("thead tr th:nth-child("+(oTable2.fnGetPosition( this )[2]+1)+")").text().replace(/ /g,"_")
                        };
                    },
                    "height": "14px",
                    "width": "100%",
                    'onblur' : 'submit'
                } );


                $('a.info').on("click", function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        cache: false,
                        url: this.href,
                        data: {
                            "id":$(this).attr('id'),
                            "member_id":"<? echo($_SESSION['SESS_MEMBER_ID']);?>"
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
                                closeEffect: 'none',
                                onClosed:function(){
                                    oTable.fnClearTable();
                                    oTable.fnDraw();
                                    oTable2.fnClearTable();
                                    oTable2.fnDraw();
                                }
                            });
                        } // success
                    }); // ajax
                }); // on

            }
        });
        /* Init the table */
        oTable2 = doneTable.dataTable( );



    } );
</script>