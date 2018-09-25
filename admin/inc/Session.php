<?php
class Session {
	
	public $pdo;
	
	public function __construct()	{
		$this->pdo = new Sql;
	}
	
	public function login($data = null) {
		return $this->pdo->insert(
			array(
				'sql' => '
					INSERT INTO '.$this->pdo->tblSes.'
					'.$this->pdo->insertFields($data).'
				'
			)
		);
	}
	
	public function delete($data = null) {
		$delete = $this->pdo->delete(
			array(
				'sql' => '
				DELETE
				FROM '.$this->pdo->tblSes.'
				WHERE 1 AND
					session_hash = "'.$data['hash'].'" AND
					session_user = "'.$data['user'].'" 
				'
			)
		);
		
		if(!$delete['error']):
			return true;
		endif;		
		return false;
	}
}

?>