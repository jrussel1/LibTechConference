<?php
/**
 * Created by PhpStorm.
 * User: Benjamin
 * Date: 3/21/14
 * Time: 2:47 PM
 */

require_once('../../resources/config.php');

class DAO
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASSWORD;
    private $dbname = DB_DATABASE;

    protected   $dbh;
    protected   $error;

    public function __construction()
    {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instance
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } // Catch any errors
        catch (PDOException $e) {
            $this->error = $e->getMessage();
        }

    }

}

class SessionDao extends DAO
{
    function __construct() {
        parent::__construction();
    }
    public function getSessionStyles()
    {
        $qry = $this->dbh->query('SELECT * FROM Session_Style');
        return json_encode($qry->rowcount() > 0 ? $qry->fetchAll() : NULL);
    }
}
class PersonDAO extends DAO
{
    function __construct() {
        parent::__construction();
    }
    public function getSessionStyles()
    {
        $qry = $this->dbh->query('SELECT * FROM Person');
        return json_encode($qry->rowcount() > 0 ? $qry->fetchAll() : NULL);
    }
}
