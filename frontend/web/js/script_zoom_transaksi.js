
var map, infoWindow;
var markers = [];
var geocoder = new google.maps.Geocoder;

map = new google.maps.Map(document.getElementById('map'), {
  center: {lat: 4.018995, lng: 102.877244},
  zoom: 12,
  //mapTypeId: 'satellite'
});

// get data from DB
var urlsys = window.location.hostname;
var id = getUrlParameter('transaksi');

// get data from DB
var urlsys = window.location.hostname;
// if(urlsys.includes('bitextreme.com.my'))
// {
//   var namaSistem = '/skator2';
// }
// else
// {
   var namaSistem = '/boilerplate2';
// }

$.ajax({ 
    type: "GET",
    url: namaSistem + '/frontend/web/transaksi/get-transaksi-byid?id='+id,            
    dataType: "json",            
    success: function(data){ 
      var newLatLng = new google.maps.LatLng(data.ts_mod_latitud, data.ts_mod_longitud);
      map.setCenter(newLatLng);

      var content = "<h5 style='text-transform:uppercase;'><b>" + data.ts_mod_ip_klien + "</b></h5>"  +
          "<table style='text-align: right;border-collapse:separate; border-spacing:0.5em; max-width: 250px;'>" +
                "<tr><td><b>Lokasi : </b></td> <td>" + data.ts_mod_bandar + ',' + data.ts_mod_negara + " </td> </tr>" +
                "</table>" +
          "</form>";

      var icon = 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png';

      var transaksi = new google.maps.Marker({
          position: newLatLng, 
          map: map,
          icon: icon
      });

      var infowindow = new google.maps.InfoWindow({
          content: content
        });

      infowindow.open(map, transaksi);

      google.maps.event.addListener(transaksi, 'click', function() {
        infowindow.open(map, transaksi);
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