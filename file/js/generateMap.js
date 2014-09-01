	var geocoder = new google.maps.Geocoder();

	// function geocodePosition(pos) {
	  // geocoder.geocode({
		// latLng: pos
	  // }, function(responses) {
		// if (responses && responses.length > 0) {
		  // updateMarkerAddress(responses[0].formatted_address);
		// } else {
		  // updateMarkerAddress('Cannot determine address at this location.');
		// }
	  // });
	// }

	// function updateMarkerStatus(str) {
	   // document.getElementById('markerStatus').value = str;
	// }

	function updateMarkerPosition(latLng) {
	  // document.getElementById('info').value = [
		// latLng.lat(),
		// latLng.lng()
	  // ].join(', ');
	  document.getElementById('latitude').value = latLng.lat();
	  document.getElementById('longitude').value = latLng.lng();
	}
	
	function updateZoomLevel(zoomLevel) {
	  // document.getElementById('info').value = [
		// latLng.lat(),
		// latLng.lng()
	  // ].join(', ');
	  document.getElementById('zoomlevel').value = zoomLevel;
	}

	// function updateMarkerAddress(str) {
	  // document.getElementById('address').value = str;
	// }

	function initialize() {
	  var latLng = new google.maps.LatLng(-3.646241812532168,120.150083015625);
	  var map = new google.maps.Map(document.getElementById('mapCanvas'), {
		zoom: 8,
		center: latLng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	  });
	  var marker = new google.maps.Marker({
		position: latLng,
		title: 'Drag marker ini ke lokasi properti anda',
		map: map,
		draggable: true,
		icon: new google.maps.MarkerImage(
			"<?php echo base_url();?>file/img/point2.png", // reference from your base
			new google.maps.Size(50, 40), // size of image to capture
			new google.maps.Point(0, 0), // start reference point on image (upper left)
			new google.maps.Point(13, 40), // point on image to center on latlng (scaled)
			new google.maps.Size(50, 40) // actual size on map
		)
	  });
	  
	  // Update current position info.
	  updateMarkerPosition(latLng);
	  updateZoomLevel(map.getZoom());
	  //geocodePosition(latLng);
	  
	  // Add dragging event listeners.
	  // google.maps.event.addListener(marker, 'dragstart', function() {
		// updateMarkerAddress('Dragging...');
	  // });
	  
	  google.maps.event.addListener(marker, 'drag', function() {
		//updateMarkerStatus('Dragging...');
		updateMarkerPosition(marker.getPosition());
	  });
	  
	  google.maps.event.addListener(map, 'zoom_changed', function() {
		updateZoomLevel(map.getZoom());
	  });
	  
	  // google.maps.event.addListener(marker, 'dragend', function() {
		// updateMarkerStatus('Drag ended');
		// geocodePosition(marker.getPosition());
	  // });
	}

	// Onload handler to fire off the app.
	google.maps.event.addDomListener(window, 'load', initialize);