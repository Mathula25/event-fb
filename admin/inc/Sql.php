<?php
class Sql {
	
	public $pdoCon = '';
	public $pdo = '';
	public $tblfb = 'fb_event';
	
	
	public function __construct()	{
		$this->pdoCon = new SqlConnect;
		$this->pdo = $this->pdoCon->pdo;		
	}
	
	public function select($data = null)	{
		$select = array();
		$select['query'] = 'select';
		$data['select'] = isset($data['select']) ? $data['select']:true;
		
		if(isset($data['select'])):		
			if($data['select'] === true):
				try {
					$qry = $this->pdo->query($data['sql']);
					$qry = $qry->fetchAll(PDO::FETCH_ASSOC);
					
					$select['error'] 	= false;
					$select['qryData'] 	= $qry;
					$select['errorMessage'] 	= '';
					$select['data'] 	= $data;	
					
				} catch(PDOException  $e ) {
					$select['error'] 	= true;
					$select['errorMessage'] 	= $e;
					$select['data'] 	= $data;
				}			
			elseif($data['select'] !== true):
				$select['error'] 		= true;
				$select['errorMessage'] = 'Admin error : Not allow to excute select query';
				$select['data'] 		= $data;
			endif;
		else:
			$select['error'] 	= true;
			$select['errorMessage'] 	= 'Admin error : query excute blocked';
			$select['data'] 	= $data;
		endif;
		
		return $this->ret($select);
	}
	
	public function error($message = null) {
		$message = empty($message) ? 'null':$message;
		return array(
			'error' => true,
			'message' => $message
		);
	}
	
	public function insertLastId() {
		return $this->select('SELECT LAST_INSERT_ID()');
	}
	
	public function update($data = null)	{
		$update['query'] = 'update';		
		$data['update'] = isset($data['update']) ? $data['update']:true;
		
		if(isset($data['update'])):		
			if($data['update'] === true):
				try {
					$qry = $this->pdo->prepare($data['sql']);
					$co = $qry->execute();
					
					$update['error'] = false;
					$update['errorMessage'] = '';
					$update['data'] = $data;
					$update['updateStuatus'] = $co;
					
				} catch (PDOException  $e ) {
					$update['error'] = true;
					$update['errorMessage'] = $e;
					$update['data'] 		= $data;
				}	
			elseif($data['update'] !== true):
				$update['error'] 		= true;
				$update['errorMessage'] = 'Admin error : Not allow to excute select query';
				$update['data'] 		= $data;				
			endif;
		else:
			$update['error'] 		= true;
			$update['errorMessage'] = 'Admin error : query excute blocked';
			$update['data'] 		= $data;
		endif;
		
		return $this->ret($update);
	}
	
	public function insert($data = null) {
		
		$insert['query'] = 'insert';
		$data['insert'] = isset($data['insert']) ? $data['insert']:true;
		
		if(isset($data['insert'])):		
			if($data['insert'] === true):
				try {
					$ins = $this->pdo->prepare($data['sql']);
					$ins = $ins->execute();
					
					$insert['error'] 	= false;
					$insert['lastId'] 	= $this->pdo->lastInsertId();
					$insert['last'] 	= $this->pdo->lastInsertId();
					$insert['qryData'] 	= $ins;
					$insert['errorMessage'] 	= '';
					$insert['data']		= $data;
					
				} catch (PDOException  $e ){
					$insert['error'] 	= true;
					$insert['errorMessage'] 	= $e;
					$insert['data'] 	= $data;				
				}
			elseif($data['insert'] !== true):
				$insert['error'] 	= true;
				$insert['errorMessage'] = 'Admin error : not allow to execute query';
				$insert['data'] 	= $data;			
			endif;
		else:			
			$insert['error'] 	= true;
			$insert['errorMessage'] 	= 'Admin error : No query mode';
			$insert['data'] 	= $data;
		endif;
		
		return $this->ret($insert);
	}
	
	public function delete($data = null) {
		$delete['query'] = 'delete';
		$data['delete'] = isset($data['delete']) ? $data['delete']:true;
		
		if(isset($data['delete'])):		
			if($data['delete'] === true):
				try {
					$ins = $this->pdo->prepare($data['sql']);
					$ins = $ins->execute();
					
					$delete['error'] 	= false;
					$delete['qryData'] 	= $ins;
					$delete['errorMessage'] = '';
					$delete['data']		= $data;
					
				} catch (PDOException  $e ){
					$delete['error'] 	= true;
					$delete['errorMessage'] 	= $e;
					$delete['data'] 	= $data;				
				}
			elseif($data['insert'] !== true):
				$delete['error'] 	= true;
				$delete['errorMessage'] = 'Admin error : not allow to execute query';
				$delete['data'] 	= $data;			
			endif;
		else:			
			$delete['error'] 	= true;
			$delete['errorMessage'] 	= 'Admin error : No query mode';
			$delete['data'] 	= $data;
		endif;
		
		return $this->ret($delete);
	}
	
	
	
