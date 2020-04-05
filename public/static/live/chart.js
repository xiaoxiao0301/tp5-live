let chartURL = "ws://127.0.0.1:8001?type=chart";
// 创建对象
let chart = new WebSocket(chartURL);
// 实例对象的onopen属性,连接成功的回调函数 Event
chart.onopen = function (ev) {
    console.log("connect-charts-success");
    // let urls = '{"url": "Index/socket_message/recv"}';
    // let data = '{"url": "Index/socket_message/recv", "content": "Hello,Server"}';
    // chart.send(urls);
};
// 实例对象的onmessage属性, 接受服务器端数据回调 MessageEvent
chart.onmessage = function (ev) {
    pushs(ev.data);
    console.log("chart-server-charts-return-data: "+ev.data);
};

// error
chart.onerror = function(ev, e) {
    console.log("error: ")
};

// 实例化onclose closeEvent
chart.onclose = function (ev) {
    console.log("close");
};

function pushs(data) {

}