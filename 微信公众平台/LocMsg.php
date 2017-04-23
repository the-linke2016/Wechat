<?php
$wechatObj = new wechat_php();
$wechatObj->GetlocationMsg();

class wechat_php
{
	public function GetlocationMsg()
	{
		$postStr = $GLOBAL["HTTP_RAW_POST_DATA"];
		
		if (!empty($postStr))
		{
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$fromUsername = $postObj->FromUserName;
			$toUsername = $postObj->ToUserName;
			$msgType = $postObj->MsgType;
			$location_X = trim($postObj->Location_X);
			$location_Y = trim($postObj->Location_Y);
			$scale = trim($postObj->Scale);		//地图缩放大小
			$label = trim($postObj->Label);
			$msgId = trim($postObj->MsgId);
			$time = time();
			
			$textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Content><![CDATA[%s]]></Content>
						<FuncFlag>0</FuncFlag>
						</xml>";
						
			if (strtolower($msgType) != "location")
			{
				$msgType = "text";
				$contentStr = "我只接收地理位置信息！";
			}else {
				$msgType = "text";
				$contentStr = "Location_X: " . $location_X . "\n";
				$contentStr = $contentStr . "Location_Y: " . $location_Y . "\n";
				$contentStr = $contentStr . "Scale: " . $scale . "\n";
				$contentStr = $contentStr . "Label: " . $label;
			}
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			echo $resultStr;			
		}else {
			echo "";
			exit;
		}
	}
}
?>