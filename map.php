<?php
include_once dirname(__DIR__) . '/administrator/components/com_geolive/core.php';

?><html>
<head>
<script
	src="http://s3-us-west-2.amazonaws.com/nickolanackbucket/mootools/mootools-core.js"
	type="text/javascript"></script>
<script
	src="http://s3-us-west-2.amazonaws.com/nickolanackbucket/mootools/mootools-more.js"
	type="text/javascript"></script>
<script
	src="http://s3-us-west-2.amazonaws.com/nickolanackbucket/mootools/mootools_compat.js"
	type="text/javascript"></script>
<script
	src="<?php echo UrlFrom(Core::AdminDir().'/js/Ajax/AjaxControlQuery.js'); ?>"
	type="text/javascript"></script>


<style>
#map {
	width: 100%;
	height: 100%;
}

body {
	margin: 0;
}

.paddling-areas-detail {
	background-color: rgba(255, 255, 255, 0.6);
	padding: 10px 20px;
	color: #55acee;
	text-shadow: 0 0 3px white, 0 0 1px white;
	font-size: 15px;
	font-weight: bold;
	width: 100%;
	pointer-events: none;
}

.paddling-areas-detail .no-region {
	color: tomato;
	font-weight: 100;
}

button.btn.btn-danger {
	width: 50px;
	height: 38px;
	border: none;
	background-color: #55ACEE;
	color: white;
	font-size: 15px;
	cursor: pointer;
}
</style>
</head>
<body>



	<div id="map"></div>


	<script type="text/javascript">


function initMap(){

console.log("hello world");


var map = new google.maps.Map(document.getElementById('map'), {
	disableDefaultUI:true,
    center: {
        lat:50.50359739949432,
        lng:-125.25016503906248
        },
    zoom: 6,
    mapTypeId:google.maps.MapTypeId.ROADMAP,
    panControl:true,
    zoomControl:true,
    styles:[{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}]
  });


(new AjaxControlQuery("<?php echo UrlFrom(__DIR__.DS.'mapuseagebyzoom.php?0=0');?>", "",
		{})).addEvent("success",function(response){


		heatmap = new google.maps.visualization.HeatmapLayer({
				map:map,
				maxIntensity:10
				//dissipating:false
			});

			var gradient = [
			                'rgba(0, 255, 255, 0)',
			                'rgba(0, 255, 255, 1)',
			                'rgba(0, 191, 255, 1)',
			                'rgba(0, 127, 255, 1)',
			                'rgba(0, 63, 255, 1)',
			                'rgba(0, 0, 255, 1)',
			                'rgba(0, 0, 223, 1)',
			                'rgba(0, 0, 191, 1)',
			                'rgba(0, 0, 159, 1)',
			                'rgba(0, 0, 127, 1)',
			                'rgba(63, 0, 91, 1)',
			                'rgba(127, 0, 63, 1)',
			                'rgba(191, 0, 31, 1)',
			                'rgba(255, 0, 0, 1)'
			                ]
			heatmap.set('gradient', gradient);
			heatmap.set('radius',  15);
			heatmap.set('opacity',  0.7);

		    heatmap.setData(response.records.map(function(r){

		        return new google.maps.LatLng(r.lat, r.lng);

			}));

/*
		    response.records.forEach(function(point){

		    	new google.maps.Marker({
		    	     position:new google.maps.LatLng(point.lat, point.lng),
		    	     icon:{
		    	    	   path: google.maps.SymbolPath.CIRCLE,
		    	    	   scale: 10,
		    	    	   fillColor:"rgb(191, 0, 31)",
		    	    	   fillOpacity:0.2,
		    	    	   strokeWeight:0
			    	 },
			    	 map:map
			    	});


			});

*/

		}).execute();





}


   </script>
	<script async defer
		src="https://maps.googleapis.com/maps/api/js?libraries=visualization&callback=initMap"></script>
</body>

</html>
