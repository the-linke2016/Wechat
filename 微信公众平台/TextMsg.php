<?php
$wechatObj = new wechat_php();
$wechatObj->GetTextMsg();

class wechat_php
{
	public function GetTextMsg()
	{
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		
		if (!empty($postStr))
		{
			$postStr = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$fromUesrname = $postStr->FromUserName;
			$toUsername = $postStr->ToUserName;
			$msgType = $postStr->MsgType;
			$keyword = trim($postStr->Content);
			$time = time();
			
			$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Content><![CDATA[%s]]></Content>
						<FuncFlag>0</FuncFlag>
						</xml>";
			if (strtolower($msgType) != "text")
			{
				$msgType = "text";
				$contentStr = "我只接收文本信息！";
			}else{
				if(!empty( $keyword ))
				{
					$msgType = "text";
					$contentStr = "消息内容：" . $keyword . "\n";
					$contentStr = $contentStr . "ToUserName:" . $toUsername . "\n";
					$contentStr = $contentStr . "FromUserName:" . $fromUesrname;
				}else{
					$contentStr = "请输入关键字...";
				}
			}
			$resultStr = sprintf($textTpl, $fromUesrname, $toUsername, $time, $msgType, $contentStr);
			ob_clean();
			echo $resultStr;
		}else{
			echo "";
			exit;
		}
	}
}
?>