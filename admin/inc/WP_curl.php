<?php
class WP_curl {
	
	private $url = false;
	
	public function __construct($url)	{
		$this->url = $url;
	}
	
	public function curl($data) {
		if(
			$this->url &&
			filter_var($this->url,FILTER_VALIDATE_URL)
		):
		
			$curl = array();
			
			$ch = curl_init();	
			
			curl_setopt($ch, CURLOPT_URL,$this->url.'wp-json/readmeonline/'.$data['url']);
			
			if(!empty($data['post']))
				curl_setopt($ch, CURLOPT_POSTFIELDS,$data['post']);
				
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			
			$curl['head'] = (array) json_decode(curl_exec($ch));
			$curl['httpCode'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);	
			
			curl_close($ch);
			
			return $curl;
		endif;
		
		return false;
	}
	
	public function getCategories($data = null) {
		return $this->ret(
			$this->curl(
				array(
					'url' => 'element/?element=categories'
				)
			)
		);
	}
	
	public function url($data = null) {
		return $this->ret(
			$this->curl(
				$data
			)
		);
	}
	
	public function postByCategory($data) {
		$cats = empty($data['category']) ? "":
			'&category='.$data['category'].'';
			
		return $this->ret(
			$this->curl(
				array(
					'url' => 'element/?element=posts'.$cats
				)
			)
		);
	}
	
	public function titleForPostIds($data = array()) {
		$ret =  $this->curl(
			array(
				'url' => 'element/?element=posts&id='.serialize($data)
			)
		);	
		
		return $this->ret($ret);	
	}
	
	public function returnAsData() {
	}
	
	public function elements($data) {
		$query = $this->query($data);
		return $this->ret(
			$this->curl(
				array(
					'url' => 'element/'.$query
				)
			)
		);
	}
	
	public function query($data = null)	{		
		$glue = empty($data['glue']) ? "&":$data['glue'];		
		if(
			isset($data['query']) &&
			!empty($data['query'])
		):			
			$query = $data['query'];			
			$queryString = '?';
			$queryString .= implode(
				$glue,
				array_map(
					function($v,$k) {
						$v = is_string($v) ? $v:serialize($v);
						return $k."=".urldecode($v);
					},
					$query,
					array_keys($query)
				)
			);			
			return $queryString;			
		endif;		
		return false;		
	}
	
	public function test() {
		
	}
	
	public function postTitle($data = null) {
		return $this->ret(
			$this->curl(
				array(
					'url' => 'posts',
					'post' => $data['posts'],
					'category' => $data['categories']
				)
			)
		);
	}
	
	public function ret($data) {
		
		if($data['httpCode'] == 200)
			return $data['head'];
		
		return false;
	}
}
?>