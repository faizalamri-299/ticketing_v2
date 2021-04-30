
var map;
var heatmap;
var heatMapDataDB = [];
var pointArray = [];

/* Data points defined as a mixture of WeightedLocation and LatLng objects */
var heatMapData = [
  new google.maps.LatLng(1.5333, 103.6667),
  new google.maps.LatLng(1.5333, 103.6667),
  new google.maps.LatLng(1.5333, 103.6667),
  new google.maps.LatLng(1.5333, 103.6667),
  new google.maps.LatLng(1.5333, 103.6667),
  new google.maps.LatLng(1.5333, 103.6667),
  new google.maps.LatLng(1.5333, 103.6667),
];

map = new google.maps.Map(document.getElementById('map'), {
  center: {lat: 4.732116, lng: 108.915024},
  zoom: 6,
  mapTypeId: 'satellite'
});


// get data from DB
var urlsys = window.location.hostname;
var namaSistem = '/boilerplate2';

$.ajax({ 
    type: "GET",
    url: namaSistem + '/frontend/web/transaksi/get-lat-long-transaksi', //change this to the relevant controller and action names             
    dataType: "json",            
    success: function(data){ 
      $.each(data, function(index, transaksi) {
        heatMapDataDB.push(new google.maps.LatLng(transaksi.ts_mod_latitud, transaksi.ts_mod_longitud)); 
      });

      pointArray = new google.maps.MVCArray(heatMapDataDB);

      heatmap = new google.maps.visualization.HeatmapLayer({
        data: pointArray,
        radius: 20
      });

      heatmap.setMap(map);
    }

});

function toggleHeatmap() {
  heatmap.setMap(heatmap.getMap() ? null : map);
}

function changeGradient() {
  var gradient = [
    'rgba(0, 255, 255, 0)',
    'rgba(0, 255, 255, 1)',
    'rgba(0, 191, 255, 1)',
    'rgba(0, 127, 255, 1)',
    'rgba(0, 63, 255, 1)',
    'rgba(0, 0, 255, 1)',
    'rgba(0, 0, 223, 1)',
    'rgba(0, 0, 191, 1)',
    'rgba(0, 0, 159, 1)',
    'rgba(0, 0, 127, 1)',
    'rgba(63, 0, 91, 1)',
    'rgba(127, 0, 63, 1)',
    'rgba(191, 0, 31, 1)',
    'rgba(255, 0, 0, 1)'
  ]
  heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
}

function changeRadius() {
  heatmap.set('radius', heatmap.get('radius') ? null : 20);
}

function changeOpacity() {
  heatmap.set('opacity', heatmap.get('opacity') ? null : 0.2);
}
