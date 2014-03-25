<?php
	//Start session
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')) {
		if ($_SESSION['SESS_TIMEOUT'] + 6000 * 60 < time()) {
    		 // session timed out
  
			header("location: access-denied.php");
		exit();
		}
	}