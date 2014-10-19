<HTML>
<HEAD></HEAD>
<BODY>
<?php
$fbresponsep = $_GET['fbresp'];
$atoken = $_GET['atoken'];
if($fbresponsep  == 'connected')
{
?>
<script src="mapsapikeyurl&sensor=false">
</script>

<script>
  var ListofFriends = <?php $postdata = file_get_contents("https://graph.facebook.com/me?access_token=" . $atoken . "&fields=friends.fields(location,name)");
  echo $postdata;
  ?>;
  //console.log(locations);
function transformArr(orig) {
    var newArr = [],
        types = {},
        newItem, i, j, cur;
    for (i in orig) {
        cur = orig[i];

        if (!(cur.location in types)) {
            types[cur.location] = {location: cur.location, names: []};
            newArr.push(types[cur.location]);
        }
        types[cur.location].names.push(cur.name);
    }

    return newArr;
}
function initialize()
{
geocoder = new google.maps.Geocoder();
var mapProp = {
  center:new google.maps.LatLng(51.508742,-0.120850),
  zoom:5,
  mapTypeId:google.maps.MapTypeId.ROADMAP
  };
map=new google.maps.Map(document.getElementById("googleMap")
  ,mapProp);

  console.log ("Filterin to only list friends");
  var data = ListofFriends['friends']['data'];
  var curlocknown = {};
  var skip = 0
  console.log(data);
	  for(var i in data)
	  {
		if(typeof data[i].location != "undefined")
		{
			var tmp = {name:data[i].name,location:data[i].location["name"]};
			curlocknown[(i-skip)] = tmp;
		}else
		{
			skip += 1;
		}

	  }
	  var locationsGrouped = transformArr(curlocknown)
	  for(locnumb in locationsGrouped)
	  {
      //TODO: Add locatio cache to db here.
			codeAddress(locationsGrouped[locnumb].location, locationsGrouped[locnumb].names)
		}
	 console.log(locationsGrouped);


}
function codeAddress(address, name)
{
  geocoder.geocode( {address:address}, function(results, status)
  {
    if (status == google.maps.GeocoderStatus.OK)
    {
      map.setCenter(results[0].geometry.location);//center the map over the result
      //place a marker at the location
	  //a
	  console.log(results[0].geometry.location);
      var marker = new google.maps.Marker(
      {
          map: map,
          position: results[0].geometry.location,
		  title: name.join()
      });
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
   }
  });
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
<div id="googleMap" style="width:500px;height:380px;"></div>
<?php
}
else
{

}

?>
</BODY>
</HTML>
