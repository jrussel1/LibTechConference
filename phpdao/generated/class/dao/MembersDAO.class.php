<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
interface MembersDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return Members 
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
 	 * @param member primary key
 	 */
	public function delete($member_id);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param Members member
 	 */
	public function insert($member);
	
	/**
 	 * Update record in table
 	 *
 	 * @param Members member
 	 */
	public function update($member);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByFirstname($value);

	public function queryByLastname($value);

	public function queryByLogin($value);

	public function queryByEmail($value);

	public function queryByPasswd($value);

	public function queryByAccessLevel($value);


	public function deleteByFirstname($value);

	public function deleteByLastname($value);

	public function deleteByLogin($value);

	public function deleteByEmail($value);

	public function deleteByPasswd($value);

	public function deleteByAccessLevel($value);


}
?>