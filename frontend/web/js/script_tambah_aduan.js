
  var map, infoWindow;
  var markers = [];

  var geocoder = new google.maps.Geocoder;

    map = new google.maps.Map(document.getElementById('map'), 
    {
      center: {lat: 1.564317, lng: 103.745903},
      zoom: 19
    });

    infoWindow = new google.maps.InfoWindow;

    // zoom to aduan from gridview
    $(document).on("click", ".zoom", function(){
            
            var latlong = $(this).attr('value');

            var latlongArr = latlong.split(',');

            var newLatLng = new google.maps.LatLng(latlongArr[0], latlongArr[1]);

            map.setCenter(newLatLng);
    });

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

    // onchange fileinput gambar
    // get corrdinate based on image upload
    document.getElementById("file-input").onchange = function(e) 
    {
        var file = e.target.files[0]
        if (file && file.name) 
        {
          var img_attributes = document.getElementById("img_attributes");
            EXIF.getData(file, function() {
                var exifData = EXIF.pretty(this);
                if (exifData) 
                {
                    console.log(exifData);

                    img_attributes.innerHTML = "<b>Gambar ditangkap menggunakan " 
                        + EXIF.getTag(this, "Make") + ' '
                        + EXIF.getTag(this, "Model")
                        + " pada " +EXIF.getTag(this, "DateTimeOriginal");
                    
                    //convert DMS to DD
                    //based on maker iphone x samsung etc

                    var lat,lon;

                    if(EXIF.getTag(this, "Make") == 'Apple') // ios
                    {
                        //latitude
                        var latitudeRaw =  EXIF.getTag(this, "GPSLatitude").toString();
                        var latitudeArr = latitudeRaw.split(',');

                        //longitude
                        var longitudeRaw =  EXIF.getTag(this, "GPSLongitude").toString();
                        var longitudeArr = longitudeRaw.split(',');

                        lon = longitudeArr[0] + "°" + longitudeArr[1] + "'" + longitudeArr[2] +"\"";
                        lat = latitudeArr[0] + "°" + latitudeArr[1] + "'" + latitudeArr[2] +"\"";

                        var point = new GeoPoint(lon, lat);

                        lon = point.getLonDec();
                        lat  = point.getLatDec();
                    }
                    else // android
                    {
                        //latitude
                        var latitudeRaw =  EXIF.getTag(this, "GPSLatitude").toString();
                        var latitudeArr = latitudeRaw.split(',');

                        //longitude
                        var longitudeRaw =  EXIF.getTag(this, "GPSLongitude").toString();
                        var longitudeArr = longitudeRaw.split(',');

                        lon = longitudeArr[0];
                        lat = latitudeArr[0];
                    }

                    document.getElementById("latitude").value = lat;
                    document.getElementById("longitude").value = lon;

                    var newLatLng = new google.maps.LatLng(lat, lon);

                    // get address based on latlong
                    geocoder.geocode({'location': newLatLng}, function(results, status) 
                    {
                      if (status === 'OK') 
                      {
                        if (results[0]) 
                        {
                          document.getElementById("lokasi").value = results[0].formatted_address;

                          //zoom based on results
                          if (results[0].geometry.viewport) 
                            map.fitBounds(results[0].geometry.viewport);
                        }
                      } 
                      else 
                      {
                        //window.alert('Geocoder failed due to: ' + status);
                        img_attributes.innerHTML = "Tiada maklumat lokasi pada data EXIF dalam gambar '" + file.name + "'.";
                      }
                  });


                    map.setCenter(newLatLng);

                    var gps_info;
                    gps_info = new google.maps.InfoWindow;
                    gps_info.setContent('Gambar yang dimuatnaik ditangkap DISINI!!!');

                    var gps_marker = new google.maps.Marker({
                      position: newLatLng, 
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

                    //marker click event
                    google.maps.event.addListener(gps_marker, 'click', function() {
                      gps_info.open(map, gps_marker);
                    });

                } 
                else 
                {
                    //alert("Tiada data EXIF dalam gambar '" + file.name + "'.");
                    img_attributes.innerHTML = "Tiada data EXIF dalam gambar '" + file.name + "'.";
                }
            });
        }
    }


    // add markers aduan by current user

    // get data from DB
    var urlsys = window.location.hostname;

    var getUrl = window.location;
    // var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

    
    // if(urlsys.includes('sijf.my'))
    // {
    //   var url = '/kejiranan/aduan/get-aduan-pengadu';
    //   var urlgambar = "/data/aduan/";
    // }
    // else
    // {
       var url = '/boilerplate2/frontend/web/aduan-awam/get-aduan-pengadu';
       var urlgambar = "/boilerplate2/data/aduan/";
    // }

    $.ajax({ 
        type: "GET",
        url: url,             
        dataType: "json",            
        success: function(data){  
             $.each(data, function(index, aduan) {
              //alert(aduan.aa_mod_aduan);

              var gambar = urlgambar + aduan.id + "/" + aduan.aa_mod_gambar;
              var content = "<h5 style='text-transform:uppercase;'><b>" + aduan.aa_mod_aduan + "</b></h5>"  +
                  "<table style='text-align: right;border-collapse:separate; border-spacing:0.5em; max-width: 250px;'>" +
                        "<tr><td></td> <td><img src='" + gambar +"' alt='' height='100' width='100'> </td> </tr>" +
                        "<tr><td><b>Lokasi : </b></td> <td>" + aduan.aa_mod_lokasi + " </td> </tr>" +
                        "<tr><td><b>Keterangan : </b></td> <td>" + aduan.aa_mod_keterangan + " </td> </tr>" +
                        "<tr><td><b>Status : </b></td> <td>" + aduan.aa_mod_status + " </td> </tr>" +
                        "<tr><td><b>Catatan : </b></td> <td>" + aduan.aa_mod_catatan + " </td> </tr>" +
                        "</table>" +
                  "</form>";
              var icon;

              if(aduan.aa_mod_status == 'Baru')
              {
                  icon = 'https://maps.google.com/mapfiles/ms/icons/red-dot.png';
              }
              else if(aduan.aa_mod_status == 'Dalam Proses')
              {
                  icon = 'https://maps.google.com/mapfiles/ms/icons/yellow-dot.png';
              }
              else if(aduan.aa_mod_status == 'Selesai')
              {
                  icon = 'https://maps.google.com/mapfiles/ms/icons/green-dot.png';
              }
              else
              {
                  icon = 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png';
              }

              var newLatLng = new google.maps.LatLng(aduan.aa_mod_lat, aduan.aa_mod_long);

              var aduan = new google.maps.Marker({
                  position: newLatLng, 
                  map: map,
                  icon: icon
              });

              //var ge = new GoogleEarth(map);

              var infowindow = new google.maps.InfoWindow({
                  content: content
                });

              google.maps.event.addListener(aduan, 'click', function() {
                infowindow.open(map, aduan);
              });
          });    
        }

    });

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
   addMarker(event.latLng);
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

      // var infowindow = new google.maps.InfoWindow({
      //   content: 'Latitude: ' + location.lat() +
      //   '<br>Longitude: ' + location.lng()
      // });
      // infowindow = new google.maps.InfoWindow({
      //     content: "<h5>ADUAN</h5>"  +
      //     "<form id='data' method='POST' enctype='multipart/form-data'>" +
      //     "<table style='text-align: right;border-collapse:separate; border-spacing:0.5em;'>" +
      //         "<tr><td>Tajuk Aduan : </td> <td><input type='text' id='aduan' name='aduan' class='form-control'/> </td> </tr>" +
      //           "<tr><td>Lokasi : </td> <td><input type='text' id='lokasi' name='lokasi' class='form-control'/> </td> </tr>" +
      //           "<tr><td>Keterangan Aduan : </td> <td><textarea rows='4' cols='30' id='keterangan' name='keterangan' class='form-control'></textarea> </td> </tr>" +
      //           "<tr><td>Gambar : </td> <td><input type='file' id='gambar' name='gambar' ></td> </tr>" +
      //           "</table>" +
      //           "<br/><input type='button' class='btn btn-primary' value='HANTAR ADUAN' id='hantar' onclick='saveData()'/>" +
      //     "</form>"
      //   });


      // infowindow.open(map,marker);
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

  // saves data from info window
  function saveData() 
  {
    var aduan = escape(document.getElementById('aduan').value);
    var lokasi = escape(document.getElementById('lokasi').value);
    var keterangan = document.getElementById('keterangan').value;

    if (aduan == "") {
      alert("Tajuk perlu diisi");
      return false;
    }
    if (lokasi == "") {
      alert("Lokasi perlu diisi");
      return false;
    }
    if (keterangan == "") {
      alert("Keterangan perlu diisi");
      return false;
    }

    var latlng = marker.getPosition();

    var urlsys = window.location.hostname;

    var getUrl = window.location;
    // var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

    var url = '/boilerplate2/frontend/web/aduan-awam/create?lat=' + latlng.lat() + '&lng=' + latlng.lng();

    downloadUrl(url);
  }

  function downloadUrl(url, callback) 
  {
    //e.preventDefault();    
    var formData = new FormData(document.getElementById('data'));

    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        success: function (data) {
            infowindow.close();

            var successmessagewindow = new google.maps.InfoWindow({
              content: '<div id="message">Aduan telah disimpan ke Pangkalan Data.</div>'
            });

            successmessagewindow.open(map, marker);
        },
        error: function(response){
            infowindow.close();

            var errormessagewindow = new google.maps.InfoWindow({
              content: '<div id="message">Aduan tidak  disimpan ke Pangkalan Data.Terdapat ralat : ' + response.status +'</div>'
            });

            errormessagewindow.open(map, marker);
        },
        cache: false,
        contentType: false,
        processData: false
    });
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