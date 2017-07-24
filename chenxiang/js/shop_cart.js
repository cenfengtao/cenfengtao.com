
//往购物车里动态添加商品
function loadCar(){
	var carData = JSON.parse(getCar());
	if(carData){
		var tbody = document.getElementById("carTbody");
		for(var i=0;i<carData.length;i++){
			//复选框
			var tr = document.createElement("li");
			tr.setAttribute("data-id",carData[i].id)
			tr.setAttribute("class","num")
			var td1 = document.createElement("div");
			td1.setAttribute("class","myCheckbox")
			var img=document.createElement("img")
			img.setAttribute("src","./images/checked.png")
			img.setAttribute("class","check")
			img.onclick=change;
			var inputCheck = document.createElement("input");
			inputCheck.setAttribute("type","hidden");
			inputCheck.setAttribute("value","1");
			inputCheck.setAttribute("class","checked");
			td1.appendChild(img);
			td1.appendChild(inputCheck);
			tr.appendChild(td1);
			
			//商品图片
			var td2 = document.createElement("div");
			td2.setAttribute("class","goods");
			var a2=document.createElement("a");
			a2.setAttribute("href","pro_details.html");
			var img2 = document.createElement("img");
			img2.src = carData[i].imgSrc;
			a2.appendChild(img2);
			td2.appendChild(a2);
			tr.appendChild(td2);
			
			//介绍
			var td3 = document.createElement("div");
			td3.setAttribute("class","introduce");
			var a3_1=document.createElement("a")
			var text3_1 = document.createTextNode("【世纪沉香坊】");
			a3_1.appendChild(text3_1);
			a3_1.setAttribute("href","pro_details.html");
			var a3_2=document.createElement("a")
			var text3_2 = document.createTextNode("加里曼丹 10MM *19颗 8克");
			a3_2.appendChild(text3_2);
			a3_2.setAttribute("href","pro_details.html");
			td3.appendChild(a3_1);
			td3.appendChild(a3_2);
			tr.appendChild(td3);
			
			//商品类型
			var td4=document.createElement("div");
			td4.setAttribute("class","type");
			var span4_1=document.createElement("span")
			var text4_1 = document.createTextNode("颜色：棕色");
			span4_1.appendChild(text4_1);
			var span4_2=document.createElement("span")
			var text4_2 = document.createTextNode("规格：10MM");
			span4_2.appendChild(text4_2);
			td4.appendChild(span4_1);
			td4.appendChild(span4_2);
			tr.appendChild(td4);
			
			//商品单价
			var td5 = document.createElement("div"); 
			td5.setAttribute("class","price");
			var span5=document.createElement("span");
			var text5_1 = document.createTextNode("￥"+carData[i].price.toFixed(2));
			span5.appendChild(text5_1);
			var a5=document.createElement("a");
			var text5_2 = document.createTextNode("更多促销");
			a5.onclick="#"
			a5.appendChild(text5_2);
			td5.appendChild(span5);
			td5.appendChild(a5);
			tr.appendChild(td5);
			
			//商品数量
			var td6 = document.createElement("div"); 
			td6.setAttribute("class","count");
			
			var a6_1 = document.createElement("a");
			a6_1.setAttribute("class","reduce");
			a6_1.setAttribute("onclick","reduce(this)");
			var text6_1 = document.createTextNode("-");
			a6_1.appendChild(text6_1);
			
			var input6 = document.createElement("input"); 
			input6.setAttribute("type","text");
			input6.setAttribute("onchange","numChange(this)");
			input6.setAttribute("class","count_input");
			input6.setAttribute("value",carData[i].num);
			
			var a6_2 = document.createElement("a");
			a6_2.setAttribute("class","add");
			a6_2.setAttribute("onclick","add(this)");
			var text6_2 = document.createTextNode("+");
			a6_2.appendChild(text6_2);
			
			td6.appendChild(a6_1);
			td6.appendChild(input6);
			td6.appendChild(a6_2);
			tr.appendChild(td6);
			
			//商品价格小计
			var td7 = document.createElement("div");
			td7.setAttribute("class","subtotal");
			var span7_1=document.createElement("span")
			var text7_1 = document.createTextNode("￥"+carData[i].totalPrice);
			span7_1.appendChild(text7_1);
			var span7_2=document.createElement("span")
			var text7_2 = document.createTextNode("0.8kg");
			span7_2.appendChild(text7_2);
			td7.appendChild(span7_1);
			td7.appendChild(span7_2);
			tr.appendChild(td7);
			
			//商品删除
			var td8 = document.createElement("div"); 
			td8.setAttribute("class","operation");
			var a8_1 = document.createElement("a"); 
			a8_1.setAttribute("class","delete");
			a8_1.setAttribute("onclick","deletePro(this)")
			var text8_1 = document.createTextNode("删除");
			a8_1.appendChild(text8_1);
			var a8_2 = document.createElement("a"); 
			var text8_2 = document.createTextNode("移到我的关注");
			a8_2.appendChild(text8_2);
			td8.appendChild(a8_1);
			td8.appendChild(a8_2);
			tr.appendChild(td8);
			
			//将tr添加到tbody
			tbody.appendChild(tr);
		}
	}
	totalSum()
	checkedNum()
	
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

function clearProAll(){
	clearCar();
	var tbody = document.getElementById("carTbody");
	if(tbody){
		var tr = tbody.getElementsByTagName("tr");
		var length = tr.length;
		for(var i=0;i<length;i++){
			tbody.remove(i)
		}
	}
}

//商品里的勾选
var bool=true;
function change(){
	var border=document.getElementsByClassName("border")[0];
	var check=this.parentNode.getElementsByTagName("input")[0];
	if(check.value==1){
		this.src="./images/checked_border.png";
		check.value=0;
	}else if(check.value==0){
		this.src="./images/checked.png";
		check.value=1;
	}
	checkAll()
	totalSum()
	checkedNum()
}
//判断商品里的勾选来确定全选
function checkAll(){
	var checked=document.getElementsByClassName("checked");
	var border=document.getElementsByClassName("border")[0];
	for(var i=0;i<checked.length;i++){
		if(checked[i].value==0){
			border.src="./images/checked_border.png";
			return;
		}
	}
	border.src="./images/checked.png";
	
}

//商品数量的总计
function checkedNum(){
	var checkedNum=0;
	var checked=document.getElementsByClassName("checked");
	var count=document.getElementsByClassName("checkedNum");
	for(var i=0;i<checked.length;i++){
		if(checked[i].value==1){
			var countInput=checked[i].parentNode.parentNode.getElementsByClassName("count_input")[0].value;
			checkedNum+=parseInt(countInput);
		}
	}
	for(var i=0;i<count.length;i++){
		count[i].innerHTML=checkedNum;
	}
    var checkedNum=document.getElementsByClassName("checkedNum")[0];
    var proNum=localStorage.getItem("shopCar");
    var a=JSON.parse(proNum);
	checkedNum.innerHTML=a.length;
}


//删除单行商品
function deletePro(obj){
	var tr = obj.parentNode.parentNode;
	var id = tr.getAttribute("data-id");
	var checkValue=obj.parentNode.parentNode.getElementsByClassName("checked")[0].value;
	checkedNum();
	if(checkValue==1){
		var con=confirm("确定要删除这行商品吗？");
		if(con){
			delProduct(id);
		    tr.remove();
		}else{
			return false;
		}
	}else{
		alert("只有先勾选了之后才能再删除商品。")
	}
	
}
//删除选定的商品
function del(){
	var checkValue=0;
	var tr = document.getElementsByClassName("num");
	for(var i=0;i<tr.length;i++){
		var checkValue=tr[i].getElementsByClassName("checked")[0].value;
		if(checkValue == 1){

			alert("立即删除被选中的商品。");
            break
		}
	}	
	for(var i=0;i<tr.length;i++){
		var checkValue=tr[i].getElementsByClassName("checked")[0].value;
		var id=tr[i].getAttribute("data-id");
		if(checkValue == 1){
			delProduct(id);
//			alert("立即删除被选中的商品。");
			location.reload();
			
		}
	}
	var index = 0;
	for(var i=0;i<tr.length;i++){
		var checkValue=tr[i].getElementsByClassName("checked")[0].value;
		if(checkValue == 0){
			index+=1;
		}
		if(index == tr.length){
			alert("只有先勾选了之后才能再删除商品。")
		}
	}	
}
//商品价值的总计
function totalSum(){
	var tr = document.getElementsByClassName("num");
	var sum=0;
	var totalSum=document.getElementById("totalSum");
	for(var i=0;i<tr.length;i++){
		var checkValue=tr[i].getElementsByClassName("checked")[0].value;
		if(checkValue==1){
			var totalPrice=tr[i].getElementsByClassName("subtotal")[0].getElementsByTagName("span")[0].innerHTML;
			totalPrice=parseFloat(totalPrice.slice(1));
			sum+=totalPrice;
		}
	}
	sum=sum.toFixed(2);
	totalSum.innerHTML="￥"+sum;

}
//商品数量加操作
function add(obj){
	var prd_num = obj.previousSibling;
	var id = obj.parentNode.parentNode.getAttribute("data-id");
	var num = prd_num.value;
	if(isNaN(num)){
		num = 1;
	}else{
		num = parseInt(num);
	}
	
	num+=1;
	prd_num.value = num;
    //实现商品的小计
	var price=obj.parentNode.previousSibling.getElementsByTagName("span")[0].innerHTML;
	var priceValue=price.slice(1);
	var totalPrice=(num*priceValue).toFixed(2);
    var total=obj.parentNode.nextSibling.getElementsByTagName("span")[0];
    total.innerHTML="￥"+totalPrice;
    var totalValue=totalPrice;
//  var totalValue=total.innerHTML="￥"+totalPrice;
	changeCarNum(id,num,totalValue);
	totalSum();
	checkedNum();
}
//商品数量改变的操作
function numChange(obj){
	var num = obj.value;
	var id = obj.parentNode.parentNode.getAttribute("data-id");
	
	console.log(id)
	console.log(num)
	if(isNaN(num)){
		num = 1;
	}else if(num==""){
		num=1;
	}else if(num<1){
		num=1;
	}
	num = parseInt(num);
	obj.value = num;
    //实现商品的小计
	var price=obj.parentNode.previousSibling.getElementsByTagName("span")[0].innerHTML;
	var priceValue=price.slice(1);
	var totalPrice=(num*priceValue).toFixed(2);
    var total=obj.parentNode.nextSibling.getElementsByTagName("span")[0];
    total.innerHTML="￥"+totalPrice;
    var totalValue=totalPrice;
	changeCarNum(id,num,totalValue);
	totalSum();
	checkedNum();
}
//商品数量减操作
function reduce(obj){
	var prd_num = obj.nextSibling;
	var id = obj.parentNode.parentNode.getAttribute("data-id");
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
	//实现商品的小计
	var price=obj.parentNode.previousSibling.getElementsByTagName("span")[0].innerHTML;
	var priceValue=price.slice(1);
	var totalPrice=(num*priceValue).toFixed(2);
    var total=obj.parentNode.nextSibling.getElementsByTagName("span")[0];
    total.innerHTML="￥"+totalPrice;
    var totalValue=totalPrice;
	changeCarNum(id,num,totalValue);
	totalSum();
	checkedNum();
}


//全选框的实现
$(function(){
	var bool=true;
		$(".border").click(function(){
			var tr = document.getElementsByClassName("num");
			if(bool){
				bool=false;
				$(".border").attr("src","./images/checked_border.png");
				$(".border").next().val(0);
				for(var i=0;i<tr.length;i++){
					var check=tr[i].getElementsByClassName("check")[0];
					var checkValue=tr[i].getElementsByClassName("checked")[0].value;
					if(checkValue==1){
						check.src="./images/checked_border.png";
                        check.nextSibling.value=0;
					}
				}
				totalSum()
				checkedNum()
			}else{
				bool=true;
				$(".border").attr("src","./images/checked.png")
				$(".border").next().val(1);
				for(var i=0;i<tr.length;i++){
					var check=tr[i].getElementsByClassName("check")[0];
					var checkValue=tr[i].getElementsByClassName("checked")[0].value;
					if(checkValue==0){
						check.src="./images/checked.png";
						check.nextSibling.value=1;
					}
				}
		        totalSum()
		        checkedNum()
			}
	})
})

