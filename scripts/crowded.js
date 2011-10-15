// -- dom ready
var pathname = window.location.pathname;
$(document).ready(function () {
	initialize_map();
});

// -- Google map init
var initialLocation, map, center, geocoder;
var kualalumpur = new google.maps.LatLng(3.1572, 101.7125);
var user_latitude = 3.1572, user_longitude = 101.7125;
var markers = [];
var markerCluster;

function initialize_map() {
	
	geocoder = new google.maps.Geocoder();
	var myOptions = {
		zoom: 13,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	
	// try to get geolocation
	if(navigator.geolocation) {
		browserSupportFlag = true;
		navigator.geolocation.getCurrentPosition(function(position) {
			initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
			map.setCenter(initialLocation);
			
			$.getJSON(pathname + "4sq/trending/" + position.coords.latitude +"/"+ position.coords.longitude, function(data) {
				var data_obj = jQuery.parseJSON(data)
				
				// -- load venues list
				html = new EJS({url: 'templates/ejs/venues.ejs'}).render(data_obj);
				$("#venueList").html(html);
				
				// -- go throught each venues
				var venues = data_obj.response.venues;
				for(var i = 0; i < venues.length; i++) {
					// set new markers points
					var latlng = new google.maps.LatLng(venues[i].location.lat, venues[i].location.lng);
					for(var k = 0; k < venues[i].hereNow.count; k++) {
						var marker = new google.maps.Marker({position: latlng});
						markers.push(marker);
					}
				}
				markerCluster = new MarkerClusterer(map, markers);
			});
			
			// -- register click event
			$("#find_place").submit(function() {
				if($("#place").val().length === 0) {
					console.log("empty style");
				} else {
					var address = $("#place").val();
					geocoder.geocode({'address': address}, function(results, status) {
						if(status == google.maps.GeocoderStatus.OK) {
							
							// -- remove all markers
							markers.length = 0;
							markerCluster.clearMarkers();
							
							map.setCenter(results[0].geometry.location);
							center = map.getCenter();
							
							$("#venueList").html("");
							
							// -- get area trending venue. 
							$.getJSON(pathname + "4sq/trending/" + center.Ma +"/"+ center.Na, function(data) {
								var data_obj = jQuery.parseJSON(data);
								
								if(data_obj == null) {
									$("#venueList").html("");
								} else {
									// -- load venues list
									html = new EJS({url: 'templates/ejs/venues.ejs'}).render(data_obj);
									$("#venueList").html(html);
								}
								
								// -- go throught each venues
								var venues = data_obj.response.venues;
								for(var i = 0; i < venues.length; i++) {
									// set new markers points
									var latlng = new google.maps.LatLng(venues[i].location.lat, venues[i].location.lng);
									for(var k = 0; k < venues[i].hereNow.count; k++) {
										var marker = new google.maps.Marker({position: latlng});
										markers.push(marker);
									}
								}
								markerCluster.addMarkers(markers);
							});
						} else {
							console.log("Geocode fail");
						}
					});
				}
				
				return false;
			});
			
		}, function() {
			handleNoGeolocation();
		});
	} else {
		handleNoGeolocation();
	}
	
	
	// -- start plot markers if map center changed
	google.maps.event.addListener(map, 'dragend', function () {
		// -- remove all markers
		markers.length = 0;
		markerCluster.clearMarkers();
		
		center = map.getCenter();
		
		$("#venueList").html(" ");
		
		// -- get area trending venue. 
		$.getJSON(pathname + "4sq/trending/" + center.Ma +"/"+ center.Na, function(data) {
			var data_obj = jQuery.parseJSON(data);
			
			if(typeof data_obj.status != 'undefined') {
				if(data_obj.status == 'error') {
					console.log("timeout error");
				}
			} else {
				// -- load venues list
				html = new EJS({url: 'templates/ejs/venues.ejs'}).render(data_obj);
				$("#venueList").html(html);
				
				// -- go throught each venues
				var venues = data_obj.response.venues;
				for(var i = 0; i < venues.length; i++) {
					// set new markers points
					var latlng = new google.maps.LatLng(venues[i].location.lat, venues[i].location.lng);
					for(var k = 0; k < venues[i].hereNow.count; k++) {
						var marker = new google.maps.Marker({position: latlng});
						markers.push(marker);
					}
				}
				markerCluster.addMarkers(markers);
			}
			
		});
	});
}

function handleNoGeolocation() {
	console.log("Geo location service failed...");
	user_latitude = 3.1572;
	user_longitude = 101.7125;
	initialLocation = kualalumpur;
	map.setCenter(initialLocation);
	
	$.getJSON(pathname + "4sq/trending/" + user_latitude +"/"+ user_longitude, function(data) {
		var data_obj = jQuery.parseJSON(data);
		//markers = [];
		
		// -- load venues list
		html = new EJS({url: 'templates/ejs/venues.ejs'}).render(data_obj);
		$("#venueList").html(html);
		
		// -- go throught each venues
		var venues = data_obj.response.venues;
		console.log(venues);
		for(var i = 0; i < venues.length; i++) {
			// set new markers points
			var latlng = new google.maps.LatLng(venues[i].location.lat, venues[i].location.lng);
			for(var k = 0; k < venues[i].hereNow.count; k++) {
				var marker = new google.maps.Marker({position: latlng});
				markers.push(marker);
			}
		}
		markerCluster = new MarkerClusterer(map, markers);
	});
}

