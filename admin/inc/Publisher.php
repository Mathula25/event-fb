<?php

class Publisher {
	
	public $pdo;
	
	public function __construct()	{
		$this->pdo = new Sql;
	}
	
	
	public function publishers($data = array()) {
		return $this->pdo->select(
			array_merge(
				$data,
				array(
					'sql' => '
						SELECT '.$this->pdo->fields($data).'
						FROM '.$this->pdo->tblPub.'
						WHERE 1 
						'.$this->pdo->order($data).'
					'
				)
			)
		);
	}
	
	public function data($data) {		
		$ret = array();		
		if(!$data['error']):
			$data = $data['data'];
			
			$ret['ID'] = $data['pub_auto'];
			$ret['name'] = $data['pub_name'];
			$ret['active'] = $data['pub_status'];
			$ret['folder'] = $data['pub_folder'];
			$ret['user'] = empty($data['pub_user']) ? false:$data['pub_user'];
			
			$setting = empty($data['pub_settings']) ? false:$data['pub_settings'];
			$setting = @unserialize($data['pub_settings']) ? 
				(object)unserialize($data['pub_settings']):$data['pub_settings'];
			
			$ret['curl'] = empty($setting->setting->npccurl) ? false:$$setting->setting->npccurl;			
			$ret['default'] = empty($setting->setting->default) ? false:$$setting->setting->default;
			//unset($setting->setting->default);
			//unset($setting->setting->npccurl);
						
			$setting ? $ret['setting'] = $setting:"";			
			return (object)$ret;
			
		endif;
		
		return false;
	}
	
	public function Delete($data = array()) {		
	}
	
	public function issues($data = array()) {
		return $this->pdo->select(
			array_merge(
				$data,
				array(
					'limit' => 1,
					'sql' => '
						SELECT '.$this->pdo->fields($data).'
						FROM '.$this->pdo->tblPub.' p
						LEFT JOIN digital_issues i ON 
							i.issues_publisher = p.pub_auto
						WHERE 1
						ORDER BY pub_name,issues_year,issues_name
					'
				)
			)
		);
	}
	
	public function settingText($data = null) {
		return isset($data['text']) && isset($data['setting'][$data['text']]) ? $data['setting'][$data['text']]:false;
	}
	
	public function isId($data = array()) {
		return $this->pdo->select(
			array_merge(
				$data,
				array(
					'limit' => 1,
					'sql' => '
						SELECT '.$this->pdo->fields($data).'
						FROM '.$this->pdo->tblPub.'
						WHERE 1 AND pub_auto = "'.$data['publisher'].'"
						LIMIT 1
					'
				)
			)
		);
	}
	
	public function isUsedName($data = array()) {
		if(!empty($data['name'])):
			return $this->pdo->select(
				array_merge(
					$data,
					array(
						'limit' => 1,
						'sql' => '
							SELECT '.$this->pdo->fields($data).'
							FROM '.$this->pdo->tblPub.'						
							WHERE 1 AND pub_name = "'.$data['name'].'"
							LIMIT 1
						'
					)
				)
			);
		endif;
		return array('error' => 'true','message' => 'Name is empty');
	}
	
	public function menu($data = null) {
		if(empty($data)) return;
		
		$setting = (array)$this->publisherSetting($data);
		
		if(empty($setting['menus']))
			return;
			
		return json_decode($setting['menus']);
	}
	
	public function name($data = null) {
		if(isset($data['pub_name'])):
			return $data['pub_name'];		
		endif;
		return false;
	}
		
	public function publisherDetailsText($data = null) {
		return $this->publisherSetting($data);
	}
	
	public function update($data = array()) {		
		return $this->pdo->update(
			array_merge(
				$data,
				array(
					'sql' => '
					UPDATE '.$this->pdo->tblPub.'
					'.$this->pdo->updateFields($data).'
					WHERE 1 AND pub_auto = '.$data['publisher'].'						
					'
				)
			)
		);
	}
	
	public function ID($data){
		return $this->isId($data);
	}
	
	public function folder() {
		
	}
	
	public function setting($data) {		
		if(empty($data['pub_settings'])):
			return false;
		else:
			return (object)unserialize($data['pub_settings']);
		endif;	
	}
	
	
	public function create($data = array()) {		
		return $this->pdo->insert(
			array_merge(
				$data,
				array(
					'sql' => '
						INSERT INTO '.$this->pdo->tblPub.'
						'.$this->pdo->insertFields($data).'
					'
				)
			)
		);
	}
		
	public function isPublisher($data = array()) {		
		return $this->pdo->select(
			array_merge(
				$data,
				array(
					'limit' => 1,
					'sql' => '
						SELECT '.$this->pdo->fields($data).'
						FROM '.$this->pdo->tblPub.'
						WHERE 1 AND pub_auto = "'.$data['publisher'].'"
						LIMIT 1
					'
				)
			)
		);
		
		if(isset($data['details']) && $data['details'] == true):
			return $pub;
		elseif(!$pub['error']):
			return true;
		endif;
	}
}