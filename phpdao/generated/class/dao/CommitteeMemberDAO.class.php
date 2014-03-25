<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
interface CommitteeMemberDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return CommitteeMember 
	 */
	public function load($committeeMemberID, $committeeMemberTitle);

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
 	 * @param committeeMember primary key
 	 */
	public function delete($committeeMemberID, $committeeMemberTitle);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param CommitteeMember committeeMember
 	 */
	public function insert($committeeMember);
	
	/**
 	 * Update record in table
 	 *
 	 * @param CommitteeMember committeeMember
 	 */
	public function update($committeeMember);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByPersonID($value);


	public function deleteByPersonID($value);


}
?>