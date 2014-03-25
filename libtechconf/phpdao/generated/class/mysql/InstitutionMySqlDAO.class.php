<?php
/**
 * Class that operate on table 'Institution'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
class InstitutionMySqlDAO implements InstitutionDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return InstitutionMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM Institution WHERE Institution_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM Institution';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM Institution ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param institution primary key
 	 */
	public function delete($Institution_ID){
		$sql = 'DELETE FROM Institution WHERE Institution_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($Institution_ID);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param InstitutionMySql institution
 	 */
	public function insert($institution){
		$sql = 'INSERT INTO Institution (Institution_Name, Institution_City, Institution_State, Institution_Address) VALUES (?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($institution->institutionName);
		$sqlQuery->set($institution->institutionCity);
		$sqlQuery->set($institution->institutionState);
		$sqlQuery->set($institution->institutionAddress);

		$id = $this->executeInsert($sqlQuery);	
		$institution->institutionID = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param InstitutionMySql institution
 	 */
	public function update($institution){
		$sql = 'UPDATE Institution SET Institution_Name = ?, Institution_City = ?, Institution_State = ?, Institution_Address = ? WHERE Institution_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($institution->institutionName);
		$sqlQuery->set($institution->institutionCity);
		$sqlQuery->set($institution->institutionState);
		$sqlQuery->set($institution->institutionAddress);

		$sqlQuery->setNumber($institution->institutionID);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM Institution';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByInstitutionName($value){
		$sql = 'SELECT * FROM Institution WHERE Institution_Name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByInstitutionCity($value){
		$sql = 'SELECT * FROM Institution WHERE Institution_City = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByInstitutionState($value){
		$sql = 'SELECT * FROM Institution WHERE Institution_State = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByInstitutionAddress($value){
		$sql = 'SELECT * FROM Institution WHERE Institution_Address = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByInstitutionName($value){
		$sql = 'DELETE FROM Institution WHERE Institution_Name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByInstitutionCity($value){
		$sql = 'DELETE FROM Institution WHERE Institution_City = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByInstitutionState($value){
		$sql = 'DELETE FROM Institution WHERE Institution_State = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByInstitutionAddress($value){
		$sql = 'DELETE FROM Institution WHERE Institution_Address = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return InstitutionMySql 
	 */
	protected function readRow($row){
		$institution = new Institution();
		
		$institution->institutionID = $row['Institution_ID'];
		$institution->institutionName = $row['Institution_Name'];
		$institution->institutionCity = $row['Institution_City'];
		$institution->institutionState = $row['Institution_State'];
		$institution->institutionAddress = $row['Institution_Address'];

		return $institution;
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
	 * @return InstitutionMySql 
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