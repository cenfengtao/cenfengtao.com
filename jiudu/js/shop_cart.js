
//往购物车里动态添加商品
function loadCar(){
	var carData = JSON.parse(getCar());
	if(carData){
		if(carData.length){
			var checkedAll=document.getElementsByClassName("checkedAll")[0];
			checkedAll.checked=true;
		}
		
		var tbody = document.getElementById("carTbody");
		var html="";
		for(var i=0;i<carData.length;i++){
				html+='<li data-id="'+carData[i].id+'" class="number">'+
						'<p><a href="###" class="edit">编辑</a></p>'+
						'<div class="type">'+
							'<label>'+
								'<input type="checkbox" class="checked" checked="checked"/>'+
								'<i class="check"></i>'+
							'</label>'+
							'<a href="pro_details.html">'+
								'<img src="'+carData[i].imgSrc+'"/>'+
							'</a>'+
							'<div class="content">'+
								'<a href="pro_details.html" class="text">九五至尊白酒小酒版收藏浓香型纯粮食原浆酒小瓶特价包邮2瓶</a>'+
								'<span>￥：<strong class="price">'+carData[i].price+'</strong></span>'+
								'<span>65.00</span>'+
								'<span>x<strong class="num">'+carData[i].num+'</strong></span>'+
							'</div>'+
							'<div class="changeContent">'+
								'<div class="changeNum">'+
									'<p>'+
										'<a href="###" onclick="reduce(this)">-</a>'+
										'<input type="text" name="" id="" value="'+carData[i].num+'" onchange="numChange(this)"/>'+
										'<a href="###" onclick="add(this)">+</a>'+
									'</p>'+
									'<p>'+
										'<a href="###">二锅头清香型白酒</a>'+
										'<a href="###">&or;</a>'+
									'</p>'+
								'</div>'+
								'<a href="###" class="del" onclick="deletePro(this)">删除</a>'+
							'</div>'+
						'</div>'+
					'</li>';
			
			//将html添加到tbody
			tbody.innerHTML=html;
		}
		var checkList=document.getElementsByClassName("check");
		for(var i=0;i<checkList.length;i++){
			checkList[i].onclick=checkAll;
		}
	}
	totalSum()
$(function(){
	//随着屏幕的宽度变化，删除按钮的宽度发生改变
	$(".checked").css("display","none");
	$(".checkedAll").css("display","none");
	$(".changeContent").css("display","none");
	$(window).resize(function(){
		var big=$(".changeContent").width();
		var small=$(".changeNum").width();
		$(".del").css("width",(big-small-0.8)+"px")
	})
	$(".editAll").click(function(){
		if($(".editAll").text()=="编辑"){
//			bool=false;
			$(".content").css("display","none");
			$(".changeContent").css("display","block");
			$(".editAll").text("完成");
			var big=$(".changeContent").width();
			var small=$(".changeNum").width();
			$(".del").css("width",(big-small-0.8)+"px")
			$(".edit").text("完成");
		}else{
//			bool=true;
			$(".content").css("display","block");
			$(".changeContent").css("display","none");
			$(".editAll").text("编辑");
			$(".edit").text("编辑");
		}
	})
	
	$(".edit").click(function(){
		var bool=true;
		var edit=$(".edit");
		var editAll=$(".editAll");
		var length=$(".edit").length;
		var index=$(this).parent().parent().index();
		
		if($(this).text()=="编辑"){
			$(this).parent().next().children(".content").css("display","none");
			$(this).parent().next().children(".changeContent").css("display","block");
			$(this).text("完成");
			var big=$(this).parent().next().children(".changeContent").width();
			var small=$(this).parent().next().children(".changeContent").children(".changeNum").width();
			$(".del").css("width",(big-small-0.8)+"px")
		}else{
			$(this).parent().next().children(".content").css("display","block");
			$(this).parent().next().children(".changeContent").css("display","none");
			$(this).text("编辑");
		}
		
		if($(this).text()=='完成'){
			
			editAll.text("完成");
		}
		
		for(var i=0;i<length;i++){
			if(edit[i].innerHTML=="完成"){
				bool=false;
			}
		}
		if(bool){
			editAll.text("编辑");
		}
		
		
		
		
	})
})

	
} 

