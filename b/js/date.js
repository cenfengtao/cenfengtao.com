 $(function(){         
    var cells = document.getElementById('monitor').getElementsByTagName('button');
    var day1 = document.getElementById('curday');
    var day7 = document.getElementById('curday7');
    var clen = cells.length;
    var currentFirstDate;
    var myDate=new Date();
    var today=myDate.getDate();

    var formatDate = function(date){             
        var year = date.getFullYear()+'年';
        var month = (date.getMonth()+1)+'月';
        var day = date.getDate();
        var week = '('+['日','一','二','三','四','五','六'][date.getDay()]+')';  

        return day;
    };

    var addDate= function(date,n){       
        date.setDate(date.getDate()+n);        
        return date;
    };
    var setDate = function(date){             
        var week = date.getDay();
        date = addDate(date,week*-1);
        currentFirstDate = new Date(date);
      	console.log(currentFirstDate)
        for(var i = 0;i<clen;i++){                 
            cells[i].innerHTML = formatDate(i==0 ? date : addDate(date,1));
            if (cells[i].innerHTML==today) {
                cells[i].className='mark1';
            };
			day1.innerHTML=date.getFullYear()+'年'+(date.getMonth()+1)+'月'+cells[0].innerHTML+'日'+'-'+date.getFullYear()+'年'+(date.getMonth()+1)+'月'+cells[6].innerHTML+'日';
//          day1.innerHTML='<span class="y">'+date.getFullYear()+'</span>'+'年'+ '<span class="m">'+(date.getMonth()+1)+'</span>'+'月'+'<span class="d">'+cells[6].innerHTML+'</span>'+'周';
        }
//      var y = $(".y").html(); 
//      var m = $(".m").html();
//		var d = $(".d").html();
//		var w=getMonthWeek(y, m, d);
//        console.log(y,m,d,w)
//        $(".d").html(w)
    };
 
    document.getElementById('last-week').onclick = function(){
        setDate(addDate(currentFirstDate,-7)); 
    };             
    document.getElementById('next-week').onclick = function(){                 
        setDate(addDate(currentFirstDate,7));
    };
    setDate(new Date());

});