<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
interface PastAttendeeDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return PastAttendee 
	 */
	public function load($attendeeID, $email);

	/**
	 * Get all records from table
	 */
	public function queryAll();
	
	/**
	 * Get all records from table ordered by field
	 * @Param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn);
	
	/**
 	 * Delete record from table
 	 * @param pastAttendee primary key
 	 */
	public function delete($attendeeID, $email);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PastAttendee pastAttendee
 	 */
	public function insert($pastAttendee);
	
	/**
 	 * Update record in table
 	 *
 	 * @param PastAttendee pastAttendee
 	 */
	public function update($pastAttendee);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByFirstName($value);

	public function queryByLastName($value);

	public function queryByInstitution($value);

	public function queryByAddress($value);

	public function queryByState($value);

	public function queryByZip($value);

	public function queryByPhone($value);

	public function queryByAttendeeTitle($value);

	public function queryByCity($value);

	public function queryByTypeOfLib($value);

	public function queryByNewsletter($value);


	public function deleteByFirstName($value);

	public function deleteByLastName($value);

	public function deleteByInstitution($value);

	public function deleteByAddress($value);

	public function deleteByState($value);

	public function deleteByZip($value);

	public function deleteByPhone($value);

	public function deleteByAttendeeTitle($value);

	public function deleteByCity($value);

	public function deleteByTypeOfLib($value);

	public function deleteByNewsletter($value);


}
?>