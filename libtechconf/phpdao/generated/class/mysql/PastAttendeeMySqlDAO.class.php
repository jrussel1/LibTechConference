<?php
/**
 * Class that operate on table 'Past_Attendee'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
class PastAttendeeMySqlDAO implements PastAttendeeDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return PastAttendeeMySql 
	 */
	public function load($attendeeID, $email){
		$sql = 'SELECT * FROM Past_Attendee WHERE Attendee_ID = ?  AND Email = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($attendeeID);
		$sqlQuery->setNumber($email);

		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM Past_Attendee';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM Past_Attendee ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param pastAttendee primary key
 	 */
	public function delete($attendeeID, $email){
		$sql = 'DELETE FROM Past_Attendee WHERE Attendee_ID = ?  AND Email = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($attendeeID);
		$sqlQuery->setNumber($email);

		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PastAttendeeMySql pastAttendee
 	 */
	public function insert($pastAttendee){
		$sql = 'INSERT INTO Past_Attendee (First_Name, Last_Name, Institution, Address, State, Zip, Phone, Attendee_Title, City, Type_Of_Lib, Newsletter, Attendee_ID, Email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($pastAttendee->firstName);
		$sqlQuery->set($pastAttendee->lastName);
		$sqlQuery->set($pastAttendee->institution);
		$sqlQuery->set($pastAttendee->address);
		$sqlQuery->set($pastAttendee->state);
		$sqlQuery->set($pastAttendee->zip);
		$sqlQuery->set($pastAttendee->phone);
		$sqlQuery->set($pastAttendee->attendeeTitle);
		$sqlQuery->set($pastAttendee->city);
		$sqlQuery->set($pastAttendee->typeOfLib);
		$sqlQuery->set($pastAttendee->newsletter);

		
		$sqlQuery->setNumber($pastAttendee->attendeeID);

		$sqlQuery->setNumber($pastAttendee->email);

		$this->executeInsert($sqlQuery);	
		//$pastAttendee->id = $id;
		//return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param PastAttendeeMySql pastAttendee
 	 */
	public function update($pastAttendee){
		$sql = 'UPDATE Past_Attendee SET First_Name = ?, Last_Name = ?, Institution = ?, Address = ?, State = ?, Zip = ?, Phone = ?, Attendee_Title = ?, City = ?, Type_Of_Lib = ?, Newsletter = ? WHERE Attendee_ID = ?  AND Email = ? ';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($pastAttendee->firstName);
		$sqlQuery->set($pastAttendee->lastName);
		$sqlQuery->set($pastAttendee->institution);
		$sqlQuery->set($pastAttendee->address);
		$sqlQuery->set($pastAttendee->state);
		$sqlQuery->set($pastAttendee->zip);
		$sqlQuery->set($pastAttendee->phone);
		$sqlQuery->set($pastAttendee->attendeeTitle);
		$sqlQuery->set($pastAttendee->city);
		$sqlQuery->set($pastAttendee->typeOfLib);
		$sqlQuery->set($pastAttendee->newsletter);

		
		$sqlQuery->setNumber($pastAttendee->attendeeID);

		$sqlQuery->setNumber($pastAttendee->email);

		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM Past_Attendee';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByFirstName($value){
		$sql = 'SELECT * FROM Past_Attendee WHERE First_Name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByLastName($value){
		$sql = 'SELECT * FROM Past_Attendee WHERE Last_Name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByInstitution($value){
		$sql = 'SELECT * FROM Past_Attendee WHERE Institution = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAddress($value){
		$sql = 'SELECT * FROM Past_Attendee WHERE Address = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByState($value){
		$sql = 'SELECT * FROM Past_Attendee WHERE State = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByZip($value){
		$sql = 'SELECT * FROM Past_Attendee WHERE Zip = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPhone($value){
		$sql = 'SELECT * FROM Past_Attendee WHERE Phone = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAttendeeTitle($value){
		$sql = 'SELECT * FROM Past_Attendee WHERE Attendee_Title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCity($value){
		$sql = 'SELECT * FROM Past_Attendee WHERE City = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTypeOfLib($value){
		$sql = 'SELECT * FROM Past_Attendee WHERE Type_Of_Lib = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByNewsletter($value){
		$sql = 'SELECT * FROM Past_Attendee WHERE Newsletter = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByFirstName($value){
		$sql = 'DELETE FROM Past_Attendee WHERE First_Name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByLastName($value){
		$sql = 'DELETE FROM Past_Attendee WHERE Last_Name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByInstitution($value){
		$sql = 'DELETE FROM Past_Attendee WHERE Institution = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAddress($value){
		$sql = 'DELETE FROM Past_Attendee WHERE Address = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByState($value){
		$sql = 'DELETE FROM Past_Attendee WHERE State = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByZip($value){
		$sql = 'DELETE FROM Past_Attendee WHERE Zip = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPhone($value){
		$sql = 'DELETE FROM Past_Attendee WHERE Phone = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAttendeeTitle($value){
		$sql = 'DELETE FROM Past_Attendee WHERE Attendee_Title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCity($value){
		$sql = 'DELETE FROM Past_Attendee WHERE City = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTypeOfLib($value){
		$sql = 'DELETE FROM Past_Attendee WHERE Type_Of_Lib = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByNewsletter($value){
		$sql = 'DELETE FROM Past_Attendee WHERE Newsletter = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return PastAttendeeMySql 
	 */
	protected function readRow($row){
		$pastAttendee = new PastAttendee();
		
		$pastAttendee->attendeeID = $row['Attendee_ID'];
		$pastAttendee->firstName = $row['First_Name'];
		$pastAttendee->lastName = $row['Last_Name'];
		$pastAttendee->institution = $row['Institution'];
		$pastAttendee->email = $row['Email'];
		$pastAttendee->address = $row['Address'];
		$pastAttendee->state = $row['State'];
		$pastAttendee->zip = $row['Zip'];
		$pastAttendee->phone = $row['Phone'];
		$pastAttendee->attendeeTitle = $row['Attendee_Title'];
		$pastAttendee->city = $row['City'];
		$pastAttendee->typeOfLib = $row['Type_Of_Lib'];
		$pastAttendee->newsletter = $row['Newsletter'];

		return $pastAttendee;
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
	 * @return PastAttendeeMySql 
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