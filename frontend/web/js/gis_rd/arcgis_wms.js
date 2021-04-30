$( document ).ready(function() {
    var urlsys = window.location.hostname;
    require([
            "esri/Map",
            "esri/layers/CSVLayer",
            "esri/views/MapView",
            "esri/widgets/Legend",
             "esri/layers/WMSLayer",
             "esri/geometry/Point",
             "esri/widgets/BasemapGallery",
             "esri/widgets/Expand",
             "esri/widgets/Home",
             "esri/widgets/LayerList",
             "esri/views/SceneView"
          ], function(Map, CSVLayer, MapView, Legend, WMSLayer, Point, BasemapGallery, Expand, Home, LayerList, SceneView) {

            var map = new Map({
              basemap: "hybrid",
            });

            const view = new SceneView({
              container: "viewDiv",
              center: [103.522828,1.828374],
              zoom: 9,
              map: map
            });


            var wmsDaerah = new WMSLayer({
              url: "https://geo.bitextreme.com.my/geoserver/test/wms",
              sublayers: [
                {
                  title: 'Sempadan Daerah',
                  name: "test:DAERAH_JOHOR",
                  popupTemplate: "{STATE}",
                  legendUrl : 'https://geo.bitextreme.com.my/geoserver/test/wms?REQUEST=GetLegendGraphic&VERSION=1.0.0&FORMAT=image/png&WIDTH=20&HEIGHT=20&LAYER=test:DAERAH_JOHOR'
                }
              ]
            });

            var wmsMukim = new WMSLayer({
              url: "https://geo.bitextreme.com.my/geoserver/test/wms",
              sublayers: [
                {
                  title: 'Sempadan Mukim',
                  name: "test:MUKIM_JOHOR",
                  legendUrl : 'https://geo.bitextreme.com.my/geoserver/test/wms?REQUEST=GetLegendGraphic&VERSION=1.0.0&FORMAT=image/png&WIDTH=20&HEIGHT=20&LAYER=test:MUKIM_JOHOR'
                }
              ]
            });

            var wmsLotPulai = new WMSLayer({
              url: "https://geo.bitextreme.com.my/geoserver/test/wms",
              sublayers: [
                {
                  title: 'Lot Tanah Mukim Pulai',
                  name: "test:Lot_Mukim_Pulai",
                  legendUrl : 'https://geo.bitextreme.com.my/geoserver/test/wms?REQUEST=GetLegendGraphic&VERSION=1.0.0&FORMAT=image/png&WIDTH=20&HEIGHT=20&LAYER=test:Lot_Mukim_Pulai'
                }
              ]
            });

            map.add(wmsDaerah);
            wmsDaerah.visible = true;

            map.add(wmsMukim);
            wmsMukim.visible = false;

            map.add(wmsLotPulai);
            wmsLotPulai.visible = false;

            view.ui.add(
              new Legend({
                view: view
              }),
              "bottom-left"
            );

            var homeBtn = new Home({
              view: view
            });
            view.ui.add(homeBtn, "top-left");

            var basemapGallery = new BasemapGallery({
              view: view,
              container: document.createElement("div")
            });
            var bgExpand = new Expand({
              view: view,
              content: basemapGallery
            });
            basemapGallery.watch("activeBasemap", function() {
              var mobileSize =
                view.heightBreakpoint === "xsmall" ||
                view.widthBreakpoint === "xsmall";

              if (mobileSize) {
                bgExpand.collapse();
              }
            });
            view.ui.add(bgExpand, "bottom-right");


            var layerList = new LayerList({
                view: view
            });

            view.ui.add(layerList, "top-right");
            
    });

});
