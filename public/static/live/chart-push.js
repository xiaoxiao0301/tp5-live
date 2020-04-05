$(function () {
    $("#discuss-box").keydown(function (event) {
        if (event.keyCode == 13) {
            // 回车事件
            let content = $(this).val();
            let url = "/chart";
            let datas = {
                'content': content,
                'game_id': 1
            };
            $.ajax({
                url: url,
                type: "post",
                dataType: "json",
                data: datas,
                success: function (res) {
                    $(this).val("");
                },
                error: function (res) {
                    console.log(res);
                }
            });

        }
    });
});
