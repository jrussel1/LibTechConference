<?php
/**
 * Class that operate on table 'Institution_Type'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
class InstitutionTypeMySqlDAO implements InstitutionTypeDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return InstitutionTypeMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM Institution_Type WHERE Institution_Type = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM Institution_Type';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM Institution_Type ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param institutionType primary key
 	 */
	public function delete($Institution_Type){
		$sql = 'DELETE FROM Institution_Type WHERE Institution_Type = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($Institution_Type);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param InstitutionTypeMySql institutionType
 	 */
	public function insert($institutionType){
		$sql = 'INSERT INTO Institution_Type (Institution_ID) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($institutionType->institutionID);

		$id = $this->executeInsert($sqlQuery);	
		$institutionType->institutionType = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param InstitutionTypeMySql institutionType
 	 */
	public function update($institutionType){
		$sql = 'UPDATE Institution_Type SET Institution_ID = ? WHERE Institution_Type = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($institutionType->institutionID);

		$sqlQuery->set($institutionType->institutionType);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM Institution_Type';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByInstitutionID($value){
		$sql = 'SELECT * FROM Institution_Type WHERE Institution_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByInstitutionID($value){
		$sql = 'DELETE FROM Institution_Type WHERE Institution_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return InstitutionTypeMySql 
	 */
	protected function readRow($row){
		$institutionType = new InstitutionType();
		
		$institutionType->institutionType = $row['Institution_Type'];
		$institutionType->institutionID = $row['Institution_ID'];

		return $institutionType;
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
	 * @return InstitutionTypeMySql 
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