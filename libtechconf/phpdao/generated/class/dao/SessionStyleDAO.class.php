<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
interface SessionStyleDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return SessionStyle 
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
 	 * @param sessionStyle primary key
 	 */
	public function delete($Style);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param SessionStyle sessionStyle
 	 */
	public function insert($sessionStyle);
	
	/**
 	 * Update record in table
 	 *
 	 * @param SessionStyle sessionStyle
 	 */
	public function update($sessionStyle);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByDefaultCapacity($value);


	public function deleteByDefaultCapacity($value);


}
?>