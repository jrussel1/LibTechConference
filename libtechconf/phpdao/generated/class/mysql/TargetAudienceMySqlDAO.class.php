<?php
/**
 * Class that operate on table 'Target_Audience'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
class TargetAudienceMySqlDAO implements TargetAudienceDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return TargetAudienceMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM Target_Audience WHERE Audience = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM Target_Audience';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM Target_Audience ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param targetAudience primary key
 	 */
	public function delete($Audience){
		$sql = 'DELETE FROM Target_Audience WHERE Audience = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($Audience);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param TargetAudienceMySql targetAudience
 	 */
	public function insert($targetAudience){
		$sql = 'INSERT INTO Target_Audience () VALUES ()';
		$sqlQuery = new SqlQuery($sql);
		

		$id = $this->executeInsert($sqlQuery);	
		$targetAudience->audience = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param TargetAudienceMySql targetAudience
 	 */
	public function update($targetAudience){
		$sql = 'UPDATE Target_Audience SET  WHERE Audience = ?';
		$sqlQuery = new SqlQuery($sql);
		

		$sqlQuery->set($targetAudience->audience);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM Target_Audience';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}



	
	/**
	 * Read row
	 *
	 * @return TargetAudienceMySql 
	 */
	protected function readRow($row){
		$targetAudience = new TargetAudience();
		
		$targetAudience->audience = $row['Audience'];

		return $targetAudience;
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
	 * @return TargetAudienceMySql 
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