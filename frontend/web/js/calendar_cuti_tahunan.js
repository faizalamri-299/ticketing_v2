let calendar = null;

var urlsys = window.location.hostname;
var getUrl = window.location;
var namaSistem = '/intern-yktlj-tadbir';

var dataSourceFromAjax = [];
$.ajax({
    
    //type: "GET",
    url: '/intern-yktlj-tadbir/frontend/web/pentadbiran/permohonan-cuti/get-calendar',  
    contentType: "application/json; charset=utf-8",          
    dataType: "json", 
    async:false,
    success: function (doc) {

        $(doc).each(function() {
             console.log(doc);
            
            if($(this).attr('pc_mod_status') == '0'){
                var color = '#ffa91c';
            }else if($(this).attr('pc_mod_status') == '1'){
                var color = '#32c861';
            }else if($(this).attr('pc_mod_status') == '2'){
                var color = '#f96a74';
            }else if($(this).attr('pc_mod_status') == '3'){
                var color = '#32c861';
            }else if($(this).attr('pc_mod_status') == '4'){
                var color = '#f96a74';
            }else if($(this).attr('pc_mod_status') == '5'){
                var color = '#32c861';
            }else if($(this).attr('pc_mod_status') == '6'){
                var color = '#f96a74';
            }else if($(this).attr('pc_mod_status') == '7'){
                var color = '#f96a74';
            }else{
                var color = '#f96a74';
            }
            var obj = {};
            obj = 
            {
                id: $(this).attr('id'),
                name: $(this).attr('kakitangan').ma_mod_nama_penuh, //pc_mod_jenis_cuti//pc_fk_id_kakitangan
                location: $(this).attr('kodCuti').mod_jenis,
                numbers: $(this).attr('pc_sys_bil_cuti'),
                //startDate: new Date($(this).attr('pc_mod_tarikh_mula')).toString().replace(/\sGMT.*$/, ""),
                startDate: new Date($(this).attr('pc_mod_tarikh_mula')),
                endDate: new Date($(this).attr('pc_mod_tarikh_tamat')),
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
                console.log(e.timeStamp);
                for(var i in e.events) {
                    content += '<div class="event-tooltip-content">'
                                    + '<div class="event-name color"><h5 class="color_' + e.events[i].id + '">' + e.events[i].name +'</h5></div>'
                                    + '<div class="">' + e.events[i].location + '</div>'+ '<div class="">' + e.events[i].startDate.toJSON().slice(0,10).split('-').reverse().join('-') +'</div>'
                                    + '<div class="">' + e.events[i].endDate.toJSON().slice(0,10).split('-').reverse().join('-') +'</div>'
                                    
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

});