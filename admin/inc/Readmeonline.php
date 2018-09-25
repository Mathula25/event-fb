<?php
class Readmeonline {
	
	public $pdo;
	public $relation = array();
	
	public function __construct()	{
		$this->pdo = new Sql;		
	}
	
	public function relation($data = array()) {
		$defaultRelation = array(
			'parent' => array(
				'name' => 'parent',
				'title' => 'publisher'
			),
			'sc' => array(
				'name' => 'sc',
				'title' => 'year'
			),
			'me'=> array(
				'name' => 'me',
				'title' => 'issue'
			),
			'fc'=> array(
				'name' => 'fc',
				'title' => 'publisher'
			),
			'tc'=> array(
				'name' => 'tc',
				'title' => 'publisher'
			)
		);
		
		$defaultRelation = array_merge($defaultRelation,$data);
		return $defaultRelation;
	}
}