<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
interface SessionDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Session 
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
 	 * @param session primary key
 	 */
	public function delete($Session_ID);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Session session
 	 */
	public function insert($session);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Session session
 	 */
	public function update($session);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryBySessionTitle($value);

	public function queryBySessionDescription($value);

	public function queryBySessionLocation($value);

	public function queryByDifficultyLevel($value);

	public function queryBySectionID($value);

	public function queryByEventID($value);

	public function queryByStyle($value);


	public function deleteBySessionTitle($value);

	public function deleteBySessionDescription($value);

	public function deleteBySessionLocation($value);

	public function deleteByDifficultyLevel($value);

	public function deleteBySectionID($value);

	public function deleteByEventID($value);

	public function deleteByStyle($value);


}
?>