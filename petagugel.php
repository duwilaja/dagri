<?php 
include "inc.common.php";
//include "inc.session.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lokasi</title>
	<meta charset="utf-8" />

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Icons css-->
	<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
	
<style type="text/css">
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}
#legend {
  font-family: Arial, sans-serif;
  background: #fff;
  padding: 10px;
  margin: 10px;
  border: 3px solid #000;
}

#legend h3 {
  margin-top: 0;
}

#legend img {
  vertical-align: middle;
}
</style>
</head>
<body>
&nbsp;
	<div id="map" style="position: absolute; top: 0px; left: 0; width: 100%; height: 100%;"></div>
	<div id="legend"></div>
&nbsp;
<!-- Jquery js-->
<script src="spruha/assets/plugins/jquery/jquery.min.js"></script>

<script type="module">
import {
  MarkerClusterer
} from "https://cdn.skypack.dev/@googlemaps/markerclusterer@2.3.1";

let ext = '<?php echo $ext?>';

  (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
    key: "AIzaSyB0LcVlAmmXMro8eH69aK6Wh4lUqttz-Zs",
    v: "weekly",
    // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
    // Add other bootstrap parameters as needed, using camel case.
  });

  
/**
 * Creates a control that recenters the map on Chicago.
 */
 
 const myCenter={lat: -2,lng: 118};
 
function createCenterControl(map) {
  const controlButton = document.createElement("button");

  // Set CSS for the control.
  controlButton.style.backgroundColor = "#fff";
  controlButton.style.border = "2px solid #fff";
  controlButton.style.borderRadius = "3px";
  controlButton.style.boxShadow = "0 2px 6px rgba(0,0,0,.3)";
  controlButton.style.color = "rgb(25,25,25)";
  controlButton.style.cursor = "pointer";
  controlButton.style.fontFamily = "Roboto,Arial,sans-serif";
  controlButton.style.fontSize = "16px";
  controlButton.style.lineHeight = "38px";
  controlButton.style.margin = "8px 0 22px";
  controlButton.style.padding = "0 5px";
  controlButton.style.textAlign = "center";
  controlButton.textContent = "Center Map";
  controlButton.title = "Click to recenter the map";
  controlButton.type = "button";
  // Setup the click event listeners: simply set the map to Chicago.
  controlButton.addEventListener("click", () => {
    map.setCenter(myCenter);
	map.setZoom(5);
  });
  return controlButton;
}


