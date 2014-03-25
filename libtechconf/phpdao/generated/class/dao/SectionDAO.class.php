<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
interface SectionDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Section 
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
 	 * @param section primary key
 	 */
	public function delete($Section_ID);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Section section
 	 */
	public function insert($section);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Section section
 	 */
	public function update($section);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByStartTime($value);

	public function queryByEndTime($value);

	public function queryByDay($value);

	public function queryByBuilding($value);

	public function queryByEventID($value);

	public function queryBySectionTitle($value);


	public function deleteByStartTime($value);

	public function deleteByEndTime($value);

	public function deleteByDay($value);

	public function deleteByBuilding($value);

	public function deleteByEventID($value);

	public function deleteBySectionTitle($value);


}
?>