<?php
/**
 * Created by PhpStorm.
 * User: jesse
 * Date: 1/20/14
 * Time: 2:13 PM
 */

// If the Register form has been submitted

function checkEmail($str)
{
    return preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $str);
}


function send_mail($from,$to,$subject,$body)
{
    $headers = '';
    $headers .= "From: $from\n";
    $headers .= "Reply-to: $from\n";
    $headers .= "Return-Path: $from\n";
    $headers .= "Message-ID: <" . md5(uniqid(time())) . "@" . $_SERVER['SERVER_NAME'] . ">\n";
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Date: " . date('r', time()) . "\n";

    mail($to,$subject,$body,$headers);
}
$err = array();



if(!checkEmail($_POST['email']))
{
    $err[]='Your email is not valid!';
}
elseif(!count($err))
{
    // If there are no errors

    $pass = substr(md5($_SERVER['REMOTE_ADDR'].microtime().rand(1,100000)),0,6);
    // Generate a random password

    $_POST['email'] = mysql_real_escape_string($_POST['email']);
    // Escape the input data


    mysql_query("UPDATE members SET `passwd`='".md5($pass)."' WHERE `email`='".$_POST['email']."'");

    if(mysql_affected_rows($link)==1)
    {
        mail(
            $_POST['email'],
            'LibTech Conference Reviewer Registration - Your New Password',
            "<html><body>This will give you access to your ".$_POST['access_level']." account for the 2014 LibTech Conferece.
					<br /><br />Your temporary password is: ".$pass.
            "<br /><br />To fill out your account information and begin reviewing go to <a href='http://www.jesserussell.net/libtechconf/admin/'>login</a> and go to the 'My
            Account' page.</body></html>",
            'From: NOREPLY@libTechConf.org'."\r\n".'MIME-Version: 1.0' . "\r\n".'Content-type: text/html; charset=iso-8859-1' . "\r\n");

        $_SESSION['msg']['reg-success']='We sent them an email with your new password!';
    }
    else $err[]='This email is already taken!';
}
elseif(count($err))
{
    $_SESSION['msg']['reg-err'] = implode('<br />',$err);
    echo($_SESSION['msg']['reg-err']);
}