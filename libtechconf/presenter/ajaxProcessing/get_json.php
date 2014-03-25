<?php

require_once('../../resources/config.php');

if(isset($_GET['method'])){
    switch (($_GET['method'])) {
        case 'submission-style':
            $dbh = pdo_connect();
            $qry = $dbh->query('SELECT * FROM Session_Style');
            echo json_encode($qry->rowcount() > 0 ? $qry->fetchAll() : NULL);
            exit();

        //other cases go here

        default:
            break;
    }
}

