<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: ${date}
 */
interface ${dao_clazz_name}DAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return ${dao_clazz_name} 
	 */
	public function load(${pks});

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
 	 * @param ${var_name} primary key
 	 */
	public function delete(${pks});
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ${dao_clazz_name} ${var_name}
 	 */
	public function insert($${var_name});
	
	/**
 	 * Update record in table
 	 *
 	 * @param ${dao_clazz_name} ${var_name}
 	 */
	public function update($${var_name});	

	/**
	 * Delete all rows
	 */
	public function clean();

${queryByFieldFunctions}
${deleteByFieldFunctions}
}
?>