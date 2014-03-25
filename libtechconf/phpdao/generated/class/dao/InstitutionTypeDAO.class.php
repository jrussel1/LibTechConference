<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
interface InstitutionTypeDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return InstitutionType 
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
 	 * @param institutionType primary key
 	 */
	public function delete($Institution_Type);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param InstitutionType institutionType
 	 */
	public function insert($institutionType);
	
	/**
 	 * Update record in table
 	 *
 	 * @param InstitutionType institutionType
 	 */
	public function update($institutionType);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByInstitutionID($value);


	public function deleteByInstitutionID($value);


}
?>