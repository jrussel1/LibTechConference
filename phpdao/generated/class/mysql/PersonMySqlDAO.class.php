<?php
/**
 * Class that operate on table 'Person'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
class PersonMySqlDAO implements PersonDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return PersonMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM Person WHERE Person_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM Person';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM Person ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param person primary key
 	 */
	public function delete($Person_ID){
		$sql = 'DELETE FROM Person WHERE Person_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($Person_ID);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PersonMySql person
 	 */
	public function insert($person){
		$sql = 'INSERT INTO Person (Person_First_Name, Person_Last_Name, Person_Address, Person_City, Person_State, Person_Institution, Person_Email, Person_Zip, Person_Title, Person_Phone, Institution_ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($person->personFirstName);
		$sqlQuery->set($person->personLastName);
		$sqlQuery->set($person->personAddress);
		$sqlQuery->set($person->personCity);
		$sqlQuery->set($person->personState);
		$sqlQuery->set($person->personInstitution);
		$sqlQuery->set($person->personEmail);
		$sqlQuery->set($person->personZip);
		$sqlQuery->set($person->personTitle);
		$sqlQuery->set($person->personPhone);
		$sqlQuery->setNumber($person->institutionID);

		$id = $this->executeInsert($sqlQuery);	
		$person->personID = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param PersonMySql person
 	 */
	public function update($person){
		$sql = 'UPDATE Person SET Person_First_Name = ?, Person_Last_Name = ?, Person_Address = ?, Person_City = ?, Person_State = ?, Person_Institution = ?, Person_Email = ?, Person_Zip = ?, Person_Title = ?, Person_Phone = ?, Institution_ID = ? WHERE Person_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($person->personFirstName);
		$sqlQuery->set($person->personLastName);
		$sqlQuery->set($person->personAddress);
		$sqlQuery->set($person->personCity);
		$sqlQuery->set($person->personState);
		$sqlQuery->set($person->personInstitution);
		$sqlQuery->set($person->personEmail);
		$sqlQuery->set($person->personZip);
		$sqlQuery->set($person->personTitle);
		$sqlQuery->set($person->personPhone);
		$sqlQuery->setNumber($person->institutionID);

		$sqlQuery->setNumber($person->personID);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM Person';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByPersonFirstName($value){
		$sql = 'SELECT * FROM Person WHERE Person_First_Name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPersonLastName($value){
		$sql = 'SELECT * FROM Person WHERE Person_Last_Name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPersonAddress($value){
		$sql = 'SELECT * FROM Person WHERE Person_Address = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPersonCity($value){
		$sql = 'SELECT * FROM Person WHERE Person_City = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPersonState($value){
		$sql = 'SELECT * FROM Person WHERE Person_State = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPersonInstitution($value){
		$sql = 'SELECT * FROM Person WHERE Person_Institution = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPersonEmail($value){
		$sql = 'SELECT * FROM Person WHERE Person_Email = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPersonZip($value){
		$sql = 'SELECT * FROM Person WHERE Person_Zip = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPersonTitle($value){
		$sql = 'SELECT * FROM Person WHERE Person_Title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPersonPhone($value){
		$sql = 'SELECT * FROM Person WHERE Person_Phone = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByInstitutionID($value){
		$sql = 'SELECT * FROM Person WHERE Institution_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByPersonFirstName($value){
		$sql = 'DELETE FROM Person WHERE Person_First_Name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPersonLastName($value){
		$sql = 'DELETE FROM Person WHERE Person_Last_Name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPersonAddress($value){
		$sql = 'DELETE FROM Person WHERE Person_Address = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPersonCity($value){
		$sql = 'DELETE FROM Person WHERE Person_City = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPersonState($value){
		$sql = 'DELETE FROM Person WHERE Person_State = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPersonInstitution($value){
		$sql = 'DELETE FROM Person WHERE Person_Institution = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPersonEmail($value){
		$sql = 'DELETE FROM Person WHERE Person_Email = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPersonZip($value){
		$sql = 'DELETE FROM Person WHERE Person_Zip = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPersonTitle($value){
		$sql = 'DELETE FROM Person WHERE Person_Title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPersonPhone($value){
		$sql = 'DELETE FROM Person WHERE Person_Phone = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByInstitutionID($value){
		$sql = 'DELETE FROM Person WHERE Institution_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return PersonMySql 
	 */
	protected function readRow($row){
		$person = new Person();
		
		$person->personID = $row['Person_ID'];
		$person->personFirstName = $row['Person_First_Name'];
		$person->personLastName = $row['Person_Last_Name'];
		$person->personAddress = $row['Person_Address'];
		$person->personCity = $row['Person_City'];
		$person->personState = $row['Person_State'];
		$person->personInstitution = $row['Person_Institution'];
		$person->personEmail = $row['Person_Email'];
		$person->personZip = $row['Person_Zip'];
		$person->personTitle = $row['Person_Title'];
		$person->personPhone = $row['Person_Phone'];
		$person->institutionID = $row['Institution_ID'];

		return $person;
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
	 * @return PersonMySql 
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