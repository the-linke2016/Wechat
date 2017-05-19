<?php

$appid = "wxbdd89c8d510855d1";
$appsecret = "c6779c66082d8b8f0feefc66a2cc614d";
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";

$output = https_request($url);
$jsoninfo = json_decode($output, true);

$access_token = $jsoninfo["access_token"];


$jsonmenu = '{
      "button":[
      {
            "name":"电气之音",
           "sub_button":[
            {
               "type":"click",
               "name":"走进电气",
               "key":"走进电气"
            },
            {
               "type":"view",
               "name":"院情速递",
               "url":"http://ea.hfut.edu.cn/ea/index.php/cn/"
            },
            {
               "type":"click",
               "name":"青年名义",
               "key":"青年名义"
            },
            {
               "type":"click",
               "name":"团学@声",
               "key":"团学@声"
            },
            {
                "type":"click",
                "name":"心语❤愿",
                "key":"心语❤愿"
            }]
      

       },
       {
           "name":"科创E站",
           "sub_button":[
            {
               "type":"click",
               "name":"科创前沿",
               "key":"科创前沿"
            },
            {
               "type":"click",
               "name":"科创赛事",
               "key":"科创赛事"
            },
            {
                "type":"click",
                "name":"科创访谈",
                "key":"科创访谈"
            },
            {
               "type":"click",
               "name":"科创作品",
               "key":"科创作品"
            },
            {
               "type":"click",
               "name":"科创报名",
               "key":"科创报名"
            }]
       

       },
       {
            "name":"AE精品",
           "sub_button":[
            {
               "type":"click",
               "name":"自律公告",
               "key":"自律公告"
            },
            {
               "type":"click",
               "name":"小黑板",
               "key":"小黑板"
            },
            {
               "type":"click",
               "name":"电客直播",
               "key":"电客直播"
            },
            {
               "type":"view",
               "name":"服务资讯",
               "url":"http://118.89.64.92/ServiceInfo/index.html"
            },
            {
                "type":"click",
                "name":"往期热追",
                "key":"往期热追"
            }]
      

       }]
 }';


$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
$result = https_request($url, $jsonmenu);
var_dump($result);

function https_request($url,$data = null){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}

?>