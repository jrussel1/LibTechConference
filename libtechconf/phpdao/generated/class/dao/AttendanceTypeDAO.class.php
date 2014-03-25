<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
interface AttendanceTypeDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return AttendanceType 
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
 	 * @param attendanceType primary key
 	 */
	public function delete($Attendance_Type);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param AttendanceType attendanceType
 	 */
	public function insert($attendanceType);
	
	/**
 	 * Update record in table
 	 *
 	 * @param AttendanceType attendanceType
 	 */
	public function update($attendanceType);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByCost($value);


	public function deleteByCost($value);


}
?>