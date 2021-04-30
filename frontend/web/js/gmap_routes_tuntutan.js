$( document ).ready(function() {
	var urlsys = window.location.hostname;
	var getUrl = window.location;
	var namaSistem = '/yktlj';

	if(urlsys.includes('bitextreme.com.my') || urlsys.includes('johor.gov.my')) {
      var urlSistem = '/';
    } else {
      var urlSistem = namaSistem + '/frontend/web/';
    }

	var zoomNo = 14;
	var geocoder = new google.maps.Geocoder();
	var directionsService = new google.maps.DirectionsService();
	var directionsRenderer = new google.maps.DirectionsRenderer();
	var latlongDituju = getLatLongMula($("#makt_mod_tempat_dituju").val());
	var map = new google.maps.Map(document.getElementById('map'), {
	  	zoom: zoomNo,
    	center: latlongDituju
	});
	var markerDari = new google.maps.Marker({position: latlongDituju, map: map});
	// directionsRenderer.setPanel(document.getElementById('routes'));

	// function showPosition() {
 //        if(navigator.geolocation) {
 //            navigator.geolocation.getCurrentPosition(function(position) {
 //                var positionlat = position.coords.latitude ;
 //                var positionlong = position.coords.longitude;
                
 //            });
 //        } else {
 //            alert("Sorry, your browser does not support HTML5 geolocation.");
 //        }
 //        }


	function getLatLongMula(idYKTLJ)
	{
		var latYKTLJ = '1.4234574'; // lat yktlj = 1.4234574
		var longYKTLJ = '103.6500283'; // long yktlj = 103.6500283

	   
		return new google.maps.LatLng(latYKTLJ, longYKTLJ);
	}

	// onchange textinput makt_mod_tempat_dituju
    $("#makt_mod_tempat_dituju").on('change', function(){
		if($(this).val() == '') {
			directionsRenderer.setMap(null);
			map.setZoom(zoomNo);
			$("#makt_mod_hitungan_km").val('');			
		} else {
			geocoder.geocode( { 'address': $(this).val()}, function(results, status) {
				if (status == 'OK') {
					var lokasiLatlng = results[0].geometry.location;
					$("#makt_lat_tempat_dituju").val(lokasiLatlng.lat);
					$("#makt_long_tempat_dituju").val(lokasiLatlng.lng);
				} else {
					$("#makt_lat_tempat_dituju").val('0');
					$("#makt_long_tempat_dituju").val('0');
				}
			});
			calculateAndDisplayRoute(directionsService, directionsRenderer, $(this).val(), latlongDituju);
		}
	})

	function calculateAndDisplayRoute(directionsService, directionsRenderer, origin, latlongDituju) {

		directionsRenderer.setMap(map);	
		directionsService.route(
		    {
		      origin: {query: origin},
		      destination: latlongDituju,
		      travelMode: 'DRIVING',
		      avoidTolls: true
		    },
		    function(response, status) {
		      if (status === 'OK') {
		        directionsRenderer.setDirections(response);

		        var totalDistance = 0;
				var totalDuration = 0;

				//get jarak perjalanan
				var legs = response.routes[0].legs;
				for(var i=0; i<legs.length; ++i) {
				    totalDistance += legs[i].distance.value;
				    totalDuration += legs[i].duration.value;
				}


				totalDistance = (totalDistance/1000);

				
				var jarak = parseInt(totalDistance);
				$('#makt_mod_hitungan_km').val(jarak);

		       

		       var total = 0;
		       
			   var jenis = $('#JenisTuntutan').val();

			   if(jenis == '9')
			   {
			   	total = jarak * 0.8;
			   }
			   else
			   {
			   	total = jarak * 0.5;
			   }
			    
				$('#makt_mod_kiraan_tuntutan_perjalanan').val(total.toFixed(2));


	      }
	    });
	}

	    

});