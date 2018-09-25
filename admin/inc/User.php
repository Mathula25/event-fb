<?php
class User {
	
	public $pdo;
	public $Session;
	public $currentUsers = array();
	
	public function __construct()	{
		$this->pdo = new Sql;
		$this->Session = new Session;
	}
	
	public function login($data) {
		$name = empty($data['name']) ? false:$data['name'];
		$pass = empty($data['pass']) ? false:$data['pass'];
		
		if(!empty($name)):
			return $this->pdo->select(
				array(
					'limit' => 1,
					'sql' => '
					select
						user_auto as ID,
						user_unique as uni,
						user_id as user,
						user_password,
						user_id
					FROM '.$this->pdo->tblUse.'
					WHERE 1 AND
					user_status = "active" AND
					(user_email = "'.$name.'" || user_id = "'.$name.'" || user_name = "'.$name.'")
					LIMIT 1
					',
					'qry' => true
				)
			);			
			
		endif;
		
		return array('error' => true);
	}
	
	public function createNew($data = null) {
		return $this->pdo->insert(
			array(
				'sql' => '
					INSERT INTO '.$this->pdo->tblUse.'
					'.$this->pdo->insertFields($data).'
				'
			)
		);
	}
	
	public function withEmail($email) {
		if(filter_var($email,FILTER_VALIDATE_EMAIL)):
			return $this->pdo->select(
				array(
					'limit' => 1,
					'sql' => '
						SELECT *
						FROM '.$this->pdo->tblUse.'
						WHERE 1 AND user_email = "'.$email.'"
						LIMIT 1
					'
				)
			);		
		endif;
		return false;		
	}
	
	public function withId($id) {
		if(!empty($id)):
			return $this->pdo->select(
				array(
					'limit' => 1,
					'sql' => '
						SELECT *
						FROM '.$this->pdo->tblUse.'
						WHERE 1 AND user_auto = "'.$id.'"
						LIMIT 1
					'
				)
			);		
		endif;
		return false;
	}
	
	public function user($data = null) {		
		if(!empty($data) && !$data['error']):
			return (object)$data['data'];
		endif;
		return false;
	}
	
	public function activeUser() {
		if(isset($_SESSION['active']) && count($_SESSION['active'])):
			return (object)$_SESSION['active'];
		elseif(isset($_SESSION['rmove']) && count($_SESSION['rmove'])):
			
		else:
			unset($_SESSION['rmove']);	
			unset($_SESSION['active']);		
		endif;
		return false;
	}
	
	public function loginToRmo($data = null) {
		$ret = array();
		$ret['error'] = true;
		
		$log = $this->login($data);
		
		if(!$log['error']):
			
			$log = $log['data'];
			
			$userLogin = false;
			
			if(
				$log['user_password'] == $data['pass']
			):
				$cSession = hash("md5",uniqid());
				
				$session = $this->Session->login(
					array(
						'insertFields' => array(
							'session_user' => $log['ID'],
							'session_hash' => $cSession
						),
						'qry' => true
					)
				);
				
				unset($log['user_password']);
				
				if(!$session['error']):
					$_SESSION['active'] = $log;
					$_SESSION['rmove'][$log['ID']] = $log;
					$_SESSION['rmove'][$log['ID']]['hash'] = $cSession;
					$ret['error'] = false;
				else:
					$res['message'] = 'Error on update session';
				endif;
			else:
				$res['message'] = 'Invalid password';
			endif;
		else:
			$ret['message'] = 'null';
		endif;
		
		return $ret;
	}
	
	public function validUserForLogin() {
		if(isset($_SESSION['rmove']) && count($_SESSION['rmove'])):
			
			$loginUsers = $_SESSION['rmove'];
			
			$users = array();
			$loginValidUsers = array();
			
			foreach($loginUsers as $l => $u):
				$users[] = $u['ID'];
			endforeach;
			
			$validUser = $this->IDs(
				array(
					'users' => $users
				)
			);
			
			if(!$validUser['error']):
				$validUser = $validUser['data'];
				
				foreach($validUser as $v => $u):
					$loginValidUsers[$u['ID']] = $u['ID'];
				endforeach;
			
				foreach($loginUsers as $v => $u):
					if(!isset($loginValidUsers[$u['ID']])):
						unset($_SESSION['rmove'][$u['ID']]);
					else:
						$this->currentUsers[] = $u['ID'];
					endif;
				endforeach;
				
				if(count($_SESSION['rmove'])):
					return true;
				endif;
				
			else:
				unset($_SESSION['rmove']);
			endif;
								
		endif;
		unset($_SESSION['rmove']);
		return false;
	}
	
	public function IDs($data = null) {				
		$user = isset($data['users']) && is_array($data['users']) ? 
				$this->pdo->toText($data['users']):
				false;			
		
		$user = $user ? " AND user_auto IN (".$user.")":false;
		
		if($user):
			return $this->pdo->select(
				array(
					'sql' => '
					SELECT user_auto as ID,user_status as status
					FROM '.$this->pdo->tblUse.'
					WHERE 1 AND user_status = "active" '.$user.'
					',
					'qry' => true
				)
			);
		endif;
		return false;
	}
}
?>