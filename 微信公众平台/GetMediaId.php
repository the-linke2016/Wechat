<?php

$appid = "wxbdd89c8d510855d1";
$appsecret = "c6779c66082d8b8f0feefc66a2cc614d";
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
$output = https_request($url);
$jsoninfo = json_decode($output, true);
$access_token = $jsoninfo["access_token"];



$url = "https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token=";
$type = "image";
$post = json_encode(array(
							'type' => $type,
							'offset' => 0,
							'count' => 3,
							));
$ch = curl_init();
curl_setopt($ch, CURLOPT_REFERER, "https://mp.weixin.qq.com/");
curl_setopt($ch, CURLOPT_URL, $url . $access_token);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_exec($ch);
curl_close($ch);

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