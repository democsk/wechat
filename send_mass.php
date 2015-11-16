<?php
 //获取access_token
 function getToken(){
    $appid="wx81f39b0725902fe9";
    $appidsecret="26036c3e2ac9c88078e3e6cfe5f71ff6";
    $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appidsecret;
    
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    $output=curl_exec($ch);
	//echo $output;
    curl_close($ch);
    $jsoninfo=json_decode($output,true);
    $access_token= $jsoninfo["access_token"];
	//echo $access_token; 
	return $access_token;
}
 //发送函数
 function mass_send_openid(){
    echo "<br>token为:".getToken()."<br>";
	$token = getToken();
    $url = "https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=".$token;
    /*$data='{
    "trouser":[
    "oXC-3wdtK91lNVr_9UE96i0u8OTU",
    "oXC-3wdbfQ_PtdzNjY8W6OXR1eNc"
    ],
    "msgtype":"text",
    "text":{"content":"哈哈，我在测试"}
    }';*/
	$array = array("touser"=>array('oXC-3wdtK91lNVr_9UE96i0u8OTU',"oXC-3wdbfQ_PtdzNjY8W6OXR1eNc"), "msgtype"=>"text",'text'=>array( "content"=>"哈哈，我在测试"));
	$data = json_encode($array,JSON_UNESCAPED_UNICODE);
    $curl = curl_init(); // 启动一个CURL会话
	curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
	curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
	curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
	curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
	curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
	curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
	$tmpInfo = curl_exec($curl); // 执行操作
	echo "<br>".$tmpInfo;
	if (curl_errno($curl)) {
	   echo 'Errno'.curl_error($curl);//捕抓异常
	}
	curl_close($curl); // 关闭CURL会话
}
//执行
mass_send_openid();
?>
