<?php
/**
 * Class that operate on table 'Event'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
class EventMySqlDAO implements EventDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return EventMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM Event WHERE Event_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM Event';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM Event ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param event primary key
 	 */
	public function delete($Event_ID){
		$sql = 'DELETE FROM Event WHERE Event_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($Event_ID);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param EventMySql event
 	 */
	public function insert($event){
		$sql = 'INSERT INTO Event (Event_Title, Start_Date, End_Date, Max_Total_Capacity, Activity_Level) VALUES (?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($event->eventTitle);
		$sqlQuery->set($event->startDate);
		$sqlQuery->set($event->endDate);
		$sqlQuery->setNumber($event->maxTotalCapacity);
		$sqlQuery->set($event->activityLevel);

		$id = $this->executeInsert($sqlQuery);	
		$event->eventID = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param EventMySql event
 	 */
	public function update($event){
		$sql = 'UPDATE Event SET Event_Title = ?, Start_Date = ?, End_Date = ?, Max_Total_Capacity = ?, Activity_Level = ? WHERE Event_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($event->eventTitle);
		$sqlQuery->set($event->startDate);
		$sqlQuery->set($event->endDate);
		$sqlQuery->setNumber($event->maxTotalCapacity);
		$sqlQuery->set($event->activityLevel);

		$sqlQuery->setNumber($event->eventID);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM Event';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByEventTitle($value){
		$sql = 'SELECT * FROM Event WHERE Event_Title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByStartDate($value){
		$sql = 'SELECT * FROM Event WHERE Start_Date = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByEndDate($value){
		$sql = 'SELECT * FROM Event WHERE End_Date = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByMaxTotalCapacity($value){
		$sql = 'SELECT * FROM Event WHERE Max_Total_Capacity = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByActivityLevel($value){
		$sql = 'SELECT * FROM Event WHERE Activity_Level = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByEventTitle($value){
		$sql = 'DELETE FROM Event WHERE Event_Title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByStartDate($value){
		$sql = 'DELETE FROM Event WHERE Start_Date = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByEndDate($value){
		$sql = 'DELETE FROM Event WHERE End_Date = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByMaxTotalCapacity($value){
		$sql = 'DELETE FROM Event WHERE Max_Total_Capacity = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByActivityLevel($value){
		$sql = 'DELETE FROM Event WHERE Activity_Level = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return EventMySql 
	 */
	protected function readRow($row){
		$event = new Event();
		
		$event->eventID = $row['Event_ID'];
		$event->eventTitle = $row['Event_Title'];
		$event->startDate = $row['Start_Date'];
		$event->endDate = $row['End_Date'];
		$event->maxTotalCapacity = $row['Max_Total_Capacity'];
		$event->activityLevel = $row['Activity_Level'];

		return $event;
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
	 * @return EventMySql 
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