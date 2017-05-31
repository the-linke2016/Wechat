<?php
$wechatObj = new wechat_php();
$wechatObj->GetMsg();
class wechat_php
{
	public function GetMsg()
	{
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		
		if (!empty($postStr))
		{
			libxml_disable_entity_loader(true);		//防止文件泄漏  
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);  
            $fromUsername = $postObj->FromUserName;  
            $toUsername = $postObj->ToUserName;  
            $msgType = $postObj->MsgType;  
            $mediaId = $postObj->MediaId;  
            $picUrl = trim($postObj->PicUrl);
            $keyword = trim($postObj->Content);
            $location_X = trim($postObj->Location_X);
			$location_Y = trim($postObj->Location_Y);
			$scale = trim($postObj->Scale);		//地图缩放大小
			$label = trim($postObj->Label);		//位置标签
			$msgId = trim($postObj->MsgId);  
            $time = time();
			
              
            if ($msgType == "event")
			{
				
				if($postObj->Event == "subscribe")
				{
					$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[text]]></MsgType>
							<Content><![CDATA[%s]]></Content>
					</xml>";
					
					$time = time();
					$contentStr = "欢迎关注合工大电气学院！";
					$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $contentStr);						
				}
				
				if($postObj->Event == "CLICK" && $postObj->EventKey == "自律公告")
				{
					$itemTpl = "<xml>  
			                <ToUserName><![CDATA[%s]]></ToUserName>  
			                <FromUserName><![CDATA[%s]]></FromUserName>  
			                <CreateTime>%s</CreateTime>  
			                <MsgType><![CDATA[image]]></MsgType>  
			                <Image>
			                	<MediaId><![CDATA[%s]]></MediaId>
			                </Image>		                  
			                </xml>";
			                
			    
			    $mediaId = "EZWxrJGdtAN_c6qb9HhXutFvFsj_p8RS3xzjzDg8iNk";	
					$time = time();
					$resultStr = sprintf($itemTpl, $fromUsername, $toUsername, $time, $mediaId); 
				}
				
			
			
			echo $resultStr;
			}
  
		}else{
			echo "";
			exit;
		}
	}
}
?>