 $('.video_iframe').each(function () {
        var width = document.getElementById("content-wrapper").offsetWidth, height = Math.ceil(3 * width / 4);
        $(this).attr('width', width);
        $(this).attr('height', height);
        var src = $(this).data('src');
        var f = src;
        if ((0 == f.indexOf("http://v.qq.com/iframe/player.html") || 0 == f.indexOf("http://v.qq.com/iframe/preview.html") || 0 == f.indexOf("https://v.qq.com/iframe/player.html") || 0 == f.indexOf("https://v.qq.com/iframe/preview.html"))) {
            var w = f.match(/[\?&]vid\=([^&]*)/), y = w[1];
            src = "http://v.qq.com/iframe/player.html?vid=" + y + '&width=' + width + '&hegiht=' + height + "&auto=0";
            src = src.replace(/^http:/, location.protocol);
            $(this).data('src', src);
        }
    });
    window.onload = function () {
        $("img,audio,iframe").each(function () {
            var src = $(this).data("src");
            if (src) {
                $(this).attr("src", src);
            }
        });
    }




     $(function () {
        $('.close').bind('click', function () {
            $('.ad').hide();
        })
    })
    $(function () {
        $('#conBox').on('keyup', function () {
            var txtval = $('#conBox').val().length;
            console.log(txtval);
            var str = parseInt(140 - txtval);
            console.log(str);
            if (str > 0) {
                $('#num_txt1').html(str);
            } else {
                $('#num_txt1').html('0');
                $('#conBox').val($('#conBox').val().substring(0, 140)); //这里意思是当里面的文字小于等于0的时候，那么字数不能再增加，只能是600个字
            }
            //console.log($('#num_txt').html(str));
        });
    })
    //留言弹框
    $(function(){
        $('.btn-comment').click(function () {
            $('.kap-bottomwin').css('display','block');
            $('.kap-mask-on').css('display','block');
        });
        $('.btn-close').click(function () {
            $('.kap-bottomwin').css('display','none');
            $('.kap-mask-on').css('display','none');
        });
    });
    $('#addProduct').click(function () {
        if($('#product_contact_memo').val()==''){
            alert('内容不能为空');
            return;
        }
        if($('#product_contact_memo').val().length<=3){
            alert('请填写不少于3个字');
            return;
        }
        $('.kap-bottomwin').css('display', 'none');
        $('.kap-mask-on').css('display', 'none');

        var article_id = $("#article_id").val();
        var data = {
            article_id : article_id,
            content:$('#product_contact_memo').val()
        };
        $.ajax({
            type: 'post',
            url: "/index.php/Article/comment",
            data: data,
            dataType: 'json',
            success: function (res) {
                if (res.status == 0) {
                    $("#product_contact_memo").val('');
                    return alert(res.msg);
                } else if (res.status == 1) {
                    alert(res.msg);
                    $("#product_contact_memo").val('');
                    $.each(res.data, function (i, value) {
                        $('#lists-msg').prepend(
                                "<li class='items assign'>"+
                                "<div class='first' onclick='getFather("+ value.id +")'>"+
                                "<div class='userPic'><img src="+ value.headimgurl +" alt=''></div>" +
                                "<div class='content' style='text-align: left;'>" +
                                "<div class='userName'><a href='jacascript:;'>"+ value.username +"</a>:</div>" +
                                "<div class='msgInfo'>"+ value.content +"</div>" +
                                "<div class='times'><span>"+ value.create_time +"</span></div>" +
                                "</div>" +
                                "<div class='finger'>" +
                                "<a href='javascript:finget("+ value.id +",'1')'>" +
                                "<img src='/Public/images/finger-2.jpg' alt=''>" +
                                "&nbsp;<span id='finger-"+ value.id +"'>"+ value.finger_count +"</span>" +
                                "</a>" +
                                "</div>"+
                                "</div>" +
                                "<div style='clear: both;'></div>" +
                                "<div class='replys'></div>"+
                                "</li>"
                        );
                    })

                }
            }
        })
    })

    $('.items').click(function () {
        $(this).addClass('assign');
        $(this).siblings('.items').removeClass('assign')
    });

    function getFather(id) {
        $('.kap-background').css('display', 'block');
        $('.kap-comment').css('display', 'block');
        $('.btn-close').click(function () {
            $('.kap-background').css('display', 'none');
            $('.kap-comment').css('display', 'none');
            $("#product_contact_meto").val('');
        });
        $('#addComment').attr('attr_father_id',id);
    }

    function getFatherId(id,type_id) {
        $('.kap-background').css('display', 'block');
        $('.kap-comment').css('display', 'block');
        $('.btn-close').click(function () {
            $('.kap-background').css('display', 'none');
            $('.kap-comment').css('display', 'none');
            $("#product_contact_meto").val('');
        });
        $('#addComment').attr('attr_father_id',id);
        $('#addComment').attr('attr_type_id',type_id);

    }

    $('#addComment').click(function () {
        if ($('#product_contact_meto').val() == '' && $('#product_contact_meto').val() > 0) {
            alert('内容不能为空');
            return;
        }
        if ($('#product_contact_meto').val().length <= 3) {
            alert('请填写不少于3个字');
            return;
        }
        if($('#addComment').attr('attr_father_id') != '' && $('#addComment').attr('attr_type_id') == ''){
            var url = "/index.php/Article/childComment";
            var article_id = $("#article_id").val();
            var father_id = $('#addComment').attr('attr_father_id');
            var type_id = $('#addComment').attr('attr_father_id');
            var data = {
                article_id : article_id,
                father_id : father_id,
                type_id : type_id,
                content : $('#product_contact_meto').val()
            };
            $('.kap-background').css('display', 'none');
            $('.kap-comment').css('display', 'none');
            $("#product_contact_meto").val('');
            $.post(url, data, function (res) {
                if (res.status == 0) {
                    alert(res.msg);
                } else if (res.status == 1) {
                    alert(res.msg);
                    $('.assign .replys').append(
                            "<div class='reply' onclick='getFatherId("+ res.data['id'] +","+ res.data['type_id'] +")'>" +
                            "<div class='image'><img src='" + res.data['headImg'] + "' alt=''>回复：<img src='" + res.data['headImgs'] + "' alt=''></div><span class='text'>" + res.data['content'] + "</span>" +
                            "</div>"
                    );
                }
            }, 'json');
        }else if($('#addComment').attr('attr_father_id') != '' && $('#addComment').attr('attr_type_id') != '') {
            var url = "/index.php/Article/childComment";
            var article_id = $("#article_id").val();
            var father_id = $('#addComment').attr('attr_father_id');
            var type_id = $('#addComment').attr('attr_type_id');
            var data = {};
            data.article_id= article_id;
            data.father_id= father_id;
            data.type_id = type_id;
            data.content= $('#product_contact_meto').val();
            $('.kap-background').css('display', 'none');
            $('.kap-comment').css('display', 'none');
            $("#product_contact_meto").val('');
            $.post(url, data, function (res) {
                if (res.status == 0) {
                    alert(res.msg);
                } else if (res.status == 1) {
                    alert(res.msg);
                    $('.assign .replys').append(
                            "<div class='reply' onclick='getFatherId("+ res.data['id'] +","+ res.data['type_id'] +")'>" +
                            "<div class='image'><img src='" + res.data['headImg'] + "' alt=''>回复：<img src='" + res.data['headImgs'] + "' alt=''></div><span class='text'>" + res.data['content'] + "</span>" +
                            "</div>"
                    );
                }
            }, 'json');
        }
    });

    function finger(id, status) {
        $.ajax({
            url: "/index.php/Article/finger?id=" + id + "&status=" + status,
            dataType: 'json',
            success: function (res) {
                if (res.status == 1) {
                    $("#z-" + id + "").attr('src', '/Public/images/finger-1.jpg');
                    $("#finger-" + id + "").html(res.finger);
                } else if (res.status == 2) {
                    $("#z-" + id + "").attr('src', '/Public/images/finger-2.jpg');
                    $("#finger-" + id + "").html(res.finger);
                }
            }
        })
    }
    $('#test1').on('click', function () {

        layer.open({
            type: 1
            ,
            offset: 't' //具体配置参考：offset参数项
            ,
            content: '\<\div style="padding:20px;">一、本文收录的部分文字图片来自于互联网，其版权均归原作者所有，本平台只提供参考并不构成任何投资及应用建议。<br\/> 二、如果本平台无意中侵犯了您的版权，敬请告之，核实后，将根据著作权人的要求，立即更正或者删除有关内容,谢谢！联系方式是，邮箱：1569357635@qq.com 。<br\/> 三、本平台通过互联网转载的资源，或是站内作者自己提供的资源，版权均归原作者所有，未经原版权作者许可，任何人不得擅作他用！您可以复制、转载和传播本站的任何信息，但务必在转载时注明来源，尊重其知识产权，并自负版权等法律责任。 \<\/div>'
            ,
            btn: ['我知道了']
            ,
            btnAlign: 'c' //按钮居中
            ,
            shade: 1 //不显示遮罩
            ,
            shadeClose: false
            ,
            yes: function () {
                layer.closeAll();
            }

        });
    });




     $(function () {
        $('img').each(function () {
            var src = $(this).attr('src');
            src = src.replace("ooyyee-crm-static.qiniudn.com", "7b1f8s.com1.z0.glb.clouddn.com");
            $(this).attr('src', src);
        });
    });  
    //收藏
    function collect(id, type) {
        $.ajax({
            url: "/index.php/Article/collect?id=" + id + "&type=" + type,
            dataType: 'json',
            success: function (res) {
                if (res.status == 1) {
                    $('.follow').removeClass().addClass('isCollect');
                } else if (res.status == 2) {
                    $('.isCollect').removeClass().addClass('follow');
                }
            }
        })
    }