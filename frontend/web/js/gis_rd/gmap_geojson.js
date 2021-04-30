var map;

  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 9,
    center: {lat: 1.828374, lng: 103.522828}
  });

  // Load GeoJSON.
  map.data.loadGeoJson(
      'https://geo.bitextreme.com.my/geoserver/test/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=test:MUKIM_JOHOR&maxFeatures=50&outputFormat=application/json');

  // Color each letter gray. Change the color when the isColorful property
  // is set to true.
  map.data.setStyle(function(feature) {
    var color = 'blue';
    if (feature.getProperty('isColorful')) {
      color = 'red';
    }
    return /** @type {!google.maps.Data.StyleOptions} */({
      fillColor: color,
      strokeColor: color,
      strokeWeight: 2
    });
  });

  // When the user clicks, set 'isColorful', changing the color of the letters.
  // map.data.addListener('click', function(event) {
  //   event.feature.setProperty('isColorful', true);
  // });

  // When the user hovers, tempt them to click by outlining the letters.
  // Call revertStyle() to remove all overrides. This will use the style rules
  // defined in the function passed to setStyle()
  map.data.addListener('mouseover', function(event) {
    map.data.revertStyle();
    map.data.overrideStyle(event.feature, {strokeWeight: 8});
    document.getElementById('negeri').innerHTML = event.feature.getProperty('STATE');
    document.getElementById('daerah').innerHTML = event.feature.getProperty('DISTRICT');
    document.getElementById('mukim').innerHTML = event.feature.getProperty('MUKIM');
  });

  map.data.addListener('mouseout', function(event) {
    map.data.revertStyle();
  });
