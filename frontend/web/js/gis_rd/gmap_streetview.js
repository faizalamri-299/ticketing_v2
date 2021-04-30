
  var map, infoWindow;
  var markers = [];

  var geocoder = new google.maps.Geocoder;

    map = new google.maps.Map(document.getElementById('map'), 
    {
      center: {lat: 2.1054174, lng: 103.4137753},
      zoom: 16
    });

    infoWindow = new google.maps.InfoWindow;

    // onchange textinput lokasi
    document.getElementById("lokasi").onchange = function(e) 
    {
        var address = document.getElementById("lokasi").value;
        var latLng;

        var img_attributes = document.getElementById("img_attributes");

        // get latlong based on lokasi
        geocoder.geocode({'address': address}, function(results, status) 
        {
          if (status === 'OK') 
          {
            if (results[0]) 
            {
              latLng = results[0].geometry.location;

              document.getElementById('latitude').value = results[0].geometry.location.lat();
              document.getElementById('longitude').value = results[0].geometry.location.lng();

              var lat =results[0].geometry.location.lat();
              var lon = results[0].geometry.location.lng();

              var newLatLng = new google.maps.LatLng(lat, lon);

              map.setCenter(newLatLng);

              //zoom based on results
              if (results[0].geometry.viewport) 
                map.fitBounds(results[0].geometry.viewport);

              var gps_info;
              gps_info = new google.maps.InfoWindow;
              gps_info.setContent('Lokasi yang dimasukkan DISINI!!!');

              var gps_marker = new google.maps.Marker({
                position: newLatLng, 
                map: map,
                icon: {
                  path: google.maps.SymbolPath.CIRCLE,
                  scale: 10,
                  strokeColor: '#ff1e20'
                },
              });

              // blinking marker for current location
              var intervalSeconds = 1;
              var on = true;
              setInterval(function() {
                 if(on) {
                   gps_marker.setMap(null);
                 } else {
                   gps_marker.setMap(map);
                 }
                on = !on;
              }, intervalSeconds * 1000);

              //marker click event
              google.maps.event.addListener(gps_marker, 'click', function() {
                gps_info.open(map, gps_marker);
              });


            }
          } 
          else 
          {
            //window.alert('Geocoder failed due to: ' + status);
            img_attributes.innerHTML = "Maklumat lokasi tidak dapat dijumpai.";
          }
      });

    }

    // Try HTML5 geolocation.
    if (navigator.geolocation) 
    {
      navigator.geolocation.getCurrentPosition(function(position) 
      {
        var pos = 
        {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };

        var gps_info;
        gps_info = new google.maps.InfoWindow;
        gps_info.setContent('Anda DISINI!!!');

        var gps_marker = new google.maps.Marker({
          position: pos, 
          map: map,
          icon: {
            path: google.maps.SymbolPath.CIRCLE,
            scale: 10,
            strokeColor: '#1E90FF'
          },
        });

        // blinking marker for current location
        var intervalSeconds = 1;
        var on = true;
        setInterval(function() {
           if(on) {
             gps_marker.setMap(null);
           } else {
             gps_marker.setMap(map);
           }
          on = !on;
        }, intervalSeconds * 1000);

        map.setCenter(pos);

        google.maps.event.addListener(gps_marker, 'click', function() {
            gps_info.open(map, gps_marker);
          });
      }, 
      function() 
      {
        handleLocationError(true, gps_marker, map.getCenter());
      });
    } 
    else 
    {
      // Browser doesn't support Geolocation
      handleLocationError(false, gps_marker, map.getCenter());
    }

  function handleLocationError(browserHasGeolocation, infoWindow, pos) 
  {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
                          'Error: The Geolocation service failed.' :
                          'Error: Your browser doesn\'t support geolocation.');
    infoWindow.open(map);
  }

  google.maps.event.addListener(map, 'click', function(event) {
    document.getElementById("latitude").value = event.latLng.lat();
    document.getElementById("longitude").value = event.latLng.lng();

    var newLatLng = new google.maps.LatLng(event.latLng.lat(), event.latLng.lng());
    // get address based on latlong
    geocoder.geocode({'location': newLatLng}, function(results, status) 
    {
      if (status === 'OK') 
      {
        if (results[0]) 
        {
          document.getElementById("lokasi").value = results[0].formatted_address;
        }
      } 
      else 
      {
        window.alert('Geocoder failed due to: ' + status);
      }
    });

    var panorama = new google.maps.StreetViewPanorama(
            document.getElementById('pano'), {
              position: event.latLng,
              pov: {
                heading: 34,
                pitch: 10
              }
            });
        map.setStreetView(panorama);

  });

  // Adds a marker to the map and push to the array.
  function addMarker(location) 
  {
    deleteMarkers()
    marker = new google.maps.Marker({
          position: location, 
          map: map
      });

      markers.push(marker);

      document.getElementById("latitude").value = location.lat();
      document.getElementById("longitude").value = location.lng();

      var newLatLng = new google.maps.LatLng(location.lat(), location.lng());

      // get address based on latlong
      geocoder.geocode({'location': newLatLng}, function(results, status) 
      {
        if (status === 'OK') 
        {
          if (results[0]) 
          {
            document.getElementById("lokasi").value = results[0].formatted_address;
          }
        } 
        else 
        {
          window.alert('Geocoder failed due to: ' + status);
        }
      });
  }

  // Sets the map on all markers in the array.
  function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(map);
    }
  }

  // Removes the markers from the map, but keeps them in the array.
  function clearMarkers() {
    setMapOnAll(null);
  }

  // Shows any markers currently in the array.
  function showMarkers() {
    setMapOnAll(map);
  }

  // Deletes all markers in the array by removing references to them.
  function deleteMarkers() {
    clearMarkers();
    markers = [];
  }

  function pinSymbol(color) 
  {
    return {
      path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z',
      fillColor: color,
      fillOpacity: 1,
      strokeColor: '#000',
      strokeWeight: 1,
      scale: 1
  };
}