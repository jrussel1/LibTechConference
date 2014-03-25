<?php
/**
 * Class that operate on table 'Person_Of_Session'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
class PersonOfSessionMySqlDAO implements PersonOfSessionDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return PersonOfSessionMySql 
	 */
	public function load($personID, $sessionID){
		$sql = 'SELECT * FROM Person_Of_Session WHERE Person_ID = ?  AND Session_ID = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($personID);
		$sqlQuery->setNumber($sessionID);

		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM Person_Of_Session';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM Person_Of_Session ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param personOfSession primary key
 	 */
	public function delete($personID, $sessionID){
		$sql = 'DELETE FROM Person_Of_Session WHERE Person_ID = ?  AND Session_ID = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($personID);
		$sqlQuery->setNumber($sessionID);

		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PersonOfSessionMySql personOfSession
 	 */
	public function insert($personOfSession){
		$sql = 'INSERT INTO Person_Of_Session ( Person_ID, Session_ID) VALUES ( ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		

		
		$sqlQuery->setNumber($personOfSession->personID);

		$sqlQuery->setNumber($personOfSession->sessionID);

		$this->executeInsert($sqlQuery);	
		//$personOfSession->id = $id;
		//return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param PersonOfSessionMySql personOfSession
 	 */
	public function update($personOfSession){
		$sql = 'UPDATE Person_Of_Session SET  WHERE Person_ID = ?  AND Session_ID = ? ';
		$sqlQuery = new SqlQuery($sql);
		

		
		$sqlQuery->setNumber($personOfSession->personID);

		$sqlQuery->setNumber($personOfSession->sessionID);

		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM Person_Of_Session';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}



	
	/**
	 * Read row
	 *
	 * @return PersonOfSessionMySql 
	 */
	protected function readRow($row){
		$personOfSession = new PersonOfSession();
		
		$personOfSession->personID = $row['Person_ID'];
		$personOfSession->sessionID = $row['Session_ID'];

		return $personOfSession;
	}
	
	protected function getList($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		$ret = array();
		for($i=0;$i<count($tab);$i++){
			$ret[$i] = $this->readRow($tab[$i]);
		}
		return $ret;
	}
	
	/**
	 * Get row
	 *
	 * @return PersonOfSessionMySql 
	 */
	protected function getRow($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		if(count($tab)==0){
			return null;
		}
		return $this->readRow($tab[0]);		
	}
	
	/**
	 * Execute sql query
	 */
	protected function execute($sqlQuery){
		return QueryExecutor::execute($sqlQuery);
	}
	
		
	/**
	 * Execute sql query
	 */
	protected function executeUpdate($sqlQuery){
		return QueryExecutor::executeUpdate($sqlQuery);
	}

	/**
	 * Query for one row and one column
	 */
	protected function querySingleResult($sqlQuery){
		return QueryExecutor::queryForString($sqlQuery);
	}

	/**
	 * Insert row to table
	 */
	protected function executeInsert($sqlQuery){
		return QueryExecutor::executeInsert($sqlQuery);
	}
}
?>