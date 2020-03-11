function obj2str(data) {

    data.t = new Date().getTime(); //给URL地址后面添加一个防IE不刷新地址的时间戳；

    var res=[];

    for(key in data){
        /*
        encodeURIComponent() 函数可把字符串作为 URI 组件进行编码。
        把带有中文的参数转换成：%E6%9D%A8%E8%BF%87 字符串格式；
        该方法不会对 ASCII 字母和数字进行编码， 也不会对这些 ASCII 标点符号进行编码： - _.!~ * ' ( ) 。
        其他字符（ 比如：;/?:@&=+$,# 这些用于分隔 URI 组件的标点符号），都是由一个或多个十六进制的转义序列替换的。
        */
        res.push(encodeURIComponent(key) + "=" + encodeURIComponent(data[key]));
    }
    return res.join("&"); //将遍历出来的数组拼接转换成name=foo&password=123456这种格式；
}

function ajax(option) {

    var str = obj2str(option.data);
    console.log(str);

    //
    //1.创建一个异步对象
    /*
    Hint:为了应对所有的现代浏览器，包括 IE5 和 IE6，请检查浏览器是否支持 XMLHttpRequest 对象。如果支持，则创建 XMLHttpRequest 对象。如果不支持，则创建
    ActiveXObject
    */
    var xhr;
    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        xhr = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    //2.设置请求方式和请求地址
    /*
    规定请求的类型、 URL 以及是否异步处理请求。
    method： 请求的类型； GET 或 POST
    url： 文件在服务器上的位置
    async： true（ 异步） 或 false（ 同步）
    */

    if (option.type.toLowerCase() == "get") {

        xhr.open(option.type, option.url + "?" + str, true);
        /*
        在POST请求时要在open和send 方法之间添加setRequestHeader(header: 规定头的名称, value: 规定头的值) 方法
        */
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //3.发送请求
        xhr.send();

    }else{

        xhr.open(option.type, option.url, true);
        /*
        在POST请求时要在open和send 方法之间添加setRequestHeader(header: 规定头的名称, value: 规定头的值) 方法
        */
        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        //3.发送请求
        xhr.send(str);

    }
    //4.监听状态变化
    xhr.onreadystatechange = function (ev2) {
        /*
        onreadystatechange 存储函数（ 或函数名）， 每当 readyState 属性改变时， 就会调用该函数。
        **readyState**
        存有 XMLHttpRequest 的状态。 从 0 到 4 发生变化。
        0: 请求未初始化
        1: 服务器连接已建立
        2: 请求已接收
        3: 请求处理中
        4: 请求已完成， 且响应已就绪

        **status**
        200: "OK"
        404: 未找到页面
        */
        //4.1判断函数返回的状态
        if (xhr.readyState == 4) {
            clearInterval(timer)
            //console.log("接受到来自服务器端发回的数据");

            if (xhr.status >= 200 && xhr.status < 300 || xhr.status == 304) {
                /*
                responseText 属性
                如果来自服务器的响应并非 XML， 请使用 responseText 属性。
                responseText 属性返回字符串形式的响应， 因此您可以这样使用：
                */
                //成功获取服务端数据时的回调函数
                option.success(xhr);

            } else {

                //获取服务端数据失败时的回调函数

                option.error(xhr);
            }


        }


    };
    //设置超时停止请求的定时器
    if (option.timeout) {
        var  timer = setInterval(function(){

            console.log("超时请求中断");

            xhr.abort();

            clearInterval(timer);

        }, option.timeout);


    }



}