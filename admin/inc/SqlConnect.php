<?php
	class SqlConnect {
		
		public $pdo = '';
		
		public function __construct()	{
			$host	="localhost"; 
			$login	="root"; 
			$mysql_pwd	=""; 
			$database	="event";
			/*
			$host	="localhost"; 
			$login	="kulturp1_digital"; 
			$mysql_pwd	="HVD8(!KRP[J;"; 
			$database	="kulturp1_digital";
		*/
			$this->pdo = new PDO('mysql:host='.$host.';dbname='.$database.';charset=utf8', $login, $mysql_pwd);
			
			//$this->pdo = new PDO('mysql:host=localhost;dbname=readmeonline;charset=utf8','root','');
			$this->pdo->exec("set names utf8");
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		
	}
?>