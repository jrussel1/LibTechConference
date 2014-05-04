<?php
/*
 * Object represents a dbh
 *
 * @author: Benjamin Hillmann
 * @date: 3/24/2014
 */
class DatabaseHandle{
	private $dbh;

	public function DatabaseHandle(){
		$this->dbh = DatabaseHandleFactory::getDBH();
	}

	public function close(){
		DatabaseHandleFactory::close($this->dbh);
	}

	/**
	 * Given an sql execute the query
	 *
	 * @param sql
	 * @return the results of a query
	 */
	public function executeQuery($sql){
        return $this->dbh->query($sql);
	}
}
?>