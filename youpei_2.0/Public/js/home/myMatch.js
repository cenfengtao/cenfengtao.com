$(function(){
    $.ajax({
        type:"get",
        url:"/index.php/Personal/ajaxMyMatch",
        aynsc:true,
        data:{},
        dataType:"json",
        success:function(data){
            if(data.status==1){
                var data=data.data;
                var voteLength=data.vote.length;
                if(voteLength==0){
                    $(".orgLists").append(
                            ' <p style="font-size: 0.5rem;padding: 2rem 0.5rem;text-align: center;">亲,您还没有过参加比赛的记录哦，赶紧去看看还有什么<a href="/index.php/Vote/voteActivityList.html" style="font-size: 0.5rem;text-decoration: underline;">比赛</a>参加吧！</p>'
                        )
                }
                for(var i=0; i<data.vote.length; i++){
                    $(".proceedList").append(
                        '<li onclick="voteList('+data.vote[i].id+')">'+
                            '<div class="img">'+
                                '<img src="'+data.vote[i].image+'" alt="" class="org">'+
                                // '<div class="type">'+
                                //     '<span>创造力</span>'+
                                //     '<span>动手</span>'+
                                //     '<span>美感</span>'+
                                // '</div>'+
                            '</div>'+
                            '<div class="text">'+
                                '<h3>'+data.vote[i].title+'</h3>'+
                                '<div class="work">'+
                                    '<p class="workNum">'+
                                        '<span>参与作品数 : <strong>'+data.vote[i].userWorksCount+'</strong></span>'+
                                    '</p>'+
                                    '<p class="heat num'+i+'">'+
                                    '</p>'+
                                '</div>'+
                                '<div class="date">'+
                                    '<span>活动时间 : </span>'+
                                    '<span class="dateTime">'+data.vote[i].work_start_time+'-'+data.vote[i].vote_end_time+'</span>'+
                                '</div>'+
                                '<div class="status">'+
                                        '<span>活动状态：<strong></strong></span>'+
                                    '</div>'+
                            '</div>'+
                        '</li>'  
                    )
                    var voteStatus=data.vote[i].voteStatus;
                    if(voteStatus==1){
                        $(".status").eq(i).find("strong").html("活动正在进行中")
                    }else{
                        $(".status").eq(i).find("strong").html("活动已结束")
                    }

                     var num=".num"+i;
                    if(data.vote[i].userWorksCount>2){
                        $(num).html(
                                '<span>热度 : </span>'+
                                '<img src="../../../../Public/images/star.png" alt="">'
                            )
                    }
                    if(data.vote[i].userWorksCount>5){
                        $(num).html(
                                '<span>热度 : </span>'+
                                '<img src="../../../../Public/images/star.png" alt="">'+
                                '<img src="../../../../Public/images/star.png" alt="">'
                            )
                    }
                    if(data.vote[i].userWorksCount>8){
                        $(num).html(
                                '<span>热度 : </span>'+
                                '<img src="../../../../Public/images/star.png" alt="">'+
                                '<img src="../../../../Public/images/star.png" alt="">'+
                                '<img src="../../../../Public/images/star.png" alt="">'
                            )
                    }
                    if(data.vote[i].userWorksCount>11){
                        $(num).html(
                                '<span>热度 : </span>'+
                                '<img src="../../../../Public/images/star.png" alt="">'+
                                '<img src="../../../../Public/images/star.png" alt="">'+
                                '<img src="../../../../Public/images/star.png" alt="">'+
                                '<img src="../../../../Public/images/star.png" alt="">'
                            )
                    }
                    if(data.vote[i].userWorksCount>14){
                        $(num).html(
                                '<span>热度 : </span>'+
                                '<img src="../../../../Public/images/star.png" alt="">'+
                                '<img src="../../../../Public/images/star.png" alt="">'+
                                '<img src="../../../../Public/images/star.png" alt="">'+
                                '<img src="../../../../Public/images/star.png" alt="">'+
                                '<img src="../../../../Public/images/star.png" alt="">'
                            )
                    }
                }
                
            }
            
        }
    })
    
})
function voteList(id){
    window.location.href="/index.php/Vote/voteList.html?vote_id="+id;
} 