<?php
/**
 * Class that operate on table 'Session'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
class SessionMySqlDAO implements SessionDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return SessionMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM Session WHERE Session_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM Session';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM Session ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param session primary key
 	 */
	public function delete($Session_ID){
		$sql = 'DELETE FROM Session WHERE Session_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($Session_ID);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param SessionMySql session
 	 */
	public function insert($session){
		$sql = 'INSERT INTO Session (Session_Title, Session_Description, Session_Location, Difficulty_Level, Section_ID, Event_ID, Style) VALUES (?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($session->sessionTitle);
		$sqlQuery->set($session->sessionDescription);
		$sqlQuery->set($session->sessionLocation);
		$sqlQuery->set($session->difficultyLevel);
		$sqlQuery->setNumber($session->sectionID);
		$sqlQuery->setNumber($session->eventID);
		$sqlQuery->set($session->style);

		$id = $this->executeInsert($sqlQuery);	
		$session->sessionID = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param SessionMySql session
 	 */
	public function update($session){
		$sql = 'UPDATE Session SET Session_Title = ?, Session_Description = ?, Session_Location = ?, Difficulty_Level = ?, Section_ID = ?, Event_ID = ?, Style = ? WHERE Session_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($session->sessionTitle);
		$sqlQuery->set($session->sessionDescription);
		$sqlQuery->set($session->sessionLocation);
		$sqlQuery->set($session->difficultyLevel);
		$sqlQuery->setNumber($session->sectionID);
		$sqlQuery->setNumber($session->eventID);
		$sqlQuery->set($session->style);

		$sqlQuery->setNumber($session->sessionID);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM Session';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryBySessionTitle($value){
		$sql = 'SELECT * FROM Session WHERE Session_Title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySessionDescription($value){
		$sql = 'SELECT * FROM Session WHERE Session_Description = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySessionLocation($value){
		$sql = 'SELECT * FROM Session WHERE Session_Location = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDifficultyLevel($value){
		$sql = 'SELECT * FROM Session WHERE Difficulty_Level = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySectionID($value){
		$sql = 'SELECT * FROM Session WHERE Section_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByEventID($value){
		$sql = 'SELECT * FROM Session WHERE Event_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByStyle($value){
		$sql = 'SELECT * FROM Session WHERE Style = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteBySessionTitle($value){
		$sql = 'DELETE FROM Session WHERE Session_Title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySessionDescription($value){
		$sql = 'DELETE FROM Session WHERE Session_Description = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySessionLocation($value){
		$sql = 'DELETE FROM Session WHERE Session_Location = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDifficultyLevel($value){
		$sql = 'DELETE FROM Session WHERE Difficulty_Level = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySectionID($value){
		$sql = 'DELETE FROM Session WHERE Section_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByEventID($value){
		$sql = 'DELETE FROM Session WHERE Event_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByStyle($value){
		$sql = 'DELETE FROM Session WHERE Style = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return SessionMySql 
	 */
	protected function readRow($row){
		$session = new Session();
		
		$session->sessionID = $row['Session_ID'];
		$session->sessionTitle = $row['Session_Title'];
		$session->sessionDescription = $row['Session_Description'];
		$session->sessionLocation = $row['Session_Location'];
		$session->difficultyLevel = $row['Difficulty_Level'];
		$session->sectionID = $row['Section_ID'];
		$session->eventID = $row['Event_ID'];
		$session->style = $row['Style'];

		return $session;
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
	 * @return SessionMySql 
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