<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
interface SessionTagsDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return SessionTags 
	 */
	public function load($sessionID, $tag);

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
 	 * @param sessionTag primary key
 	 */
	public function delete($sessionID, $tag);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param SessionTags sessionTag
 	 */
	public function insert($sessionTag);
	
	/**
 	 * Update record in table
 	 *
 	 * @param SessionTags sessionTag
 	 */
	public function update($sessionTag);	

	/**
	 * Delete all rows
	 */
	public function clean();



}
?>