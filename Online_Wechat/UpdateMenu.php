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
                 "type":"view",
                 "name":"走进电气",
                 "url":"https://coh5.cn/p/e09fa798.html"
              },
              {
                 "type":"view",
                 "name":"院情速递",
                 "url":"http://ea.hfut.edu.cn/ea/index.php/cn/"
              },
              {
                 "type":"view",
                 "name":"青年名义",
                 "url":"http://mp.weixin.qq.com/mp/homepage?__biz=MzI3NDY0MTgwNA==&amp;hid=1&;sn=6b7e811e13af636d5d50a3b84969c829#wechat_redirect"
              },
              {
                 "type":"view",
                 "name":"团学@声",
                 "url":"http://mp.weixin.qq.com/mp/homepage?__biz=MzI3NDY0MTgwNA==&amp;hid=3&;sn=1045297fba35adec44a211cebbffc8e7&scene=18#wechat_redirect
  "
              },
              {
                  "type":"view",
                  "name":"心语❤愿",
                  "url":"https://mp.weixin.qq.com/s/F_80BEyP9sTYrV2FonKIow"
              }]
       
         },
         {
             "name":"科创驿站",
             "sub_button":[
              {
                 "type":"view",
                 "name":"科创前沿",
                 "url":"http://mp.weixin.qq.com/s/g8GQFNs0ekjQyxxbcotKOQ"
              },
              {
                 "type":"view",
                 "name":"科创赛事",
                 "url":"http://mp.weixin.qq.com/s?__biz=MzI3NDY0MTgwNA==&mid=2247483811&idx=1&sn=fe67c07c1ca0830480d7a50ce441ced3&amp;chksm=eb11a740dc662e56501eac0c13c7c3269fb18f3907ad1c055c65732a3fc1285cf1cf6d9c048a&mpshare=1&scene=23&srcid=09272qQLhXKyy6IIExIJHWUH#rd"
              },
              {
                  "type":"view",
                  "name":"科创访谈",
                  "url":"http://mp.weixin.qq.com/s/g8GQFNs0ekjQyxxbcotKOQ"
              },
              {
                 "type":"view",
                 "name":"科创作品",
                 "url":"https://coh5.cn/p/73ae89e7.html?cobrarepost=1&amp;cobrarepostfrom=380fd9ea779e4089367a27c7ec44cbb9
  "
              },
              {
                 "type":"view",
                 "name":"科创报名",
                 "url":"http://mp.weixin.qq.com/s/g8GQFNs0ekjQyxxbcotKOQ"
              }]
         
         },
         {
              "name":"AE精品",
             "sub_button":[
              {
                 "type":"view",
                 "name":"自律公告",
                 "url":"http://www.xmypage.com/model2_47072.html"
              },
              {
                 "type":"view",
                 "name":"小黑板",
                 "url":"https://shequ.yunzhijia.com/thirdapp/forum/network/5928ffffe4b042d068c939bf"
              },
              {
                 "type":"view",
                 "name":"Q&A",
                 "url":"http://mp.weixin.qq.com/mp/homepage?__biz=MzI3NDY0MTgwNA==&amp;hid=2&;sn=e3191198bcce33d94e635e0589b3ee44#wechat_redirect"
              },
              {
                 "type":"view",
                 "name":"服务资讯",
                 "url":"http://hfutae1946.cn"
              },
              {
                  "type":"click",
                  "name":"联系我们",
                  "key":"contact"
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
