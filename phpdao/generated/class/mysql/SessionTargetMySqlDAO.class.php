<?php
/**
 * Class that operate on table 'Session_Target'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
class SessionTargetMySqlDAO implements SessionTargetDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return SessionTargetMySql 
	 */
	public function load($sessionID, $audience){
		$sql = 'SELECT * FROM Session_Target WHERE Session_ID = ?  AND Audience = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($sessionID);
		$sqlQuery->setNumber($audience);

		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM Session_Target';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM Session_Target ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param sessionTarget primary key
 	 */
	public function delete($sessionID, $audience){
		$sql = 'DELETE FROM Session_Target WHERE Session_ID = ?  AND Audience = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($sessionID);
		$sqlQuery->setNumber($audience);

		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param SessionTargetMySql sessionTarget
 	 */
	public function insert($sessionTarget){
		$sql = 'INSERT INTO Session_Target ( Session_ID, Audience) VALUES ( ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		

		
		$sqlQuery->setNumber($sessionTarget->sessionID);

		$sqlQuery->setNumber($sessionTarget->audience);

		$this->executeInsert($sqlQuery);	
		//$sessionTarget->id = $id;
		//return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param SessionTargetMySql sessionTarget
 	 */
	public function update($sessionTarget){
		$sql = 'UPDATE Session_Target SET  WHERE Session_ID = ?  AND Audience = ? ';
		$sqlQuery = new SqlQuery($sql);
		

		
		$sqlQuery->setNumber($sessionTarget->sessionID);

		$sqlQuery->setNumber($sessionTarget->audience);

		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM Session_Target';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}



	
	/**
	 * Read row
	 *
	 * @return SessionTargetMySql 
	 */
	protected function readRow($row){
		$sessionTarget = new SessionTarget();
		
		$sessionTarget->sessionID = $row['Session_ID'];
		$sessionTarget->audience = $row['Audience'];

		return $sessionTarget;
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
	 * @return SessionTargetMySql 
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