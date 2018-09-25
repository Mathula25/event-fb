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
	//header('Content-type: application/json');
	
	
	//echo json_encode();
//endif;

$ids=$_GET['id'];
//echo $ids;
	$res[] =	$currentUser = $Sql->arrayToJson(
			$Sql->select(
				array(
					'qry' => true,
					'sql' => '
						SELECT *
						FROM '.$Sql->tblfb.'
						WHERE 1 
							AND auto_id= "'.$ids.'"
							
						LIMIT 1
					',
					'limit' => true,
				)
			)
		);
	//	print_r($currentUser->data->start_date);
		
		if($currentUser->data->guest==1)
		{
			$check="checked";	
		}
		else
		{
			$check="";	
		}
		if($currentUser->data->guest_list==1)
		{
			$check_guest="checked";	
		}
		else
		{
			$check_guest="";	
		}
		if($currentUser->data->end_date=='0000-00-00')
		{
			//echo 'dsdsd';
			$hidden="hidden";
			$hiddens="";
			//$check_guest="checked";	
			
		}
		elseif($currentUser->data->end_date!='0000-00-00')
		{
			$hidden="";
			$hiddens="hidden";
		}
		
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<title>Untitled Document</title>
</head>

<body>

<div class="container">
	<div class="row">
    	<div class="col-lg-12" align="center">
        	<h1>Edit Your Event</h1>
            <br>
            <br>
        	<form action="" method="post">
            	<table>
                	<tr>
                    	<td>
                        	<label>Event Name </label>
                        </td>
                        <td>
                        	<input type="text" id="name"  width="50px" value="<?php echo $currentUser->data->name;?>">
                        </td>
                    </tr>
                    <tr>
                            <td>
                                <label>Location </label>
                            </td>
                            <td>
                                <input type="text" id="location" placeholder="Include a place or address" value="<?php echo $currentUser->data->location;?>">
                            </td>
                     </tr>
                      <tr id="datetime" <?php echo $hiddens; ?> >
                            <td>
                                <label>Date/Time  </label>
                            </td>
                            <td>
                                <input type="date" id="datetimedate" placeholder="" value="<?php echo $currentUser->data->start_date;?>">
                                <input type="time" id="datetimetime" placeholder=""value="<?php echo $currentUser->data->start_time;?>">
                                <a href="#" id="expand">+ End Time</a>
                            </td>
                     </tr>
                     <tr id="expandstartdate" <?php echo $hidden; ?> >
                            <td>
                                <label>Start  </label>
                            </td>
                            <td>
                                <input type="date" id="startdate" placeholder=""value="<?php echo $currentUser->data->start_date;?>">
                                <input type="time" id="starttime" placeholder=""value="<?php echo $currentUser->data->start_time;?>">
                                
                            </td>
                     </tr>
                     <tr id="expandenddate" <?php echo $hidden; ?>>
                            <td>
                                <label>End  </label>
                            </td>
                            <td>
                                <input type="date" id="enddate" placeholder=""value="<?php echo $currentUser->data->end_date;?>">
                                <input type="time" id="endtime" placeholder=""value="<?php echo $currentUser->data->end_time;?>">
                                <a href="#" id="remove">+ Remove</a>
                            </td>
                     </tr>
                     <tr>
                            <td>
                                <label>Description  </label>
                            </td>
                            <td>
                                <textarea id="description" placeholder="Tell people more about the event" ><?php echo $currentUser->data->description;?></textarea>
                            </td>
                     </tr>
                     <tr>
                            <td>
                                
                            </td>
                            <td>
                                <input type="checkbox" id="invite" value="1" <?php echo $check; ?> > Guests can invite friends
                            </td>
                     </tr>
                     <tr>
                            <td>
                                
                            </td>
                            <td>
                                 <input type="checkbox" id="guestlist" value="1" <?php echo $check_guest; ?> > Show guest list
                            </td>
                     </tr>
                     <tr>
                          <td colspan="2" align="center">
                          	<button type="submit" id="submit">Update Event</button>
                          </td>
                     </tr>
                </table>
            
            </form>
        </div>
    </div>
</div>
</body>

</html>
<script>
$(function(){
   $('#submit').click(function(){
	   if($('#invite').prop('checked'))
	   {
		    var invite = 1;
	   }
	   else
	   {
			 var invite = 0;
	   }
	   if($('#guestlist').prop('checked'))
	   {
		    var guestlist = 1;
	   }
	   else
	   {
			 var guestlist = 0;
	   }
	   if($('#expandstartdate').is(":hidden"))
	   {
			 var startdate = $('#datetimedate').val();
			 var starttime = $('#datetimetime').val();
	   }
	   else
	   {
		   	 var startdate = $('#startdate').val();
		     var starttime = $('#starttime').val();
	   }
	   var name = $('#name').val();
	   var location = $('#location').val();
	   var id='<?php echo $ids; ?>';
	   var enddate = $('#enddate').val();
	   var endtime = $('#endtime').val();
	   var description = $('#description').val();
	   var datetime = $('#datetimedate').val();
	   var datetimetime = $('#datetimetime').val();
      $.post('<?=URL?>/admin/load/update_event.php',{id:id,name:name,location:location,date:datetime,time:datetimetime,start:startdate,end:enddate,starttime:starttime,endtime:endtime,description:description,invite:invite,guetslist:guestlist},function(res) {
			console.log(res);				
	  });
      //return false;
   });
});
$(function(){
   $('#expand').click(function(){
      $('#datetime').hide();
      $('#expandstartdate').removeAttr('hidden');
	  $('#expandenddate').removeAttr('hidden');
      return false;
   });
});
$(function(){
   $('#remove').click(function(){
      $('#datetime').show();
	  $('#datetime').removeAttr("<?php echo $hiddens; ?>");
	  $('#enddate').attr("value","");
	  $('#endtime').attr("value","");
      $('#expandstartdate').attr("hidden","true");
	  $('#expandenddate').attr("hidden","true");
	  
      return false;
   });
});
</script>
