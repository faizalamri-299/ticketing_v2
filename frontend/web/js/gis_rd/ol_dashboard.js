var mapService = 'test:Negeri';
var lat = 109.546469;
var long = 3.755218;
var zoom = 5.5;
var mapCenter = ol.proj.transform([lat,long], 'EPSG:4326', 'EPSG:3857');

var styleCache;

initChart();

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
  
  styleCache.getText().setText(feature.get('NEGERI').toUpperCase());
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

var map = new ol.Map({
  target: 'map',
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
    zoom: 5.5
  })
});



var extent = map.getView().calculateExtent();
var zoomToExtentControl = new ol.control.ZoomToExtent({
  extent: extent
});

map.addControl(zoomToExtentControl);
//map.getView().setZoom(zoom);

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
        map: map,
        style: function (feature, resolution) {
            var text = resolution * 100000 < 10 ? feature.get('NEGERI') : '';
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

            highlightStyleCache[text].getText().setText(feature.get('NEGERI').toUpperCase());

            return highlightStyleCache[text];
        }
    });

var highlight;
var displayFeatureInfo = function (pixel) {

    var feature = map.forEachFeatureAtPixel(pixel, function (feature) {
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


map.on('moveend', function(e) {
  var newZoom = map.getView().getZoom();
});


map.on("singleclick", function (evt) {

  this.forEachFeatureAtPixel(evt.pixel, function (feature, layer) {

    var geom = feature.getGeometry();
    var view = map.getView();
    view.fit(geom, map.getSize());

    $("#negeri").html(feature.get("NEGERI"));
    $("#negeriSubs").html(feature.get("NEGERI"));
    //get data from db (call yii action)
    $.ajax({
        url: '/boilerplate2/frontend/web/geomap/get-data-hakmilik-strata', //change this to the relevant controller and action names
        data:{
          negeri:feature.get("NEGERI"),
        },
        dataType: 'json',   
        global:  true,
        beforeSend: function () 
        {
            
        },
        complete: function () 
        {
          
        },      
        success:function(data)
        {
          
        	if(data.length != 0)
        	{
        		refreshChart(data[0].permohonan_skim, data[0].pendaftaran_skim, data[0].permohonan_hakmilik, data[0].pendaftaran_hakmilik);
        	}
        	else
        	{
        		refreshChart('0,0','0,0','0,0','0,0');
        	}
        	
        },
        error:function(xhr,statusCode,errorText)
        {
          alert(errorText)
        }
    });

  });

    var pixel = map.getEventPixel(evt.originalEvent);
    displayFeatureInfo(evt.pixel);
});

function initChart()
{

	Highcharts.chart('chart1', {
	    chart: {
	        type: 'pie',
	        options3d: {
	            //enabled: true,
	            //alpha: 45
	        }
	    },
	    exporting: {
		    enabled: false
		},
	    title: {
	        text: ''
	    },
	    subtitle: {
	        text: ''
	    },
	    plotOptions: {
	        pie: {
	            allowPointSelect: true,
		        cursor: 'pointer',
		            dataLabels: {
		                enabled: false,
		        }
	        }
	    },
	    credits: {
		     enabled: false,
		},
	    series: [{
	        name: 'Skim',
	        data: [
	            {
		        	name: 'Permohonan',
			        y: 16052,
			        color: '#66b1fd'
			    }, 
			    {
			        name: 'Pendaftaran',
			        y: 15243,
			        color: '#fd66fd'
			    }
	        ]
	    }]
	});

	Highcharts.chart('chart2', {
	    chart: {
	        type: 'pie',
	        // options3d: {
	        //     enabled: true,
	        //     alpha: 15,
	        //     beta: 15,
	        //     depth: 50,
	        //     viewDistance: 25
	        // }
	    },
	    title: {
	        text: ''
	    },
	    exporting: {
		    enabled: false
		},
	    xAxis: {
	        categories: ['Permohonan', 'Pendaftaran']
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: 'Jumlah (RM)'
	        },
	        max:1000,
	    },
	    credits: {
		     enabled: false,
		},
	    plotOptions: {
	        pie: {
	            allowPointSelect: true,
		        cursor: 'pointer',
		            dataLabels: {
		                enabled: false,
		        }
	        }
	    },
	    series: [{
	        data:[
	        	{
		        	name: 'Permohonan',
			        y: 1355932,
			        color: '#fdb266'
			    }, 
			    {
		        	name: 'Pendaftaran',
			        y: 1178545,
			        color: '#fd66b1'
			    }, 
			    
	        ],
	        name: 'Hakmilik Strata',
	        showInLegend: false
	    }]
	});


	Highcharts.chart('chart3', {
	    chart: {
	        type: 'pie',
	        // options3d: {
	        //     enabled: true,
	        //     alpha: 45
	        // }
	    },
	    exporting: {
		    enabled: false
		},
	    title: {
	        text: ''
	    },
	    subtitle: {
	        text: ''
	    },
	    plotOptions: {
	        pie: {
	            allowPointSelect: true,
		        cursor: 'pointer',
		            dataLabels: {
		                enabled: false,
		        }
	        }
	    },
	    credits: {
		     enabled: false,
		},
	    series: [{
	        name: 'Hakmilik',
	        data: [
	            {
		        	name: 'Seluruh Malaysia',
			        y: 1178545,
			        color: '#b1fd66'
			    }, 
			    {
			        name: 'Negeri Dipilih',
			        y: value2,
			        color: '#fd66fd'
			    }
	        ]
	    }]
	});
}

function refreshChart(permohonanSkim, pendaftaranSkim, permohonanHakmilik, pendaftaranHakmilik)
{

	$("#value1").html(permohonanSkim);
	$("#value2").html(pendaftaranSkim);

	Highcharts.chart('chart1', {
	    chart: {
	        type: 'pie',
	        // options3d: {
	        //     enabled: true,
	        //     alpha: 45
	        // }
	    },
	    title: {
	        text: ''
	    },
	    subtitle: {
	        text: ''
	    },
	    exporting: {
		    enabled: false
		 },
	    plotOptions: {
	        pie: {
	            allowPointSelect: true,
		        cursor: 'pointer',
		            dataLabels: {
		                enabled: false,
		        }
	        }
	    },
	    credits: {
		     enabled: false,
		},
	    series: [{
	        name: 'Skim',
	        data: [
	            {
		        	name: 'Permohonan',
			        y: parseInt(permohonanSkim.replace(/,/g, '')),
			        color: '#66b1fd'
			    }, 
			    {
			        name: 'Pendaftaran',
			        y: parseInt(pendaftaranSkim.replace(/,/g, '')),
			        color: '#fd66fd'
			    }
	        ]
	    }]
	});


	$("#value3").html(permohonanHakmilik);
	$("#value4").html(pendaftaranHakmilik);

	Highcharts.chart('chart2', {
	    chart: {
	        type: 'pie',
	        options3d: {
	            // enabled: true,
	            // alpha: 15,
	            // beta: 15,
	            // depth: 50,
	            // viewDistance: 25
	        }
	    },
	    title: {
	        text: ''
	    },
	    exporting: {
		    enabled: false
		 },
	    xAxis: {
	        categories: ['Permohonan', 'Pendaftaran']
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: 'Hakmilik Strata'
	        },
	        max:1000,
	    },
	    credits: {
		     enabled: false,
		},
	    plotOptions: {
	        pie: {
	            allowPointSelect: true,
		        cursor: 'pointer',
		            dataLabels: {
		                enabled: false,
		        }
	        }
	    },
	    series: [{
	        //data: [value3, value4, value5, value6, value7, value8],
	        data:[
	        	{
		        	name: 'Permohonan',
			        y: parseInt(permohonanHakmilik.replace(/,/g, '')),
			        color: '#fdb266'
			    }, 
			    {
		        	name: 'Pendaftaran',
			        y: parseInt(pendaftaranHakmilik.replace(/,/g, '')),
			        color: '#fd66b1'
			    }, 
			    
	        ],
	        name: 'Hakmilik Strata',
	        showInLegend: false
	    }]
	});


	Highcharts.chart('chart3', {
	    chart: {
	        type: 'pie',
	        // options3d: {
	        //     enabled: true,
	        //     alpha: 45
	        // }
	    },
	    exporting: {
		    enabled: false
		 },
	    title: {
	        text: ''
	    },
	    subtitle: {
	        text: ''
	    },
	    plotOptions: {
	        pie: {
	            allowPointSelect: true,
		        cursor: 'pointer',
		            dataLabels: {
		                enabled: false,
		        }
	        }
	    },
	    credits: {
		     enabled: false,
		},
	    series: [{
	        name: 'Hakmilik Strata',
	        data: [
	            {
		        	name: 'Seluruh Malaysia',
			        y: 1178545,
			        color: '#b1fd66'
			    }, 
			    {
			        name: 'Negeri Dipilih',
			        y: parseInt(pendaftaranHakmilik.replace(/,/g, '')),
			        color: '#fd66fd'
			    }
	        ]
	    }]
	});
}












