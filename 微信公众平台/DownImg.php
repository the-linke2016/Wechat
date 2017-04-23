<?php
//主程序
header("content-type:text/html;charset=utf-8");

$appid = "wxbdc1a94da5d70e0c";
$appsecret = "47ec1923089c55e9c897e0847c62efcd";
$access_token = get_access_token($appid, $appsecret);
print_r($access_token);		// 输出access_token的值
$media_id = '';
$dirname = './down/';		// 保存位置
$filename = time().rand(100, 999);		// 文件名

$media = down_media($access_token, $media_id);		// 下载文件
echo "<pre>";
var_dump($media);
echo "</pre>";
save_media($dirname, $filename, $media);
echo "<br />图片下载成功！";

// 获取access_token
function get_access_token($appid, $appsecret)
{
	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
			// 微信获取access_token的接口
	$ch = curl_init();		// 初始化url
	curl_setopt($ch, CURLOPT_URL, $url);		// 设置URL
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);		// 设置参数
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$output = curl_exec($ch);		// 执行并返回结果
	if (curl_errno($ch)) {		// 检查curl执行是否成功
		echo 'Errno' . curl_error($ch);
	}
	curl_close($ch);		// 关闭curl
	$jsoninfo = json_decode($output, true);		// 解析	JSON数据
	return $jsoninfo["access_token"];		// 返回access_token
}

// 下载文件
function down_media($access_token, $media_id)
{
	$url = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=$access_token &media_id=$media_id";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_NOBODY, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$package = curl_exec($ch);
	$httpinfo = curl_getinfo($ch);
	if (curl_errno($ch)) {		// // 检查curl执行是否成功
		echo 'Errno' . curl_error($ch);
	}
	
	curl_close($ch);
	return array_merge(array('header' => $httpinfo), array('body' => $package));
}


// 保存多媒体文件
function save_media($dirname, $filename, $media)
{
	switch ($media["header"]["content_type"])		// 从头信息中判断图片类型
	{
		case "image/jpeg":
		$fileExt = "jpg";
		break;
		case "image/tiff";
		$fileExt = "tif";
		break;
		case "image/png":
		$fileExt = 'png';
		break;
	}
	$filename = $filename . ".{$fileExt}";		// 文件名与扩展名组合
	if (!file_exists($dirname)) {		// 若目录不存在
		mkdir($dirname, 0777,true);		// 创建保存多媒体文件的目录
	}
	file_put_contents($dirname, $filename, $media['body']);		// 保存文件到指定位置
}


?>