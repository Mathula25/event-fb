<?php
class Delete {
	
	public $pdo;
	
	public function __construct()	{
		$this->pdo = new Sql;		
	}
	
	public function year($data = null) {
		$pub = empty($data['publisher']) ? false:$data['publisher'];
		$year = empty($data['year']) ? false:$data['year'];
		
		if($year && $pub):
			return $this->pdo->update(
				array(
					'sql' => '
					UPDATE '.$this->pdo->tblIss.'
					SET issue_status = "closed"
					WHERE 1 AND
						issue_year = "'.$year.'" AND
						issue_publisher = "'.$pub.'"
					'
				)
			);
		endif;
		return false;
	}
	
	public function pub($data = null) {
		return $this->pdo->update(
			array(
				'sql' => '
					UPDATE
						'.$this->pdo->tblPub.',
						'.$this->pdo->tblAcc.'
					SET
						pub_status = "closed",
						access_status = "closed"
					WHERE 1 AND
					pub_auto = "'.$data['publisher'].'" AND
					access_publisher = "'.$data['publisher'].'" 
				'
			)
		);
	}
	
	public function issue($data = null) {
		return $this->pdo->update(
			array(
				'sql' => '
				UPDATE '.$this->pdo->tblIss.'
				SET issue_status = "closed"
				WHERE 1 AND issue_auto = "'.$data['issue'].'"
				'
			)
		);
	}	
	
}