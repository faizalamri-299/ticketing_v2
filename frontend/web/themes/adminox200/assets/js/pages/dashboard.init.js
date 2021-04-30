jQuery(function(e){"use strict";var o=window.AdminoxAdmin||{};if(o.dashboardEcharts=function(){if(e("#platform_type_dates_donut").length){echarts.init(document.getElementById("platform_type_dates_donut")).setOption({timeline:{show:!0,data:["06-16","05-16","04-16"],label:{formatter:function(e){return e?e.slice(0,5):null}},x:10,y:null,x2:10,y2:0,width:250,height:50,backgroundColor:"rgba(0,0,0,0)",borderColor:"#eaeaea",borderWidth:0,padding:5,controlPosition:"left",autoPlay:!0,loop:!0,playInterval:2e3,lineStyle:{width:1,color:"#bdbdbd",type:""}},options:[{color:["#f1f1f1","#64c5b1","#414b4f","#ee4b82","#45bbe0"],title:{text:"",subtext:""},tooltip:{trigger:"item",formatter:"{a} <br/>{b} : {c} ({d}%)"},legend:{show:!1,x:"left",orient:"vertical",padding:0,data:["iPhone 7","Windows","Desktop","Mobiles","Others"]},toolbox:{show:!0,color:["#bdbdbd","#bdbdbd","#bdbdbd","#bdbdbd"],feature:{mark:{show:!1},dataView:{show:!1,readOnly:!0},magicType:{show:!0,type:["pie","funnel"],option:{funnel:{x:"10%",width:"80%",funnelAlign:"center",max:50},pie:{roseType:"none"}}},restore:{show:!1},saveAsImage:{show:!0}}},series:[{name:"06-16",type:"pie",radius:[20,"80%"],roseType:"none",center:["50%","45%"],width:"50%",itemStyle:{normal:{label:{show:!0},labelLine:{show:!0}},emphasis:{label:{show:!1},labelLine:{show:!1}}},data:[{value:35,name:"iPhone 7"},{value:16,name:"Windows"},{value:27,name:"Desktop"},{value:29,name:"Mobiles"},{value:12,name:"Others"}]}]},{series:[{name:"05-16",type:"pie",data:[{value:42,name:"iPhone 7"},{value:51,name:"Windows"},{value:39,name:"Desktop"},{value:25,name:"Mobiles"},{value:9,name:"Others"}]}]},{series:[{name:"04-16",type:"pie",data:[{value:29,name:"iPhone 7"},{value:16,name:"Windows"},{value:24,name:"Desktop"},{value:19,name:"Mobiles"},{value:5,name:"Others"}]}]}]})}if(e("#user_type_bar").length){echarts.init(document.getElementById("user_type_bar")).setOption({grid:{zlevel:0,x:50,x2:50,y:20,y2:20,borderWidth:0,backgroundColor:"rgba(0,0,0,0)",borderColor:"rgba(0,0,0,0)"},tooltip:{trigger:"axis",axisPointer:{type:"shadow",lineStyle:{color:"rgba(0,0,0,.5)",width:1},shadowStyle:{color:"rgba(0,0,0,.1)"}}},legend:{data:[]},toolbox:{orient:"vertical",show:!0,showTitle:!0,color:["#bdbdbd","#bdbdbd","#bdbdbd","#bdbdbd"],feature:{mark:{show:!1},dataZoom:{show:!0,title:{dataZoom:"Data Zoom",dataZoomReset:"Reset Zoom"}},dataView:{show:!1,readOnly:!0},magicType:{show:!0,title:{bar:"Bar",line:"Area",stack:"Stacked Bar",tiled:"Tiled Bar"},type:["bar","line","stack","tiled"]},restore:{show:!1},saveAsImage:{show:!0,title:"Save as Image"}}},calculable:!0,xAxis:[{type:"category",boundaryGap:!1,data:["2016-06-01","2016-05-01","2016-04-01","2016-03-01","2016-02-01","2016-01-01","2015-12-01","2015-11-01","2015-10-01","2015-09-01"],axisLine:{show:!0,onZero:!0,lineStyle:{color:"#98a6ad",type:"solid",width:"2",shadowColor:"rgba(0,0,0,0)",shadowBlur:5,shadowOffsetX:3,shadowOffsetY:3}},axisTick:{show:!1},axisLabel:{color:"#98a6ad"},splitLine:{show:!1,lineStyle:{color:"#fff",type:"solid",width:0,shadowColor:"rgba(0,0,0,0)"}}}],yAxis:[{type:"value",splitLine:{show:!1,lineStyle:{color:"fff",type:"solid",width:0,shadowColor:"rgba(0,0,0,0)"}},axisLabel:{show:!1},axisTick:{show:!1},axisLine:{show:!1,onZero:!0,lineStyle:{color:"#98a6ad",type:"solid",width:"0",shadowColor:"rgba(0,0,0,0)",shadowBlur:5,shadowOffsetX:3,shadowOffsetY:3}}}],series:[{name:"Registered Users",type:"bar",smooth:!0,symbol:"none",symbolSize:2,showAllSymbol:!0,barWidth:10,barGap:"10%",itemStyle:{normal:{color:"#64c5b1",borderWidth:2,borderColor:"#64c5b1",areaStyle:{color:"#64c5b1",type:"default"}}},data:[2323,2144,4534,1989,3232,2323,2144,4534,1989,3232,2323,2144,4534,1989,3232,2323,2144,4534,1989,3232,2323,2144,4534,1989,3232,2323,2144,4534,1989,3232]},{name:"Guest Visitors",type:"bar",smooth:!0,symbol:"none",symbolSize:2,showAllSymbol:!0,barWidth:10,barGap:"10%",itemStyle:{normal:{color:"#f1f1f1",borderWidth:2,borderColor:"#f1f1f1",areaStyle:{color:"#f1f1f1",type:"default"}}},data:[5656,6567,7675,3423,4343,5656,6567,7675,3423,4343,5656,6567,7675,3423,4343,5656,6567,7675,3423,4343,5656,6567,7675,3423,4343,5656,6567,7675,3423,4343]}]})}},e("#page_views_today").length){echarts.init(document.getElementById("page_views_today")).setOption({grid:{zlevel:0,x:20,x2:20,y:20,y2:20,borderWidth:0,backgroundColor:"rgba(0,0,0,0)",borderColor:"rgba(0,0,0,0)"},tooltip:{trigger:"axis",axisPointer:{type:"shadow",lineStyle:{color:"rgba(0,0,0,.5)",width:1},shadowStyle:{color:"rgba(0,0,0,.1)"}}},legend:{data:[]},toolbox:{orient:"vertical",show:!0,showTitle:!0,color:["#bdbdbd","#bdbdbd","#bdbdbd","#bdbdbd"],feature:{mark:{show:!1},dataZoom:{show:!0,title:{dataZoom:"Data Zoom",dataZoomReset:"Reset Zoom"}},dataView:{show:!1,readOnly:!0},magicType:{show:!0,title:{line:"Line",bar:"Bar"},type:["line","bar"],option:{}},restore:{show:!1},saveAsImage:{show:!0,title:"Save as Image"}}},calculable:!0,xAxis:[{type:"category",boundaryGap:!1,data:["0h-2h","2h-4h","4h-6h","6h-8h","8h-10h","10h-12h","12h-14h","14h-16h","16h-18h","18h-20h","20h-22h","22h-24h"],axisLine:{show:!0,onZero:!0,lineStyle:{color:"#98a6ad",type:"solid",width:"1",shadowColor:"rgba(0,0,0,0)",shadowBlur:5,shadowOffsetX:3,shadowOffsetY:3}},axisTick:{show:!1},splitLine:{show:!1,lineStyle:{color:"#fff",type:"solid",width:0,shadowColor:"rgba(0,0,0,0)"}}}],yAxis:[{type:"value",splitLine:{show:!1,lineStyle:{color:"fff",type:"solid",width:0,shadowColor:"rgba(0,0,0,0)"}},axisLabel:{show:!1},axisTick:{show:!1},axisLine:{show:!1,onZero:!0,lineStyle:{color:"#ff0000",type:"solid",width:"0",shadowColor:"rgba(0,0,0,0)",shadowBlur:5,shadowOffsetX:3,shadowOffsetY:3}}}],series:[{name:"Page Views",type:"line",smooth:!0,symbol:"none",symbolSize:2,showAllSymbol:!0,barWidth:10,itemStyle:{normal:{color:"#64c5b1",borderWidth:2,borderColor:"#64c5b1",areaStyle:{color:"rgba(100,197,177,0)",type:"default"}}},data:[1545,1343,1445,2675,2878,1789,1745,2343,2445,1675,1878,2789,1545,1343,1445,2675,2878,1789,1745,2343,2445,1675,1878,2789]},{name:"Page Views",type:"line",smooth:!0,symbol:"none",symbolSize:2,showAllSymbol:!0,barWidth:10,itemStyle:{normal:{color:"#f1f1f1",borderWidth:2,borderColor:"#f1f1f1)",areaStyle:{color:"rgba(221,221,221,0)",type:"default"}}},data:[5656,6567,7675,3423,4343,5656,6567,7675,3423,4343,5656,6567,7675,3423,4343,5656,6567,7675,3423,4343,5656,6567,7675,3423,4343,5656,6567,7675,3423,4343]}]})}e(document).ready(function(){o.dashboardEcharts()}),e(window).on("load",function(){})}),function(e){"use strict";var o=function(){};o.prototype.init=function(){c3.generate({bindto:"#donut-chart",data:{columns:[["Minor",46],["Major",24]],type:"donut"},donut:{title:"Jenis Baikpulih",width:30,label:{show:!1}},color:{pattern:["#64c5b1","#f1f1f1"]}}),c3.generate({bindto:"#pie-chart",data:{columns:[["Selesai",46],["Lewat",24],["Tangguh",30]],type:"pie"},color:{pattern:["#f1f1f1","#64c5b1","#e68900"]},pie:{label:{show:!1}}})},e.Dashboard=new o,e.Dashboard.Constructor=o}(window.jQuery),function(e){"use strict";window.jQuery.Dashboard.init()}();