// -- dom ready
var pathname = window.location.pathname;
$(document).ready(function () {
	initialize_map();
});

// -- Google map init
var venueLocation;
var v_lat, v_lng;

// -- initialize mini map
function initialize_map() {
	// get geo location coordinates
	var lat = $('#minimap_canvas').data('lat');
	var lng = $('#minimap_canvas').data('lng');
	console.log(lat);
	console.log(lng);
	
	venueLocation = new google.maps.LatLng(lat, lng);
	// set the map
	var myOptions = {
		zoom: 17,
		center: venueLocation,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(document.getElementById("minimap_canvas"), myOptions);
	var marker = new google.maps.Marker({
		position: venueLocation,
		map: map,
		title: $('#minimap_canvas').data('venuename')
	});
	
}