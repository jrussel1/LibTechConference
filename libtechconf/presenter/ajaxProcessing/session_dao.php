<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 3/21/14
 * Time: 2:49 PM
 */

require_once("dao.php");

class SessionDAO extends DAO {

    public function getSessionStyles() {
        $qry = $this->conn->prepare('SELECT * FROM Session_Style');
        $qry->exectue();
        console.log("hi from php");
        return $qry->rowcount() > 0 ? $qry->fetchAll() : NULL;
    }
}