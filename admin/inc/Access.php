<?php

class Access {
	
	public $pdo;
	
	public function __construct()	{
		$this->pdo = new Sql;
	}
	
	public function create($data = null) {
		return 	$this->pdo->insert(
			array_merge(
				$data,
				array(
					'sql' => '
					INSERT INTO '.$this->pdo->tblAcc.'
					'.$this->pdo->insertFields($data).'
					'
				)
			)		
		);
	}
	
	public function changeStatus($data = null) {
		return $this->update(
			array(
				'publisher' => $data['publisher'],
				'user' => $data['user'],
				'updateFields' => array(
					"access_status" => $data["status"]
				),
				'access' => $data['access']
			)
		);
	}
	
	public function isAccessForUser($data = null) {
		return $this->pdo->select(
			array(
				'sql' => '
					SELECT '.$this->pdo->fields($data).'
					FROM '.$this->pdo->tblAcc.'
					WHERE 1 AND
						access_publisher = "'.$data['publisher'].'" AND
						access_user = "'.$data['user'].'"
					LIMIT 1
				',
				'limit' => 1
			)
		);
	}
	
	public function update($data = null) {
		return $this->pdo->update(
			array(
				'sql' => '
				UPDATE '.$this->pdo->tblAcc.'
				'.$this->pdo->updateFields($data).'
				WHERE 1 AND access_auto = "'.$data['access'].'"
				',
				'qry' => true
			)
		);
	}
	
	public function set($data) {
		
		$User = new User;
		
		if(isset($data['data'])):
			if(filter_var($data['data'],FILTER_VALIDATE_EMAIL)):
				$user = $User->withEmail($data['data']);
				
				if(!$user['error']):
					
					$user = $user['data'];
					
					$haveAccess = $this->isAccessForUser(
						array(
							'publisher' => $data['publisher'],
							'user' => $user['user_auto']
						)
					);
																		
					if(!$haveAccess['error']):		
						
						$haveAccess = $haveAccess['data'];
						
						$updateAccess = $this->update(
							array(
								'updateFields' => array(
									'access_level' => $data['level']
								),
								'access' => $haveAccess['access_auto']
							)
						);
						
						if(!$updateAccess['error']):							
							return $this->pdo->error('Updated access level');
						else:
							return $this->pdo->error('On update access level');
						endif;		
						
					else:
						$cAccess = $this->create(
							array(
								'insertFields' => array(
									'access_level' => $data['level'],
									'access_publisher' => $data['publisher'],
									'access_user' => $user['user_auto']
								)
							)
						);
						
						if(!$cAccess['error']):
							return true;
						endif;
					endif;
				else:
					if(isset($_SESSION['active']['ID'])):
						$AddNewUser = $User->createNew(
							array(
								'insertFields' => array(
									'user_email' => $data['data'],
									'user_status' => "active",
									'user_password' => '123456',
									'user_owner' => $_SESSION['active']['ID'],
									'user_unique' => uniqid(),
									'user_key' => md5(uniqid())
								)
							)
						);
						
						if(!$AddNewUser['error']):
							$cAccess = $this->create(
								array(
									'insertFields' => array(
										'access_level' => $data['level'],
										'access_publisher' => $data['publisher'],
										'access_user' => $AddNewUser['lastId']
									)
								)
							);
							
							if(!$cAccess['error']):
								return $cAccess;
							endif;
							
						else:
							return $this->pdo->error('error on create new user');
						endif;						
					else:
						return $this->pdo->error('Invalid user for create new access');
					endif;
				endif;
			else:
				return $this->pdo->error('Invalid email');
			endif;
		endif;
		
		return $this->pdo->error('In set new access');
	}
	
	public function forPublisher($data = null) {
		return $this->pdo->select(
			array(
				'sql' => '
					SELECT '.$this->pdo->fields($data).'
					FROM '.$this->pdo->tblAcc.' a
					LEFT JOIN '.$this->pdo->tblUse.' u ON
						a.access_user = u.user_auto
					WHERE 1 AND
					access_status IN ("active","pending","inactive") AND
					access_publisher = '.$data['publisher'].'
				'
			)
		);
	}
}
?>