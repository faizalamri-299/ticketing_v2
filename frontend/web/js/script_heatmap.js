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
             "esri/widgets/LayerList"
          ], function(Map, CSVLayer, MapView, Legend, WMSLayer, Point, BasemapGallery, Expand, Home, LayerList) {
            const urlSemua =
              urlsys + 
              "../../../../../data/geomap/tbl_ts_transaksi.csv";  

            const renderer = {
              type: "heatmap",
              colorStops: [
                { color: "rgba(63, 40, 102, 0)", ratio: 0 },
                { color: "#472b77", ratio: 0.083 },
                { color: "#4e2d87", ratio: 0.166 },
                { color: "#563098", ratio: 0.249 },
                { color: "#5d32a8", ratio: 0.332 },
                { color: "#6735be", ratio: 0.415 },
                { color: "#7139d4", ratio: 0.498 },
                { color: "#7b3ce9", ratio: 0.581 },
                { color: "#853fff", ratio: 0.664 },
                { color: "#a46fbf", ratio: 0.747 },
                { color: "#c29f80", ratio: 0.83 },
                { color: "#e0cf40", ratio: 0.913 },
                { color: "#ffff00", ratio: 1 }
              ],
              maxPixelIntensity: 5000,
              minPixelIntensity: 0
            };

            const layerSemua = new CSVLayer({
              url: urlSemua,
              title: "Taburan Akses",
              renderer: renderer,
              latitudeField : 'latitude',
              longitudeField : 'longitude'
            });

            const map = new Map({
              basemap: "hybrid",
              layers: [layerSemua]
            });

            const view = new MapView({
              container: "viewDiv",
              center: [107.948227,4.184463],
              zoom: 6,
              map: map
            });

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
