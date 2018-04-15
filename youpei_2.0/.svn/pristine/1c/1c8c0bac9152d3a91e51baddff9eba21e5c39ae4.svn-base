function addProductN(){
var num=parseFloat($('.counts').val());
var n=parseFloat($('#integral').val());
var integral_exchange=parseFloat($('#integral_exchange').val());
var nums=parseInt(num)+1;
var integral=parseInt(n)-parseInt(integral_exchange);

if (integral <0 ) {return;}
if(nums<1 || nums>100){ return;}
$('.counts').val(nums);
 $('#integral').val(integral);  
}
function reduceProductN(){
var num=parseFloat($('.counts').val());
var n=parseFloat($('#integral').val());
var integral_exchange=parseFloat($('#integral_exchange').val());
var nums=parseInt(num)-1;
var integral=parseInt(n)+parseInt(integral_exchange);;  
if (integral <n ) {return;}
	if(nums<1){ return;}
	$('.counts').val(nums);
	$('#integral').val(integral); 
}
function submitintegral(id){
    var num=$('#count').val();
    if (num>=1) {
	$.post("/index.php/Lottery/confirmexchange",{num:num},function(res){
			if(res.status==1){
				alert('兑换成功');
				setTimeout(function () {
					window.parent.location.reload();
					var index = parent.layer.getFrameIndex(window.name);
					parent.layer.close(index);
				}, 1000);
			}else if(res.status==2){
				layer.open({
					   content: res.msg
					   ,btn: '我知道了'
					});
			}else{
				alert(res.msg||'兑换失败');
				window.location.href=window.location.href+"?math="+10000*Math.random();
			}
        })
	}else{
		alert('兑换不能小于0');
	}
}