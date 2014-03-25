<?php
/**
 * Created by PhpStorm.
 * User: jesse
 * Date: 1/23/14
 * Time: 4:08 PM
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




$qry="SELECT * FROM Section;";
$result=mysql_query($qry);
$allSections=Array();
if($result) {
    while ( $col = mysql_fetch_array($result) ) {
        //Remove extra pieces from Col object
        $section=Array(
            "Section_ID"=>$col['Section_ID'],
            "Day"=>$col['Day'],
            "Start_Time"=>$col['Start_Time'],
            "End_Time"=>$col['End_Time'],
            "Building"=>$col['Building'],
            "Section_Title"=>$col['Section_Title'],
            "Event_ID"=>$col['Event_ID']
        );
        $qry2="SELECT * FROM Session WHERE Session.Section_ID=".$col['Section_ID'].";";
        $result2=mysql_query($qry2);
        $sessions=Array();
        if($result2) {
            while ( $col2 = mysql_fetch_array($result2) ) {
                //Remove extra pieces from Col object and place session into section object
                $sessions[$col2['Session_ID']]= Array(
                    "Session_ID" => $col2['Session_ID'],
                    "Session_Title" => $col2['Session_Title'],
                    "Session_Description" => utf8_encode($col2['Session_Description']),
                    "Session_Location" => $col2['Session_Location'],
                    "Difficulty_Level" => $col2['Difficulty_Level'],
                    "Section_ID" => $col2['Section_ID'],
                    "Event_ID" => $col2['Event_ID'],
                    "Style" => $col2['Style']
                );
            }
            $section['child_sessions']=$sessions;
            unset($sessions);
        }
        $allSections[$section['Section_ID']]=$section;
    }
    echo(utf8_encode(json_encode($allSections)));
}else{
    die(mysql_error());
}