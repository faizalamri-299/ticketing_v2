
  var map, infoWindow;
  var markers = [];

  var geocoder = new google.maps.Geocoder;

    map = new google.maps.Map(document.getElementById('map'), 
    {
      center: {lat: 1.564317, lng: 103.745903},
      zoom: 19
    });

    // add markers aduan by id

    // get data from DB
    var urlsys = window.location.hostname;
    var id = getUrlParameter('id');

    var getUrl = window.location;
    // var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

    

    // if(urlsys.includes('sijf.my'))
    // {
    //   var url = '/kejiranan/aduan/get-aduan-byid?id='+id;
    //   var urlgambar = "/data/aduan/";
    // }
    // else
    // {
    var url = '/boilerplate2/frontend/web/aduan-awam/get-aduan-byid?id='+id;
    var urlgambar = "/boilerplate2/data/aduan/";
    // }

    console.log(url);
    $.ajax({ 
        type: "GET",
        url: url,             
        dataType: "json",            
        success: function(data){ 
              
              var newLatLng = new google.maps.LatLng(data.aa_mod_lat, data.aa_mod_long);
              map.setCenter(newLatLng);

              var gambar = urlgambar + data.id + "/" + data.aa_mod_gambar;
              var content = "<h5 style='text-transform:uppercase;'><b>" + data.aa_mod_aduan + "</b></h5>"  +
                  "<table style='text-align: right;border-collapse:separate; border-spacing:0.5em; max-width: 250px;'>" +
                        "<tr><td></td> <td><img src='" + gambar +"' alt='' height='100' width='100'> </td> </tr>" +
                        "<tr><td><b>Lokasi : </b></td> <td>" + data.aa_mod_lokasi + " </td> </tr>" +
                        "<tr><td><b>Keterangan : </b></td> <td>" + data.aa_mod_keterangan + " </td> </tr>" +
                        "<tr><td><b>Status : </b></td> <td>" + data.aa_mod_status + " </td> </tr>" +
                        "<tr><td><b>Catatan : </b></td> <td>" + data.aa_mod_catatan + " </td> </tr>" +
                        "</table>" +
                  "</form>";
              var icon;

              if(data.aa_mod_status == 'Baru')
              {
                  icon = 'https://maps.google.com/mapfiles/ms/icons/red-dot.png';
              }
              else if(data.aa_mod_status == 'Dalam Proses')
              {
                  icon = 'https://maps.google.com/mapfiles/ms/icons/yellow-dot.png';
              }
              else if(data.aa_mod_status == 'Selesai')
              {
                  icon = 'https://maps.google.com/mapfiles/ms/icons/green-dot.png';
              }
              else
              {
                  icon = 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png';
              }

              var aduan = new google.maps.Marker({
                  position: newLatLng, 
                  map: map,
                  icon: icon
              });

              var infowindow = new google.maps.InfoWindow({
                  content: content
                });

              infowindow.open(map, aduan);

              google.maps.event.addListener(aduan, 'click', function() {
                infowindow.open(map, aduan);
              });
        }

    });


    function getUrlParameter(sParam) 
    {
      var sPageURL = window.location.search.substring(1),
          sURLVariables = sPageURL.split('&'),
          sParameterName,
          i;

      for (i = 0; i < sURLVariables.length; i++) 
      {
          sParameterName = sURLVariables[i].split('=');

          if (sParameterName[0] === sParam) {
              return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
          }
      }
    };


