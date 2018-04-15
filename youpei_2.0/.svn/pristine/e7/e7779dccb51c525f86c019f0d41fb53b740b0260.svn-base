var calUtil = {
  showYear:2015,
  showMonth:1,
  showDays:1,
  eventName:"load",
  init:function(signList,s=''){
    calUtil.setMonthAndDay();
    if (typeof(s) == 'undefined'){
    }else{
      signList.splice('','',s);
    }
    calUtil.draw(signList);
    calUtil.bindEnvent(signList);
  },
  draw:function(signList){
    //alert(signList.length);
//  console.log(signList);
    if(signList.length > 21){
      //alert(21);
      $("#sign_note").empty();
      $("#sign_note").html('<button class="sign_contener" type="button"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>&nbsp;宸茶揪鏍囷紝鑾峰彇1娆℃娊濂�</button>');
    }
    var str = calUtil.drawCal(calUtil.showYear,calUtil.showMonth,signList);
    $("#calendar").html(str);
    var calendarName=calUtil.showYear+"年"+calUtil.showMonth+"月";
    $(".calendar_month_span").html(calendarName);  
    var trLength=$(".sign_row").length;
//  for(var j=0;j<trLength;j++){
//  	
//  }
       	if(trLength<6){
       		$("table").append(
       			'<tr>'+
       			'<td></td>'+
       			'<td></td>'+
       			'<td></td>'+
       			'<td></td>'+
       			'<td></td>'+
       			'<td></td>'+
       			'<td></td>'+
       			'</tr>'
       		)
       	}
       	var array=Array(1,2,3,4)
       	var tdLength=$("td").length;
  			for(var j=0; j<tdLength; j++){
  				var td=document.getElementsByTagName("td")[j].innerHTML;
  				for(var i=0; i<array.length;i++){
  					if(td==array[i]){
	  					document.getElementsByTagName("td")[j].style.background="red";
	  					$("td").eq(j).click(function(){
						   	console.log(1111)
						   })
	  				}
  				
  				}
  			}
//			$("td").click(function(){
//			   	console.log(1111)
//			   })
  },
  bindEnvent:function(signList){
    // $(".calendar_month_prev").click(function(){
    //   //var signList=[{"signDay":"10"},{"signDay":"11"},{"signDay":"12"},{"signDay":"13"}];
    //   calUtil.eventName="prev";
    //   calUtil.init(signList);
    // });
    // $(".calendar_month_next").click(function(){
    //   //var signList=[{"signDay":"10"},{"signDay":"11"},{"signDay":"12"},{"signDay":"13"}];
    //   calUtil.eventName="next";
    //   calUtil.init(signList);
    // });
    
    $(".calendar_record").click(function(){
      //alert(typeof(signList)+"yxy");
    	//var signList=[{"signDay":"10"},{"signDay":"11"},{"signDay":"12"},{"signDay":"13"}];
    	//var tmp = {"signDay":$(this).html()};
      //if (typeof(signList) == 'undefined'){
      //}else{
      //  signList.splice('','',tmp);
      //  console.log(signList);
      //  calUtil.init(signList);
     // }
     //alert($(this).html());
    var tmp = {"signDay":$(this).html()};
    calUtil.init(signList,tmp);
     
      
      
    });
  },
  setMonthAndDay:function(){
    switch(calUtil.eventName)
    {
      case "load":
        var current = new Date();
        calUtil.showYear=current.getFullYear();
        calUtil.showMonth=current.getMonth() + 1;
        break;
      case "prev":
        var nowMonth=$(".calendar_month_span").html().split("年")[1].split("月")[0];
        calUtil.showMonth=parseInt(nowMonth)-1;
        if(calUtil.showMonth==0)
        {
            calUtil.showMonth=12;
            calUtil.showYear-=1;
        }
        break;
      case "next":
        var nowMonth=$(".calendar_month_span").html().split("年")[1].split("月")[0];
        calUtil.showMonth=parseInt(nowMonth)+1;
        if(calUtil.showMonth==13)
        {
            calUtil.showMonth=1;
            calUtil.showYear+=1;
        }
        break;
    }
  },
  getDaysInmonth : function(iMonth, iYear){
   var dPrevDate = new Date(iYear, iMonth, 0);
   return dPrevDate.getDate();
  },
  bulidCal : function(iYear, iMonth) {
   var aMonth = new Array();
   aMonth[0] = new Array(7);
   aMonth[1] = new Array(7);
   aMonth[2] = new Array(7);
   aMonth[3] = new Array(7);
   aMonth[4] = new Array(7);
   aMonth[5] = new Array(7);
   aMonth[6] = new Array(7);
   var dCalDate = new Date(iYear, iMonth - 1, 1);
   var iDayOfFirst = dCalDate.getDay();
   var iDaysInMonth = calUtil.getDaysInmonth(iMonth, iYear);
   var iVarDate = 1;
   var d, w;
   aMonth[0][0] = "日";
   aMonth[0][1] = "一";
   aMonth[0][2] = "二";
   aMonth[0][3] = "三";
   aMonth[0][4] = "四";
   aMonth[0][5] = "五";
   aMonth[0][6] = "六";
   for (d = iDayOfFirst; d < 7; d++) {
    aMonth[1][d] = iVarDate;
    iVarDate++;
   }
   for (w = 2; w < 7; w++) {
    for (d = 0; d < 7; d++) {
     if (iVarDate <= iDaysInMonth) {
      aMonth[w][d] = iVarDate;
      iVarDate++;
     }
    }
   }
   return aMonth;
  },
  ifHasSigned : function(signList,day){
   var signed = false;
   $.each(signList,function(index,item){
    if(item.signDay == day) {
     signed = true;
     return false;
    }
   });
   return signed ;
  },
  drawCal : function(iYear, iMonth ,signList) {
   var myMonth = calUtil.bulidCal(iYear, iMonth);
   var htmls = new Array();
   htmls.push("<div class='sign_main' id='sign_layer'>");
   htmls.push("<div class='sign_succ_calendar_title'>");
   //htmls.push("<div class='calendar_month_next'>涓嬫湀</div>");
   //htmls.push("<div class='calendar_month_prev'>涓婃湀</div>");
// htmls.push("<div class='calendar_month_span'></div>");
   htmls.push("</div>");
   htmls.push("<table class='sign_equal' id='sign_cal'>");
// htmls.push("<tr class='sign_row'>");
// htmls.push("<td class='th_1 bold'>" + myMonth[0][0] + "</td>");
// htmls.push("<td class='th_2 bold'>" + myMonth[0][1] + "</td>");
// htmls.push("<td class='th_3 bold'>" + myMonth[0][2] + "</td>");
// htmls.push("<td class='th_4 bold'>" + myMonth[0][3] + "</td>");
// htmls.push("<td class='th_5 bold'>" + myMonth[0][4] + "</td>");
// htmls.push("<td class='th_6 bold'>" + myMonth[0][5] + "</td>");
// htmls.push("<td class='th_7 bold'>" + myMonth[0][6] + "</td>");
// htmls.push("</tr>");
   var d, w;
   for (w = 1; w < 6; w++) {
    htmls.push("<tr class='sign_row'>");
    for (d = 0; d < 7; d++) {

     var ifHasSigned = calUtil.ifHasSigned(signList,myMonth[w][d]);
//   console.log("001:"+ifHasSigned);
     if(ifHasSigned && typeof(myMonth[w][d]) != 'undefined'){
      htmls.push("<td class='td_"+d+" on'>" + (!isNaN(myMonth[w][d]) ? myMonth[w][d] : " ") + "</td>");
     } else {
      htmls.push("<td class='td_"+d+" calendar_record'>" + (!isNaN(myMonth[w][d]) ? myMonth[w][d] : " ") + "</td>");
     }
    }
    htmls.push("</tr>");
   }

   htmls.push("</table>");
   htmls.push("</div>");
   htmls.push("</div>");
   return htmls.join('');
   
  }
     	
};