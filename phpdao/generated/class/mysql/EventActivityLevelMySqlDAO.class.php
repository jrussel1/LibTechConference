<?php
/**
 * Class that operate on table 'Event_Activity_Level'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
class EventActivityLevelMySqlDAO implements EventActivityLevelDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return EventActivityLevelMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM Event_Activity_Level WHERE Event_Activity_Type = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM Event_Activity_Level';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM Event_Activity_Level ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param eventActivityLevel primary key
 	 */
	public function delete($Event_Activity_Type){
		$sql = 'DELETE FROM Event_Activity_Level WHERE Event_Activity_Type = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($Event_Activity_Type);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param EventActivityLevelMySql eventActivityLevel
 	 */
	public function insert($eventActivityLevel){
		$sql = 'INSERT INTO Event_Activity_Level () VALUES ()';
		$sqlQuery = new SqlQuery($sql);
		

		$id = $this->executeInsert($sqlQuery);	
		$eventActivityLevel->eventActivityType = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param EventActivityLevelMySql eventActivityLevel
 	 */
	public function update($eventActivityLevel){
		$sql = 'UPDATE Event_Activity_Level SET  WHERE Event_Activity_Type = ?';
		$sqlQuery = new SqlQuery($sql);
		

		$sqlQuery->set($eventActivityLevel->eventActivityType);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM Event_Activity_Level';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}



	
	/**
	 * Read row
	 *
	 * @return EventActivityLevelMySql 
	 */
	protected function readRow($row){
		$eventActivityLevel = new EventActivityLevel();
		
		$eventActivityLevel->eventActivityType = $row['Event_Activity_Type'];

		return $eventActivityLevel;
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
	 * @return EventActivityLevelMySql 
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