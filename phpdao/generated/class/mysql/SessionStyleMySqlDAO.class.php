<?php
/**
 * Class that operate on table 'Session_Style'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
class SessionStyleMySqlDAO implements SessionStyleDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return SessionStyleMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM Session_Style WHERE Style = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM Session_Style';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM Session_Style ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param sessionStyle primary key
 	 */
	public function delete($Style){
		$sql = 'DELETE FROM Session_Style WHERE Style = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($Style);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param SessionStyleMySql sessionStyle
 	 */
	public function insert($sessionStyle){
		$sql = 'INSERT INTO Session_Style (Default_Capacity) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($sessionStyle->defaultCapacity);

		$id = $this->executeInsert($sqlQuery);	
		$sessionStyle->style = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param SessionStyleMySql sessionStyle
 	 */
	public function update($sessionStyle){
		$sql = 'UPDATE Session_Style SET Default_Capacity = ? WHERE Style = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($sessionStyle->defaultCapacity);

		$sqlQuery->set($sessionStyle->style);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM Session_Style';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByDefaultCapacity($value){
		$sql = 'SELECT * FROM Session_Style WHERE Default_Capacity = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByDefaultCapacity($value){
		$sql = 'DELETE FROM Session_Style WHERE Default_Capacity = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return SessionStyleMySql 
	 */
	protected function readRow($row){
		$sessionStyle = new SessionStyle();
		
		$sessionStyle->style = $row['Style'];
		$sessionStyle->defaultCapacity = $row['Default_Capacity'];

		return $sessionStyle;
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
	 * @return SessionStyleMySql 
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