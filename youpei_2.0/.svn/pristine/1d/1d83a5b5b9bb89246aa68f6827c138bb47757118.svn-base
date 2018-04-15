function toEditAddress(id){
	location.href = "/index.php/Lottery/toEdit?id=" + id;
}
function delAddress(id){
		layer.confirm("您确定要删除该地址吗？",{icon: 3, title:'系统提示'},function(tips){
			var ll = layer.load('数据处理中，请稍候...');
			$.post("/index.php/Lottery/del",{id:id},function(data,textStatus){
				layer.close(ll);
		    	layer.close(tips);
				if(data.status=='1'){
					alert('操作成功');
					 window.location.href=window.location.href+"?math="+10000*Math.random();
				}else{
					alert('操作失败');
				}
			});
		});
	}