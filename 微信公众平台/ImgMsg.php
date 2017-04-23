<?php
$wechatObj = new wechat_php();
$wechatObj->GetImageMsg();

class wechat_php
{
	public function GetImageMsg()
	{
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		
		if (!empty($postStr))
		{
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$fromUsername = $postObj->FromUserName;
			$toUsername = $postObj->ToUserName;
			$msgType = $postObj->Msgtype;
			$picUrl = trim($postObj->PicUrl);
			$mediaId = trim($postObj->MediaId);
			$time = time();
			
			$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<Createtime>%s</Createtime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Content><![CDATA[%s]]>></Content>
						<FuncFlag>0</FuncFlag>
						</xml>";
						
			if (strtolower($msgType) != "image")
			{
				$msgType = "text";
				$contentStr = "我只接收图片信息！";
			}else{
				if (!empty( $picUrl ))
				{
					$msgType = "text";
					$contentStr = "图片链接：" . $picUrl . "\n";
					$contentStr = $contentStr . "媒体id：" . $mediaId;
				}else{
					$contentStr = "请发送图片...";
				}
			}
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			echo $resultStr;
		}else{
			echo "";
			exit;
		}
	}
}
?>