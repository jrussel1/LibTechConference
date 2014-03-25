<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
interface SiteRegistrationDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return SiteRegistration 
	 */
	public function load($id, $email);

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
 	 * @param siteRegistration primary key
 	 */
	public function delete($id, $email);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param SiteRegistration siteRegistration
 	 */
	public function insert($siteRegistration);
	
	/**
 	 * Update record in table
 	 *
 	 * @param SiteRegistration siteRegistration
 	 */
	public function update($siteRegistration);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByUsr($value);

	public function queryByPass($value);

	public function queryByRegIP($value);

	public function queryByDt($value);

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

	public function queryByConfirmed($value);

	public function queryByTerms($value);


	public function deleteByUsr($value);

	public function deleteByPass($value);

	public function deleteByRegIP($value);

	public function deleteByDt($value);

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

	public function deleteByConfirmed($value);

	public function deleteByTerms($value);


}
?>