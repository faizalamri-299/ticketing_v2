$( document ).ready(function() {
	var urlsys = window.location.hostname;
	var getUrl = window.location;
	var namaSistem = '/yktlj';

    var zoomNo = 14;
    
	// var geocoder = new google.maps.Geocoder();
	var directionsService = new google.maps.DirectionsService();
	var directionsRenderer = new google.maps.DirectionsRenderer();
    var latlongHsp = new google.maps.LatLng($('#hsp_lat').html(), $('#hsp_long').html());
    var latlongOrigin = new google.maps.LatLng($('#lokasi_lat').html(), $('#lokasi_long').html());
    var map = new google.maps.Map(document.getElementById('map'), {
	  	zoom: zoomNo,
    	center: latlongHsp
	});
    var map = new google.maps.Map(document.getElementById('map'));
	// var markerHSI = new google.maps.Marker({position: latlongHsp, map: map});

	calculateAndDisplayRoute(directionsService, directionsRenderer, latlongOrigin, latlongHsp);

	function calculateAndDisplayRoute(directionsService, directionsRenderer, latlongOrigin, latlongHsp) {
		directionsRenderer.setMap(map);
	directionsService.route(
	    {
	      origin: latlongOrigin,
	      destination: latlongHsp,
	      travelMode: 'DRIVING'
	    },
	    function(response, status) {
	      if (status === 'OK') {
	        directionsRenderer.setDirections(response);
	      }
	    });
	}
});