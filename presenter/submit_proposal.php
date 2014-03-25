<?
    require_once('../resources/config.php');
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	include('login_panel/login_ex.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Presenter Portal</title>
    <link rel="stylesheet" href="css/portal.css" type="text/css" media="screen" />
    <style>
    .center{
        text-align:center;
        }
    </style>
    <? include('login_panel/header_incl.php'); ?>
</head>

<body>
	<? include('login_panel/panel.php'); ?>
    <br /><br />
    <div id="wrapper">
    <img src="images/banner.png" />
    <div id="nav"><? if($_SESSION['id']){ include "navbar1.html"; }else{ include "navbar2.html";}// include the navbar based on whether the user is logged in or not ---- navbar1 if in, navbar2 if not ?> </div>
    <div id="container" class="rounded-corners">
        <div id="sidebar" class="rounded-corners" style="height:450px;" ><h3>INFORMATION NEEDED TO SUBMIT A SESSION PROPOSAL:</h3>
            <p><strong>Each session submission must include the following:</strong></p>
            <ul>
                <li>Session title;</li>
                <li>Presenter information including the full name, institution, and email address for each presenter;</li>
                <li>Identification of lead presenter- the presenter which should be primary contact for session submission and who should receive the registration discount;</li>
                <li>Full session proposal which gives complete session description (up to 300 words) that will be used to evaluate submission;</li>
				<li>Limit 150 word session abstract that can be published on the conference web site and in the conference program.</li>
            </ul>
        </div>
        <h1>Submit a Proposal</h1>
        <?
            //Check if a user is signed in
            if (isset($_SESSION['email'])) {
                $qry=" Select * FROM `".DB_DATABASE."`.`Person` JOIN `".DB_DATABASE."`.`Presenter_Of_Session` ON Person.Person_ID=Presenter_Of_Session.Presenter_ID JOIN Session ON Presenter_Of_Session.Session_ID=Session.Session_ID WHERE Person.Person_Email='".$_SESSION['email']."';";
                $result = mysql_query($qry);
                //Check for result query
                if($result) {
                    //Check if user has submission
                    if (mysql_num_rows($result) > 0) {
						echo("<h3> CURRENT SUBMISSIONS:</h3><ul>");
                        while($row=mysql_fetch_array($result)) {  
                                //Print each individual submission with an edit button
                                echo ("<form action='edit_proposal.php' method='post'><strong><input type='hidden' name = 'submissiontitle' value ='".$row["Submission_Title"]."'>".$row["Submission_Title"]."</strong><br />".$row["Submission_Abstract"]."<br /><input type='submit' value='Edit' style='float: right;'></form><br><br>");
						}
								echo ("<div class='center'><hr width='45%'> Click <a href='edit_proposal.php'>here</a> to create a new proposal</div>");
                    //If user has no submission, prompt them for one
                    } else {
                    	echo("<div class='center'>You have not yet submitted any proposals. Click <a href='edit_proposal.php'>here</a> to create one.</div>");  
                    }
                //If no result, print error message
                } else {
                    die(mysql_error());}
			//Prompt for Login
            } else {
                echo ("<div class='center'>You must be <a class='signup' href='#'>logged in</a> before creating a proposal</div>");
            }
        ?>
        </div>
    </div>
</body>

</html>