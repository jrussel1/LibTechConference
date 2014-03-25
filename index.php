<?PHP
require_once('resources/config_local.php');
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if(!$link) {
    die('Failed to connect to server: ' . mysql_error());
}

//Select database
$db = mysql_select_db(DB_DATABASE);
if(!$db) {
    die("Unable to select database");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Boring Page</title>
</head>

<body>

<br /><br />
<div style="margin-left: 50%;margin-top: 5%;width: 25%;">
    <a href="admin">Go to Admin Portal</a>
    <br><br>
    <a href="presenter">Go to Presenter Portal</a>
</div>
</body>
</html>