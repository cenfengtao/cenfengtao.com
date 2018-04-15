function searchWord(word) {
        var type = $("select[name='searchType'] option:selected").val();
        if (!word) {
            var inputWord = $("input[name='searchWord']").val();
            if (!inputWord) {
                return alert("请输入搜索内容");
            }
        } else {
            var inputWord = word;
        }
        var url = "/index.php/Index/searchResult";
        window.location.href = url + "?type=" + type + "&word=" + inputWord;
    }
    function clearHistory() {
        var url = "/index.php/Index/clearHistory";
        $.get(url,function (result) {
            if(result.status == 1){
                alert(result.msg);
                return $("#searchHistory").hide();
            } else {
                alert(result.msg);
            }
        }, 'json')
    }
    $("#sel_type_switch").change(function () {
        var type = $(this).children('option:selected').val();
        if (type == 1) {
            $('.kap-input-value').text('文章');
        }
        if (type == 2) {
            $('.kap-input-value').text('课程');
        }
        if(type == 3){
            $('.kap-input-value').text('商品');
        }
        if(type == 4){
            $('.kap-input-value').text('机构');
        }
    });
    $(function () {
        var type = $("#sel_type_switch").val();
        if (type == 1) {
            $('.kap-input-value').text('文章');
        }
        if (type == 2) {
            $('.kap-input-value').text('课程');
        }
        if(type == 3){
            $('.kap-input-value').text('商品');
        }
        if(type == 4){
            $('.kap-input-value').text('机构');
        }
    })