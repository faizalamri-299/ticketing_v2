$( document ).ready(function() {
	var urlsys = window.location.hostname;
	var getUrl = window.location;
	var namaSistem = '/yktlj';
	
	var directionsService = new google.maps.DirectionsService();
	var directionsRenderer = new google.maps.DirectionsRenderer();
	var map = new google.maps.Map(document.getElementById('map'), {
	  	zoom: 9,
    	center: {lat: 1.828374, lng: 103.522828}
	});
	directionsRenderer.setMap(map);
	directionsRenderer.setPanel(document.getElementById('routes'));

	
	calculateAndDisplayRoute(directionsService, directionsRenderer);

	// onchange textinput lokasi
    $("#lokasi,#destinasi").on('change', function(){
	   calculateAndDisplayRoute(directionsService, directionsRenderer);
	})

	$("#jenisBantuan").on("change", function() {

	    var jenisBantuan = $(this).val();
	    
	    if(jenisBantuan == 'TBG')
	    {
	    	calculateAndDisplayRoute(directionsService, directionsRenderer);
	    }
	})

	function calculateAndDisplayRoute(directionsService, directionsRenderer) {
	directionsService.route(
	    {
	      origin: {query: document.getElementById('lokasi').value},
	      destination: {query: document.getElementById('destinasi').value},
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

	        document.getElementById('jarak').value = parseFloat(totalDistance);
	       	
	       	caculateKadarTambang(parseFloat(totalDistance),document.getElementById('destinasi').value);

	      } else {
	        window.alert('Directions request failed due to ' + status);
	      }
	    });
    } 

    function caculateKadarTambang($jarak, $hospital)
    {
    	$.ajax({
		    //type: "GET",
		    url: namaSistem + '/frontend/web/kadar-tambang/get-kadar',  
		    contentType: "application/json; charset=utf-8",  
		    data: {
		    	"jarak": $jarak,
		    	'hospital': $hospital
		  	},        
		    dataType: "json", 
		    async:false,
		    success: function (data) {
		        document.getElementById('kadar').value = data.toFixed(2);

		        var jumlahTambang = parseFloat(data*$jarak);
		        jumlahTambang = jumlahTambang.toFixed(2);
		        document.getElementById('jumlahTambang').value = jumlahTambang;
		    },
		});
    }
});