//定义key名称
var keyName = "shopCar"
//将商品添加到购物车
function addShopCar(product){
	//先获取本地数据
	var productData = getCar();
	//如果本地里面没有任何商品
	if(!productData){
		//创建一个JSON数据，将商品添加到这个JSON数据里面
		var proData = [
			product
		]
		//再存储到本地存储（添加到购物车）
		addCar(proData)
	}else{
		//本地已经有数据（商品）
		//将数据转换成JSON格式的数据
		var carData = JSON.parse(productData);
		var bool = true;
		//遍历这个数据
		for(var i=0;i<carData.length;i++){
			//通过id判断是否有相同的商品，如果有相同的商品，直接加数量和小计
			if(carData[i].id == product.id){
				carData[i].num = parseInt(carData[i].num) + parseInt(product.num);
				carData[i].totalPrice = (parseFloat(carData[i].totalPrice) + parseFloat(product.totalPrice)).toFixed(2);
				bool = false;
				break;
			}
		}
		//如果没有相同的商品，直接将这个商品添加到购物车
		if(bool){
			//数组添加数据的方法push()
			carData.push(product)
		}
		//再重新将所有的商品存储到购物车
		addCar(carData);
	}
}
//通过指定的key获取商品数据
function getCar(){
	return localStorage.getItem(keyName);
}
//通过指定的key添加商品到本地
function addCar(productData){
	localStorage.setItem(keyName,JSON.stringify(productData));
}
//通过指定的id删除对应的商品
function delProduct(id){
	//先获取本地数据
	var carData = JSON.parse(getCar());
	//定义一个空数组，用来存储id不相等的商品
	var arrData = [];
	for(var i=0;i<carData.length;i++){
		if(carData[i].id == id){
			//如果id等于本地数据其中一个商品的id，就直接跳出这一次循环，再进行下一次循环
			continue;
		}else{
			//把id不相等的商品添加到新数组里面
			arrData.push(carData[i])
		}
	}
	//再重新将数据添加到购物车里面
	addCar(arrData);
}
//清空购物车
function clearCar(){
	//通过指定的key删除购物车
	localStorage.removeItem(keyName);
}

//改变本地数据的数量
function changeCarNum(id,num,totalValue){

	var carData = JSON.parse(getCar());
	for(var i=0;i<carData.length;i++){
		if(carData[i].id == id){
			carData[i].num = num;
			carData[i].totalPrice = totalValue;
			break;
		}
	}
	addCar(carData);
}

//商品里的勾选
var bool=true;

//判断商品里的勾选来确定全选

function checkAll(){
	var cList=document.getElementsByClassName("check");
	var checkedAll=document.getElementsByClassName("checkedAll")[0];
	var input=this.parentNode.getElementsByTagName("input")[0];
	input.checked=input.checked?false:true;
	for(var j=0;j<cList.length;j++){
		if(cList[j].parentNode.getElementsByTagName("input")[0].checked==false){
			checkedAll.checked=false;
			totalSum()
			return false;
		}
	}	
	checkedAll.checked=true;
	totalSum()
	return false;
	
}
//全选框的实现
$(function(){
	var bool=true;
		$(".checkedAll").click(function(){
			var tr = document.getElementsByClassName("number");
			var checkedAll=document.getElementsByClassName("checkedAll")[0];
			if(bool){
				bool=false;
				checkedAll.checked=false;
				for(var i=0;i<tr.length;i++){
					var check=tr[i].getElementsByClassName("checked")[0];
					if(check.checked==true){
						check.checked=false;
					}
				}
				totalSum()
			}else{
				bool=true;
				checkedAll.checked=true;
				for(var i=0;i<tr.length;i++){
					var check=tr[i].getElementsByClassName("checked")[0];
					if(check.checked==false){
						check.checked=true;
					}
				}
		        totalSum()
			}
	})
})

