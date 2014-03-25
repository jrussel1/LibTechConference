<?php
/**
 * Class that operate on table 'Section'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
class SectionMySqlDAO implements SectionDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return SectionMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM Section WHERE Section_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM Section';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM Section ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param section primary key
 	 */
	public function delete($Section_ID){
		$sql = 'DELETE FROM Section WHERE Section_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($Section_ID);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param SectionMySql section
 	 */
	public function insert($section){
		$sql = 'INSERT INTO Section (Start_Time, End_Time, Day, Building, Event_ID, Section_Title) VALUES (?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($section->startTime);
		$sqlQuery->set($section->endTime);
		$sqlQuery->set($section->day);
		$sqlQuery->set($section->building);
		$sqlQuery->setNumber($section->eventID);
		$sqlQuery->set($section->sectionTitle);

		$id = $this->executeInsert($sqlQuery);	
		$section->sectionID = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param SectionMySql section
 	 */
	public function update($section){
		$sql = 'UPDATE Section SET Start_Time = ?, End_Time = ?, Day = ?, Building = ?, Event_ID = ?, Section_Title = ? WHERE Section_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($section->startTime);
		$sqlQuery->set($section->endTime);
		$sqlQuery->set($section->day);
		$sqlQuery->set($section->building);
		$sqlQuery->setNumber($section->eventID);
		$sqlQuery->set($section->sectionTitle);

		$sqlQuery->setNumber($section->sectionID);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM Section';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByStartTime($value){
		$sql = 'SELECT * FROM Section WHERE Start_Time = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByEndTime($value){
		$sql = 'SELECT * FROM Section WHERE End_Time = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDay($value){
		$sql = 'SELECT * FROM Section WHERE Day = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByBuilding($value){
		$sql = 'SELECT * FROM Section WHERE Building = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByEventID($value){
		$sql = 'SELECT * FROM Section WHERE Event_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySectionTitle($value){
		$sql = 'SELECT * FROM Section WHERE Section_Title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByStartTime($value){
		$sql = 'DELETE FROM Section WHERE Start_Time = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByEndTime($value){
		$sql = 'DELETE FROM Section WHERE End_Time = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDay($value){
		$sql = 'DELETE FROM Section WHERE Day = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByBuilding($value){
		$sql = 'DELETE FROM Section WHERE Building = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByEventID($value){
		$sql = 'DELETE FROM Section WHERE Event_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySectionTitle($value){
		$sql = 'DELETE FROM Section WHERE Section_Title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return SectionMySql 
	 */
	protected function readRow($row){
		$section = new Section();
		
		$section->sectionID = $row['Section_ID'];
		$section->startTime = $row['Start_Time'];
		$section->endTime = $row['End_Time'];
		$section->day = $row['Day'];
		$section->building = $row['Building'];
		$section->eventID = $row['Event_ID'];
		$section->sectionTitle = $row['Section_Title'];

		return $section;
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
	 * @return SectionMySql 
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