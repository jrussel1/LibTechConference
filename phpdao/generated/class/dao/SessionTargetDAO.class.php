<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
interface SessionTargetDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return SessionTarget 
	 */
	public function load($sessionID, $audience);

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
 	 * @param sessionTarget primary key
 	 */
	public function delete($sessionID, $audience);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param SessionTarget sessionTarget
 	 */
	public function insert($sessionTarget);
	
	/**
 	 * Update record in table
 	 *
 	 * @param SessionTarget sessionTarget
 	 */
	public function update($sessionTarget);	

	/**
	 * Delete all rows
	 */
	public function clean();



}
?>