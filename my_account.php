<? 
require_once('admin/config.php');
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
	//Include login panel
	include('login_panel/login_ex.php');
	
	//Change password query
	if(isset($_POST['pass'])){
		$qry="SELECT * FROM `jrussell_Lib`.`site_registration` WHERE email='".$_SESSION['email']."';";
		$result=mysql_query($qry);
			if($result) {
				while ( $row = mysql_fetch_array($result) ) {
					if( md5($_POST['old_pass'])==$row['pass'] && $_POST['new_pass']==$_POST['confirm_pass']){
						$qry2="UPDATE `jrussell_Lib`.`site_registration` SET `pass` = '".md5($_POST['new_pass'])."' WHERE email='".$_SESSION['email']."';";
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
	if(isset($_POST['Submit'])&&isset($_POST['terms'])&&$_POST['terms']=="Accepted"){
		$qry="UPDATE `jrussell_Lib`.`site_registration` SET `Terms` = 1  WHERE email='".$_SESSION['email']."';";
		$result=mysql_query($qry);
			if($result) {
			}else{die('Invalid query: ' . mysql_error() . "with query".$qry);}
		//Edit a user profile
		if(isset($_POST['action'])&&$_POST['action']=="Update"){
			echo(var_dump($_SESSION));
			$qry="UPDATE `jrussell_Lib`.`Person` SET
			`Person_ID` = '".$_POST['Person_ID']."',
			`Person_First_Name` = '".$_POST[$_POST['Person_ID'].'_First_Name']."',
			`Person_Last_Name` = '".$_POST[$_POST['Person_ID'].'_Last_Name']."',
			`Person_Address` = '".$_POST[$_POST['Person_ID'].'_Street_Address']."',
			`Person_City` = '".$_POST[$_POST['Person_ID'].'_City']."',
			`Person_State` = '".$_POST[$_POST['Person_ID'].'_State']."',
			`Person_Zip` = '".$_POST[$_POST['Person_ID'].'_Zip']."',
			`Person_Title` = '".$_POST[$_POST['Person_ID'].'_Person_Title']."',
			`Person_Phone` = '".$_POST[$_POST['Person_ID'].'_Phone']."' ";
			//Update institution for person
			if(isset($_POST['Institution_Quick_Select'])&&$_POST['Institution_Quick_Select']=="Other"){
					$qry2="INSERT INTO `jrussell_Lib`.`Institution`
							(`Institution_Name`,`Institution_City`,`Institution_State`,`Institution_Address`,`Institution_Zip`)
							VALUES('".$_POST['Institution_Name']."','".$_POST['Institution_City']."','".$_POST['Institution_State']."',
							'".$_POST['Institution_Address']."','".$_POST['Institution_Zip']."',);";
							$result2=mysql_query($qry2);
							if($result2) {
							}else{die('Invalid query: ' . mysql_error() . "with query".$qry2);}
					$qry=$qry.",`Instutition_ID` = '".mysql_insert_id()."' ";
			}else if(isset($_POST['Institution_Quick_Select'])&&$_POST['Institution_Quick_Select']!="Other"){
				$qry=$qry.",`Institution_ID` = '".$_POST['Institution_Quick_Select']."' ";
			}
			$qry=$qry."WHERE Person_ID='".$_POST['Person_ID']."';";
			$result=mysql_query($qry);
			if($result) {
				if(isset($_POST['Institution_Quick_Select'])&&$_POST['Institution_Quick_Select']!="Other"){
					$qry2="UPDATE `jrussell_Lib`.`Institution`
							SET
							`Institution_ID` = '".$_POST['Instutition_ID']."',
							`Institution_Name` = '".$_POST['Institution_Name']."',
							`Institution_City` = '".$_POST['Institution_City']."',
							`Institution_State` = '".$_POST['Institution_State']."',
							`Institution_Address` = '".$_POST['Institution_Address']."',
							`Institution_Zip` = '".$_POST['Institution_Zip']."',
							WHERE Institution_ID = '".$_POST['Instutition_ID']."';";
							$result2=mysql_query($qry2);
							if($result2) {
								$qry3="INSERT IGNORE INTO `jrussell_Lib`.`Institution_Type` (`Institution_ID`,`Institution_Type`) 
								VALUES ('".$_POST['Instutition_ID']."','".$_POST['Instutition_Type']."');";
								$result3=mysql_query($qry3);
								if($result3) {
								
								}else{die('Invalid query: ' . mysql_error() . "with query".$qry3);}
							}else{die('Invalid query: ' . mysql_error() . "with query".$qry2);}
				}
			}else{die('Invalid query: ' . mysql_error() . "with query".$qry);}
		//New user profile	
		}else{
			$qry="INSERT INTO `jrussell_Lib`.`Person`
			(`Person_First_Name`,`Person_Last_Name`,`Person_Email`,`Person_Address`,`Person_City`,`Person_State`,`Person_Title`,`Person_Phone`,`Person_Zip`,`Institution_ID`)
			VALUES('".$_POST['First_Name']."','".$_POST['Last_Name']."','".$_SESSION['email']."','".$_POST['Street_Address']."','".$_POST['City']."','".$_POST['State']."',
			'".$_POST['Person_Title']."','".$_POST['Phone']."','".$_POST['Zip']."',
			 ";
			if(isset($_POST['Institution_Quick_Select'])&&$_POST['Institution_Quick_Select']=="Other"){
					$qry2="INSERT INTO `jrussell_Lib`.`Institution`
							(`Institution_Name`,`Institution_City`,`Institution_State`,`Institution_Address`,`Institution_Zip`)
							VALUES('".$_POST['Institution_Name']."','".$_POST['Institution_City']."','".$_POST['Institution_State']."',
							'".$_POST['Institution_Address']."','".$_POST['Institution_Zip']."',);";
							$result2=mysql_query($qry2);
							if($result2) {
							}else{die('Invalid query: ' . mysql_error() . "with query".$qry2);}
							$last=mysql_insert_id();
							$qry3="INSERT IGNORE INTO `jrussell_Lib`.`Institution_Type` (`Institution_ID`,`Institution_Type`) 
								VALUES ('".$last."','".$_POST['Instutition_Type']."');";
								$result3=mysql_query($qry3);
								if($result3) {
								
								}else{die('Invalid query: ' . mysql_error() . "with query".$qry3);}
					
					$qry=$qry."'".$last."' ";
			}else if(isset($_POST['Institution_Quick_Select'])&&$_POST['Institution_Quick_Select']!="Other"){
				$qry=$qry."'".$_POST['Institution_Quick_Select']."' ";
			}
			$qry=$qry.");";
			$result=mysql_query($qry);
			if($result) {
				$qry3="INSERT INTO `jrussell_Lib`.`Presenter` (`Person_ID`) VALUES ('".mysql_insert_id()."');";
				$result3=mysql_query($qry3);
				if($result3) {
				
				}else{die('Invalid query: ' . mysql_error() . "with query".$qry3);}
			}else{die('Invalid query: ' . mysql_error() . "with query".$qry);}
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Presenter Portal</title>
<link rel="stylesheet" href="portal.css" type="text/css" media="screen" />
<? include('login_panel/header_incl.php'); ?>

<script src="http://code.jquery.com/jquery-1.6.4.js"></script>
<script type="text/javascript" src="/libtechconf/resources/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" href="/libtechconf/resources/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />

</head>

<body>

<? include('login_panel/panel.php'); ?>
<br /><br />
<div id="wrapper">
<img src="images/banner.png" />
<div id="nav"><? if($_SESSION['id']){ include "navbar1.html"; }else{ include "navbar2.html";}// include the navbar based on whether the user is logged in or not ---- navbar1 if in, navbar2 if not ?> </div><div id="container" class="rounded-corners">

<div id="sidebar" class="rounded-corners" style="height:400px; "><h2>Please note:</h2> <p>If you have been in our system before, some data may be prepopulated for you. Please verify any information and fill in missing spaces. The more complete our records, the better we can help you. Information entered here can be reused in your proposal and by your co-presenters adding you to their submission.</p> 
<hr style="width:70%;" /><br/><br/>
<div style="text-align:center;"><a id='inline' href='#pass' ><button>Change Password</button></a></div>

</div>
<div id="content"><h1>Your Account</h1>
<?
	$qry="SELECT * FROM Person p JOIN Institution i ON p.Institution_ID = i.Institution_ID JOIN Institution_Type it ON p.Institution_ID = it.Institution_ID WHERE p.Person_Email = '".$_SESSION['email']."';";
	$result=mysql_query($qry);
	if($result) {
		//Check if the person existed in the database before
		if (mysql_num_rows($result) > 0) {
			//If the person existed
			while($row = mysql_fetch_array($result)) {
				$Pid=$row["Person_ID"];
				$Iid=$row["Institution_ID"];
				echo("<form action='' method='post' name='Update_Person'>
				<input type='hidden' value='Update' name='action' />
				<input type='hidden' value='".$row["Person_ID"]."' name='Person_ID' />
				<table>
				<tr>
					<td colspan='2'><h3>Personal Info</h3></td>
					<td colspan='2'><h3>Institution Info</h3></td>
				</tr>
				<tr>
					<td><label id='l".$row["Person_ID"]."_First_Name' for='".$row["Person_ID"]."_First_Name'>First Name:</label></td>
					<td><input type='text' name='".$row["Person_ID"]."_First_Name' id='".$row["Person_ID"]."_First_Name' value='".$row['Person_First_Name']."'/></td>
					<td><strong>Quick Select:</strong></td><td>
					<select name='Institution_Quick_Select' id='Institution_Quick_Select'>
					<option disabled='disabled'>Please select an institution:</option>
					<option value='Other'>Other</option>");
					$qry2="SELECT * FROM jrussell_Lib.Institution;";
					$result2=mysql_query($qry2);
					if($result2) {
						while ( $row2 = mysql_fetch_array($result2) ) {
							echo("<option value='".$row2['Institution_ID']."' ");
							if($row['Institution_ID']==$row2['Institution_ID']){
								echo("selected='selected'");
							}
							echo(">".$row2['Institution_Name']."</option>");
						}
					}
					echo("</td>
				</tr>
				<tr>
					<td><label id='l".$row["Person_ID"]."_Last_Name' for='".$row["Person_ID"]."_Last_Name'>Last Name:</label></td><td>
					<input type='text' name='".$row["Person_ID"]."_Last_Name' id='".$row["Person_ID"]."_Last_Name'  value='".$row['Person_Last_Name']."'/></td>
					<td colspan='2' style='text-align:center;'>If your institution isn't found in the quick select, <br/>enter information below:</td>
				</tr>
				<tr>
					<td><label id='l".$row["Person_ID"]."_Person_Title' for='".$row["Person_ID"]."_Person_Title'>Job Title:</label></td><td>
					<input type='text' name='".$row["Person_ID"]."_Person_Title' id='".$row["Person_ID"]."_Person_Title' value='".$row['Person_Title']."'/></td>
					<td><label id='lInstitution_Name' for='Institution_Name'>Institution Name:</label></td>
					<td><input type='text' name='Institution_Name' id='Institution_Name'
					value='".$row['Institution_Name']."'/></td>
				</tr>
				<tr>
					<td><label id='l".$row["Person_ID"]."_Street_Address' for='".$row["Person_ID"]."_Street_Address'>Street Address:</label></td><td>
					<input type='text' name='".$row["Person_ID"]."_Street_Address' id='".$row["Person_ID"]."_Street_Address' 
					value='".$row['Person_Address']."'/></td>
					<td><label id='lInstitution_Address' for='Institution_Address'>
					Institution Street Address:</label></td><td>
					<input type='text' name='Institution_Address' id='Institution_Address' 
					value='".$row['Institution_Address']."'/></td>
				</tr>
				<tr>
					<td><label id='l".$row["Person_ID"]."_City' for='".$row["Person_ID"]."_City'>City:</label></td><td>
					<input type='text' name='".$row["Person_ID"]."_City' id='".$row["Person_ID"]."_City' value='".$row['Person_City']."'/></td>
					<td><label id='lInstitution_City' for='Institution_City'>
					Institution City:</label></td>
					<td><input type='text' name='Institution_City' id='Institution_City' 
					value='".$row['Institution_City']."'/></td>
				</tr>
				<tr>
					<td><label id='l".$row["Person_ID"]."_State' for='".$row["Person_ID"]."_State'>State:</label></td><td>
					<input type='text' name='".$row["Person_ID"]."_State' id='".$row["Person_ID"]."_State' value='".$row['Person_State']."'/></td>
					<td><label id='lInstitution_State' for='Institution_State'>
					Institution State:</label></td><td>
					<input type='text' name='Institution_State' id='Institution_State' 
					value='".$row['Institution_State']."'/></td>
					
				</tr>
				<tr>
					<td><label id='l".$row["Person_ID"]."_Zip' for='".$row["Person_ID"]."_Zip'>Zipcode:</label></td><td>
					<input type='text' name='".$row["Person_ID"]."_Zip' id='".$row["Person_ID"]."_Zip' value='".$row['Person_Zip']."'/></td>
					<td><label id='lInstitution_Zip' for='Institution_Zip'>
					Institution Zip:</label></td><td>
					<input type='text' name='Institution_Zip' id='Institution_Zip' 
					value='".$row['Institution_Zip']."'/></td>
				</tr>
				<tr>
					<td><label id='l".$row["Person_ID"]."_Phone' for='".$row["Person_ID"]."_Phone'>Phone Number:</label></td><td>
					<input type='text' name='".$row["Person_ID"]."_Phone' id='".$row["Person_ID"]."_Phone' value='".$row['Person_Phone']."'/></td>
					<td><label id='lInstitution_Type' for='Institution_Type'>
					Insitution Type:</label></td>
					<td>
					<select name='Institution_Type' id='Institution_Type'>
					<option disabled='disabled' selected='selected'>Please select a type:</option>");
					$qry2="SELECT * FROM jrussell_Lib.Target_Audience;";
					$result2=mysql_query($qry2);
					if($result2) {
						while ( $row2 = mysql_fetch_array($result2) ) {
							echo("<option value='".$row2['Audience']."' ");
							if($row['Institution_Type']==$row2['Audience']){
								echo("selected='selected'");
							}
							echo(">".$row2['Audience']."</option>");
						}
					}
					echo("</td>
				</tr>
				<tr>
					<td colspan='4'>&nbsp;</td>
				</tr>
				<tr>
					<td colspan='2'>Please review and accept the terms and conditions:</td><td><a id='inline' href='#conditions' ><button>View Here</button></a></td>
					<td>Accept?<input type='checkbox' name='terms' value='Accepted' checked/></td>
				</tr>
				<tr>
					<td colspan='3'></td><td><input type='submit' name='Submit' /></td>
				</tr>
				
				</table></form>");
			}
		//If the person did not exist before
		} else {
			echo("<form action='' method='post' name='New_Person'>
			<input type='hidden' value='Add' name='action' />
			<input type='hidden' value='".$row["Person_ID"]."' name='Person_ID' /><table>
				<tr>
					<td colspan='2'><h3>Personal Info</h3></td><td colspan='2'><h3>Institution Info</h3></td>
				</tr>
				<tr>
					<td><label id='lFirst_Name' for='First_Name'>First Name:</label></td><td>
					<input type='text' name='First_Name' id='First_Name' /></td>
					<td><strong>Quick Select:</strong></td><td>
					<select name='Institution_Quick_Select' id='Institution_Quick_Select'>
					<option disabled='disabled' selected='selected'>Please select an institution:</option>
					<option value='Other'>Other</option>");
					$qry2="SELECT * FROM jrussell_Lib.Institution;";
					$result2=mysql_query($qry2);
					if($result2) {
						while ( $row2 = mysql_fetch_array($result2) ) {
							echo("<option value='".$row2['Institution_ID']."'>".$row2['Institution_Name']."</option>");
						}
					}
					echo("</td>
				</tr>
				<tr>
					<td><label id='lLast_Name' for='Last_Name'>Last Name:</label></td><td>
					<input type='text' name='Last_Name' id='Last_Name'  /></td>
					<td colspan='2' style='text-align:center;'>If your institution isn't found in the quick select, <br/>enter information below:</td>
				</tr>
				<tr>
					<td><label id='lPerson_Title' for='Person_Title'>Job Title:</label></td><td>
					<input type='text' name='Person_Title' id='Person_Title' /></td>
					<td><label id='lInstitution_Name' for='Institution_Name'>Institution Name:</label></td><td>
					<input type='text' name='Institution_Name' id='Institution_Name' /></td>
				</tr>
				<tr>
					<td><label id='lStreet_Address' for='Street_Address'>Street Address:</label></td><td>
					<input type='text' name='Street_Address' id='Street_Address' /></td>
					<td><label id='lInstitution_Address' for='Institution_Address'>Institution Street Address:</label></td><td>
					<input type='text' name='Institution_Address' id='Institution_Address' /></td>
				</tr>
				<tr>
					<td><label id='lCity' for='City'>City:</label></td><td>
					<input type='text' name='City' id='City' /></td>
					<td><label id='lInstitution_City' for='Institution_City'>Institution City:</label></td><td>
					<input type='text' name='Institution_City' id='Institution_City' /></td>
				</tr>
				<tr>
					<td><label id='lState' for='State'>State:</label></td><td>
					<input type='text' name='State' id='State' /></td>
					<td><label id='lInstitution_State' for='Institution_State'>Institution State:</label></td><td>
					<input type='text' name='Institution_State' id='Institution_State' /></td>
				</tr>
				<tr>
					<td><label id='lZip' for='Zip'>Zipcode:</label></td><td>
					<input type='text' name='Zip' id='Zip' /></td>
					<td><label id='lInstitution_Zip' for='Institution_Zip'>Institution Zip:</label></td>
					<td><input type='text' name='Institution_Zip' id='Institution_Zip' /></td>
				</tr>
				<tr>
					<td><label id='lPhone' for='Phone'>Phone Number:</label></td><td>
					<input type='text' name='Phone' id='Phone'/></td>
					<td><label id='lInstitution_Type' for='Institution_Type'>Insitution Type:</label></td><td>
					<select name='Institution_Type' id='Institution_Type'>
					<option disabled='disabled' selected='selected'>Please select a type:</option>");
					$qry2="SELECT * FROM jrussell_Lib.Target_Audience;";
					$result2=mysql_query($qry2);
					if($result2) {
						while ( $row2 = mysql_fetch_array($result2) ) {
							echo("<option value='".$row2['Audience']."'>".$row2['Audience']."</option>");
						}
					}
					echo("</td>				
				</tr>
				<tr>
					<td colspan='4'>&nbsp;</td>
				</tr>
				<tr>
					<td colspan='2'>Please review and accept the terms and conditions:</td><td><a id='inline' href='#conditions' ><button>View Here</button></a></td>
					<td>Accept?<input type='checkbox' name='terms' value='Accepted'/></td>
				</tr>
				<tr>
					<td colspan='3'></td><td><input type='submit' name='Submit' /></td>
				</tr>
				
				</table></form>");
		}
	}
?>

</div>


</div>
</div>
<div style="display:none;">
	<div id="conditions"><h1>Speaker Terms and Conditions</h1>
	<p>Thank you for your interest in presenting at the the upcoming 2014 Library Technology Conference. By submitting a session proposal, you are agreeing to follow the speaker terms and conditions outlined below:</p>
	 
	<h4>PRESENTER REGISTRATION</h4><p>
	All conference presenters must complete the online registration process no later than January 24th, 2014. Failure to complete presenter registration by this date may result in the cancellation of your session. </p><br />

	<h4>REGISTRATION DISCOUNT</h4><p>
	Session presenters are encouraged to participate in as much of the conference as their schedule will allow. To help facilitate this and in recognition of their contribution to the conference, up to two (2) presenters are given one-day complimentary registration on the day of their presentation.  Presenters who choose to participate in the second day of the conference will be expected to pay the single-day conference registration rate.
	 
	<h4>SUBMISSION OF PRESENTATION MATERIALS AND HANDOUTS</h4><p>
	All presenters are expected to provide presentation materials (Powerpoint slides, etc) and any additional supporting handouts to be made available to participants on the conference web site and to be placed in the conference repository. The deadline for presenters to do this is March 10th, 2014. Submission in PDF or PowerPoint format is preferred. This material should be sent to libtechconference@macalester.edu as an attachment.  </p><br />
	 
	<h4>FINALIZING SESSION DETAILS</h4><p>
	Session details, including presenter information, session title, and the 80-100 word session description for your session, can be edited by you by logging into the speaker portal. However, this information must be finalized no later than January 6th, 2014.</p><br />
	 
	<h4>SESSION SCHEDULING</h4><p>
	The final schedule for presentation sessions will be set by December 16th, 2013. If you have scheduling limitations that will affect the timing of your session, please notify libtechconference@macalester.edu by that date.  Every effort will be made to schedule sessions during a time that reflects these limitations, but because a limited number of sessions will be offered during each time slot, we regret that not all specific time requests may be able to be met.</p><br />
	 
	<h4>LOADING SOFTWARE ON LAB PRESENTATION SPACE COMPUTERS</h4><p>
	We recognize that specific software may need to be installed and made available on presentation and/or lab computers, especially for lab-based hands-on sessions. We will work with presenters to facilitate this prior to the conference. Presenters needing to have software available on presentation space computers should contact libtechconference@macalester.edu no later than February 18th, 2014 to coordinate this.  After that date, requests for software to be loaded on presentation space computers cannot be accepted.</p><br />
	 
	<h4>RESOURCES AVAILABLE IN EACH PRESENTATION SPACE</h4><p>
	Wired and wireless internet as well as projection capabilities will be available in all conference presentation spaces. The following resources can also be available upon request: laptops (PC or Mac) for use during your presentation; audio equipment for broadcasting sound files, projection equipment for transparencies, a whiteboard or easel pads, and other audio/visual equipment as needed. Every effort will be made, but cannot be guaranteed, to meet any  needs requested by presenters.  Please contact libtechconference@macalester.edu if any special needs are being requested beyond internet access and projection capabilities no  later than March 1, 2014.  After that date, requests cannot be accepted. 
	</p>

	</div>
</div>
	<div style="display:none;">
		<div id="pass">
			<h4>Change Password</h4>
			<table><form action="" method="post">
				<tr>
					<td>Current Password:
					</td>
					<td><input type="password" name="old_pass" />
					</td>
				</tr>
				<tr>
					<td>New Password:
					</td>
					<td><input type="password" name="new_pass" />
					</td>
				</tr>
				<tr>
					<td>Confirm New Password:
					</td>
					<td><input type="password" name="confirm_pass" />
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