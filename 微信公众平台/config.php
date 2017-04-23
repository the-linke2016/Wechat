<?php
define("TOKEN","weixin");		// 定义token
$wechatObj = new wechat_php();	// 生成类实例
$wechatObj->valid();		// 调用类的检验方法

// 定义一个操作微信公众帐号的类
class wechat_php
{
	// 定义公用校验方法
	public function valid()
	{
		$echoStr = $_GET["echostr"];	// 获取GET请求的参数echostr
		
		// 校验signature
		if($this->checkSignature ()) {	// 调用校验方法
			echo $echoStr;
			exit;
		}
	}
	
	// 校验方法
	private function checkSignature ()
	{
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);	// 将三个参数保存到数组中
		sort($tmpArr);		// 对数组中三个数据进行排序
		$tmpStr = implode( $tmpArr );		// 将数组中三个数据组成一个字符串
		$tmpStr = sha1( $tmpStr );		// 对字符串进行SHA-1散列运算
		
		if( $tmpStr == $signature ) {		// 计算结果与$signature相等
			return true;		// 通过验证
		} else {
			return false;		// 未通过验证
		}
	}
}
?>