//删除单行商品
function deletePro(obj){
	var tr = obj.parentNode.parentNode.parentNode;
	var id = tr.getAttribute("data-id");
	var checked=obj.parentNode.parentNode.parentNode.getElementsByClassName("checked")[0];
	if(checked.checked==true){
		var con=confirm("确定要删除该商品吗？");
		if(con){
			delProduct(id);
		    tr.remove();
		}else{
			return false;
		}
	}else{
		alert("只有先勾选了之后才能再删除商品。")
	}
	
	var numLen=$(".number");
	var checkedAll=document.getElementsByClassName("checkedAll")[0];
	if(numLen.length==0){
		checkedAll.checked=false;	
	}
	
	var bool=true;
	var edit=$(".edit");
	for(var i=0;i<numLen.length;i++){
		if(edit[i].innerHTML=="完成"){
			bool=false;
		}
	}
	if(bool){
		$(".editAll").text("编辑");
	}
	totalSum()	
}

//商品价值的总计
function totalSum(){
	var tr = document.getElementsByClassName("number");
	var sum=0;
	var totalSum=document.getElementById("totalSum");
	for(var i=0;i<tr.length;i++){
		var checked=tr[i].getElementsByClassName("checked")[0];
		var price=tr[i].getElementsByClassName("price")[0].innerHTML;
		var piece=tr[i].getElementsByClassName("num")[0].innerHTML;
		if(checked.checked==true){
		  sum+=price*piece;
		}
	}
	sum=sum.toFixed(2);
	totalSum.innerHTML=sum;

}
//商品数量加操作
function add(obj){
	var piece=obj.parentNode.parentNode.parentNode.previousSibling.getElementsByClassName("num")[0];
	var prd_num = obj.previousSibling;
	var id = obj.parentNode.parentNode.parentNode.parentNode.parentNode.getAttribute("data-id");
	
	var num = prd_num.value;
	if(isNaN(num)){
		num = 1;
	}else{
		num = parseInt(num);
	}
	
	num+=1;
	prd_num.value = num;
	piece.innerHTML=num;
    //实现商品的小计
	var price=obj.parentNode.parentNode.parentNode.previousSibling.getElementsByTagName("strong")[0].innerHTML;
	var totalPrice=(num*price).toFixed(2);
    var totalValue=totalPrice;
	changeCarNum(id,num,totalValue);
	totalSum()
}
//商品数量改变的操作
function numChange(obj){
	var piece=obj.parentNode.parentNode.parentNode.previousSibling.getElementsByClassName("num")[0];
	var num = obj.value;
	var id = obj.parentNode.parentNode.parentNode.parentNode.parentNode.getAttribute("data-id");
	if(isNaN(num)){
		num = 1;
	}else if(num==""){
		num=1;
	}else if(num<1){
		num=1;
	}
	num = parseInt(num);
	obj.value = num;
	piece.innerHTML=num;
    //实现商品的小计
	var price=obj.parentNode.parentNode.parentNode.previousSibling.getElementsByTagName("strong")[0].innerHTML;
	var totalPrice=(num*price).toFixed(2);
    var totalValue=totalPrice;
	changeCarNum(id,num,totalValue);
	totalSum();
}
//商品数量减操作
function reduce(obj){
	var piece=obj.parentNode.parentNode.parentNode.previousSibling.getElementsByClassName("num")[0];
	var prd_num = obj.nextSibling;
	var id = obj.parentNode.parentNode.parentNode.parentNode.parentNode.getAttribute("data-id");
	var num = prd_num.value;
	if(isNaN(num)){
		num = 1;
	}else{
		num = parseInt(num);
	}
	
	num-=1;
	if(num<1){
		num=1
	}
	prd_num.value = num;
	piece.innerHTML=num;
	//实现商品的小计
	var price=obj.parentNode.parentNode.parentNode.previousSibling.getElementsByTagName("strong")[0].innerHTML;
	var totalPrice=(num*price).toFixed(2);
    var totalValue=totalPrice;
	changeCarNum(id,num,totalValue);
	totalSum();
}
function goLoad(){
	var data=localStorage.getItem("user");
	console.log(data)
	var input=document.getElementsByClassName("checked");

	if(input.length==0){
		alert("请先添加商品。")
		return;
	}
	var index=0;
	for(var i=0;i<input.length;i++){	
		if(input[i].checked==false){
			index+=1;
		}
		if(index==input.length){
			alert("请先勾选商品再提交订单。")
			return;
		}
		if(input[i].checked==true){
			if(data==null){
				var con=confirm("请先登录再进行提交订单。")
				if(con){
					location.href="login.html";
				}else{
					return false;
				}
				break;
			}else{
				location.href="confirm_order.html";
			}
		}
	}
	
}

