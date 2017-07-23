//更改商品文本框数值时触发
function changeValue(){
	var pro_num=document.getElementById("pro_num");
	var num=pro_num.value;
	if(isNaN(num)){
		num=1;
	}else if(num==""){
		num=1;
	}else if(num<1){
		num=1;
	}
	num =parseInt(num);
	pro_num.value=num;
}
//实现商品增加功能
function add(){
	var pro_num = document.getElementById("pro_num");
	var num=pro_num.value;
	if(isNaN(num)){
		num=1;
	}else{
		num=parseInt(num);
	}
	num+=1;
	pro_num.value=num;
}
//实现商品减少功能
function reduce(){
				var prd_num = document.getElementById("prd_num");
				var num = parseInt(pro_num.value);
				num-=1;
				if(num<1){
					num = 1;
				}
				pro_num.value = num;
}

