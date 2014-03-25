<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
interface InstitutionDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Institution 
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
 	 * @param institution primary key
 	 */
	public function delete($Institution_ID);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Institution institution
 	 */
	public function insert($institution);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Institution institution
 	 */
	public function update($institution);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByInstitutionName($value);

	public function queryByInstitutionCity($value);

	public function queryByInstitutionState($value);

	public function queryByInstitutionAddress($value);


	public function deleteByInstitutionName($value);

	public function deleteByInstitutionCity($value);

	public function deleteByInstitutionState($value);

	public function deleteByInstitutionAddress($value);


}
?>