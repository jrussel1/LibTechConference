<?php
/**
 * Class that operate on table 'Committee_Member'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
class CommitteeMemberMySqlDAO implements CommitteeMemberDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return CommitteeMemberMySql 
	 */
	public function load($committeeMemberID, $committeeMemberTitle){
		$sql = 'SELECT * FROM Committee_Member WHERE Committee_Member_ID = ?  AND Committee_Member_Title = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($committeeMemberID);
		$sqlQuery->setNumber($committeeMemberTitle);

		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM Committee_Member';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM Committee_Member ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param committeeMember primary key
 	 */
	public function delete($committeeMemberID, $committeeMemberTitle){
		$sql = 'DELETE FROM Committee_Member WHERE Committee_Member_ID = ?  AND Committee_Member_Title = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($committeeMemberID);
		$sqlQuery->setNumber($committeeMemberTitle);

		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param CommitteeMemberMySql committeeMember
 	 */
	public function insert($committeeMember){
		$sql = 'INSERT INTO Committee_Member (Person_ID, Committee_Member_ID, Committee_Member_Title) VALUES (?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($committeeMember->personID);

		
		$sqlQuery->setNumber($committeeMember->committeeMemberID);

		$sqlQuery->setNumber($committeeMember->committeeMemberTitle);

		$this->executeInsert($sqlQuery);	
		//$committeeMember->id = $id;
		//return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param CommitteeMemberMySql committeeMember
 	 */
	public function update($committeeMember){
		$sql = 'UPDATE Committee_Member SET Person_ID = ? WHERE Committee_Member_ID = ?  AND Committee_Member_Title = ? ';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($committeeMember->personID);

		
		$sqlQuery->setNumber($committeeMember->committeeMemberID);

		$sqlQuery->setNumber($committeeMember->committeeMemberTitle);

		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM Committee_Member';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByPersonID($value){
		$sql = 'SELECT * FROM Committee_Member WHERE Person_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByPersonID($value){
		$sql = 'DELETE FROM Committee_Member WHERE Person_ID = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return CommitteeMemberMySql 
	 */
	protected function readRow($row){
		$committeeMember = new CommitteeMember();
		
		$committeeMember->committeeMemberID = $row['Committee_Member_ID'];
		$committeeMember->committeeMemberTitle = $row['Committee_Member_Title'];
		$committeeMember->personID = $row['Person_ID'];

		return $committeeMember;
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
	 * @return CommitteeMemberMySql 
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