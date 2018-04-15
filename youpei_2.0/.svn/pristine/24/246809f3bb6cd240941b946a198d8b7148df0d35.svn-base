 $(function () {
        $('img').each(function () {
            var src = $(this).attr('src');
            src = src.replace("ooyyee-crm-static.qiniudn.com", "7b1f8s.com1.z0.glb.clouddn.com");
            $(this).attr('src', src);
        });
    });

// 遍历学友团
    $.ajax({
    url:'/index.php/Friends/ajaxGetChildren',
    async: true,
    type:"get",
    dataType:"json",
    success:function(data){
        console.log(data)
        $(".user_list").html(
		            '<li class="clr gray-bg_v4 bdr10 ptb3" style="background: #97c2e0;">'+
		                '<label>总人数</label>'+
		                '<div class="user-total-coupons bdr10 fz18">'+data.data.count+'人</div>'+
		            '</li>'           
		        )   
        	$(".user_list").append(
            	'<li class="clr gray-bg_v4 bdr10 ptb3 close">'+
	                '<label class="username">你的上级</label>'+
	                '<div class="user-total-coupons bdr10 fz18">'+data.data.up_user+'</div>'+
	            '</li>'
       		)
        if(data.data.up_user==false){
        	 $(".close").hide()
        }
        if(data.data.up_user==undefined){
        	 $(".close").hide()
        }
        if(data.data.up_user==null){
        	 $(".close").hide()
        }
        
        
        
        
        if(data.data.count==0){
            $(".clr").remove();
            alert("您目前还没有任何学友团，快邀请属于你的学友团来助力吧");
        }
        var childrenL=data.data.children.length;
        for(var i=0; i<=childrenL-1; i++){
            var id=data.data.children[i].id;
            var username=data.data.children[i].username;
            var date=data.data.children[i].create_time;
            var child_count=data.data.children[i].child_count;
             $("#tableList tbody").append(
                '<tr onclick="showChildren('+id+')"  class="onclick">'+
                    '<td>'+username+'</td>'+
                    '<td>'+date+'</td>'+
                    '<td class="last-td last_id'+id+'"><span class="num">'+child_count+'</span><img src="/Public/images/down.png" alt="">'+
                    '</td>'+
                '</tr>'
            )
             if(child_count!=0){
                document.getElementsByClassName("onclick")[i].id="tr_"+id+"";

             }
        }

    }
})
//  var friends = {$total_count | default= "1"};
//  if (friends == 0) {
//      alert("您目前还没有任何学友团，快邀请属于你的学友团来助力吧");
//  }
    var bool=true;
    function showChildren(id) {
            if($("#tr_"+id).attr("id")){
                if(bool){
                    $.ajax({
                        url:'/index.php/Friends/ajaxGetChildren',
                        async: true,
                        type:"get",
                        dataType:"json",
                        success:function(data){
                            var childrenL=data.data.children.length; 
                            for(var j=0; j<=childrenL-1; j++){
                                
                                if(id==data.data.children[j].id){
                                    var nextChild=data.data.children[j].children;
                                    var nextChildL=data.data.children[j].children.length;
                                    if(nextChildL>0){
                                            var tbody='';
                                            for(var s=0; s<=nextChildL-1; s++){
                                            $('#tr_' + id).attr('onclick', 'closeChildren(' + id + ')');
                                            $('.last_id' + id + ' img').attr('src', '/Public/images/up.png');
                                            tbody += '<tr class="down-tr del tr-' + id + '" id=""><td>' + nextChild[s].username + '</td><td  style="text-align:center;">' + nextChild[s].create_time + '</td><td> 0 </td></tr>';
                                            }
                                            $("#tr_" + id).after(tbody);
                                    }
                                }
                            }

                        }
                    })
                    bool=false;
                }   
            }
      }  
    function closeChildren(id) {
        bool=true;
        $('.tr-' + id).click();
        $('.tr-' + id).remove();
        $('#tr_' + id).attr('onclick', 'showChildren(' + id + ');');
        $('.last_id' + id + ' img').attr('src', '/Public/images/down.png');
    }
    function isInArray(arr, id) {
        var b = true;
        for (var i = 0; i < arr.length; i++) {
            if (id == arr[i]) {
                b = false;
                break;
            }
        }
        return b;
    }