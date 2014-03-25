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




//Change password query
if(isset($_POST['pass'])){
    $qry="SELECT * FROM `".DB_DATABASE."`.`members` WHERE member_id='".$_SESSION['SESS_MEMBER_ID']."';";
    $result=mysql_query($qry);
    if($result) {
        while ( $row = mysql_fetch_array($result) ) {
            if( md5($_POST['old_pass'])==$row['passwd'] && $_POST['new_pass']==$_POST['confirm_pass']){
                $qry2="UPDATE `".DB_DATABASE."`.`members` SET `passwd` = '".md5($_POST['new_pass'])."' WHERE member_id='".$_SESSION['SESS_MEMBER_ID']."';";
                $result2=mysql_query($qry2);
                if($result2) {
                    echo("<script>alert('Password change successful!');</script>");
                }else{die('Invalid query: ' . mysql_error() . "with query".$qry2);}
            }
        }
    } else {
        die('Invalid query: ' . mysql_error() . "with query".$qry);
    }
}

//Edit User Profiles
if(isset($_POST['Submit'])){
    //Edit a user profile
    if(isset($_POST['action'])&&$_POST['action']=="Update"){
        $qry="UPDATE `".DB_DATABASE."`.`members` SET
			`firstname` = '".$_POST[$_POST['member_id'].'_First_Name']."',
			`lastname` = '".$_POST[$_POST['member_id'].'_Last_Name']."',
			`login` = '".$_POST[$_POST['member_id'].'_Login']."' 
			WHERE member_id='".$_POST['member_id']."';";
        $result=mysql_query($qry);
        if(!$result) {
            die('Invalid query: ' . mysql_error() . "with query".$qry);
        }
        //New user profile
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>My Account</title>

    <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/resources/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" href="/resources/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
    <script type="text/javascript" src="../oldFiles/oldFiles_EditorV2/jquery.jeditable.js"></script>
    <script type="text/javascript" charset="utf-8" src="/resources/DataTables-1.9.4/media/js/jquery.dataTables.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
    <link rel="stylesheet" href="/resources/DataTables-1.9.4/media/css/jquery.dataTables.css" />
    <style type="text/css" title="currentStyle">
        body {
            font: 11px Verdana, Arial, Helvetica, sans-serif;
            color: #666666;
            margin: 0;
            padding: 20px 10px 0;
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
            margin: 0 0 5px;
            padding: 0 0 3px;
            font: bold 22px Verdana, Arial, Helvetica, sans-serif;
            border-bottom: 1px dashed #E6E8ED;
        }
        h2 {
            color: #0979D4;
            margin: 0 0 5px;
            padding: 0 0 3px;
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
            bottom: 0;
            left: 0;
            right: 0;
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


<?
echo("<h1>My Account</h1>");


echo("<br/>
	<div style='float:right'>
	    <table>
	        <tr>");
if(isset($_SESSION['SESS_ACCESS'])&&$_SESSION['SESS_ACCESS']!="Reviewer"){
    echo("
	            <td style='padding-right:15px;'><a href='/admin/utilities.php'>Home</a></td>
	            <td style='padding-right:15px;'><a href='/admin/logout.php'>Logout</a></td>
	            <td style='padding-right:15px;'><a href='/admin/my_account.php'>Account Info</a></td>
	            <td style='padding-right:15px;'><a href='/Library.jpg' target='_blank'>View LDS of Database</a></td>
	        </tr>
	    </table>
	</div>
	<form action='utilities.php' method='post'><select name='Table_Select'>");
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
}else{
    echo("
	<td style='padding-right:15px;'><a href='/admin/review.php'>Review Proposals</a></td>
	<td style='padding-right:15px;'><a href='/admin/my_account.php'>Account Info</a></td>
	<td style='padding-right:15px;'><a href='/admin/logout.php'>Logout</a></td>
	</tr></table>
	</div>");
}
echo("<p>Use this to view and edit your account information.</p>
      <br/><br/>
	  <h2>Your Account</h2>
	  <div id='content' style='margin-left:2%;'>");

$qry="SELECT * FROM members WHERE member_id = '".$_SESSION['SESS_MEMBER_ID']."';";
$result=mysql_query($qry);
if($result) {
    //Check if the person existed in the database before
    if (mysql_num_rows($result) > 0) {
        //If the person existed
        while($row = mysql_fetch_array($result)) {
            $Pid=$row["member_id"];
            echo("<form action='' method='post' name='Update_Person'>
				<input type='hidden' value='Update' name='action' />
				<input type='hidden' value='".$row["member_id"]."' name='member_id' />
				<table style='margin-left:30px;'>
				<tr>
					<td colspan='2'><h3>Personal Info</h3></td><td colspan='2' style='padding-left: 30px;'><h3>Change Password</h3></td>
				</tr>
				<tr>
					<td><label id='l".$row["member_id"]."_First_Name' for='".$row["member_id"]."_First_Name'>First Name:</label></td>
					<td><input type='text' name='".$row["member_id"]."_First_Name' id='".$row["member_id"]."_First_Name' value='".$row['firstname']."'/></td>
					<td colspan='2' style='padding-left: 30px;'><a id='inline' href='#pass' ><button>Change Password</button></a></td>
				</tr>
				<tr>
					<td><label id='l".$row["member_id"]."_Last_Name' for='".$row["member_id"]."_Last_Name'>Last Name:</label></td><td>
					<input type='text' name='".$row["member_id"]."_Last_Name' id='".$row["member_id"]."_Last_Name'  value='".$row['lastname']."'/></td>
					<td colspan='2'></td>
				</tr>
				<tr>
					<td><label id='l".$row["member_id"]."_Login' for='".$row["member_id"]."_Login'>Login:</label></td><td>
					<input type='text' name='".$row["member_id"]."_Login' id='".$row["member_id"]."_Login' value='".$row['login']."'/></td>
					<td colspan='2'></td>
				</tr>
				<tr>
					<td colspan='2' style='text-align:right;'><input type='submit' name='Submit' /></td><td colspan='2'></td>
				</tr>
				
				</table></form>");
        }
    }
}
?>

</div>



<div style="display:none;">
    <div id="pass">
        <h4>Change Password</h4>
        <form action="" method="post">
        <table>
                <tr>
                    <td><label for="old_pass">Current Password:</label>
                    </td>
                    <td>
                            <input id="old_pass" type="password" name="old_pass"/>

                    </td>
                </tr>
                <tr>
                    <td><label for="new_pass">New Password:</label>
                    </td>
                    <td><input type="password" name="new_pass" id="new_pass" />
                    </td>
                </tr>
                <tr>
                    <td><label for="confirm_pass">Confirm New Password:</label>
                    </td>
                    <td><input type="password" name="confirm_pass" id="confirm_pass" />
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td><input type="submit" name="pass" value="Change Password" />
                    </td>
                </tr>
            </form>
        </table>

    </div>
</div>
</body>
</html>
<script>
    $(document).ready(function() {
        $("a#inline").fancybox({
            'hideOnContentClick': false,
            'onClose': function () {
                parent.location.reload(true);
            }
        });



    });
</script>