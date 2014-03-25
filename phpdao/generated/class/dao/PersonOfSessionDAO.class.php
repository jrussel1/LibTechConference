<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
interface PersonOfSessionDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return PersonOfSession 
	 */
	public function load($personID, $sessionID);

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
 	 * @param personOfSession primary key
 	 */
	public function delete($personID, $sessionID);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param PersonOfSession personOfSession
 	 */
	public function insert($personOfSession);
	
	/**
 	 * Update record in table
 	 *
 	 * @param PersonOfSession personOfSession
 	 */
	public function update($personOfSession);	

	/**
	 * Delete all rows
	 */
	public function clean();



}
?>