$( document ).ready(function() {
  
  var directionsService = new google.maps.DirectionsService();
  var directionsRenderer = new google.maps.DirectionsRenderer();
  var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 14,
      center: {lat: 1.4234574, lng: 103.6500283}
  });
  directionsRenderer.setMap(map);


  var onChangeHandler = function() {
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

        } else {
          window.alert('Directions request failed due to ' + status);
        }
      });
    } 
});