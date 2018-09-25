<?php
include 'inc/autoload.php';
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
  <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<title>Untitled Document</title>
  <script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/34/10/util.js"></script>
  <script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/34/10/map.js"></script>
  <script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/34/10/common.js"></script>
  <script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/34/10/marker.js"></script>
  <script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/34/10/controls.js"></script>
  <script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/34/10/places_impl.js"></script>
  <script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/34/10/geocoder.js"></script>
  <style type="text/css">.gm-style {
        font: 400 11px Roboto, Arial, sans-serif;
        text-decoration: none;
      }
      .gm-style img { max-width: none; }</style>
	  <script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/34/10/onion.js"></script>
	  <script type="text/javascript" charset="UTF-8" src="http://maps.googleapis.com/maps-api-v3/api/js/34/10/stats.js"></script>
      </head>
<body>

<div class="container">
	<div class="row">
    	<div class="col-lg-12" align="center">
        	<h1>Create Your Event</h1>
            <br>
            <br>
            <div class="map_canvas"></div>
        	<form action="" method="post" id="property">
            	<table>
                	<tr>
                    	<td>
                        	<label>Event Name </label>
                        </td>
                        <td>
                        	<input type="text" id="name" placeholder="Add a short, clear name" width="50px">
                        </td>
                    </tr>
                    <tr>
                            <td>
                                <label>Location </label>
                            </td>
                            <td>
                              
                               <input type="text" id="location" placeholder="Include a place or address"> 
                               <input id="geocomplete" type="text" placeholder="Type in an address" value="Empire State Bldg" />
      <input id="find" type="button" value="find" />

      <fieldset>
    

        

        <label>Latitude</label>
        <input name="lat" type="text" value="" >

        <label>Longitude</label>
        <input name="lng" type="text" value="" >

      
      </fieldset>
                              
                                </div>
                            </td>
                     </tr>
                      <tr id="datetime">
                            <td>
                                <label>Date/Time  </label>
                            </td>
                            <td>
                                <input type="date" id="datetimedate" placeholder="">
                                <input type="time" id="datetimetime" placeholder="">
                                <a href="#" id="expand">+ End Time</a>
                            </td>
                     </tr>
                     <tr id="expandstartdate" hidden="true">
                            <td>
                                <label>Start  </label>
                            </td>
                            <td>
                                <input type="date" id="startdate" placeholder="">
                                <input type="time" id="starttime" placeholder="">
                                
                            </td>
                     </tr>
                     <tr id="expandenddate" hidden="true">
                            <td>
                                <label>End  </label>
                            </td>
                            <td>
                                <input type="date" id="enddate" placeholder="">
                                <input type="time" id="endtime" placeholder="">
                                <a href="#" id="remove">+ Remove</a>
                            </td>
                     </tr>
                     <tr>
                            <td>
                                <label>Description  </label>
                            </td>
                            <td>
                                <textarea id="description" placeholder="Tell people more about the event"></textarea>
                            </td>
                     </tr>
                     <tr>
                            <td>
                                
                            </td>
                            <td>
                                <input type="checkbox" id="invite" value="1"> Guests can invite friends
                            </td>
                     </tr>
                     <tr>
                            <td>
                                
                            </td>
                            <td>
                                 <input type="checkbox" id="guestlist" value="1"> Show guest list
                            </td>
                     </tr>
                     <tr>
                          <td colspan="2" align="center">
                          	<button type="submit" id="submit">Create Event</button>
                          </td>
                     </tr>
                </table>
            
            </form>
        </div>
    </div>
</div>
 
<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

    <script src="jquery.geocomplete.min.js"></script>
     <script src="jquery.geocomplete.js"></script>

    <script>
      $(function(){
        $("#geocomplete").geocomplete({
          map: ".map_canvas",
          details: "form",
          types: ["geocode", "establishment"],
        });

        $("#find").click(function(){
          $("#geocomplete").trigger("geocode");
        });
      });
    </script>
</body>
<script type="text/javascript">
function myMap() {
/*var mapProp= {
    center:new google.maps.LatLng(9.661498,80.025543),
    zoom:5,
};*/
//var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
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
      $('#expandstartdate').attr("hidden","true");
	  $('#expandenddate').attr("hidden","true");
      return false;
   });
});
//$('#new-publisher-name').val()
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
	  
	   var enddate = $('#enddate').val();
	   var endtime = $('#endtime').val();
	   var description = $('#description').val();
	   var datetime = $('#datetimedate').val();
	   var datetimetime = $('#datetimetime').val();
      $.post('<?=URL?>/admin/load/event.php',{name:name,location:location,date:datetime,time:datetimetime,start:startdate,end:enddate,starttime:starttime,endtime:endtime,description:description,invite:invite,guetslist:guestlist},function(res) {
			console.log(res);				
	  });
      //return false;
   });
});
</script>

<script src=""></script>
<script>
$(document).ready(function(){
  // Call Geo Complete
  //$("#location").geocomplete({details:"form#property"});
});
//https://maps.googleapis.com/maps/api/js?key=AIzaSyDXnym6AhxyQxl9eyTlWsMWzwdivxfOfJg&callback=myMap
/*function showResult(result) {
    document.getElementById('latitude').value = result.geometry.location.lat();
    document.getElementById('longitude').value = result.geometry.location.lng();
}

function getLatitudeLongitude(callback, address) {
    // If adress is not supplied, use default value 'Ferrol, Galicia, Spain'
    address = address || 'Ferrol, Galicia, Spain';
    // Initialize the Geocoder
    geocoder = new google.maps.Geocoder();
    if (geocoder) {
        geocoder.geocode({
            'address': address
        }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                callback(results[0]);
            }
        });
    }
}

var button = document.getElementById('btn');

button.addEventListener("click", function () {
    var address = document.getElementById('location').value;
    getLatitudeLongitude(showResult, address)
});*/
</script>
</html>