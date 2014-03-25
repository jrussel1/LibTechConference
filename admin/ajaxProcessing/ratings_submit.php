<?php
/**
 * Created by PhpStorm.
 * User: jesse
 * Date: 1/16/14
 * Time: 6:13 PM
 */

require_once('../auth.php');
require_once('../../resources/config_local.php');
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if(!$link) {
    die('Failed to connect to server: ' . mysql_error());
}

//Select database
$db = mysql_select_db(DB_DATABASE);
if(!$db) {
    die("Unable to select database");
}

if(isset($_POST['member_id'])){
    $member_id=$_POST['member_id'];
}
if(isset($_POST['session_id'])){
    $ID=$_POST['session_id'];
}
if(isset($_POST['insert'])){
    $qry="INSERT INTO `Review_Proposals`
        (
        `Member_ID`,
        `Proposal_ID`,
        `Relevancy`,
        `Timeliness`,
        `Anticipated_Interest`,
        `Quality`,
        `Comments`
        )
        VALUES
        (
        ".$member_id.",
        ".$ID.",
        ".$_POST['Relevancy'].",
        ".$_POST['Timeliness'].",
        ".$_POST['Anticipated_Interest'].",
        ".$_POST['Quality'].",
        '".$_POST['Comments']."'
        );";
    $result=mysql_query($qry);
    if($result){
        echo("Success");
    }else{
        die($qry);
    }
}else if(isset($_POST['update'])){
    $qry="UPDATE `Review_Proposals`
          SET `Member_ID`=".$member_id.",
          `Proposal_ID`=".$ID.",
          `Relevancy`=".$_POST['Relevancy'].",
          `Timeliness`= ".$_POST['Timeliness'].",
          `Anticipated_Interest`=".$_POST['Anticipated_Interest'].",
          `Quality`=".$_POST['Quality'].",
          `Comments`='".$_POST['Comments']."'
          WHERE `Member_ID`=".$member_id." AND `Proposal_ID`=".$ID.";";
    $result=mysql_query($qry);
    if($result){
        echo("Success");
    }else{
        die($qry);
    }
}
