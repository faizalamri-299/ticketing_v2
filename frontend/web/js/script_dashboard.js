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

function styleFunctionMukim(feature, resolution) {
    styleCache = new ol.style.Style({
      fill: new ol.style.Fill({
        //color: [250,250,250,0]
        color: [9,4,131,0.1],
      }),
      stroke:  new ol.style.Stroke({
          color: [9,4,131,1],
          width: 2
      }),
      text: new ol.style.Text({
        font: 'Bold 10px Calibri,sans-serif',
        fill: new ol.style.Fill({
          color: '#000'
        }),
      })
    });
  
  styleCache.getText().setText(feature.get('MUKIM').toUpperCase());
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

var mapDaerah = new ol.Map({
  target: 'mapDaerah',
  //controls: [],
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

var layerWFSMukimInitial = new ol.layer.Vector({
  source: new ol.source.Vector({
    loader: function(extent) {
      $.ajax('https://geo.bitextreme.com.my/geoserver/wfs', {
        type: 'GET',
        data: {
          service: 'WFS',
          version: '1.1.0',
          request: 'GetFeature',
          typename: 'test:MUKIM_JOHOR',
          srsname: 'EPSG:3857',
          bbox: extent.join(',') + ',EPSG:3857'
        }
      }).done(function(response) {
        layerWFSMukimInitial
        .getSource()
        .addFeatures(new ol.format.WFS()
          .readFeatures(response));
      });
    },
    strategy: ol.loadingstrategy.bbox,
    projection: 'EPSG:3857'
  }),
  style : styleFunctionMukim,
});

var mapMukim = new ol.Map({
  target: 'mapMukim',
  //controls: [],
  controls: [
    //new ol.control.Zoom(),
    new ol.control.ScaleLine,
    //new ol.control.OverviewMap({collapsible : false})
  ],
  layers: [
    new ol.layer.Tile({
      source: new ol.source.OSM()
    }),
    layerWFSMukimInitial
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
//mapDaerah.getView().setZoom(zoom);

var list = document.getElementsByClassName("ol-zoom-extent ol-unselectable ol-control")[0].className;
var buttons = document.getElementsByTagName('button');

// for (var i = 0, len = buttons.length; i < len; ++i) 
// {
//     if(buttons[i].innerHTML == 'E')
//     {
//       buttons[i].innerHTML = '<i class="glyphicon glyphicon-fullscreen">';
//     }
// }

var highlightStyleCache = {};
var featureOverlay = new ol.layer.Vector({
        source: new ol.source.Vector(),
        map: mapDaerah,
        style: function (feature, resolution) {
            var text = resolution * 100000 < 10 ? feature.get('DISTRICT') : '';
            if (!highlightStyleCache[text]) {
                highlightStyleCache[text] = new ol.style.Style({
                    stroke: new ol.style.Stroke({
                        color: '#000',
                        width: 3
                    }),
                    fill: new ol.style.Fill({
                        color: [207,31,37,0.5]
                    }),
                    text: new ol.style.Text({
                        font: 'bold 18px Calibri,sans-serif',
                        text: text,
                        fill: new ol.style.Fill({
                            color: '#000'
                        }),
                        stroke: new ol.style.Stroke({
                            color: '#FFF',
                            width: 4
                        })
                    })
                });
            }

            highlightStyleCache[text].getText().setText(feature.get('DISTRICT').toUpperCase());

            return highlightStyleCache[text];
        }
    });

var highlight;
var displayFeatureInfo = function (pixel) {

    var feature = mapDaerah.forEachFeatureAtPixel(pixel, function (feature) {
        return feature;
    });

    if (feature !== highlight) {
        if (highlight) {
            featureOverlay.getSource().removeFeature(highlight);
        }
        if (feature) {
            featureOverlay.getSource().addFeature(feature);
        }
        highlight = feature;
    }

};


var highlightStyleCacheMukim = {};
var featureOverlayMukim = new ol.layer.Vector({
        source: new ol.source.Vector(),
        map: mapMukim,
        style: function (feature, resolution) {
            var text = resolution * 100000 < 10 ? feature.get('MUKIM') : '';
            if (!highlightStyleCacheMukim[text]) {
                highlightStyleCacheMukim[text] = new ol.style.Style({
                    stroke: new ol.style.Stroke({
                        color: '#000',
                        width: 3
                    }),
                    fill: new ol.style.Fill({
                        color: [9,4,131,0.5]
                    }),
                    text: new ol.style.Text({
                        font: 'bold 18px Calibri,sans-serif',
                        text: text,
                        fill: new ol.style.Fill({
                            color: '#000'
                        }),
                        stroke: new ol.style.Stroke({
                            color: '#FFF',
                            width: 4
                        })
                    })
                });
            }

            highlightStyleCacheMukim[text].getText().setText(feature.get('MUKIM').toUpperCase());

            return highlightStyleCacheMukim[text];
        }
    });

var highlightMukim;
var displayFeatureInfoMukim = function (pixel) {

    var feature = mapMukim.forEachFeatureAtPixel(pixel, function (feature) {
        return feature;
    });

    if (feature !== highlightMukim) {
        if (highlightMukim) {
            featureOverlayMukim.getSource().removeFeature(highlightMukim);
        }
        if (feature) {
            featureOverlayMukim.getSource().addFeature(feature);
        }
        highlightMukim = feature;
    }

};

mapDaerah.on('moveend', function(e) {
  var newZoom = mapDaerah.getView().getZoom();
  mapMukim.getView().setZoom(newZoom);
});

var layerWFSMukim;

mapDaerah.on("singleclick", function (evt) {
  $("#maklumat_rezab_melayu_mukim").css("display", "none");
  mapMukim.removeLayer(layerWFSMukimInitial);
  mapMukim.removeLayer(layerWFSMukim);

  this.forEachFeatureAtPixel(evt.pixel, function (feature, layer) {

    var geom = feature.getGeometry();
    var view = mapDaerah.getView();
    view.fit(geom, mapDaerah.getSize());

    //console.log(mapMukim.getSize());
    var view2 = mapMukim.getView();
    view2.fit(geom, mapMukim.getSize());

    // create vector MUKIM
    var cqlFilter = "DISTRICT = '" + feature.get("DISTRICT").toUpperCase() + "'";

    var vectorMukimSource = new ol.source.Vector({
        loader: function(extent) {
          $.ajax('https://geo.bitextreme.com.my/geoserver/wfs', {
            type: 'GET',
            data: {
              service: 'WFS',
              version: '1.1.0',
              request: 'GetFeature',
              CQL_FILTER: cqlFilter,
              typename: 'test:MUKIM_JOHOR',
              srsname: 'EPSG:3857',
              //bbox: extent.join(',') + ',EPSG:3857' // cant use while filtering
            }
          }).done(function(response) {
            layerWFSMukim
            .getSource()
            .addFeatures(new ol.format.WFS()
              .readFeatures(response));
          });
        },
        strategy: ol.loadingstrategy.bbox,
        projection: 'EPSG:3857'
      });


    layerWFSMukim = new ol.layer.Vector({
      source: vectorMukimSource,
      style : styleFunctionMukim,
    });

    mapMukim.addLayer(layerWFSMukim);

    //get data from db (call yii action)
    $.ajax({
        url: '/boilerplate2/frontend/web/hakmilik/get-luas-rezab-daerah', //change this to the relevant controller and action names
        data:{
          daerah:feature.get("DISTRICT"),
          //mukim:feature.get("MUKIM"),
        },
        dataType: 'json',   
        global:  true,
        beforeSend: function () 
        {
            $("#progressDaerah").css("display", "block");
            $("#maklumat_rezab_melayu_daerah").css("display", "none");
            var elem = document.getElementById("progressBarDaerah"); 
            var width = 1;
            var id = setInterval(frame, 10);
            function frame() {
              if (width >= 100) {
                clearInterval(id);
              } else {
                width++; 
                elem.style.width = width + '%';
                elem.innerHTML = width + '%'; 
              }
            }
        },
        complete: function () 
        {
          setTimeout(function()
            { 
              $("#progressDaerah").css("display", "none");
              document.getElementById("progressBarDaerah").style.width = '10%'; 
              $("#maklumat_rezab_melayu_daerah").css("display", "block"); 
            }, 2000);
        },      
        success:function(data)
        {
          createTableFromJSON(data,'tableDaerah');

          var json_data = data;
          var result = [];
          var total = 0 ;

          for(var i in json_data)
          {
            result.push([json_data[i].Mukim , parseFloat(json_data[i].Jumlah.replace(',', ''))]);
          }

          for(var j in json_data)
          {
            total += parseFloat(json_data[j].Jumlah);
          }

          total = total.toFixed(2);
          total = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

          var optionChart = 
          {
              credits : {'enabled' : false },
              chart: {
                  renderTo: 'chartDaerah',
                  type : 'pie',
                  options3d : 
                  {
                      enabled : true,
                      alpha : 45,
                      beta : 0
                  }        
              },
              title : 
              {
                text : 'LUAS (HEKTAR) <br/>DAERAH <b>' 
                  + feature.get("DISTRICT").toUpperCase() + '</b><br/> MENGIKUT MUKIM<br/>'
                  + '<b>Jumlah keseluruhan : ' + total + ' Hektar</b>',
              },
              plotOptions : {
                  series : {
                      cursor : 'pointer',
                      depth : 35,
                  }
              },                 
              series: [
                {
                  name : 'Luas (Hektar)',
                  type : 'pie',
                  //colorByPoint : true,
                  showInLegend : true,
                  dataLabels : {
                    enabled : true,
                    format : '<b>{point.name}</b> : {point.y}'
                  },
                  data : result
                }
              ]
          };
          var chart = new Highcharts.Chart(optionChart);

        },
        error:function(xhr,statusCode,errorText)
        {
          alert(errorText)
        }
    });

  });

    var pixel = mapDaerah.getEventPixel(evt.originalEvent);
    displayFeatureInfo(evt.pixel);
});




mapMukim.on("singleclick", function (evt) {
  mapMukim.removeLayer(featureOverlayMukim);
  this.forEachFeatureAtPixel(evt.pixel, function (feature, layer) {

    var geom = feature.getGeometry();
    var view = mapMukim.getView();
    view.fit(geom, mapMukim.getSize());


    //get data from db (call yii action)
    $.ajax({
        url: '/boilerplate2/frontend/web/hakmilik/get-luas-rezab-kegunaan', //change this to the relevant controller and action names
        data:{
          daerah:feature.get("DISTRICT"),
          mukim:feature.get("MUKIM"),
        },
        dataType: 'json',   
        global:  true,
        beforeSend: function () 
        {
            $("#progressMukim").css("display", "block");
            $("#maklumat_rezab_melayu_mukim").css("display", "none");
            var elem = document.getElementById("progressBarMukim"); 
            var width = 1;
            var id = setInterval(frame, 10);
            function frame() {
              if (width >= 100) {
                clearInterval(id);
              } else {
                width++; 
                elem.style.width = width + '%';
                elem.innerHTML = width + '%'; 
              }
            }
        },
        complete: function () 
        {
          setTimeout(function()
            { 
              $("#progressMukim").css("display", "none");
              document.getElementById("progressBarMukim").style.width = '10%'; 
              $("#maklumat_rezab_melayu_mukim").css("display", "block"); 
            }, 2000);
        },      
        success:function(data)
        {
          createTableFromJSON(data,'tableMukim');

          var json_data = data;
          var result = [];
          var total = 0 ;

          for(var i in json_data)
          {
            result.push([json_data[i].Kategori , parseFloat(json_data[i].Jumlah.replace(',', ''))]);
          }

          for(var j in json_data)
          {
            total += parseFloat(json_data[j].Jumlah);
          }

          total = total.toFixed(2);
          total = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

          var optionChart = 
          {
              credits : {'enabled' : false },
              chart: {
                  renderTo: 'chartMukim',
                  type : 'pie',
                  options3d : 
                  {
                      enabled : true,
                      alpha : 45,
                      beta : 0
                  }        
              },
              title : 
              {
                text : 'LUAS (HEKTAR)<br/>' 
                  + '<br/>MUKIM <b>' + feature.get("MUKIM").toUpperCase() 
                  + '</b><br/> MENGIKUT KATEGORI TANAH<br/>' 
                  + '<b>Jumlah keseluruhan : ' + total + ' Hektar</b>',
              },
              plotOptions : {
                  series : {
                      cursor : 'pointer',
                      depth : 35,
                  }
              },                 
              series: [
                {
                  name : 'Luas (Hektar)',
                  type : 'pie',
                  //colorByPoint : true,
                  showInLegend : true,
                  dataLabels : {
                    enabled : true,
                    format : '<b>{point.name}</b> : {point.y}'
                  },
                  data : result
                }
              ]
          };
          var chart = new Highcharts.Chart(optionChart);

        },
        error:function(xhr,statusCode,errorText)
        {
          alert(errorText)
        }
    });

    });

    var pixel = mapMukim.getEventPixel(evt.originalEvent);
    displayFeatureInfoMukim(evt.pixel);

});




function createTableFromJSON(json,elem) 
{
    // EXTRACT VALUE FOR HTML HEADER. 
    var col = [];
    for (var i = 0; i < json.length; i++) {
        for (var key in json[i]) {
            if (col.indexOf(key) === -1) {
                col.push(key);
            }
        }
    }

    // CREATE DYNAMIC TABLE.
    var table = document.createElement("table");

    table.className = "table table-striped table-hover"; 

    // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

    var tr = table.insertRow(-1);                   // TABLE ROW.

    for (var i = 0; i < col.length; i++) {
        var th = document.createElement("th");      // TABLE HEADER.
        th.innerHTML = col[i];
        tr.appendChild(th);
    }

    // ADD JSON DATA TO THE TABLE AS ROWS.
    for (var i = 0; i < json.length; i++) {

        tr = table.insertRow(-1);

        for (var j = 0; j < col.length; j++) {
            var tabCell = tr.insertCell(-1);
            tabCell.innerHTML = json[i][col[j]];
        }
    }

    // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
    var divContainer = document.getElementById(elem);
    divContainer.innerHTML = "";
    divContainer.appendChild(table);
}