	public function ret($data = null) {
		$return = array();
		
		$return['error'] = isset($data['error']) ? $data['error']:true;			
		$return['errorMessage'] = $data['errorMessage'];
		$return['rows'] = isset($data['qryData']) ? count($data['qryData']):0;
		isset($data['data']['qry']) ? $return['qryData'] = $data['data']:'';
			
		$return['data'] = false;
		
		if($data['query'] == 'select'):
			if($return['rows']):
				if(isset($data['json']) && $return['rows'] == 1):
					$return['qryJson'] = $this->arrayToJson($data['qryData'][0]);
				else:
					$return['rows'] > 1 ?
						$return['data'] = $data['qryData']:
						(
						$return['rows'] == 1 && isset($data['data']['limit'])  ?
							$return['data'] = $data['qryData'][0]:
							$return['data'] = $data['qryData']
						);
				endif;
			else:
				$return['error'] = true;
				$return['errorMessage'] = 'no rows selected';
				unset($return['rows'],$return['data']);
			endif;
			
		elseif($data['query'] == 'update'):
			unset($return['data'],$return['rows']);
			isset($update['updateStuatus']) ? $return['updated'] = $update['updateStuatus']:false;
		elseif($data['query'] == 'delete'):
			$return['errorMessage'] = $data['errorMessage'];
			unset($return['data'],$return['rows']);
			
		elseif($data['query'] == 'insert'):
			unset($return['data'],$return['rows']);
			$return['errorMessage'] = $data['errorMessage'];
			isset($data['lastId']) ? $return['lastId'] = $data['lastId']:'';			
		endif;
		
		return $return;
	}
	
	public function arrayToJson($array) {
		return @json_decode(json_encode($array));
	}

	
	public function insertField($data = null) {
		
		$field = array_keys($data['insertFields']);		
		$values = array_values($data['insertFields']);	
		
		$fields = ' (';
		$fields .= implode(',', array_map(
				function ($v, $k) { return $v; }, 
				$field, 
				array_keys($field)
			));
		$fields .= ') VALUES (';
		
		$fields .= implode(',', array_map(
			function ($v, $k) {
				if(is_int($v)) $val = $v;
				elseif($v === 'null') $val = 'NULL';
				else $val = "\"".addslashes($v)."\"";
				return $val;
			}, 
			$values, 
			array_keys($values)
		));
		
		$fields .= ') ';
			
		return $fields;		
	}
	
	public function updateField($data = null)	{		
		$updateField = '';
		if(isset($data['updateFields']) && count($data['updateFields'])):
			
			$data['updateField'] = 
				isset($data['updateField']) ? 
				$data['updateField']:$data['updateFields'];
			
			$updateField = 'SET ';			
			$updateField .= implode(', ', array_map(
				function ($v, $k) {
					if(is_int($v)) $val = $v;
					elseif($v === 'null') $val = 'NULL';
					else $val = "\"".addslashes($v)."\"";
					return $k . ' = '.$val.'';
				}, 
				$data['updateField'], 
				array_keys($data['updateField'])
			));		
		endif;		
		return $updateField;
	}
	
	public function duplicate($data = null) {
		$updateField = '';
		if(
			(isset($data['insertFields']) && count($data['insertFields']))
			):
					
			$updateField .= implode(', ', array_map(
				function ($v, $k) {
					if(is_int($v)) $val = $v;
					elseif($v === 'null') $val = 'NULL';
					else $val = "\"".$v."\"";
					return $k . ' = '.$val.'';
				}, 
				$data['insertFields'], 
				array_keys($data['insertFields'])
			));		
		endif;		
		return $updateField;
	}
	
	public function updateFields($data = null) {
		return $this->updateField($data);
	}
		
	public function insertFields($data = null) {
		return $this->insertField($data);
	}
		
	public function fields($data = null) {
		if(isset($data['fields']) && is_array($data['fields']) && count($data['fields'])):
			$fields = implode(',',$data['fields']);
		else:
			$fields = '*';
		endif;
				
		return $fields;
	}
	
	public function order($data = null)	{		
		$order = '';
		if(isset($data['order']) && count($data['order'])):
		
			$order = 'ORDER BY ';			
			$order .= implode(', ', array_map(
				function ($v, $k) {
					$val = is_array($v) ? ' FIELD('.$k.','.$this->toText($v).')':$k.' '.$v;
					return $val;
				}, 
				$data['order'], 
				array_keys($data['order'])
			));		
		endif;
		return $order;	
	}
	
	public function group($data = null)	{		
		if(isset($data['group']) && is_array($data['group']) && count($data['group'])):
			$group = 'GROUP BY '.implode(',',$data['group']);
		else: $group = '';
		endif;		
		return $group;		
	}
	
	public function toText($data = null) {
		$toText = '';
		if(is_array($data) && count($data)):
			$toText = implode(', ', array_map(
				function ($v, $k) {
					$val = is_int($v) ? $v:'"'.$v.'"';					
					return $val;
				}, 
				$data, 
				array_keys($data)
			));	
		endif;
		return $toText;
	}
	
	public function getTables() {
		return $this->pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);				
	}
	
	public function getTableFields($data = null) {
		$q = $this->pdo->query('DESCRIBE  '.$data['table'].'');
		return $q->fetchAll(PDO::FETCH_COLUMN);
	}
	
	public function where($data = null) {
		return (isset($data['where']) && $data['where']) ? ' AND ' . $data['where']:'';
	}
}