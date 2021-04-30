var mapService = 'test:DAERAH_JOHOR';
var lat = 103.4137753;
var long = 2.1054174;
var zoom = 8.5;
var mapCenter = ol.proj.transform([lat,long], 'EPSG:4326', 'EPSG:3857');

var styleCache;

function styleFunctionDaerah(feature, resolution) {
    styleCache = new ol.style.Style({
      fill: new ol.style.Fill({
        //color: [250,250,250,0]
        color: [207,31,37,0.1],
      }),
      stroke:  new ol.style.Stroke({
          color: [207,31,37,1],
          width: 3
      }),
      text: new ol.style.Text({
        font: 'Bold 12px Calibri,sans-serif',
        fill: new ol.style.Fill({
          color: '#000'
        }),
      })
    });
  
  styleCache.getText().setText(feature.get('DISTRICT').toUpperCase());
  return [styleCache];
}

var layerWFSDaerah = new ol.layer.Vector({
  source: new ol.source.Vector({
    loader: function(extent) {
      $.ajax('https://geo.bitextreme.com.my/geoserver/wfs', {
        type: 'GET',
        data: {
          service: 'WFS',
          version: '1.1.0',
          request: 'GetFeature',
          typename: mapService,
          srsname: 'EPSG:3857',
          bbox: extent.join(',') + ',EPSG:3857'
        }
      }).done(function(response) {
        layerWFSDaerah
        .getSource()
        .addFeatures(new ol.format.WFS()
          .readFeatures(response));
      });
    },
    strategy: ol.loadingstrategy.bbox,
    projection: 'EPSG:3857'
  }),
  style : styleFunctionDaerah,
});


var select = new ol.interaction.Select({
  wrapX: false
});

var modify = new ol.interaction.Modify({
  features: select.getFeatures()
});


var mapDaerah = new ol.Map({
  interactions: ol.interaction.defaults().extend([select, modify]),
  target: 'mapDaerah',
  controls: [
    new ol.control.Zoom(),
    new ol.control.ScaleLine,
    new ol.control.OverviewMap({collapsible : false})
  ],
  layers: [
    new ol.layer.Tile({
      source: new ol.source.OSM()
    }),
    layerWFSDaerah
  ],
  view: new ol.View({
    center: mapCenter,
    zoom: 8.5
  })
});


var extent = mapDaerah.getView().calculateExtent();
var zoomToExtentControl = new ol.control.ZoomToExtent({
  extent: extent
});

mapDaerah.addControl(zoomToExtentControl);













