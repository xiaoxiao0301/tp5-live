let wsURL = "ws://127.0.0.1:8001?type=live";
// 创建对象
let ws = new WebSocket(wsURL);
// 实例对象的onopen属性,连接成功的回调函数 Event
ws.onopen = function (ev) {
    console.log("connect-swoole-success");
    // let urls = '{"url": "Index/socket_message/recv"}';
    // let data = '{"url": "Index/socket_message/recv", "content": "Hello,Server"}';
    // ws.send(urls);
};
// 实例对象的onmessage属性, 接受服务器端数据回调 MessageEvent
ws.onmessage = function (ev) {
    pushs(ev.data);
    console.log("ws-server-return-data: "+ev.data);
};

// error
ws.onerror = function(ev, e) {
    console.log("error: ")
};

// 实例化onclose closeEvent
ws.onclose = function (ev) {
    console.log("close");
};

function pushs(data) {
    data = JSON.parse(data);
    html = '<div class="frame">' +
        '<h3 class="frame-header">' +
        '<i class="icon iconfont icon-shijian"></i>第一节 03：30' +
        '</h3>' +
        '<div class="frame-item">' +
        '<span class="frame-dot"></span>' +
        '<div class="frame-item-author">' +
        '<img src="static/live/imgs/team1.png" width="20px" height="20px" /> 马刺' +
        '</div>' +
        '<p>test html</p>' +
        '</div>' +
        '</div>';

    $("#match-result").prepend(html);
}