<?php
class Pagedetails {
	
	public $pdo;
	
	public function __construct()	{
		$this->pdo = new Sql;		
		//print_r($this->pdo->getTableFields(array('table' => 'pages')));
	}
	
	public function pageDetail($data = null) {
		return $this->pdo->ret(
			$this->pdo->select(
				array_merge(
					$data,
					array(
						'limit' => 1,
						'sql' => '
							SELECT '.$this->pdo->fields($data).'
							FROM '.$this->pdo->tblPag.'
							WHERE 1 AND page_auto = '.$data['page'].'
						'
					)
				)
			)
		);
	}
	
	public function pageForIssues($data = null) {
		return $this->pdo->ret(
			$this->pdo->select(
				array_merge(
					$data,
					array(
						'limit' => 1,
						'sql' => '
							SELECT '.$this->pdo->fields($data).'
							FROM '.$this->pdo->tblPag.'
							WHERE 1 AND
							page_name = "'.$data['pagename'].'" AND
							page_issue_id = "'.$data['issuesId'].'"
							LIMIT 1
						'
					)
				)
			)
		);
	}
	
	public function pageTags($data = null) {
		$pageAvtive = isset($data['active']) ? ($data['active'] == 1 ? ' AND page_active = 1':' AND page_active = 0'):'';
		return $this->pdo->ret(
			$this->pdo->select(
				array_merge(
					$data,
					array(
						'sql' => '
							SELECT '.$this->pdo->fields($data).'
							FROM '.$this->pdo->tblPag.'
							WHERE 1 AND 
							page_name IN ('.$this->pdo->toText($data['in']).') AND
							page_issue_id = '.$data['issueId'].'
							'.$pageAvtive.'
						'
					)
				)
			)
		);
	}
	
	public function pageDeleteSolo($data = null) {
		return $this->pdo->ret(
			$this->pdo->delete(
				array_merge(
					$data,
					array(
						'sql' => '
							DELETE FROM '.$this->pdo->tblPag.'
							WHERE 1 AND
							page_auto = '.$data['pageId'].'
						'
					)
				)
			)
		);
	}
	
	public function pageInsert($data = null) {
		return $this->pdo->ret(
			$this->pdo->insert(
				array_merge(
					$data,
					array(
						'sql' => '
							INSERT INTO '.$this->pdo->tblPag.'
							'.$this->pdo->insertFields($data).'
							ON DUPLICATE KEY UPDATE 
							'.$this->pdo->duplicate($data).'
						'
					)
				)
			)
		);
	}
	
	public function pageUpdate($data = null) {
		return $this->pdo->ret(
			$this->pdo->update(
				array_merge(
					$data,
					array(
						'sql' => '
							UPDATE '.$this->pdo->tblPag.'
							'.$this->pdo->updateField($data).'
							WHERE 1 AND page_auto = "'.$data['page'].'"
						'
					)
				)
			)
		);
	}
	
}
?>