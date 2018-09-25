<?php
include 'inc/autoload.php';
?>
<!doctype html>
<html>
<head>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.js"></script>
<meta charset="utf-8">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<title>Untitled Document</title>
</head>

<body>
<button id="open" > Create Event</button>
<br>
<br>
<div class="container">
	<div class="row">
    	<div class="col-lg-12">
        	<h1>View Events</h1>
            
            
        </div>
        
    </div>
    <div class="row">
    	<div class="col-lg-12">
        	<div id="view">
            
            </div>
            
            
    </div>
        
    </div>
</div>
</body>

<script>
 var windowSizeArray = [ "width=600,height=600, scrollbars=yes" ];
$(document).ready(function(e) {
	$('#open').click(function(e){
		 var url = '<?=URL?>/admin/event.php';
		//var windowSize = windowSizeArray[$(this).attr("rel")];
		 window.open(url, 'event',windowSizeArray);
	})
})

</script>
</html>
<?php

$User = new User;
$Sql = new Sql;
	
	$currentevent = $Sql->arrayToJson(
$res[] = 		$issue = 	$Sql->select(
			array(
				'qry' => true,
				'sql' => '
					SELECT *
					FROM '.$Sql->tblfb.'
					WHERE 1 
						
				',
				'query'=>true
			)
			
			
		)
	);
	echo'<pre>';
	///print_r($currentevent->data);
	echo'</pre>';
	foreach($currentevent->data as $event=>$view):
	 echo 'ID : '. $view->auto_id.'<br>';
	 print_r('Name : '. $view->name.'<br>');
	 print_r('Location : '. $view->location.'<br>');
	 print_r('Start Date : '.  $view->start_date.'<br>');
	 print_r('Start Time : '. $view->start_time.'<br>');
	 print_r('End Date : '. $view->end_date.'<br>');
	 print_r('End Time : '. $view->end_time.'<br>');
	 print_r('Description : '. $view->description.'<br>');
	 print_r('Can invite guest : '. $view->guest.'<br>');
	 print_r('View guest list : '. $view->guest_list.'    ');
	 $id = $view->auto_id;
	 echo '<a href="'.URL.'/admin/load/edit_event.php?id='.$id.'" id="a" target="new" ><button type="button" id="edit" >Edit</button></a><br><br>';
	 ?>
     <script>
	 $('a').click(function(){
	   var windowSizeArray = [ "width=600,height=600, scrollbars=yes" ];
	   //var url = '<?=URL?>/admin/load/edit_event.php?id=<?php echo $id; ?>';
	   window.open(this.href,'event',windowSizeArray);
	 });
	  </script>
     <?php
    $name = $view->name;
	$location =	$view->location;
	$startdate = $view->start_date;
	$starttime = $view->start_time;
	$enddate = $view->end_date;
	$endtime = $view->end_time;
	$description = $view->description;
	$invite  = $view->guest;
	$guest = $view->guest_list;
	
	endforeach;
?>



<script>
	   
   $('#edit').click(function(){
	   
	   var name = '<?php echo $name;?>';
	   var location = '<?php echo $location;?>';
	   var id = '<?php echo $id;?>';
	   var enddate = '<?php echo $enddate;?>';
	   var endtime = '<?php echo $enddate;?>';
	   var description = '<?php echo $description;?>';
	   var startdate = '<?php echo $startdate;?>';
	   var starttime = '<?php echo $starttime;?>';
	   var invites = '<?php echo $invite;?>';
	   var guests = '<?php echo $guest;?>';
	   
	   if(invites=='1'){
		 	var invite = 'checked'; 
	   }
	   if(guests=='1'){
		 	var guest = 'checked'; 
	   } 
	   if(enddate=='0000-00-00'){
		 	var datetime = startdate; 
	   }
	   if(endtime=='00:00:00'){
		 	var datetimetime = starttime; 
	   }
	 //  console.log(location);
	  
	   $.post('<?=URL?>/admin/load/edit_event.php',{id:id,name:name,location:location,date:datetime,time:datetimetime,start:startdate,end:enddate,starttime:starttime,endtime:endtime,description:description,invite:invite,guest:guest},function(res) {
			console.log(res);				
	  });
	 //return false;
	  //console.log(startdate);
	  
   });
	
</script>  