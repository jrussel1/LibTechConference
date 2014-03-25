<?php
/**
 * Class that operate on table 'Session_Tags'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
class SessionTagsMySqlDAO implements SessionTagsDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return SessionTagsMySql 
	 */
	public function load($sessionID, $tag){
		$sql = 'SELECT * FROM Session_Tags WHERE Session_ID = ?  AND Tag = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($sessionID);
		$sqlQuery->setNumber($tag);

		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM Session_Tags';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM Session_Tags ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param sessionTag primary key
 	 */
	public function delete($sessionID, $tag){
		$sql = 'DELETE FROM Session_Tags WHERE Session_ID = ?  AND Tag = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($sessionID);
		$sqlQuery->setNumber($tag);

		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param SessionTagsMySql sessionTag
 	 */
	public function insert($sessionTag){
		$sql = 'INSERT INTO Session_Tags ( Session_ID, Tag) VALUES ( ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		

		
		$sqlQuery->setNumber($sessionTag->sessionID);

		$sqlQuery->setNumber($sessionTag->tag);

		$this->executeInsert($sqlQuery);	
		//$sessionTag->id = $id;
		//return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param SessionTagsMySql sessionTag
 	 */
	public function update($sessionTag){
		$sql = 'UPDATE Session_Tags SET  WHERE Session_ID = ?  AND Tag = ? ';
		$sqlQuery = new SqlQuery($sql);
		

		
		$sqlQuery->setNumber($sessionTag->sessionID);

		$sqlQuery->setNumber($sessionTag->tag);

		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM Session_Tags';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}



	
	/**
	 * Read row
	 *
	 * @return SessionTagsMySql 
	 */
	protected function readRow($row){
		$sessionTag = new SessionTag();
		
		$sessionTag->sessionID = $row['Session_ID'];
		$sessionTag->tag = $row['Tag'];

		return $sessionTag;
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
	 * @return SessionTagsMySql 
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