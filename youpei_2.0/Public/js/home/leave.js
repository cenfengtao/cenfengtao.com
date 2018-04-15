 //    获取url参数
  function GetRequest() {
      var url = location.search; //获取url中"?"符后的字串
      var theRequest = new Object();
      if (url.indexOf("?") != -1) {
          var str = url.substr(1);
          strs = str.split("&");
          for (var i = 0; i < strs.length; i++) {
              theRequest[strs[i].split("=")[0]] = unescape(strs[i].split("=")[1]);
          }
      }
      return theRequest;
  }
  var id=GetRequest().id;
$(function(){
  $.ajax({
      type:"get",
      url:"/index.php/Personal/ajaxLeave",
      aynsc:true,
      data:{
        id:id
      },
      dataType:"json",
      success:function(data){
        if(data.status==1){
          var data=data.data;
          $(".content").append(
              '<div>'+
               '<h3>'+data.class.class_title+'</h3>'+
               '<div class="teacher">'+
                   '<span>上课老师</span>'+
                   '<span>'+data.class.teacher+'</span>'+
               '</div>'+
               '<div class="classNum">'+
                   '<span>当前课次</span>'+
                   '<span>'+data.class.class_hour+'</span>'+
               '</div>'+
           '</div>'
            )
        }
      }
    })
    $(".submit").click(function(){
       var content=$("textarea[name='content']").val()
        $.ajax({
          type:"post",
          url:"/index.php/Personal/uploadLeave",
          aynsc:true,
          data:{
            id:id,
            leave:content
          },
          dataType:"json",
          success:function(data){
            if(data.status==1){
             alert(data.message)
             history.back()
            }else{
              alert(data.message)
            }
          }
      })
    })
     
})