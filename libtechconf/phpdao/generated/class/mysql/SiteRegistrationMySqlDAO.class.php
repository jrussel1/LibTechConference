<?php
/**
 * Class that operate on table 'site_registration'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
class SiteRegistrationMySqlDAO implements SiteRegistrationDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return SiteRegistrationMySql 
	 */
	public function load($id, $email){
		$sql = 'SELECT * FROM site_registration WHERE id = ?  AND email = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		$sqlQuery->setNumber($email);

		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM site_registration';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM site_registration ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param siteRegistration primary key
 	 */
	public function delete($id, $email){
		$sql = 'DELETE FROM site_registration WHERE id = ?  AND email = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		$sqlQuery->setNumber($email);

		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param SiteRegistrationMySql siteRegistration
 	 */
	public function insert($siteRegistration){
		$sql = 'INSERT INTO site_registration (usr, pass, regIP, dt, First_Name, Last_Name, Institution, Address, State, Zip, Phone, Attendee_Title, City, Type_Of_Lib, Newsletter, Confirmed, Terms, id, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($siteRegistration->usr);
		$sqlQuery->set($siteRegistration->pass);
		$sqlQuery->set($siteRegistration->regIP);
		$sqlQuery->set($siteRegistration->dt);
		$sqlQuery->set($siteRegistration->firstName);
		$sqlQuery->set($siteRegistration->lastName);
		$sqlQuery->set($siteRegistration->institution);
		$sqlQuery->set($siteRegistration->address);
		$sqlQuery->set($siteRegistration->state);
		$sqlQuery->set($siteRegistration->zip);
		$sqlQuery->set($siteRegistration->phone);
		$sqlQuery->set($siteRegistration->attendeeTitle);
		$sqlQuery->set($siteRegistration->city);
		$sqlQuery->set($siteRegistration->typeOfLib);
		$sqlQuery->set($siteRegistration->newsletter);
		$sqlQuery->set($siteRegistration->confirmed);
		$sqlQuery->set($siteRegistration->terms);

		
		$sqlQuery->setNumber($siteRegistration->id);

		$sqlQuery->setNumber($siteRegistration->email);

		$this->executeInsert($sqlQuery);	
		//$siteRegistration->id = $id;
		//return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param SiteRegistrationMySql siteRegistration
 	 */
	public function update($siteRegistration){
		$sql = 'UPDATE site_registration SET usr = ?, pass = ?, regIP = ?, dt = ?, First_Name = ?, Last_Name = ?, Institution = ?, Address = ?, State = ?, Zip = ?, Phone = ?, Attendee_Title = ?, City = ?, Type_Of_Lib = ?, Newsletter = ?, Confirmed = ?, Terms = ? WHERE id = ?  AND email = ? ';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($siteRegistration->usr);
		$sqlQuery->set($siteRegistration->pass);
		$sqlQuery->set($siteRegistration->regIP);
		$sqlQuery->set($siteRegistration->dt);
		$sqlQuery->set($siteRegistration->firstName);
		$sqlQuery->set($siteRegistration->lastName);
		$sqlQuery->set($siteRegistration->institution);
		$sqlQuery->set($siteRegistration->address);
		$sqlQuery->set($siteRegistration->state);
		$sqlQuery->set($siteRegistration->zip);
		$sqlQuery->set($siteRegistration->phone);
		$sqlQuery->set($siteRegistration->attendeeTitle);
		$sqlQuery->set($siteRegistration->city);
		$sqlQuery->set($siteRegistration->typeOfLib);
		$sqlQuery->set($siteRegistration->newsletter);
		$sqlQuery->set($siteRegistration->confirmed);
		$sqlQuery->set($siteRegistration->terms);

		
		$sqlQuery->setNumber($siteRegistration->id);

		$sqlQuery->setNumber($siteRegistration->email);

		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM site_registration';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByUsr($value){
		$sql = 'SELECT * FROM site_registration WHERE usr = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPass($value){
		$sql = 'SELECT * FROM site_registration WHERE pass = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByRegIP($value){
		$sql = 'SELECT * FROM site_registration WHERE regIP = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDt($value){
		$sql = 'SELECT * FROM site_registration WHERE dt = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByFirstName($value){
		$sql = 'SELECT * FROM site_registration WHERE First_Name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByLastName($value){
		$sql = 'SELECT * FROM site_registration WHERE Last_Name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByInstitution($value){
		$sql = 'SELECT * FROM site_registration WHERE Institution = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAddress($value){
		$sql = 'SELECT * FROM site_registration WHERE Address = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByState($value){
		$sql = 'SELECT * FROM site_registration WHERE State = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByZip($value){
		$sql = 'SELECT * FROM site_registration WHERE Zip = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPhone($value){
		$sql = 'SELECT * FROM site_registration WHERE Phone = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAttendeeTitle($value){
		$sql = 'SELECT * FROM site_registration WHERE Attendee_Title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCity($value){
		$sql = 'SELECT * FROM site_registration WHERE City = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTypeOfLib($value){
		$sql = 'SELECT * FROM site_registration WHERE Type_Of_Lib = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByNewsletter($value){
		$sql = 'SELECT * FROM site_registration WHERE Newsletter = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByConfirmed($value){
		$sql = 'SELECT * FROM site_registration WHERE Confirmed = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTerms($value){
		$sql = 'SELECT * FROM site_registration WHERE Terms = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByUsr($value){
		$sql = 'DELETE FROM site_registration WHERE usr = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPass($value){
		$sql = 'DELETE FROM site_registration WHERE pass = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByRegIP($value){
		$sql = 'DELETE FROM site_registration WHERE regIP = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDt($value){
		$sql = 'DELETE FROM site_registration WHERE dt = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByFirstName($value){
		$sql = 'DELETE FROM site_registration WHERE First_Name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByLastName($value){
		$sql = 'DELETE FROM site_registration WHERE Last_Name = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByInstitution($value){
		$sql = 'DELETE FROM site_registration WHERE Institution = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAddress($value){
		$sql = 'DELETE FROM site_registration WHERE Address = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByState($value){
		$sql = 'DELETE FROM site_registration WHERE State = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByZip($value){
		$sql = 'DELETE FROM site_registration WHERE Zip = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPhone($value){
		$sql = 'DELETE FROM site_registration WHERE Phone = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAttendeeTitle($value){
		$sql = 'DELETE FROM site_registration WHERE Attendee_Title = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCity($value){
		$sql = 'DELETE FROM site_registration WHERE City = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTypeOfLib($value){
		$sql = 'DELETE FROM site_registration WHERE Type_Of_Lib = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByNewsletter($value){
		$sql = 'DELETE FROM site_registration WHERE Newsletter = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByConfirmed($value){
		$sql = 'DELETE FROM site_registration WHERE Confirmed = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTerms($value){
		$sql = 'DELETE FROM site_registration WHERE Terms = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return SiteRegistrationMySql 
	 */
	protected function readRow($row){
		$siteRegistration = new SiteRegistration();
		
		$siteRegistration->id = $row['id'];
		$siteRegistration->usr = $row['usr'];
		$siteRegistration->pass = $row['pass'];
		$siteRegistration->email = $row['email'];
		$siteRegistration->regIP = $row['regIP'];
		$siteRegistration->dt = $row['dt'];
		$siteRegistration->firstName = $row['First_Name'];
		$siteRegistration->lastName = $row['Last_Name'];
		$siteRegistration->institution = $row['Institution'];
		$siteRegistration->address = $row['Address'];
		$siteRegistration->state = $row['State'];
		$siteRegistration->zip = $row['Zip'];
		$siteRegistration->phone = $row['Phone'];
		$siteRegistration->attendeeTitle = $row['Attendee_Title'];
		$siteRegistration->city = $row['City'];
		$siteRegistration->typeOfLib = $row['Type_Of_Lib'];
		$siteRegistration->newsletter = $row['Newsletter'];
		$siteRegistration->confirmed = $row['Confirmed'];
		$siteRegistration->terms = $row['Terms'];

		return $siteRegistration;
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
	 * @return SiteRegistrationMySql 
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