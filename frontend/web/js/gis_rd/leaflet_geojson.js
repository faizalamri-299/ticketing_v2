$( document ).ready(function() {

  var mymap = L.map('map').setView([2.1054174, 103.4137753], 9);

  L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
    maxZoom: 18,
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
      '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
      'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    id: 'mapbox/streets-v11'
  }).addTo(mymap);

  	refreshChart();

  	var rootUrl = 'https://geo.bitextreme.com.my/geoserver/wfs';

	var defaultParameters = {
	    service: 'WFS',
	    version: '2.0.0',
	    request: 'GetFeature',
	    typeName: 'test:DAERAH_JOHOR',
	    //maxFeatures: 200,
	    outputFormat: 'application/json',
	    srsName:'EPSG:4326'

	};

	var style ={
    	color: '#fd6666',
        stroke: true,
        fillColor: '#66fdfd',
        fillOpacity: 0
    }

    var highlight ={
    	color: '#fd6666',
        stroke: true,
        fillColor: '#fd6666',
        fillOpacity: 0.6
    }

	function whenClicked(e,feature, layer) {
	  console.log(e.target.feature.properties.DISTRICT);
	}

	function onEachFeature(feature, layer) 
	{

        var popupContent = "<p><b>STATE : </b>"+ feature.properties.STATE +
            "</br><b>DISTRICT : </b>"+ feature.properties.DISTRICT +'</p>';

        layer.bindPopup(popupContent);

        layer.on("click", function (e) { 
            WFSLayer.setStyle(style); //resets layer colors
            layer.setStyle(highlight);  //highlights selected.
            refreshChart();
        }); 
	}

	var parameters = L.Util.extend(defaultParameters);
	var URL = rootUrl + L.Util.getParamString(parameters);

	var WFSLayer = null;
	var ajax = $.ajax({
	    url : URL,
	    dataType : 'json',
	    jsonpCallback : 'getJson',
	    success : function (response) {
	        WFSLayer = L.geoJson(response, {
	        	onEachFeature: onEachFeature,
	            style: function (feature) {
	                return {
	                	color: '#fd6666',
	                    stroke: true,
	                    fillColor: '#ffffff',
	                    fillOpacity: 0
	                };
	            }
	        }).addTo(mymap);
	    }
	});


	function refreshChart()
	{
		var value1 = Math.floor((Math.random() * 2000) + 1);
		var value2 = Math.floor((Math.random() * 2000) + 1);

		$("#value1").html(value1);
		$("#value2").html(value2);

		Highcharts.chart('chart1', {
		    chart: {
		        type: 'pie',
		        options3d: {
		            enabled: true,
		            alpha: 45
		        }
		    },
		    title: {
		        text: ''
		    },
		    subtitle: {
		        text: ''
		    },
		    plotOptions: {
		        pie: {
		            innerSize: 60,
		            depth: 45
		        }
		    },
		    credits: {
			     enabled: false,
			},
		    series: [{
		        name: 'Delivered amount',
		        data: [
		            {
			        	name: 'minor',
				        y: value1,
				        color: '#66b1fd'
				    }, 
				    {
				        name: 'major',
				        y: value2,
				        color: '#fd66fd'
				    }
		        ]
		    }]
		});

		var value3 = Math.floor((Math.random() * 1000) + 1);
		var value4 = Math.floor((Math.random() * 1000) + 1);
		var value5 = Math.floor((Math.random() * 1000) + 1);
		var value6 = Math.floor((Math.random() * 1000) + 1);
		var value7 = Math.floor((Math.random() * 1000) + 1);
		var value8 = Math.floor((Math.random() * 1000) + 1);

		$("#value3").html(value3);
		$("#value4").html(value4);
		$("#value5").html(value5);
		$("#value6").html(value6);
		$("#value7").html(value7);
		$("#value8").html(value8);

		Highcharts.chart('chart2', {
		    chart: {
		        type: 'cylinder',
		        options3d: {
		            enabled: true,
		            alpha: 15,
		            beta: 15,
		            depth: 50,
		            viewDistance: 25
		        }
		    },
		    title: {
		        text: ''
		    },
		    xAxis: {
		        categories: ['JAN', 'FEB', 'MAC', 'MEI', 'JUN', 'JUL']
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
		        series: {
		            depth: 25,
		            colorByPoint: true
		        }
		    },
		    series: [{
		        //data: [value3, value4, value5, value6, value7, value8],
		        data:[
		        	{
			        	name: 'JAN',
				        y: value3,
				        color: '#fdb266'
				    }, 
				    {
			        	name: 'FEB',
				        y: value4,
				        color: '#fd66b1'
				    }, 
				    {
			        	name: 'MAC',
				        y: value5,
				        color: '#66fdb2'
				    }, 
				    {
			        	name: 'MEI',
				        y: value6,
				        color: '#66b1fd'
				    }, 
				    {
			        	name: 'JUN',
				        y: value7,
				        color: '#66fdfd'
				    },
				    {
			        	name: 'JUL',
				        y: value8,
				        color: '#b266fd'
				    }, 
		        ],
		        name: 'Jumlah (RM)',
		        showInLegend: false
		    }]
		});
	}


});
