<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
interface EventActivityLevelDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return EventActivityLevel 
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
 	 * @param eventActivityLevel primary key
 	 */
	public function delete($Event_Activity_Type);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param EventActivityLevel eventActivityLevel
 	 */
	public function insert($eventActivityLevel);
	
	/**
 	 * Update record in table
 	 *
 	 * @param EventActivityLevel eventActivityLevel
 	 */
	public function update($eventActivityLevel);	

	/**
	 * Delete all rows
	 */
	public function clean();



}
?>