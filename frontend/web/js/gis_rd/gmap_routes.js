$( document ).ready(function() {
	
	var directionsService = new google.maps.DirectionsService();
	var directionsRenderer = new google.maps.DirectionsRenderer();
	var map = new google.maps.Map(document.getElementById('map'), {
	  	zoom: 9,
    	center: {lat: 1.828374, lng: 103.522828}
	});
	directionsRenderer.setMap(map);
	directionsRenderer.setPanel(document.getElementById('routes'));

	var onChangeHandler = function() {
	  document.getElementById('container_routes').style.display = 'none';
	  calculateAndDisplayRoute(directionsService, directionsRenderer);
	};
	document.getElementById('dari').addEventListener('change', onChangeHandler);
	document.getElementById('dituju').addEventListener('change', onChangeHandler);
	

	function calculateAndDisplayRoute(directionsService, directionsRenderer) {
	directionsService.route(
	    {
	      origin: {query: document.getElementById('dari').value},
	      destination: {query: document.getElementById('dituju').value},
	      travelMode: 'DRIVING'
	    },
	    function(response, status) {
	      if (status === 'OK') {
	        directionsRenderer.setDirections(response);
	        document.getElementById('container_routes').style.display = 'block';
	        var totalDistance = 0;
			var totalDuration = 0;

			//get jarak perjalanan
			var legs = response.routes[0].legs;
			for(var i=0; i<legs.length; ++i) {
			    totalDistance += legs[i].distance.value;
			    totalDuration += legs[i].duration.value;
			}

			totalDistance = (totalDistance/1000) + ' kilometer';
			console.log(totalDistance);
			
			//get masa perjalanan
			var hours = Math.floor(totalDuration / 3600);
		    totalDuration %= 3600;
		    var minutes = Math.floor(totalDuration / 60);
		    var seconds = totalDuration % 60;

		    totalDuration = hours + ' jam ' + minutes + ' minit ' + seconds + ' saat'
			console.log(totalDuration);

	      } else {
	        window.alert('Directions request failed due to ' + status);
	      }
	    });
    } 
});