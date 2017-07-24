//城市级联的实现
$(function(){
	$.getScript("js/city.js",function(data){
		var result=JSON.parse(data);
		var cityArr = [];
		var countyArr = [];
		for(var i=0;i<result.length;i++){
			if(result[i].ProSort){
				$(".province").append("<option value='"+result[i].ProID+"'>"+result[i].name+"</option>")//把数据拼接到.province下的option里
			}else if(result[i].CitySort){
				cityArr.push(result[i]);//把符合的数据放入cityArr里
			}else if(result[i].DisSort == null){
				countyArr.push(result[i]);//把符合的数据放入countyArr里
			}
		}	
		$(".province").change(function(){
			var value = $(this).val();
			$(".city option").remove();
			$(".province option").eq(0).remove();
			for(var i=0;i<cityArr.length;i++){
				if(cityArr[i].ProID == value){
                    $(".city").append("<option value='"+cityArr[i].CityID+"'>"+cityArr[i].name+"</option>"); //把数据拼接到.city下的option里
				}
			}
			
			var value2=$(".city option").val();
			
			$(".county option").remove();
			for(var i=0;i<countyArr.length;i++){
				if(countyArr[i].CityID == value2)
				$(".county").append("<option>"+countyArr[i].DisName+"</option>")
			}
		})	
		$(".city").change(function(){
			var value = $(this).val();
			$(".county option").remove();
			for(var i=0;i<countyArr.length;i++){
				if(countyArr[i].CityID == value)
				$(".county").append("<option>"+countyArr[i].DisName+"</option>")//把数据拼接到.county下的option里
			}
		
		})
	})
})
//$(function(){
//
//	$(".province").click(function(){
//	$(".province").css("background","none")
//	})
//	$(".city").click(function(){
//	$(".city").css("background","none")
//	})
//	$(".county").click(function(){
//	$(".county").css("background","none")
//})
//})


//实现月份级联
function YYYYMMDDstart(){   
	MonHead = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];   
	
	//先给年下拉框赋内容   
	var y  = new Date().getFullYear();  
	for (var i = (y-50); i < (y+50); i++) //以今年为准，前50年，后50年   
		   document.reg_testdate.YYYY.options.add(new Option(" "+ i, i));   
	
	//赋月份的下拉框   
	for (var i = 1; i < 13; i++)   
		   document.reg_testdate.MM.options.add(new Option(" " + i, i));   
	
//	document.reg_testdate.YYYY.value = y;   
//	document.reg_testdate.MM.value = new Date().getMonth() + 1;   
	var n = MonHead[new Date().getMonth()];   
	if (new Date().getMonth() ==1 && IsPinYear(YYYYvalue)) n++;   
		writeDay(n); //赋日期下拉框Author:meizz   
//	document.reg_testdate.DD.value = new Date().getDate();   
}   
if(document.attachEvent)   
	window.attachEvent("onload", YYYYMMDDstart);   
else   
window.addEventListener('load', YYYYMMDDstart, false);   
function YYYYDD(str) //年发生变化时日期发生变化(主要是判断闰平年)   
{   
	var MMvalue = document.reg_testdate.MM.options[document.reg_testdate.MM.selectedIndex].value;   
	if (MMvalue == ""){ var e = document.reg_testdate.DD; optionsClear(e); return;}   
	var n = MonHead[MMvalue - 1];   
	if (MMvalue ==2 && IsPinYear(str)) n++;   
	writeDay(n)   
}   
function MMDD(str)   //月发生变化时日期联动   
{   
	var YYYYvalue = document.reg_testdate.YYYY.options[document.reg_testdate.YYYY.selectedIndex].value;   
	if (YYYYvalue == ""){ var e = document.reg_testdate.DD; optionsClear(e); return;}   
	var n = MonHead[str - 1];   
	if (str ==2 && IsPinYear(YYYYvalue)) n++;   
	writeDay(n)   
}   
function writeDay(n)   //据条件写日期的下拉框   
{   
	var e = document.reg_testdate.DD; optionsClear(e);   
	for (var i=1; i<(n+1); i++)   
	e.options.add(new Option("  "+ i, i));   
}   
function IsPinYear(year)//判断是否闰平年   
{
	return(0 == year%4 && (year%100 !=0 || year%400 == 0));
}   
function optionsClear(e)   
{   
	e.options.length = 1;   
}   

//实现点击文本可切换来获取当前状态
$(function(){
	$(".hobby a").click(function(){
		index=$(this).index()-3;
		$(".hobby a").eq(index).addClass("on").siblings().removeClass("on");
	})
})
