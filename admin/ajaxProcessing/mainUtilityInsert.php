<?php
/**
 * Created by PhpStorm.
 * User: jesse
 * Date: 1/20/14
 * Time: 2:42 PM
 */

require_once('../auth.php');
require_once('../config.php');
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if(!$link) {
    die('Failed to connect to server: ' . mysql_error());
}

//Select database
$db = mysql_select_db(DB_DATABASE);
if(!$db) {
    die("Unable to select database");
}
$tableName=$_POST['Table_Select'];
$qry="INSERT INTO `".DB_DATABASE."`.`".$tableName."` (";
$qryC="SHOW COLUMNS FROM ".DB_DATABASE.".".$tableName;
$resultC=mysql_query($qryC);
if($resultC) {

    while ( $col = mysql_fetch_array($resultC) ) {
        $qry=$qry."`".$col['Field']."`,";
    }
    $qry=rtrim($qry, ",");
}

$qry=$qry.")VALUES(";
$qryC="SHOW COLUMNS FROM ".DB_DATABASE.".".$tableName;
$resultC=mysql_query($qryC);
if($resultC) {

    while ( $col = mysql_fetch_array($resultC) ) {
        $qry=$qry."'".$_POST[$col['Field']]."',";
    }
    $qry=rtrim($qry, ",");
    $qry=$qry.")";
}
$result=mysql_query($qry);
if(!$result){
    die("Query failed-".$qry.var_dump($_POST));
}else{
    echo("Success!");
}

if($_POST['Table_Select']=='members'&&isset($_POST['email']))
{
    include("newMemberEmail.php");
}
