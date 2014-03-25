<?php
/**
 * Class that operate on table 'Attendance_Type'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
class AttendanceTypeMySqlDAO implements AttendanceTypeDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return AttendanceTypeMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM Attendance_Type WHERE Attendance_Type = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM Attendance_Type';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM Attendance_Type ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param attendanceType primary key
 	 */
	public function delete($Attendance_Type){
		$sql = 'DELETE FROM Attendance_Type WHERE Attendance_Type = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($Attendance_Type);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param AttendanceTypeMySql attendanceType
 	 */
	public function insert($attendanceType){
		$sql = 'INSERT INTO Attendance_Type (Cost) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($attendanceType->cost);

		$id = $this->executeInsert($sqlQuery);	
		$attendanceType->attendanceType = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param AttendanceTypeMySql attendanceType
 	 */
	public function update($attendanceType){
		$sql = 'UPDATE Attendance_Type SET Cost = ? WHERE Attendance_Type = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($attendanceType->cost);

		$sqlQuery->set($attendanceType->attendanceType);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM Attendance_Type';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByCost($value){
		$sql = 'SELECT * FROM Attendance_Type WHERE Cost = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByCost($value){
		$sql = 'DELETE FROM Attendance_Type WHERE Cost = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return AttendanceTypeMySql 
	 */
	protected function readRow($row){
		$attendanceType = new AttendanceType();
		
		$attendanceType->attendanceType = $row['Attendance_Type'];
		$attendanceType->cost = $row['Cost'];

		return $attendanceType;
	}
	
	protected function getList($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		$ret = array();
		for($i=0;$i<count($tab);$i++){
			$ret[$i] = $this->readRow($tab[$i]);
		}
		return $ret;
	}
	
	/**
	 * Get row
	 *
	 * @return AttendanceTypeMySql 
	 */
	protected function getRow($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		if(count($tab)==0){
			return null;
		}
		return $this->readRow($tab[0]);		
	}
	
	/**
	 * Execute sql query
	 */
	protected function execute($sqlQuery){
		return QueryExecutor::execute($sqlQuery);
	}
	
		
	/**
	 * Execute sql query
	 */
	protected function executeUpdate($sqlQuery){
		return QueryExecutor::executeUpdate($sqlQuery);
	}

	/**
	 * Query for one row and one column
	 */
	protected function querySingleResult($sqlQuery){
		return QueryExecutor::queryForString($sqlQuery);
	}

	/**
	 * Insert row to table
	 */
	protected function executeInsert($sqlQuery){
		return QueryExecutor::executeInsert($sqlQuery);
	}
}
?>