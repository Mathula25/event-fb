<?php
//if($_SERVER['REQUEST_METHOD'] === "POST"):
	include '../inc/autoload.php';

	$User = new User;
	$Sql = new Sql;
	
	
	$requiredFields = array_fill_keys(
		array(
			'id',
			'name',
			'location',
			'date',
			'time',
			'start',
			'end',
			'starttime',
			'endtime',
			'description',
			'invite',
			'guest',		
		),null
	);
	
	extract(
		array_intersect_key(
			array_merge(
				$requiredFields,
				$_POST
			),
			$requiredFields
		)

	);
	$updates = array(
					'updateFields' => array(
						'name' => ''.$name.'',
						'start_date' => ''.$start.'',
						'start_time' => ''.$starttime.'',
						'end_date' => ''.$end.'',
						'end_time' => ''.$endtime.'',
						'description' =>''.$description.'',
						'guest' => ''.$invite.'',
						'guest_list' => ''.$guetslist.'',
						'location' => ''.$location.'',
						
					)
				);
	$res[]=	$updateUser = $Sql->update(
					array(
						'sql' => '
							UPDATE '.$Sql->tblfb.'
							'.$Sql->updateFields($updates).'
							WHERE 1								 
								AND auto_id = "'.$id.'"
							'
					)
				);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>