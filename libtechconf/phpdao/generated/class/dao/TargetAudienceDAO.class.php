<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
interface TargetAudienceDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return TargetAudience 
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
 	 * @param targetAudience primary key
 	 */
	public function delete($Audience);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param TargetAudience targetAudience
 	 */
	public function insert($targetAudience);
	
	/**
 	 * Update record in table
 	 *
 	 * @param TargetAudience targetAudience
 	 */
	public function update($targetAudience);	

	/**
	 * Delete all rows
	 */
	public function clean();



}
?>