<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
interface WaitlistDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Waitlist 
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
 	 * @param waitlist primary key
 	 */
	public function delete($Waitlist_Index);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Waitlist waitlist
 	 */
	public function insert($waitlist);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Waitlist waitlist
 	 */
	public function update($waitlist);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByEventID($value);

	public function queryByPersonID($value);


	public function deleteByEventID($value);

	public function deleteByPersonID($value);


}
?>