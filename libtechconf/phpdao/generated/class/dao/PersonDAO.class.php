<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
interface PersonDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Person 
	 */
	public function load($id);

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
 	 * @param person primary key
 	 */
	public function delete($Person_ID);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Person person
 	 */
	public function insert($person);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Person person
 	 */
	public function update($person);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByPersonFirstName($value);

	public function queryByPersonLastName($value);

	public function queryByPersonAddress($value);

	public function queryByPersonCity($value);

	public function queryByPersonState($value);

	public function queryByPersonInstitution($value);

	public function queryByPersonEmail($value);

	public function queryByPersonZip($value);

	public function queryByPersonTitle($value);

	public function queryByPersonPhone($value);

	public function queryByInstitutionID($value);


	public function deleteByPersonFirstName($value);

	public function deleteByPersonLastName($value);

	public function deleteByPersonAddress($value);

	public function deleteByPersonCity($value);

	public function deleteByPersonState($value);

	public function deleteByPersonInstitution($value);

	public function deleteByPersonEmail($value);

	public function deleteByPersonZip($value);

	public function deleteByPersonTitle($value);

	public function deleteByPersonPhone($value);

	public function deleteByInstitutionID($value);


}
?>