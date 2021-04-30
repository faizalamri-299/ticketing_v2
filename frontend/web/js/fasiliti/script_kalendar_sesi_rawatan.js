let calendar = null;

var urlsys = window.location.hostname;
var getUrl = window.location;
var namaSistem = '/yktlj';

if(urlsys.includes('johor.gov.my') || urlsys.includes('bitextreme.com.my'))
{
  var url = "/fasiliti/sesi-rawatan/get-sesirawatan-tahunan";
}
else
{
  var url = "/yktlj/frontend/web/fasiliti/sesi-rawatan/get-sesirawatan-tahunan";
}

var dataSourceFromAjax = [];

$.ajax({
    //type: "GET",
    //url: '../../../fasiliti/sesi-rawatan/get-sesirawatan-tahunan',
    //url: namaSistem + '/frontend/web/fasiliti/sesi-rawatan/get-sesirawatan-tahunan',
    url: url,
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    async:false,
    success: function (doc) {
        $(doc).each(function() {
            if($(this).attr('cio_mod_status_check_out') == '0'){
                var color = '#64c5b1';
            }else if($(this).attr('cio_mod_status_check_out') == '1'){
                var color = '#ffa91c';
            }
            var obj = {};
            obj =
            {
                id: $(this).attr('id'),
                name: $(this).attr('sr_mod_nama'),
                startDate: new Date($(this).attr('sr_mod_tarikh')),
                endDate: new Date($(this).attr('sr_mod_tarikh')),
                pic: $(this).attr('sr_mod_pic'),
                jenis: $(this).attr('sr_mod_jenis'),
                nama: $(this).attr('sr_mod_keterangan'),
                color: color,
            }
            dataSourceFromAjax.push(obj);
        });
    },
});
$(function() {
    var currentYear = new Date().getFullYear();

    calendar = new Calendar('#calendar', {
        enableContextMenu: true,
        enableRangeSelection: true,
        // contextMenuItems:[
        //     {
        //         text: 'Update',
        //         click: editEvent
        //     },
        //     {
        //         text: 'Delete',
        //         click: deleteEvent
        //     }
        // ],
        selectRange: function(e) {
            editEvent({ startDate: e.startDate, endDate: e.endDate });
        },
        mouseOnDay: function(e) {
            if(e.events.length > 0) {
                var content = '';
                // var color = document.write(str.fontcolor( \"blue\" ));
                // for(var i in e.events) {
                //     content += '<div class=\"event-tooltip-content\">'
                //                    + '<span style=\"color:'+ e.events[i].color +'\">'+ e.events[i].name +'</span>' +
                //                     // + '<div class=\"event-name\" style=\"color:' + e.events[i].color + ';\"><h1 style=\"color:#ffcccc\">' + e.events[i].name + '</h1></div>'
                //                     + '<div class=\"event-location\" style=\"white-space:nowrap;\">' + e.events[i].location + '</div>'
                //                 + '</div>';
                // }
                //console.log(e.timeStamp);
                for(var i in e.events) {

                    content += '<div class="event-tooltip-content">'
                                    + '<div class="event-name color"><h5 class="color_' + e.events[i].id + '">' + e.events[i].name + '</h5></div>'
                                    + '<div class="">' + e.events[i].nama + '</div>'
                                    + '<div class=""><b>Jenis : </b>' + e.events[i].jenis + '</div>'
                                    + '<div class=""><b>Staff Bertanggungjawab : </b>' + e.events[i].pic + '</div>'
                                + '</div>';

                    $(document).ready(function(){
                        for(var i in e.events) {
                            var color = ".color_" + e.events[i].id;
                            // $(".event-tooltip-content").css("background-color",  '#ccc');
                            $(color).css("color",  e.events[i].color);
                            // console.log(e.events[i].id);
                        }

                    });
                }

                $(e.element).popover({
                    trigger: 'manual',
                    container: 'body',
                    html: true,
                    content: content,
                    placement: 'auto'
                });

                $(e.element).popover('show');
            }
        },
        mouseOutDay: function(e) {
            if(e.events.length > 0) {
                $(e.element).popover('hide');
            }
        },
        dayContextMenu: function(e) {
            $(e.element).popover('hide');
        },
        dataSource: dataSourceFromAjax
    });

    // on change dropdown Jenis Program
    // reset Calendar based on selected value
    // document.getElementById('jenisDropdown').onchange = function ()
    // {
    //     var jenisProgram = $("#jenisDropdown").select2("val");

    //     var dataSourceFromAjax_jenisDropdown = [];
    //     $.ajax({
    //         url: '../../aktiviti/aktiviti/get-aktiviti-tahunan-by-jenis?jenis='+jenisProgram,
    //         contentType: "application/json; charset=utf-8",
    //         dataType: "json",
    //         async:false,
    //         success: function (doc) {
    //             $(doc).each(function() {
    //                 if($(this).attr('akt_mod_status') == '0'){
    //                     var color = '#64c5b1';
    //                 }else if($(this).attr('akt_mod_status') == '1'){
    //                     var color = '#ffa91c';
    //                 }else if($(this).attr('akt_mod_status') == '3'){
    //                     var color = '#f96a74';
    //                 }else{
    //                     var color = '#32c861';
    //                 }
    //                 var obj = {};
    //                 obj =
    //                 {
    //                     id: $(this).attr('id'),
    //                     name: $(this).attr('akt_mod_tajuk'),
    //                     startDate: new Date($(this).attr('akt_mod_tarikh_mula')),
    //                     endDate: new Date($(this).attr('akt_mod_tarikh_tamat')),
    //                     location: $(this).attr('akt_mod_status'),
    //                     nama: $(this).attr('akt_mod_keterangan'),
    //                     color: color,
    //                 }
    //                 dataSourceFromAjax_jenisDropdown.push(obj);
    //             });
    //         },
    //     });

    //     calendar.setDataSource(dataSourceFromAjax_jenisDropdown);
    // };

    // document.getElementById('resetButton').onclick = function ()
    // {
    //     $("#jenisDropdown").val("").trigger("change");
    //     calendar.setDataSource(dataSourceFromAjax);
    // };

});
