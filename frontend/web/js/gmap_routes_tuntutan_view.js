$( document ).ready(function() {
	var urlsys = window.location.hostname;
	var getUrl = window.location;
	var namaSistem = '/yktlj';

    var zoomNo = 14;
    
	var geocoder = new google.maps.Geocoder();
	var directionsService = new google.maps.DirectionsService();
	var directionsRenderer = new google.maps.DirectionsRenderer();
    var latlongDari = new google.maps.LatLng($('#yktlj_lat').html(), $('#yktlj_long').html());
    var latlongOrigin = new google.maps.LatLng($('#lokasi_lat').html(), $('#lokasi_long').html());
    var map = new google.maps.Map(document.getElementById('map'), {
	  	zoom: zoomNo,
    	center: latlongDari
	});
    var map = new google.maps.Map(document.getElementById('map'));
	// var markerHSI = new google.maps.Marker({position: latlongDari, map: map});

	calculateAndDisplayRoute(directionsService, directionsRenderer, latlongOrigin, latlongDari);

	function calculateAndDisplayRoute(directionsService, directionsRenderer, latlongOrigin, latlongDari) {
		directionsRenderer.setMap(map);
	directionsService.route(
	    {
	      origin: latlongOrigin,
	      destination: latlongDari,
	      travelMode: 'DRIVING'
	    },
	    function(response, status) {
	      if (status === 'OK') {
	        directionsRenderer.setDirections(response);
	      }
	    });
	}
});