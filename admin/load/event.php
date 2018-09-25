<?php
if($_SERVER['REQUEST_METHOD'] === "POST"):
	include '../inc/autoload.php';

	$User = new User;
	$Sql = new Sql;
	
	
	$requiredFields = array_fill_keys(
		array(
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
			'guetslist',		
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
	//header('Content-type: application/json');
	
	$res[] = $insertNew = $Sql->insert(
				array(
					'sql' => '
					INSERT INTO '.$Sql->tblfb.'
					'.$Sql->insertFields(
						array(
							'insertFields' => array(
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
						)
					),
					'query'=>true
				)
	);
	echo json_encode($res);
endif;
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