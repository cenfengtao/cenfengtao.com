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
        $('img').each(function () {
            var src = $(this).attr('src');
            src = src.replace("ooyyee-crm-static.qiniudn.com", "7b1f8s.com1.z0.glb.clouddn.com");
            $(this).attr('src', src);
        });
    });


     