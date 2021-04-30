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
	var latlongHsp = getLatLongHosp($("#btnt_fk_hsp_id").val());
	var map = new google.maps.Map(document.getElementById('map'), {
	  	zoom: zoomNo,
    	center: latlongHsp 
	});
	var markerHSI = new google.maps.Marker({position: latlongHsp, map: map});
	// directionsRenderer.setPanel(document.getElementById('routes'));

	calculateAndDisplayRoute(directionsService, directionsRenderer, $("#btnt_mod_lokasi").val(), latlongHsp);

	// onchange textinput btnt_mod_lokasi
    $("#btnt_mod_lokasi").on('change', function(){
		if($(this).val() == '') {
			directionsRenderer.setMap(null);
			map.setZoom(zoomNo);
			map.panTo(markerHSI.position);
			$("#btnt_mod_jarak_km").val('');
			$("#btnt_mod_amaun_sehala").val('');
			$("#btnt_mod_amaun_kembali").val('');
		} else {
			geocoder.geocode( { 'address': $(this).val()}, function(results, status) {
				if (status == 'OK') {
					var lokasiLatlng = results[0].geometry.location;
					$("#btnt_mod_lokasi_lat").val(lokasiLatlng.lat);
					$("#btnt_mod_lokasi_long").val(lokasiLatlng.lng);
				} else {
					$("#btnt_mod_lokasi_lat").val('0');
					$("#btnt_mod_lokasi_long").val('0');
				}
			});
			calculateAndDisplayRoute(directionsService, directionsRenderer, $(this).val(), latlongHsp);
		}
	})

	// $("#jenisBantuan").on("change", function() {

	//     var jenisBantuan = $(this).val();
	    
	//     if(jenisBantuan == 'TBG')
	//     {
	//     	calculateAndDisplayRoute(directionsService, directionsRenderer);
	//     }
	// })

	function calculateAndDisplayRoute(directionsService, directionsRenderer, origin, latlongHsp) {
		directionsRenderer.setMap(map);
	directionsService.route(
	    {
	      origin: {query: origin},
	      destination: latlongHsp,
	      travelMode: 'DRIVING'
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
			
			//get masa perjalanan
			var hours = Math.floor(totalDuration / 3600);
		    totalDuration %= 3600;
		    var minutes = Math.floor(totalDuration / 60);
		    var seconds = totalDuration % 60;

		    totalDuration = hours + ' jam ' + minutes + ' minit ' + seconds + ' saat';

			var jarak = parseInt(totalDistance);
	        $("#btnt_mod_jarak_km").val(jarak);
	       	
	       	calculateAmaunTambang(jarak, $("#btnt_fk_hsp_id").val());

	      }
	    });
	}

	function getLatLongHosp(idHsp)
	{
		var latHsp = '';
		var longHsp = '';
		$.ajax({
		    //type: "GET",
		    url: urlSistem + 'hospital/get-latlong',  
		    contentType: "application/json; charset=utf-8",  
		    data: {
		    	'idHsp': idHsp
		  	},        
		    dataType: "json", 
		    async:false,
		    success: function (data) {
				latHsp = data.hsp_mod_lokasi_lat;
				longHsp = data.hsp_mod_lokasi_long;
				// alert(data);
				// return new google.maps.LatLng(latHsp, longHsp);
		    },
		});
		return new google.maps.LatLng(latHsp, longHsp);
	}

    function calculateAmaunTambang(jarak, idHsp)
    {
    	$.ajax({
		    //type: "GET",
		    url: urlSistem + 'hospital/kira-amaun',  
		    contentType: "application/json; charset=utf-8",  
		    data: {
		    	"jarak": jarak,
		    	'idHsp': idHsp
		  	},        
		    dataType: "json", 
		    async:false,
		    success: function (data) {
				$("#btnt_mod_amaun_sehala").val(data.toFixed(2));
				$("#btnt_mod_amaun_kembali").val((parseFloat(data) * 2).toFixed(2));
		    },
		});
    }
});