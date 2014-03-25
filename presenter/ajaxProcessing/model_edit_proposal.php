<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 3/21/14
 * Time: 2:47 PM
 */

require_once('dao.php');

if(isset($_GET['method'])){
    switch (($_GET['method'])) {
        case 'submission-style':
            $dao = new SessionDao();
            echo $dao->getSessionStyles();
            exit();
        case 'person':
            $dao = new PersonDAO();
            echo $dao->getSessionStyles();
            exit();


        //other cases go here

        default:
            break;
    }
}

