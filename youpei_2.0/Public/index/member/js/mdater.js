
var dater = (function(){
	//ahthor wkf39988@gmail.com, //www.maivl.com
	_dater = function(arg){
		this.curDat = new Date();
		this.maxDat = new Date("2015/12/31");
		this.minDat = new Date("1980/01/01");
		this.selectYear = null;
		this.selectMonth = null;
		this.selectDate = null; 
		for(var a in arg){
			this[a] = arg[a];
		}
		//重置当前日期,防止错误
		this.minDat&&(this.curDat = new Date(Math.max(this.minDat, this.curDat) ) );
		this.maxDat&&(this.curDat = new Date(Math.min(this.maxDat, this.curDat) ) );
		//
		this.curDate = this.formate(this.curDat );
		this.maxDate = this.formate(this.maxDat );
		this.minDate = this.formate(this.minDat );
	}
	_dater.prototype = {
		init: function(selects){
			var that = this;
			//
			that.selectYear.onchange = that.selectMonth.onchange = that.selectDate.onchange = function(){
					that.onchange.call(that, this, true);
				};
			that.onchange(that.selectYear, false);
			return that;
		},
		onchange: function(select, auto){
			var that = this;
			switch(select){
				case that.selectYear:
					if(auto){
						that.curDate[0] = parseInt(select.value, 10)||that.curDate[0];
						that.curDate[1] = 1;
						that.curDate[2] = 1;
						that.selectMonth.value = 1;
					}
					that.selectYear&&(function(){
						that.selectYear.options.length = 0;
						for(var startY = that.minDate[0]; startY <= that.maxDate[0]; startY++){
							that.selectYear.options.add(new Option(startY +"年",startY));
						}
						that.selectYear.value = that.curDate[0];
					})();
					//
					that.onchange(that.selectMonth, auto);
				break;
				case that.selectMonth:
					if(auto){
						that.curDate[1] = parseInt(select.value, 10)||that.curDate[1];
						that.curDate[2] = 1;
						that.selectDate.value = 1;
					}
					that.selectMonth&&(function(){
						that.selectMonth.options.length = 0;
						var minM = Math.max((function(){
							var _minM = (that.curDate[0] == that.minDate[0])?that.minDate[1]:1;
							return _minM;
						})(), 1);
						var maxM = Math.min((function(){
							var _maxM = that.curDate[0]==that.maxDate[0]? that.maxDate[1]:12;
							return _maxM;
						})(), 12);
						that.curDate[1] = [minM, that.curDate[1], maxM].sort(function(a,b){
							return a>b?1:0;
						})[1];
						for(var startM = minM; startM<= maxM; startM++){
							that.selectMonth.options.add(new Option(startM +"月",startM));
						}
						that.selectMonth.value = that.curDate[1];
					})();
					//
					that.onchange(that.selectDate, auto);
				break;
				case that.selectDate:
					if(auto){
						that.curDate[2] = parseInt(select.value, 10)||that.curDate[2];
					}
					that.selectDate&&(function(){
						that.selectDate.options.length = 0;
						var minD = Math.max((function(){
							var _minD = ((that.curDate[0] == that.minDate[0])&&(that.curDate[1] == that.minDate[1]) )?that.minDate[2]:1;
							return _minD;
						})(), 1);
						var maxD = Math.min( (function(){
							var _maxD = (that.curDate[1] in {1:true,3:true,5:true,7:true,8:true,10:true,12:true})?31:30;
							return _maxD;
						})(), (function(){
							if(2 == that.curDate[1]){
								var _maxD = (that.curDate[0]%4==0 && that.curDate[0]%100!=0)||(that.curDate[0]%100==0 && that.curDate[0]%400==0)?28:29;
								return _maxD;
							}else{
								return 31;
							}
						})(), (function(){
							var _maxD = ((that.curDate[0] == that.maxDate[0])&&(that.curDate[1] == that.maxDate[1]) )?that.maxDate[2]:31;
							return _maxD;
						})());
						that.curDate[2] = [minD, that.curDate[2], maxD].sort(function(a,b){
							return a>b?1:0;
						})[1];
						//
						for(var startD = minD; startD<= maxD; startD++){
							that.selectDate.options.add(new Option(startD +"日",startD));
						}
						that.selectDate.value = that.curDate[2];
					})();
				default:
					console.log(that.curDate);
				break;
			}
			return that;
		},
		formate: function(date){
			var that = this;
			if(date instanceof Array){
				return date;
			}
			var arrDate = new Array();
			arrDate.push(parseInt(date.getFullYear(), 10) );
			arrDate.push(parseInt(date.getMonth()+1, 10) );
			arrDate.push(parseInt(date.getDate(), 10) );

			return arrDate;
		}
	}
	return _dater;
})();