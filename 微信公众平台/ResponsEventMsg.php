<?php
$wechatObj = new wechat_php();
$wechatObj->ResponsEventMsg();

class wechat_php
{
	public function ResponsEventMsg()
	{
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		
		if (!empty($postStr))
		{
			$postObj = simplexml_load_string($postStr, 'SinpleXMLElement', LIBXML_NOCDATA);
			$fromUsername = $postObj->FromUserName;
			$toUsername = $postObj->ToUserName;
			$msgType = $postObj->MsgType;
			
			$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Content><![CDATA[%s]]></Content>
						</xml>";
						
			if ($msgType == "event")
			{
				if($postObj->Event == "subscribe")
				{
					$contentStr = "欢迎关注木木口丁！回复：\n";
					$contentStr = $contentStr . "1.文本消息；\n2.图片消息；\n3.地理位置消息。\n进行功能测试。";
				}
			}
			$msgType = "text";
			$time = time();
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			echo $resultStr;
		}else {
			echo "";
			exit;
		}
	}
}
?>