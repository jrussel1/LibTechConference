<?php
/**
 * Class that operate on table 'Review_Proposals'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
class ReviewProposalsMySqlDAO implements ReviewProposalsDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ReviewProposalsMySql 
	 */
	public function load($memberID, $proposalID){
		$sql = 'SELECT * FROM Review_Proposals WHERE Member_ID = ?  AND Proposal_ID = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($memberID);
		$sqlQuery->setNumber($proposalID);

		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM Review_Proposals';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM Review_Proposals ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param reviewProposal primary key
 	 */
	public function delete($memberID, $proposalID){
		$sql = 'DELETE FROM Review_Proposals WHERE Member_ID = ?  AND Proposal_ID = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($memberID);
		$sqlQuery->setNumber($proposalID);

		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ReviewProposalsMySql reviewProposal
 	 */
	public function insert($reviewProposal){
		$sql = 'INSERT INTO Review_Proposals (Relevancy, Timeliness, Anticipated_Interest, Quality, Comments, Member_ID, Proposal_ID) VALUES (?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($reviewProposal->relevancy);
		$sqlQuery->setNumber($reviewProposal->timeliness);
		$sqlQuery->setNumber($reviewProposal->anticipatedInterest);
		$sqlQuery->setNumber($reviewProposal->quality);
		$sqlQuery->set($reviewProposal->comments);

		
		$sqlQuery->setNumber($reviewProposal->memberID);

		$sqlQuery->setNumber($reviewProposal->proposalID);

		$this->executeInsert($sqlQuery);	
		//$reviewProposal->id = $id;
		//return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ReviewProposalsMySql reviewProposal
 	 */
	public function update($reviewProposal){
		$sql = 'UPDATE Review_Proposals SET Relevancy = ?, Timeliness = ?, Anticipated_Interest = ?, Quality = ?, Comments = ? WHERE Member_ID = ?  AND Proposal_ID = ? ';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($reviewProposal->relevancy);
		$sqlQuery->setNumber($reviewProposal->timeliness);
		$sqlQuery->setNumber($reviewProposal->anticipatedInterest);
		$sqlQuery->setNumber($reviewProposal->quality);
		$sqlQuery->set($reviewProposal->comments);

		
		$sqlQuery->setNumber($reviewProposal->memberID);

		$sqlQuery->setNumber($reviewProposal->proposalID);

		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM Review_Proposals';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByRelevancy($value){
		$sql = 'SELECT * FROM Review_Proposals WHERE Relevancy = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByTimeliness($value){
		$sql = 'SELECT * FROM Review_Proposals WHERE Timeliness = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAnticipatedInterest($value){
		$sql = 'SELECT * FROM Review_Proposals WHERE Anticipated_Interest = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByQuality($value){
		$sql = 'SELECT * FROM Review_Proposals WHERE Quality = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByComments($value){
		$sql = 'SELECT * FROM Review_Proposals WHERE Comments = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByRelevancy($value){
		$sql = 'DELETE FROM Review_Proposals WHERE Relevancy = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByTimeliness($value){
		$sql = 'DELETE FROM Review_Proposals WHERE Timeliness = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAnticipatedInterest($value){
		$sql = 'DELETE FROM Review_Proposals WHERE Anticipated_Interest = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByQuality($value){
		$sql = 'DELETE FROM Review_Proposals WHERE Quality = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByComments($value){
		$sql = 'DELETE FROM Review_Proposals WHERE Comments = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ReviewProposalsMySql 
	 */
	protected function readRow($row){
		$reviewProposal = new ReviewProposal();
		
		$reviewProposal->memberID = $row['Member_ID'];
		$reviewProposal->proposalID = $row['Proposal_ID'];
		$reviewProposal->relevancy = $row['Relevancy'];
		$reviewProposal->timeliness = $row['Timeliness'];
		$reviewProposal->anticipatedInterest = $row['Anticipated_Interest'];
		$reviewProposal->quality = $row['Quality'];
		$reviewProposal->comments = $row['Comments'];

		return $reviewProposal;
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
	 * @return ReviewProposalsMySql 
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