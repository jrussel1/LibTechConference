<?PHP
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
<div id="sidebar" class="rounded-corners" style="height:475px;"><h3>INFORMATION NEEDED TO SUBMIT A SESSION PROPOSAL:</h3>
 <p>
<strong>Each session submission must include the following:</strong></p>
<ul><li>
Session title;</li><li>
Presenter information including the full name, position title, institution, and email address for each presenter;</li><li>
Identification of lead presenter(s) - the presenter(s) which should be primary contact for session submission and who should receive the registration discount;</li><li>
Full session proposal which gives complete session description (up to 500 words) that will be used to evaluate submission;</li><li>
80-100 word session abstract that can be published on the conference web site and in the conference program.</li></ul>
 </div>
<div id="content"><h1>Session Proposal Guidelines</h1>
<p>The Library Technology Conference is an annual conference which mixes traditional lecture-style presentations, panel discussions, hands-on workshops, and poster sessions to highlight technologies that affect how users interact with libraries and how libraries are using technology to create new and better ways to manage their resources.  
<br /><br />
The conference attracts approximately 500 library professionals and technologists from as many as 150 institutions each year.   While the conference attracts a majority of its attendees from the midwest region (Minnesota, Iowa, Wisconsin, North and South Dakota), we also see a significant number attending from around the United States as well as from Canada. In previous years, the highest percentage of attendees have come from academic libraries but we also had a high number of participants from public libraries. A smaller number of attendees have come from school (K-12) and special libraries.
<br /><br />
We are looking for a balance of sessions that will appeal to a broad library audience and provide a combination of "right now" solutions and "see the future" technology presentations. Projects can be already implemented or still in process. Long-term experiments that stretch the boundaries of how we work, or will work, in libraries, as well as "out of the box" solutions and ideas for libraries struggling to 'keep up' are welcome topics. What has worked for you? Why? What brought you to that solution? What benefits has it provided to your organization?   Sessions that are interactive and which provide practical information that will allow participants to apply what they've learned at their own library are desired. 
<br />
<br /></p>
<h3>POSSIBLE PROGRAM TYPES:</h3>
<ul><li><strong>
Traditional Lecture-Style Sessions</strong><br />
Sixty minute lecture-style presentation highlighting a technology, resource or service. Typically having no limit on participants unless one is requested by the presenter. Presenters should plan to leave a few time at the end of their session to respond to questions from participants.
</li><br /><li><strong>
Hands-On Sessions</strong><br />
Ninety minute session offering participants a more in-depth, active learning opportunity or hands-on experience working with a technology or learning the details of a software resource. Typically limited to a maximum of 30 participants unless a different maximum number of participants has been requested. Lab spaces will include from 15-30 PC or Macintosh computers and may require session participants to work in groups of two per computer workstation depending on number of conference participants that sign up for the session. Conference participants will also be encouraged to bring their laptop or wireless internet device to the conference for use in some sessions.
</li><br /><li><strong>
Technology Dialogue / Panel Sessions</strong><br />
Sixty or ninety minute session offering participants a more in-depth opportunity with a technology-related topic. Should be interactive / active learning experience for participants. Typically no limit on number of attendees unless requested by the presenter(s). Conference participants will also be encouraged to bring their laptop or wireless internet device to the conference for use in some sessions.
</li><br /><li><strong>
Poster Sessions</strong><br />
Sessions will include posters and handouts describing and explaining a technology resource or service of interest to libraries. Easels and chairs will be provided. If requested, additional resources (such as table space, computer workstation/laptop, audio/visual equipment, etc) will be provided as availability allows. Primary poster session period will be during the 'poster session reception' to be held on Thursday of the conference. Poster session presenters should plan to be present at their poster to offer further explanation and answer questions during the primary poster seesion time. However, poster session participants are encouraged to set up their poster by 8:00am on Thursday, if possible, and have the poster available for viewing throughtout the day.</li></ul>


</div>

</div>
</div>
</body>
</html>