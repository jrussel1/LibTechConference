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
<div id="nav"><? if($_SESSION['id']){ include "navbar1.html"; }else{ include "navbar2.html";}// include the navbar based on whether the user is logged in or not ---- navbar1 if in, navbar2 if not ?> </div>
<div id="container" class="rounded-corners">
<div id="sidebar" class="rounded-corners" style="height:400px; "><h2>Sidebar title</h2> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mattis condimentum lectus, vitae sodales nunc ornare eget. Vivamus malesuada, ligula vitae ultricies laoreet, leo lectus pretium tortor, in convallis mauris purus ac nunc. Fusce non augue id felis pharetra ullamcorper nec id nunc. Nam ut erat tortor. Mauris mattis lectus sit amet nisl dapibus eu iaculis lectus elementum. Vivamus sit amet gravida turpis. Nunc risus erat, ornare et vestibulum vel, tincidunt vitae enim.</p> </div>
<div id="content"><h1>Title</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi mattis condimentum lectus, vitae sodales nunc ornare eget. Vivamus malesuada, ligula vitae ultricies laoreet, leo lectus pretium tortor, in convallis mauris purus ac nunc. Fusce non augue id felis pharetra ullamcorper nec id nunc. Nam ut erat tortor. Mauris mattis lectus sit amet nisl dapibus eu iaculis lectus elementum. Vivamus sit amet gravida turpis. Nunc risus erat, ornare et vestibulum vel, tincidunt vitae enim. Integer quis enim odio, non interdum quam. Vestibulum euismod sem non nibh rhoncus fringilla. Aliquam accumsan semper diam sollicitudin feugiat. Aliquam molestie porta imperdiet. Nullam rutrum accumsan risus ac congue. Donec adipiscing, tellus vitae ultricies posuere, augue est posuere nulla, non ullamcorper dolor massa sed tortor. Fusce a dolor nisi. Integer bibendum porta tortor, non tempor nibh eleifend quis. Pellentesque non nisi quis ipsum tristique fermentum sed a eros.</p></div>
<div id="sidebar2" class="rounded-corners" style="clear:left;"><img class="rounded-corners" style="padding-left:5px;" src="images/smallproposals2014_2.png" /></div>

</div>
</div>
</body>
</html>