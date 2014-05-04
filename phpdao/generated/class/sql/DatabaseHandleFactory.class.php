<?php
/*
 * Class returns dbh to the database
 *
 * @author: Benjamin Hillmann
 * @date: 3/24/2014
 */
class DatabaseHandleFactory{

    /**
     * Get a dbh
     * @throws Exception
     * @return connection
     */
	static public function getDBH(){

        // Set DSN
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instance
        try {
            $dbh = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
        } // Catch any errors
        catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }

        return $dbh;
	}

	/**
	 * Closes a dbh
	 *
	 * @param close connection
	 */
	static public function close($dbh){
		$dbh = null;
	}
}
?>