<?php

class Issue {
	
	public $pdo;
	
	public function __construct()	{
		$this->pdo = new Sql;
	}
	
	public function issuesCreate($data = array()) {
		return $this->pdo->insert(
			array_merge(
				$data,
				array(
					'sql' => '
						INSERT INTO '.$this->pdo->tblIss.'
						'.$this->pdo->insertFields($data).'
					'
				)
			)
		);
	}
	
	public function issueActDeact($data = null) {
		$act = $this->pdo->update(
			array(
				'sql' => '
					UPDATE '.$this->pdo->tblIss.'
					SET issue_active = "'.$data['active'].'"
					WHERE 1 AND
					issue_auto = "'.$data['issue'].'"
				'
			)
		);
		
		if(!$act['error']):
			return true;
		else:
			return false;
		endif;
	}
	
	public function issuesSetting() {
		if(isset($data['error']) && !$data['error']):
			$pub = $data['data'];
			return (object) json_decode($pub['issue_settings']);
		endif;
		
		return false;
	}
	
	public function issuesUpdateWithId($data = array()) {
		return $this->pdo->update(
			array_merge(
				$data,
				array(
					'sql' => '
					UPDATE '.$this->pdo->tblIss.'
					'.$this->pdo->updateFields($data).'
					WHERE 1 AND issue_auto = '.$data['issue'].'						
					'
				)
			)
		);
	}
	
	public function updateWithId($data = null) {
		return $this->issuesUpdateWithId($data);
	}
	
	
	public function issueWithUrl($data = null) {
		return $this->pdo->select(
			array_merge(
				$data,
				array(
					'sql' => '
						SELECT '.$this->pdo->fields($data).'
						FROM '.$this->pdo->tblIss.'
						WHERE 1 AND
						issue_url like "%'.$data['url'].'%"
						ORDER BY issue_year
					'
				)
			)
		);
	}
	
	public function withUrl($data) {
		return $this->issueWithUrl($data);
	}
	
	public function issuesPublisher($data = array()) {
		return $this->pdo->select(
			array_merge(
				$data,
				array(
					'limit' => 1,
					'sql' => '
						SELECT '.$this->pdo->fields($data).'
						FROM '.$this->pdo->tblPub.' 
						LEFT JOIN '.$this->pdo->tblIss.' ON
							'.$this->pdo->tblPub.'.pub_auto = '.$this->pdo->tblIss.'.issue_publisher
						WHERE 1 AND
						issue_auto = '.$data['issue'].' AND
						pub_auto = '.$data['publisher'].'
					'
				)
			)
		);
	}
	
	public function wpPostList($data) {
		
		$posts = array();
		
		$postOrder = !trim($data['issue_page_order']) ?
			false:
			$data['issue_page_order'];
		
		$postOrder = json_decode($postOrder);
		
		if(!empty($postOrder)):
			foreach($postOrder as $post => $order):
				$order->wp ? $posts[] = $order->id:false;
			endforeach;
		endif;
		
		return $posts;
	}
	
	public function isIssue($data) {
		$data['fields'] = array('issue_auto','issue_publisher');
		$data = $this->issuesPublisher($data);
		if(!$data['error']):			
			return true;
		endif;
		return false;
	}
		
	public function issuesWithId($data = array()) {
		return $this->pdo->select(
			array_merge(
				$data,
				array(
					'limit' => true,
					'sql' => '
						SELECT '.$this->pdo->fields($data).'
						FROM '.$this->pdo->tblIss.'
						WHERE 1 AND
						issue_auto = "'.$data['issue'].'"
						LIMIT 1
					'
				)
			)
		);
	}
	
	public function issuesSelect($data = array()) {
		return $this->pdo->select(
			array_merge(
				$data,
				array(
					'limit' => true,
					'sql' => '
						SELECT '.$this->pdo->fields($data).'
						FROM '.$this->pdo->tblIss.'
						WHERE 1 AND
						issue_publisher = "'.$data['publisher'].'" AND
						issue_name = "'.$data['name'].'" AND
						(issue_year = "'.$data['year'].'" || issue_year IS NULL)
						LIMIT 1
					'
				)
			)
		);
	}
	
	public function issuesFromWP($data = array()) {
		$data['fields'] = array(
			'issues_sp'
		);
		$fromWp = $this->issuesWithId($data);
		
		if(!$fromWp['error']):
			$fromWp = $fromWp['data'];
			return $fromWp['issue_wp'];
		else:
			return 0;
		endif;
		
		return false;		
	}
	
	public function issuesList($data = array()) {
		$users = isset($data['users']) && is_array($data['users']) ?
			' AND access_user IN ('.$this->pdo->toText($data['users']).')':
			(
				isset($data['users']) && !is_array($data['users']) ?
				' AND access_user = "'.$data['users'].'"':''
			);
			
		return $this->pdo->select(
			array_merge(
				$data,
				array(
					'sql' => '
						SELECT '.$this->pdo->fields($data).'
						FROM '.$this->pdo->tblPub.'
							LEFT JOIN '.$this->pdo->tblIss.' ON
							'.$this->pdo->tblPub.'.pub_auto = '.$this->pdo->tblIss.'.issue_publisher AND issue_status NOT IN ("closed")
							
							LEFT JOIN '.$this->pdo->tblAcc.' ON 
							'.$this->pdo->tblPub.'.pub_auto = '.$this->pdo->tblAcc.'.access_publisher AND access_status = "active"			
											
						WHERE 1 AND
							pub_status NOT IN ("closed")
							'.$users.'
						'.$this->pdo->order($data).'
					'
				)
			)
		);
			
	}
	
	public function usedName($data = null) {
		if($data)
		return $this->pdo->select(
			array_merge(
				$data,
				array(
					'limit' => true,
					'sql' => '
						SELECT '.$this->pdo->fields($data).'
						FROM '.$this->pdo->tblIss.'
						WHERE 1 AND
						issue_publisher = "'.$data['publisher'].'" AND
						issue_name = "'.$data['name'].'"
						LIMIT 1
					'
				)
			)
		);
		
		return false;
	}
}