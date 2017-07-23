//实现每个页面购物车商品种类数量
function proNum(){
	var checkedNum=document.getElementsByClassName("checkedNum")[0];
    var proNum=localStorage.getItem("shopCar");
    var a=JSON.parse(proNum);
//  var num=0;
//  if(a){
//  	for(var i=0;i<a.length;i++){
//	  		num+=parseInt(a[i].num);
//	  	}
//  }

// 	checkedNum.innerHTML=num;
    if(a!=null){
    	checkedNum.innerHTML=a.length;
    }else{
    	checkedNum.innerHTML=0;
    }

}
