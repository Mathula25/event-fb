<?php

class WP_connect {
	
	public $pdo;
	public $connected = false;
	public $tp = ''; // table prefix
	
	public function __construct($data)	{
		if($data):
			$this->tp = isset($data['Tableprefix']) && $data['Tableprefix'] ? $data['Tableprefix']:"wp_";
			try {			
				$this->pdo = new PDO('mysql:host='.$data['host'].';dbname='.$data['database'].';charset=utf8',$data['username'],$data['password']);
				
				$this->pdo->exec( "SET CHARACTER SET utf8" );
				
				$this->pdo->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
				$this->pdo->setAttribute( PDO::ATTR_PERSISTENT, true );						
				
				$this->connected = true;
				
			} catch (PDOException $e) {
				return $this->connected;
				die();
			}
		else:
			return $this->connected;
		endif;
	}
	
	public function query($data) {		
		$query = $this->pdo->query('SELECT * FROM '.$this->tp.'links');
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function showTable() {
		$qry = $this->pdo->query('SHOW TABLES');
		return $qry->fetchAll(PDO::FETCH_ASSOC);
		
	}
	
	public function wpCategory($data = null) {
		$category = $this->pdo->query('
			SELECT *
			FROM '.$this->tp.'terms
			LEFT JOIN '.$this->tp.'term_taxonomy ON
				'.$this->tp.'term_taxonomy.term_id = '.$this->tp.'terms.term_id
			WHERE 1 AND
			taxonomy = "category"
			ORDER BY parent,name
			'
		);
		
		if($category):
			return $category->fetchAll(PDO::FETCH_ASSOC);
		endif;
		
		return array();
	}
	
	public function loadPostViaCategory($data = null) {
		
		$chooseCategery = (isset($data['category']) && !empty($data['category'])) ? 'AND t.term_id = '.$data['category'].'':"";
		//
		$query = $this->pdo->query('
			SELECT p.ID, t.term_id,p.post_title,p.post_type,tax.taxonomy,m.meta_value,m.meta_key
			FROM '.$this->tp.'posts p
			LEFT JOIN '.$this->tp.'term_relationships rel ON 
				rel.object_id = p.ID
			LEFT JOIN '.$this->tp.'term_taxonomy tax ON 
				tax.term_taxonomy_id = rel.term_taxonomy_id
			LEFT JOIN '.$this->tp.'terms t ON 
				t.term_id = tax.term_id
			LEFT JOIN '.$this->tp.'postmeta m ON
				p.ID = m.post_id AND m.meta_key = "premiumArticle"
			WHERE 1 AND
			p.post_type IN ("post") AND
			p.post_status = "publish" AND
			tax.taxonomy = "category" '.$chooseCategery.'			
			GROUP BY p.ID
			ORDER BY p.post_title
		');
		
		if($query):
			return $query->fetchAll(PDO::FETCH_ASSOC);
		endif;
		
		return array();
	}
	
	public function wpSelectedPost($data = null) {
		
		$postID = (is_array($data['ID']) && isset($data['ID'])) ?
			" AND p.ID IN (".$this->toText($data['ID']).") 
				ORDER BY FIELD (p.ID,".$this->toText($data['ID']).")":"";
		if($postID):
			$query = $this->pdo->query('
				SELECT '.$this->fields($data).'
				FROM '.$this->tp.'posts p
				RIGHT JOIN '.$this->tp.'users u ON
					p.post_author = u.ID
				WHERE 1	
				'.$postID.'
			');
			if($query):
				return $query->fetchAll(PDO::FETCH_ASSOC);
			endif;
		endif;		
		return false;
	}
	
	public function wpPostThumbnail($data = null) {
		$metaData = $this->pdo->query(
			'SELECT *
			FROM '.$this->tp.'postmeta
			WHERE 1 AND
			post_id IN (
				SELECT meta_value
				FROM '.$this->tp.'postmeta
				WHERE 1 AND
				(meta_key = "_thumbnail_id" || meta_key = "_'.$this->tp.'attached_file") AND
				post_id = "'.$data['ID'].'"
			) OR post_id = "'.$data['ID'].'"
			LIMIT 30
			'
		);
		
		if($metaData):
			return $metaData->fetchAll(PDO::FETCH_ASSOC);		
		endif;		
		
		return array();
	}
	
	public function wpFeaturedImage($data = null) {
		$fi = array();
		$query = $this->pdo->query('
			SELECT guid,post_excerpt
			FROM '.$this->tp.'posts
			WHERE 1 AND
			ID = (
				SELECT meta_value
				FROM '.$this->tp.'postmeta
				WHERE 1 AND
				post_id = '.$data['ID'].' AND
				meta_key = "_thumbnail_id"
			)
		');
		
		if($query):
			$query = $query->fetchAll(PDO::FETCH_ASSOC);
			if(count($query)):
				$query = $query[0];
				$fi['url'] = $query['guid'];
				$fi['excerpt'] = $query['post_excerpt'];				
				return $fi;
			else:
				return false;
			endif;
		endif;		
		
		return false;
	}
	
	
	public function wpAllPosts($data = null) {
	
		$query = $this->pdo->query('
			SELECT p.ID, t.term_id,p.post_title,p.post_type,tax.taxonomy,m.meta_value,m.meta_key
			FROM '.$this->tp.'posts p
			LEFT JOIN '.$this->tp.'term_relationships rel ON 
				rel.object_id = p.ID
			LEFT JOIN '.$this->tp.'term_taxonomy tax ON 
				tax.term_taxonomy_id = rel.term_taxonomy_id
			LEFT JOIN '.$this->tp.'terms t ON 
				t.term_id = tax.term_id
			LEFT JOIN '.$this->tp.'postmeta m ON
				p.ID = m.post_id AND m.meta_key = "premiumArticle"
			WHERE 1 AND
			p.post_type IN ("post") AND
			p.post_status = "publish"
			GROUP BY p.ID
			ORDER BY p.post_title
		');
		
		if($query):
			return $query->fetchAll(PDO::FETCH_ASSOC);
		endif;
		
		return array();  
		/*  
		$query = $this->pdo->query('
			SELECT *
			FROM '.$this->tp.'posts p
			LEFT JOIN '.$this->tp.'term_relationships rel ON 
				rel.object_id = p.ID
			LEFT JOIN '.$this->tp.'term_taxonomy tax ON 
				tax.term_taxonomy_id = rel.term_taxonomy_id
			LEFT JOIN '.$this->tp.'terms t ON 
				t.term_id = tax.term_id
			LEFT JOIN '.$this->tp.'postmeta m ON
				p.ID = m.post_id AND m.meta_key = "premiumArticle"
			WHERE 1 AND
			p.post_type NOT IN ("page","revision") AND
			p.post_status IN ("publish") AND
			tax.taxonomy = "category"
			ORDER BY p.post_date DESC
			LIMIT 30
		');
		
		if($query):
			return $query->fetchAll(PDO::FETCH_ASSOC);
		endif;
		
		return array();
		*/
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
	
	public function fields($data = null) {
		if(isset($data['fields']) && is_array($data['fields']) && count($data['fields'])):
			$fields = implode(',',$data['fields']);
		else:
			$fields = '*';
		endif;
				
		return $fields;
	}
	
}
?>