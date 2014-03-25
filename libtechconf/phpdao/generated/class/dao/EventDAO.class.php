<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
interface EventDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Event 
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
 	 * @param event primary key
 	 */
	public function delete($Event_ID);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Event event
 	 */
	public function insert($event);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Event event
 	 */
	public function update($event);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByEventTitle($value);

	public function queryByStartDate($value);

	public function queryByEndDate($value);

	public function queryByMaxTotalCapacity($value);

	public function queryByActivityLevel($value);


	public function deleteByEventTitle($value);

	public function deleteByStartDate($value);

	public function deleteByEndDate($value);

	public function deleteByMaxTotalCapacity($value);

	public function deleteByActivityLevel($value);


}
?>