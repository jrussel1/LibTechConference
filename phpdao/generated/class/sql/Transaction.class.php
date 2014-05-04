<?php
/**
 * Database transaction
 *
 * @author: Benjamin Hillmann
 * @date: 3/24/2014
 */
class Transaction{
	private static $transactions;

	private $dbh;

	public function Transaction(){
		$this->dbh = new DatabaseHandle();
		if(!Transaction::$transactions){
			Transaction::$transactions = new ArrayList();
		}
		Transaction::$transactions->add($this);
		$this->dbh->executeQuery('BEGIN');
	}

	/**
	 * Execute a commit query
	 */
	public function commit(){
		$this->dbh->executeQuery('COMMIT');
		$this->dbh = null;
		Transaction::$transactions->removeLast();
	}

	/**
	 * Execute a rollback query
	 */
	public function rollback(){
		$this->dbh->executeQuery('ROLLBACK');
        $this->dbh = null;
		Transaction::$transactions->removeLast();
	}

	/**
	 * Return the dbh
	 *
	 * @return dbh
	 */
	public function getDbh(){
		return $this->dbh;
	}

	/**
	 * Get the current transaction
	 *
	 * @return current transaction
	 */
	public static function getCurrentTransaction(){
		if(Transaction::$transactions){
			$tran = Transaction::$transactions->getLast();
			return $tran;
		}
		return;
	}
}
?>