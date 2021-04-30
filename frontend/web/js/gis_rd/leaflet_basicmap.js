$( document ).ready(function() {

  var mymap = L.map('map').setView([4.732116, 108.915024], 6);

  L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    maxZoom: 18,
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
      '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
      'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    id: 'mapbox/streets-v11'
  }).addTo(mymap);

  var circle = L.circle([3.581406, 102.172852], {
	    color: 'red',
	    fillColor: '#f03',
	    fillOpacity: 0.5,
	    radius: 50000
	}).addTo(mymap);

  var polygon = L.polygon([
	    [2.747726, 112.324219],
	    [2.04522, 113.818359],
	    [2.769673, 114.32373],
	    [2.374564, 112.258301]
	]).addTo(mymap);


	var popup = L.popup();

	function onMapClick(e) {
		var marker = L.marker(e.latlng).addTo(mymap);
	    popup
	        .setContent("You clicked the map at " + e.latlng.toString());
	    marker.bindPopup(popup).openPopup();

	    document.getElementById('latitude').value = e.latlng.lat;
    	document.getElementById('longitude').value = e.latlng.lng;
	}

	mymap.on('click', onMapClick);

});
