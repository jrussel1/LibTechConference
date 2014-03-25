<?PHP
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
<? include('login_panel/header_incl.php'); ?>
</head>

<body>
<? include('login_panel/panel.php'); ?>
<br /><br />
<div id="wrapper">
<img src="images/banner.png" />
<div id="nav"><? if($_SESSION['id']){ include "navbar1.html"; }else{ include "navbar2.html";}// include the navbar based on whether the user is logged in or not ---- navbar1 if in, navbar2 if not ?> </div><div id="container" class="rounded-corners">
<div id="sidebar" class="rounded-corners" ><h3>IMPORTANT DATES FOR PRESENTERS</h3>
<table><tr class="border_bottom"><td id="td_space">
Nov 15th </td><td> Deadline for session proposal submissions</td></tr><tr class="border_bottom"><td style="white-space:nowrap;" id="td_space">
Dec 1st-5th</td><td>  Notification of session proposal acceptance</td></tr><tr class="border_bottom"><td id="td_space">
Dec 20th  </td><td>  Session details must be finalized.</td></tr><tr class="border_bottom"><td id="td_space">
Jan 12th </td><td> Conference Registration Opens</td></tr><tr class="border_bottom"><td id="td_space">
Jan 24th </td><td> Deadline for presenters to complete online registration process</td></tr><tr class="border_bottom"><td id="td_space">
Mar 1st </td><td> Deadline for submitting special equipment needs for your presentation</td></tr><tr class="border_bottom"><td id="td_space">
Mar 9th </td><td> Deadline for submitting presentation materials for conference web site</td></tr></table>
<p>
The 7th annual Library Technology Conference is <strong>March 19th-20th, 2014</strong> on the campus of Macalester College.
 </p>
 </div>
<div id="content"><h1>Speaker Terms and Conditions</h1>
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
</div>
</body>
</html>