<?php
	include_once("config.php");
?>
<?php if(!(isset($_POST['register']))) { ?>
<?xml version = "1.0"  encoding = "utf-8" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns = "http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" type="text/css" href="../links/styles/styles.css" />
		<link rel="stylesheet" type="text/css" href="../links/styles/registration.css" />
		<script type"text/javascript" src="../links/javascript/registration.js"></script>
		<style>
      		#map-canvas {
        		width: 1000px;
        		height: 600px;
        		
      		}
    	</style>
    	<script src="https://maps.googleapis.com/maps/api/js"></script>
    	<script>
    		var map;
			var initialLocation;
			var browserSupportFlag = new Boolean();
      		function initialize() {
				if(!!navigator.geolocation){
				
					var mapCanvas = document.getElementById('map-canvas');
					var mapOptions = {
						//center: new google.maps.LatLng(44.5403, -78.5463),
						zoom: 8,
						mapTypeId: google.maps.MapTypeId.HYBRID
					}
					map = new google.maps.Map(mapCanvas, mapOptions);
					if(navigator.geolocation){
							browserSupportFlag = true;
							navigator.geolocation.getCurrentPosition(function(position){
								initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
								map.setCenter(initialLocation);
						}, function(){
							handleNoGeolocation(browserSupportFlag);
						});
						}
						else{
							browserSupportFlag = false;
							handleNoGeolocation(BrowserSupportFlag);
						}
						function handleNoGeolocation(errorFlag){
							if(errorFlag == true){
								alert("Geolocation service failed.");
								initialLocation = new google.maps.LatLng(0.0, 0.0);
							}else{
								alert("Your browser doesn't support geolocation.");
								initialLocation = new google.maps.LatLng(0.0, 0.0);
							}
						map.setCenter(initialLocation);
					}
				}
				var num = 0;
				
				google.maps.event.addListener(map, 'click', function(event){
					//lat and lng is available in e object
					var lat= event.latLng.lat();
					var lng= event.latLng.lng();
					
					if(num == 0)
					{
						var latText = document.getElementById('upLefLat');
						var lonText = document.getElementById('upLefLon');
						latText.value = lat;
						lonText.value = lng;
						num = 1;
						
					}
					else if(num == 1)
					{
						var latText = document.getElementById('lowRigLat');
						var lonText = document.getElementById('lowRigLon');
						latText.value = lat;
						lonText.value = lng;
						num = 2;
						
					}
					else
					{
						if(confirm("Would you like to change geofence location?") == true){
							num = 0;
							var latText = document.getElementById('upLefLat');
							var lonText = document.getElementById('upLefLon');
							latText.value = " ";
							lonText.value = " ";
							latText = document.getElementById('lowRigLat');
							lonText = document.getElementById('lowRigLon');
							latText.value = " ";
							lonText.value = " ";
						}
					}
				});
      		}
      		google.maps.event.addDomListener(window, 'load', initialize);
			
      		
    	</script>
		<title>
			Registration page
		</title>
	</head>
	<body>
		<div class="main">
			<h3 id="registhead">Please Register for use.</h3>
			<form id="register" method="post" action="<?php echo $uploadHandler ?>" enctype="multipart/form-data">
				<ul>
				<div id="step1" style="display:show">
					<p class="small">Please fill in all fields. If all ready registered please hit back.<img id="registrationLogin" src="../pictures/buttons/btnBACK.png" /></p>
					</p>
					<li>
						<label for="fname">First Name : </label>
						<input type="text" maxlength="30" required autofocus name="fname" /> 
					</li>
					<li>
						<label for="lname">Last Name : </label>
						<input type="text" maxlength="30" required name="lname" />
					</li>
					<li>
						<label for="usn">Username : </lable>
						<input type="text" maxlength="30" required name="username" />
					</li>
					<li>
						<label for="passwd">Password : </label>
						<input type="password" id="passwd" maxlength ="30" required name="password" />
					</li>
					<li>
						<label for="conpasswd">Confirm Password : </label>
						<input type="password" id="conpasswd" maxlength="30" required name="conpassword" onkeyup="checkPass(); return false;"/>
						<span id="confirmMessage" class="small"></span>
					</li>
					<li>
						<label for="email">Email : </label>
						<input type="text" id="email" maxlength="88" required name="email" />
					</li>
					<li>
						<label for="tzone">Time Zone : </label>
						<select>
							<option name="tzone" value="+10:30">Australian Central Daylight Savings Time</option>
							<option name="tzone" value="+9:30">Australian Central Standard Time</option>
							<option name="tzone" value="-05">Acre Time</option>
							<option name="tzone" value="+08">ASEAN Common Time</option>
							<option name="tzone" value="-03">Atlantic Daylight Time</option>
							<option name="tzone" value="+11">Australian Eastern Daylight Savings Time</option>
							<option name="tzone" value="+10">Australian Eastern Standard Time</option>
							<option name="tzone" value="+04:30">Afghanistan Time</option>
							<option name="tzone" value="-08">Alaska Daylight Time</option>
							<option name="tzone" value="-09">Alaska Standard Time</option>
							<option name="tzone" value="-03">Amazon Summer Time</option>
							<option name="tzone" value="+05">Armenia Summer Time</option>
							<option name="tzone" value="-04">Amazon Time</option>
							<option name="tzone" value="+04">Armenia Time</option>
							<option name="tzone" value="-03">Argentina Time</option>
							<option name="tzone" value="+03">Arabia Standard Time</option>
							<option name="tzone" value="-04">Atlantic Standard Time</option>
							<option name="tzone" value="+09">Australian Western Daylight Time</option>
							<option name="tzone" value="+08">Australian Western Standard Time</option>
							<option name="tzone" value="-01">Azores Standard Time</option>
							<option name="tzone" value="+04">Azerbaijan Time</option>
							<option name="tzone" value="+08">Bruenei Time</option>
							<option name="tzone" value="+06">British Indian Ocean Time</option>
							<option name="tzone" value="-12">Baker Island Time</option>
							<option name="tzone" value="-04">Bolivia Time</option>
							<option name="tzone" value="-02">Brasilia Summer Time</option>
							<option name="tzone" value="-03">Brasilia Time</option>
							<option name="tzone" value="+06">Bangladesh Standard Time</option>
							<option name="tzone" value="+01">British Summer Time</option>
							<option name="tzone" value="+06">Bhutan Time</option>
							<option name="tzone" value="+02">Central Africa Time</option>
							<option name="tzone" value="+06:30">Cocos Island Time</option>
							<option name="tzone" value="-05">Central Daylight Time</option>
							<option name="tzone" value="-04">Cuba Daylight Time</option>
							<option name="tzone" value="+02">Central European Daylight Time</option>
							<option name="tzone" value="+01">Central European Time</option>
							<option name="tzone" value="+13:45">Chatham Daylight Time</option>
							<option name="tzone" value="+12:45">Chatham Standard Time</option>
							<option name="tzone" value="+08">Choibalsan</option>
							<option name="tzone" value="+10">Chamorro Standard Time</option>
							<option name="tzone" value="+10">Chuuk Time</option>
							<option name="tzone" value="-08">Clipperton Island Standard Time</option>
							<option name="tzone" value="+08">Central Indonesia Time</option>
							<option name="tzone" value="-10">Cook Island Time</option>
							<option name="tzone" value="-03">Chile Summer Time</option>
							<option name="tzone" value="-04">Chile Standard Time</option>
							<option name="tzone" value="-04">Colombia Summer Time</option>
							<option name="tzone" value="-05">Colombia Time</option>
							<option name="tzone" value="-06">Central Standard Time(North America)</option>
							<option name="tzone" value="+08">China Standard Time</option>
							<option name="tzone" value="+09:30">Central Standard Time(Australia)</option>
							<option name="tzone" value="+10:30">Central Summer Time(Australia)</option>
							<option name="tzone" value="-05">Cuba Standard Time</option>
							<option name="tzone" value="+08">China Time</option>
							<option name="tzone" value="-01">Cape Verde Time</option>
							<option name="tzone" value="+08:45">Central Western Standard Time(Australia)</option>
							<option name="tzone" value="+07">Christmas Island Time</option>
							<option name="tzone" value="+07">Davis Time</option>
							<option name="tzone" value="+10">Dumont d'Urville Time</option>
							<option name="tzone" value="-05">Easter Island Standard Summer Time</option>
							<option name="tzone" value="-06">Easter Island Standard Time</option>
							<option name="tzone" value="+03">East Africa Time</option>
							<option name="tzone" value="-04">Eastern Caribbean Time</option>
							<option name="tzone" value="-05">Ecuador Time</option>
							<option name="tzone" value="-04">Eastern Daylight Time(North America)</option>
							<option name="tzone" value="+03">Eastern European Daylight Time</option>
							<option name="tzone" value="+03">Eastern European Summer Time</option>
							<option name="tzone" value="+02">Eastern European Time</option>
							<option name="tzone" value="00">Eastern Greenland Summer Time</option>
							<option name="tzone" value="-01">Eastern Greenland Time</option>
							<option name="tzone" value="+09">Eastern Indonesian Time</option>
							<option name="tzone" value="-05">Eastern Standard Time(North America)</option>
							<option name="tzone" value="+10">Eastern Standard Time(Australia)</option>
							<option name="tzone" value="+03">Further-eastern European Time</option>
							<option name="tzone" value="+12">Fiji Time</opion>
							<option name="tzone" value="-03">Falkland Island Standard Time</option>
							<option name="tzone" value="-03">Falkland Island Summer Time</option>
							<option name="tzone" value="-04">Falkland Island Time</option>
							<option name="tzone" value="-02">Fernando de Noronha Time</option>
							<option name="tzone" value="-06">Galapagos Time</option>
							<option name="tzone" value="-09">Gambier Island</option>
							<option name="tzone" value="+04">Georgia Standard Time</option>
							<option name="tzone" value="-03">French Guiana Time</option>
							<option name="tzone" value="+12">Gilbert Island Time</option>
							<option name="tzone" value="-09">Gambier Island Time</option>
							<option name="tzone" value="00">Greenwich Mean Time</option>
							<option name="tzone" value="-02">South Georgia and the South Sandwich Islands</option>
							<option name="tzone" value="+04">Gulf Standard Time</option>
							<option name="tzone" value="-04">Guyana Time</option>
							<option name="tzone" value="-09">Hawaii-Aleutian Daylight Time</option>
							<option name="tzone" value="+02">Heure Avanc&eacute;e d'Europe Centrale</option>
							<option name="tzone" value="-10">Hawaii-Aleutian Standard Time</option>
							<option name="tzone" value="+08">Hong Kong Time</option>
							<option name="tzone" value="+05">Heard and McDonald Island Time</option>
							<option name="tzone" value="+07">Khovd Time</option>
							<option name="tzone" value="-10">Hawaii Standard Time</option>
							<option name="tzone" value="+07">Indochina Time</option>
							<option name="tzone" value="+03">Israel Daylight Time</option>
							<option name="tzone" value="+03">Indian Ocean Time</option>
							<option name="tzone" value="+4:30">Iran Daylight Time</option>
							<option name="tzone" value="+08">Irkutsk Time</option>
							<option name="tzone" value="+3:30">Iran Standard Time</option>
							<option name="tzone" value="+5:30">Indian Standard Time</option>
							<option name="tzone" value="+01">Irish Standard Time</option>
							<option name="tzone" value="+02">Israel Standard Time</option>
							<option name="tzone" value="+09">Japan Standard Time</option>
							<option name="tzone" value="+06">Kyrgyzstan Time</option>
							<option name="tzone" value="+11">Kosrae Time</option>
							<option name="tzone" value="+07">Krasnoyarsk Time</option>
							<option name="tzone" value="+09">Korea Standard Time</option>
							<option name="tzone" value="+10:30">Lord Howe Standard Time</option>
							<option name="tzone" value="+11">Lord Howe Summer Time</option>
							<option name="tzone" value="+14">Line Islands Time</option>
							<option name="tzone" value="+12">Magadan Time</option>
							<option name="tzone" value="-9:30">Marquesas Islands Time</option>
							<option name="tzone" value="+05">Mawson Station Time</option>
							<option name="tzone" value="-06">Mountain Daylight Time(North America)</option>
							<option name="tzone" value="+01">Middle European Time</option>
							<option name="tzone" value="+02">Middle European Saving Time</option>
							<option name="tzone" value="+12">Marshall Islands</option>
							<option name="tzone" value="+11">Macquarie Island Station Time</option>
							<option name="tzone" value="-09:30">Marquesas Islands Time</option>
							<option name="tzone" value="+06:30">Myanmar Time</option>
							<option name="tzone" value="+03">Moscow Time</option>
							<option name="tzone" value="+08">Malaysia Standard Time</option>
							<option name="tzone" value="-07">Mountain Standard Time(North America)</option>
							<option name="tzone" value="+06:30">Myanmar Standard Time</option>
							<option name="tzone" value="+04">Mauritius Time</option>
							<option name="tzone" value="+05">Maldives Time</option>
							<option name="tzone" value="+08">Malaysia Time</option>
							<option name="tzone" value="+11">New Caledonia Time</option>
							<option name="tzone" value="-02:30">Newfoundland Daylight Time</option>
							<option name="tzone" value="+11:30">Norfolk Time</option>
							<option name="tzone" value="+05:45">Nepal Time</option>
							<option name="tzone" value="-03:30">Newfoundland Standard Time</option>
							<option name="tzone" value="-11">Niue Time</option>
							<option name="tzone" value="+13">New Zealand Daylight Time</option>
							<option name="tzone" value="+12">New Zealand Standard Time</option>
							<option name="tzone" value="+06">Omsk Time</option>
							<option name="tzone" value="+05">Oral Time</option>
							<option name="tzone" value="-07">Pacific Daylight Time(North America)</option>
							<option name="tzone" value="-05">Peru Time</option>
							<option name="tzone" value="+12">Kamchatka Time</option>
							<option name="tzone" value="+10">Papua New Guinea Time</option>
							<option name="tzone" value="+13">Phoenix Island Time</option>
							<option name="tzone" value="+05">Pakistan Standard Time</option>
							<option name="tzone" value="-02">Saint Pierre and Miquelon Daylight Time</option>
							<option name="tzone" value="-03">Saint Pierre and Miquelon Standard Time</option>
							<option name="tzone" value="+11">Pohnpei Standard Time</option>
							<option name="tzone" value="-08">Pacific Standard Time(North America)</option>
							<option name="tzone" value="+08">Philippine Standard Time</option>
							<option name="tzone" value="-03">Paraguay Summer Time(South America)</option>
							<option name="tzone" value="-04">Paraguay Time(South America)</option>
							<option name="tzone" value="+04">R&eacute;union Time</option>
							<option name="tzone" value="-03">Rothera Research Station Time</option>
							<option name="tzone" value="+11">Sakhalin Island Time</option>
							<option name="tzone" value="+04">Samara Time</option>
							<option name="tzone" value="+02">South African Standard Time</option>
							<option name="tzone" value="+11">Solomon Islands Time</option>
							<option name="tzone" value="+04">Seychelles Time</option>
							<option name="tzone" value="+08">Singapore Time</option>
							<option name="tzone" value="+5:30">Sri Lanka Time</option>
							<option name="tzone" value="+11">Srednekolymsk Time</option>
							<option name="tzone" value="-03">Suriname Time</option>
							<option name="tzone" value="-11">Samoa Standard Time</option>
							<option name="tzone" value="+08">Singapore Standard Time</option>
							<option name="tzone" value="+03">Showa Station Time</option>
							<option name="tzone" value="-10">Tahiti Time</option>
							<option name="tzone" value="+07">Thailand Standard Time</option>
							<option name="tzone" value="+05">Indian/Kerguelen</option>
							<option name="tzone" value="+05">Tajikistan Time</option>
							<option name="tzone" value="+13">Tokelau Time</option>
							<option name="tzone" value="+09">Timor Leste Time</option>
							<option name="tzone" value="+05">Turkmenistan Time</option>
							<option name="tzone" value="+13">Tonga Time</option>
							<option name="tzone" value="+12">Tuvalu Time</option>
							<option name="tzone" value="+08">Ulaanbaatar Time</option>
							<option name="tzone" value="+02">Kaliningrad Time</option>
							<option name="tzone" value="-02">Uruguay Summer Time</option>
							<option name="tzone" value="-03">Uruguay Standard Time</option>
							<option name="tzone" value="+05">Uzbekistan Time</option>
							<option name="tzone" value="-04:30">Venezuelan Standard Time</option>
							<option name="tzone" value="+10">Vladivostok Time</option>
							<option name="tzone" value="+04">Volgograd Time</option>
							<option name="tzone" value="+06">Vostok Station Time</option>
							<option name="tzone" value="+11">Vanuatu Time</option>
							<option name="tzone" value="+12">Wake Station Time</option>
							<option name="tzone" value="+02">West Africa Summer Time</option>
							<option name="tzone" value="+01">West Africa Time</option>
							<option name="tzone" value="+01">Western European Daylight Time</option>
							<option name="tzone" value="00">Western European Time</option>
							<option name="tzone" value="+07">Western Indonesian Time</option>
							<option name="tzone" value="+08">Western Standard Time</option>
							<option name="tzone" value="+05">Yekaterinburg Time</option>
						</select>
					</li>
					<li class="buttons">
						<input type="image" class="button" name="login" src="../pictures/buttons/btnBACK.png" onClick="location.hrep='index.php'" />
						<input type="image" class="button" name="register" alt="new user registration" src="../pictures/buttons/next.jpeg" onclick="javascript:show('step2');" />
					</li>
					</div>
					<div id="step2" style="display:none;">
						<p class="small">
							Please tell us what you would like to track and download icons to be used.<br />
							Also give use the maximum speed of groups to be tracked.
						</p>
						<li id="dynamicInput">
							<input type="radio" name="type" value="v" checked />Vehicle
							<input type="radio" name="type" value="a" />Animal<br />
							<label for="speed[]">Maximum Speed: </label><input type="text" maxlength="2" required name="speed[]" /><br />
							<label for="trackedObject[]">Type of object: </label><input type="text" maxlength="20" required name="trackedObject[]" /><br />
							<label for="icon[]">Download Icon: </label><input type="file" name="icon[]" required />
						</li>
						<li>
							<input type="image" class="button" name="addNew" src="../pictures/buttons/btnADDNEW.png" onClick="addInput('dynamicInput');" />
						</li>
						<li class="buttons">
							<input type="image" class="button" name="login" src="../pictures/buttons/btnBACK.png" onClick="show('step1')" />
							<input type="image" class="button" name="register" alt="new user registration" src="../pictures/buttons/next.jpeg" onclick="javascript:show('step3');" />
							
						</li>
					</div>
					<div id="step3" style="display:none;">
						<p class="small">Please click the upper left hand corner of your geofence location.<br />
						Then click lower right hand corner of your geofence location.</p>
						<div id="map-canvas" style="display:show;">
					
						</div>
					
						<li class="umap">
							<label for="upLefLat">Upper Left Latitude:</label>
							<input type="text" maxlength="20" required name="upLefLat" id="upLefLat" />
							<label for="upLefLon">Upper Left Longitude:</label>
							<input type="text" maxlength="20" required name="upLefLon" id="upLefLon" />
						</li>
						<li class="umap">
							<label for="lowRigLat">Lower Right Latitude:</label>
							<input type="text" maxlength="20" required name="lowRigLat" id="lowRigLat" />
							<label for="lowRigLon">Lower Right Longitude:</label>
							<input type="text" maxlength="20" required name="lowRigLon" id="lowRigLon" />
						</li>
						<li class="umapbuttons">
							<input type="image" class="button" name="register" alt="new user registration" src="../pictures/buttons/btnSAVE.png" onclick="location.href='map.html'" />
						</li>
					</div>
				</ul>
			</form>
		</div>
	</body>
</html>
<?php 
	}else{
		$usr = new Users;
		$usr->storeFormValues($_POST);
		
		if($_POST['password'] == $_POST['conpassword']){
			echo $usr->register($_POST);
		}else{
			echo "Password and Confirm password not match";
		}
	}
?>