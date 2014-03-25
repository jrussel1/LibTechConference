<?php
/**
 * Class that operate on table 'members'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
class MembersMySqlDAO implements MembersDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return MembersMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM members WHERE member_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM members';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM members ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param member primary key
 	 */
	public function delete($member_id){
		$sql = 'DELETE FROM members WHERE member_id = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($member_id);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param MembersMySql member
 	 */
	public function insert($member){
		$sql = 'INSERT INTO members (firstname, lastname, login, email, passwd, access_level) VALUES (?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($member->firstname);
		$sqlQuery->set($member->lastname);
		$sqlQuery->set($member->login);
		$sqlQuery->set($member->email);
		$sqlQuery->set($member->passwd);
		$sqlQuery->set($member->accessLevel);

		$id = $this->executeInsert($sqlQuery);	
		$member->memberId = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param MembersMySql member
 	 */
	public function update($member){
		$sql = 'UPDATE members SET firstname = ?, lastname = ?, login = ?, email = ?, passwd = ?, access_level = ? WHERE member_id = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($member->firstname);
		$sqlQuery->set($member->lastname);
		$sqlQuery->set($member->login);
		$sqlQuery->set($member->email);
		$sqlQuery->set($member->passwd);
		$sqlQuery->set($member->accessLevel);

		$sqlQuery->setNumber($member->memberId);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM members';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByFirstname($value){
		$sql = 'SELECT * FROM members WHERE firstname = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByLastname($value){
		$sql = 'SELECT * FROM members WHERE lastname = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByLogin($value){
		$sql = 'SELECT * FROM members WHERE login = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByEmail($value){
		$sql = 'SELECT * FROM members WHERE email = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByPasswd($value){
		$sql = 'SELECT * FROM members WHERE passwd = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAccessLevel($value){
		$sql = 'SELECT * FROM members WHERE access_level = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByFirstname($value){
		$sql = 'DELETE FROM members WHERE firstname = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByLastname($value){
		$sql = 'DELETE FROM members WHERE lastname = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByLogin($value){
		$sql = 'DELETE FROM members WHERE login = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByEmail($value){
		$sql = 'DELETE FROM members WHERE email = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByPasswd($value){
		$sql = 'DELETE FROM members WHERE passwd = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAccessLevel($value){
		$sql = 'DELETE FROM members WHERE access_level = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return MembersMySql 
	 */
	protected function readRow($row){
		$member = new Member();
		
		$member->memberId = $row['member_id'];
		$member->firstname = $row['firstname'];
		$member->lastname = $row['lastname'];
		$member->login = $row['login'];
		$member->email = $row['email'];
		$member->passwd = $row['passwd'];
		$member->accessLevel = $row['access_level'];

		return $member;
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
	 * @return MembersMySql 
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