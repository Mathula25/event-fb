<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
for($i=0; $row = $currentevent->qryData->fetch(); $i++){
	?>
	<tr class="record">
		<td><?php echo $row['name']; ?></td>
		<td><?php echo $row['location']; ?></td>
		<td><?php echo $row['description']; ?></td>
		<td><a href="editform.php?id=<?php echo $row['id']; ?>"> edit </a></td>
	</tr>
	<?php
		}
	?>