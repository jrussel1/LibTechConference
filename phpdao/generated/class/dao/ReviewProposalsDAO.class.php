<?php
/**
 * Intreface DAO
 *
 * @author: http://phpdao.com
 * @date: 2014-03-22 17:50
 */
interface ReviewProposalsDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @Return ReviewProposals 
	 */
	public function load($memberID, $proposalID);

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
 	 * @param reviewProposal primary key
 	 */
	public function delete($memberID, $proposalID);
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ReviewProposals reviewProposal
 	 */
	public function insert($reviewProposal);
	
	/**
 	 * Update record in table
 	 *
 	 * @param ReviewProposals reviewProposal
 	 */
	public function update($reviewProposal);	

	/**
	 * Delete all rows
	 */
	public function clean();

	public function queryByRelevancy($value);

	public function queryByTimeliness($value);

	public function queryByAnticipatedInterest($value);

	public function queryByQuality($value);

	public function queryByComments($value);


	public function deleteByRelevancy($value);

	public function deleteByTimeliness($value);

	public function deleteByAnticipatedInterest($value);

	public function deleteByQuality($value);

	public function deleteByComments($value);


}
?>