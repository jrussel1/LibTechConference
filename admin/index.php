<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login Form</title>
<style>
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
</style>
</head>
<body>
<p>&nbsp;</p>
<form id="loginForm" name="loginForm" method="post" action="login-exec.php">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
      <td width="112"><label for="login"><strong>Login</strong></label></td>
      <td width="188"><input name="login" type="text" class="textfield" id="login" /></td>
    </tr>
    <tr>
      <td><label for="password"><strong>Password</strong></label></td>
      <td><input name="password" type="password" class="textfield" id="password" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Login" /></td>
    </tr>
  </table>
</form>
</body>
</html>
