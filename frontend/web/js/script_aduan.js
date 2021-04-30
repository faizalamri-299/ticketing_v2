
  var map, infoWindow;
  var markers = [];
    map = new google.maps.Map(document.getElementById('map'), 
    {
      center: {lat: 1.564317, lng: 103.745903},
      zoom: 11
    });

    infoWindow = new google.maps.InfoWindow;

    // zoom to aduan from gridview
    $(document).on("click", ".zoom", function(){
            
        var latlong = $(this).attr('value');

        var latlongArr = latlong.split(',');

        var newLatLng = new google.maps.LatLng(latlongArr[0], latlongArr[1]);

        //map.setCenter(newLatLng);
        var bounds = new google.maps.LatLngBounds(newLatLng);
        map.fitBounds(bounds);
    });

    // add all markers aduan
    // get data from DB
    var urlsys = window.location.hostname;

    var getUrl = window.location;
    // var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

    //var url = baseUrl + '/frontend/web/kejiranan/aduan/get-aduan-byid?id='+id;

    // if(urlsys.includes('sijf.my'))
    // {
    //   var url = '/kejiranan/aduan/get-aduan';
    //   var urlgambar = "/data/aduan/";
    // }
    // else
    // {
       var url = '/boilerplate2/frontend/web/aduan-awam/get-aduan';
       var urlgambar = "/boilerplate2/data/aduan/";
    // }

    $.ajax({ 
        type: "GET",
        url: url,             
        dataType: "json",            
        success: function(data){  
             $.each(data, function(index, aduan) {

              var gambar =  urlgambar + aduan.id + "/" + aduan.aa_mod_gambar;
              var content = '';

              if(aduan.aa_mod_status != 'Selesai')
              {
                content = "<h5 style='text-transform:uppercase;'><b>" + aduan.aa_mod_aduan + "</b></h5>"  +
                    "<table style='text-align: right;border-collapse:separate; border-spacing:0.5em;max-width: 250px;'>" +
                        "<tr><td></td> <td><img src='" + gambar +"' alt='' height='100' width='100'> </td> </tr>" +
                        "<tr><td><b>Lokasi : </b></td> <td>" + aduan.aa_mod_lokasi + " </td> </tr>" +
                        "<tr><td><b>Keterangan : </b></td> <td>" + aduan.aa_mod_keterangan + " </td> </tr>" +
                        "<tr><td><b>Status : </b></td> <td>" + aduan.aa_mod_status + " </td> </tr>" +
                        "<tr><td><b>Catatan : </b></td> <td>" + aduan.aa_mod_catatan + " </td> </tr>" +
                        "<tr><td></td> <td style='text-align:center'><b>TINDAKAN </b></td> </tr>" +
                        "<tr><td></td> <td><input type='hidden' id='marker' name='marker' value='" + aduan.id + "' class='form-control'/> </td> </tr>" +
                         "<tr><td>Status : </td> <td style='text-align:center'>" +
                          "<select class='form-control' id='status' name='status'>" +
                            "<option value='Baru'>Baru</option>" +
                            "<option value='Dalam Proses'>Dalam Proses</option>" +
                            "<option value='Selesai'>Selesai</option>" +
                          "</select></td> </tr>" +
                        "<tr><td>Catatan : </td> <td><textarea rows='4' cols='30' id='catatan' name='catatan' class='form-control'></textarea> </td> </tr>" +
                        "</table>" +
                        "<br/><input type='button' class='btn btn-success' value='KEMASKINI ADUAN' id='hantar' onclick='saveData()'/>";
              }
              else
              {
                content = "<h5 style='text-transform:uppercase;'><b>" + aduan.aa_mod_aduan + "</b></h5>"  +
                    "<table style='text-align: right;border-collapse:separate; border-spacing:0.5em;max-width: 250px;'>" +
                        "<tr><td></td> <td><img src='" + gambar +"' alt='' height='100' width='100'> </td> </tr>" +
                        "<tr><td><b>Lokasi : </b></td> <td>" + aduan.aa_mod_lokasi + " </td> </tr>" +
                        "<tr><td><b>Keterangan : </b></td> <td>" + aduan.aa_mod_keterangan + " </td> </tr>" +
                        "<tr><td><b>Status : </b></td> <td>" + aduan.aa_mod_status + " </td> </tr>" +
                        "<tr><td><b>Catatan : </b></td> <td>" + aduan.aa_mod_catatan + " </td> </tr>" +
                        "</table>";
              }
              
              var icon;

              if(aduan.aa_mod_status == 'Baru')
              {
                  icon = 'https://maps.google.com/mapfiles/ms/icons/red-dot.png';
              }
              else if(aduan.aa_mod_status == 'Dalam Proses')
              {
                  icon = 'https://maps.google.com/mapfiles/ms/icons/yellow-dot.png';
              }
              else if(aduan.aa_mod_status == 'Selesai')
              {
                  icon = 'https://maps.google.com/mapfiles/ms/icons/green-dot.png';
              }
              else
              {
                  icon = 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png';
              }

              var newLatLng = new google.maps.LatLng(aduan.aa_mod_lat, aduan.aa_mod_long);

              var marker = new google.maps.Marker({
                  position: newLatLng, 
                  map: map,
                  icon: icon
              });


              var infowindow = new google.maps.InfoWindow({
                  content: content
                });

              google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map, marker);
              });
          });    
        }

    });


  // saves data from info window
  function saveData() 
  {
    var status = escape(document.getElementById('status').value);
    var catatan = escape(document.getElementById('catatan').value);
    var marker = escape(document.getElementById('marker').value);

    if (catatan == "") {
      alert("Catatan perlu diisi");
      return false;
    }
    if (status == "") {
      alert("Status perlu diisi");
      return false;
    }

    var urlsys = window.location.hostname;

    var getUrl = window.location;
    var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

    
    var url = '/boilerplate2/frontend/web/aduan-awam/update-from-popup?status=' + status + '&catatan=' + catatan + '&marker=' + marker;

    downloadUrl(url);
  }

  function downloadUrl(url, callback) 
  {
    $.ajax({
        url: url,
        type: 'POST',
        //data: formData,
        success: function (data) {
            //infowindow.close();
        },
        error: function(response){
            //infowindow.close();
        },
        cache: false,
        contentType: false,
        processData: false
    });
  }

  function pinSymbol(color) 
  {
    return {
      path: 'M 0,0 C -2,-20 -10,-22 -10,-30 A 10,10 0 1,1 10,-30 C 10,-22 2,-20 0,0 z',
      fillColor: color,
      fillOpacity: 1,
      strokeColor: '#000',
      strokeWeight: 1,
      scale: 1
  };
}