async function initMap(locations) {
  // Request needed libraries.
  const { Map, InfoWindow } = await google.maps.importLibrary("maps");
  const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary(
    "marker",
  );
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 5, //3,
    center: myCenter, //{ lat: -28.024, lng: 140.887 },
    mapId: "DEMO_MAP_ID",
  });
  
  // Create the DIV to hold the control.
  const centerControlDiv = document.createElement("div");
  // Create the control.
  const centerControl = createCenterControl(map);

  // Append the control to the DIV.
  centerControlDiv.appendChild(centerControl);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(centerControlDiv);
  
  const legend = document.getElementById("legend");
  for(var i=0;i<2;i++){
	const div = document.createElement("div");
	const name = (i==0)? "Down" : "Up";
	div.innerHTML = '<img src="img/' + i + '.png"> ' + name;
	legend.appendChild(div);  
  }
	map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(legend);
  /*
  const infoWindow = new google.maps.InfoWindow({
    content: "",
    disableAutoPan: true,
  });*/
  
  
  // Create an array of alphabetical characters used to label the markers.
  //const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
  // Add some markers to the map.
  //const markers = locations.map((position, i) => {
    /*const label = labels[i % labels.length];
    const pinGlyph = new google.maps.marker.PinElement({
      glyph: label,
      glyphColor: "white",
    });
	*/
	var err=''; var markers=[];
	var bounds = new google.maps.LatLngBounds();
   for (var i = 0; i < locations.length; i++) {
		var a = locations[i];
		var title = a['name']+'\nTotal: '+a['cnt']+'\nON: '+a['onoff']+'\nOFF: '+a['off']+'\nLink: '+a['lnk']+'\nBW: '+a['bw'];
		var color = a['onoff']=="0"?"0":"1";
		
		if(isNaN(a['lat'])||isNaN(a['lng'])){
			err+=a['name']+'/';
		}else{
			const myLatLng = new google.maps.LatLng(a['lat'], a['lng']);

			const iconImage = "img/"+color+".png";
			const marker = new google.maps.Marker({
			  position: myLatLng,
			  icon: iconImage,//pinGlyph.element,
			  title: title,
			});
			
			markers.push(marker);
			//extend the bounds to include each marker's position
			bounds.extend(myLatLng);

			// markers can only be keyboard focusable when they have click listeners
			// open info window when marker is clicked
			//marker.addListener("click", () => {
			  //infoWindow.setContent(position.lat + ", " + position.lng);
			  //infoWindow.open(map, marker);
			//});
				//return marker;
		}
  };

  // Add a marker clusterer to manage the markers.
  new MarkerClusterer({ markers, map });
  if(markers.length>0) {
	  map.fitBounds(bounds);
  }
  if(err!='') console.log(err);
}
/*
const locations = [
  { lat: -31.56391, lng: 147.154312 },
  { lat: -33.718234, lng: 150.363181 },
  { lat: -33.727111, lng: 150.371124 },
  { lat: -33.848588, lng: 151.209834 },
  { lat: -33.851702, lng: 151.216968 },
  { lat: -34.671264, lng: 150.863657 },
  { lat: -35.304724, lng: 148.662905 },
  { lat: -36.817685, lng: 175.699196 },
  { lat: -36.828611, lng: 175.790222 },
  { lat: -37.75, lng: 145.116667 },
  { lat: -37.759859, lng: 145.128708 },
  { lat: -37.765015, lng: 145.133858 },
  { lat: -37.770104, lng: 145.143299 },
  { lat: -37.7737, lng: 145.145187 },
  { lat: -37.774785, lng: 145.137978 },
  { lat: -37.819616, lng: 144.968119 },
  { lat: -38.330766, lng: 144.695692 },
  { lat: -39.927193, lng: 175.053218 },
  { lat: -41.330162, lng: 174.865694 },
  { lat: -42.734358, lng: 147.439506 },
  { lat: -42.734358, lng: 147.501315 },
  { lat: -42.735258, lng: 147.438 },
  { lat: -43.999792, lng: 170.463352 },
];
*/
//initMap();

$(document).ready(function(){
	loadLoc();
});

function gohome(){
	//map.setView([-2,118], 5);
}

function loadLoc(){
	var err='';
	$.ajax({
		type: 'POST',
		url: 'dataget'+ext,
		data: {q:'map',id:-1},
		success: function(datax){
			var data=JSON.parse(datax)["msgs"];
			initMap(data);
		},
		error: function(xhr){
			console.log(xhr);
		}
	});
}

function loadMarker(){
	gohome();
	if(markers!=null)  {
		map.removeLayer(markers);
		markers.clearLayers();
		//$("#tot").val(0);
	}
	markers=L.markerClusterGroup();
	var err='';
	$.ajax({
		type: 'POST',
		url: 'dataget'+ext,
		data: {q:'map',id:-1},
		success: function(datax){
			var data=JSON.parse(datax)["msgs"];
			for (var i = 0; i < data.length; i++) {
				var a = data[i];
				var title = a['name']+'\nTotal: '+a['cnt']+'\nON: '+a['onoff']+'\nOFF: '+a['off']+'\nLink: '+a['lnk']+'\nBW: '+a['bw'];
				var color = a['onoff']>0?"1":"0";
				//var icon = L.AwesomeMarkers.icon({icon: 'server', prefix: 'fa', markerColor: color});
				var icon = L.icon({iconUrl:'img/'+color+'.png',iconSize:[30,30],iconAnchor:[15,30]});
				
				if(isNaN(data[i]['lat'])||isNaN(data[i]['lng'])){
					err+=data[i]['name']+'/';
				}else{
					var marker = L.marker(new L.LatLng(a['lat'], a['lng']), { title: title, icon: icon });
					
					//var fn=markerClickFunction(a['locid']);
					//marker.on('click', fn);
					
					//marker.addTo(map);
					markers.addLayer(marker);
				}
			}
			markers.addTo(map);
			//$("#tot").val(data.length);
			if(err!='') {
				alert('Error: '+err);
			}
		},
		error: function(xhr){
			console.log(xhr);
		}
	});
}
</script>
</body>
</html>
