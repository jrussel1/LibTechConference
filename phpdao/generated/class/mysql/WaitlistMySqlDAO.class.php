<?php
/**
 * Class that operate on table 'Waitlist'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
class WaitlistMySqlDAO implements WaitlistDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return WaitlistMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM Waitlist WHERE Waitlist_Index = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM Waitlist';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM Waitlist ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param waitlist primary key
 	 */
	public function delete($Waitlist_Index){
		$sql = 'DELETE FROM Waitlist WHERE Waitlist_Index = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($Waitlist_Index);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param WaitlistMySql waitlist
 	 */
	public function insert($waitlist){
		$sql = 'INSERT INTO Waitlist (Event_ID, Person_ID) VALUES (?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($waitlist->eventID);
		$sqlQuery->setNumber($waitlist->personID);

		$id = $this->executeInsert($sqlQuery);	
		$waitlist->waitlistIndex = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param WaitlistMySql waitlist
 	 */
	public function update($waitlist){
		$sql = 'UPDATE Waitlist SET Event_ID = ?, Person_ID = ? WHERE Waitlist_Index = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($waitlist->eventID);
		$sqlQuery->setNumber($waitlist->personID);

		$sqlQuery->setNumber($waitlist->waitlistIndex);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM Waitlist';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByEventID($value){
		$sql = 'SELECT * FROM Waitlist WHERE Event_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPersonID($value){
		$sql = 'SELECT * FROM Waitlist WHERE Person_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByEventID($value){
		$sql = 'DELETE FROM Waitlist WHERE Event_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPersonID($value){
		$sql = 'DELETE FROM Waitlist WHERE Person_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return WaitlistMySql 
	 */
	protected function readRow($row){
		$waitlist = new Waitlist();
		
		$waitlist->waitlistIndex = $row['Waitlist_Index'];
		$waitlist->eventID = $row['Event_ID'];
		$waitlist->personID = $row['Person_ID'];

		return $waitlist;
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
	 * @return WaitlistMySql 
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