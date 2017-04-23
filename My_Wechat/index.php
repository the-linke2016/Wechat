<?php
$wechatObj = new wechat_php();
$wechatObj->GetMsg();
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
			
			if (strtolower($msgType) == "text")
			{
				$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
				if(!empty( $keyword ))
				{
					$msgType = "text";
					$contentStr = "您发给我的消息是：" . $keyword . "\n";
					$contentStr = $contentStr . "本公众号ID：" . $toUsername . "\n";
					$contentStr = $contentStr . "您的微信ID：" . $fromUsername;
				}else{
					$contentStr = "请输入关键字...";
				}
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
				ob_clean();
				echo $resultStr;
			}
	
                  
                  
            if(strtolower($msgType) == "image")
            {  
                $itemTpl1 = "<xml>  
			                <ToUserName><![CDATA[%s]]></ToUserName>  
			                <FromUserName><![CDATA[%s]]></FromUserName>  
			                <CreateTime>%s</CreateTime>  
			                <MsgType><![CDATA[text]]></MsgType>  
			                <Content><![CDATA[%s]]>></Content>
							<FuncFlag>0</FuncFlag>			                  
			                </xml>";
			                
			    $itemTpl2 = "<xml>  
			                <ToUserName><![CDATA[%s]]></ToUserName>  
			                <FromUserName><![CDATA[%s]]></FromUserName>  
			                <CreateTime>%s</CreateTime>  
			                <MsgType><![CDATA[image]]></MsgType>  
			                <Image>
			                	<MediaId><![CDATA[%s]]></MediaId>
			                </Image>		                  
			                </xml>";
			    if (!empty( $picUrl ))
  				{
					$contentStr = "图片链接：" . $picUrl . "\n";
					$contentStr = $contentStr . "媒体id：" . $mediaId;
				}else{
					$contentStr = "请发送图片...";
				} 
                
                $result1 = sprintf($itemTpl1, $fromUsername, $toUsername, $time, $contentStr);
                $result2 = sprintf($itemTpl2, $fromUsername, $toUsername, $time, $mediaId);   
                echo  $result2 . $result1; 
            }
            
            
            if(strtolower($msgType) == "location")
            {
            	$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
						
				$msgType = "text";
				$contentStr = "纬度: " . $location_X . "\n";
				$contentStr = $contentStr . "经度: " . $location_Y . "\n";
				$contentStr = $contentStr . "地图缩放比例: " . $scale . "\n";
				$contentStr = $contentStr . "具体位置: " . $label;
				
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
				echo $resultStr;
            }
            
            
            if ($msgType == "event")
			{
				$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							</xml>";
				if($postObj->Event == "subscribe")
				{
					$contentStr = "欢迎关注木木口丁！\n我只是个微信公众平台开发新手。\n欢迎关注我的简书：木木口丁 (分享自：@简书)\nhttp://www.jianshu.com/u/cb1345fc750f\n回复：\n";
					$contentStr = $contentStr . "1.文本消息；\n2.图片消息；\n3.地理位置消息。\n即可进行功能测试（不是回数字哦！）。";
				}
				if($postObj->Event == "CLICK" && $postObj->EventKey == "走进电气")
				{
					$contentStr = "走进电气";
				}
				if($postObj->Event == "CLICK" && $postObj->EventKey == "青年名义")
				{
					$contentStr = "青年名义";
				}
				if($postObj->Event == "CLICK" && $postObj->EventKey == "团学@声")
				{
					$contentStr = "团学@声";
				}
				if($postObj->Event == "CLICK" && $postObj->EventKey == "心语❤愿")
				{
					$contentStr = "心语❤愿";
				}
				if($postObj->Event == "CLICK" && $postObj->EventKey == "科创前沿")
				{
					$contentStr = "科创前沿";
				}
				if($postObj->Event == "CLICK" && $postObj->EventKey == "科创赛事")
				{
					$contentStr = "科创赛事";
				}
				if($postObj->Event == "CLICK" && $postObj->EventKey == "科创访谈")
				{
					$contentStr = "科创访谈";
				}
				if($postObj->Event == "CLICK" && $postObj->EventKey == "科创作品")
				{
					$contentStr = "科创作品";
				}
				if($postObj->Event == "CLICK" && $postObj->EventKey == "自律公告")
				{
					$contentStr = "自律公告";
				}
				if($postObj->Event == "CLICK" && $postObj->EventKey == "小黑板")
				{
					$contentStr = "小黑板";
				}
				if($postObj->Event == "CLICK" && $postObj->EventKey == "电客直播")
				{
					$contentStr = "电客直播";
				}
				if($postObj->Event == "CLICK" && $postObj->EventKey == "服务资讯")
				{
					$contentStr = "服务资讯";
				}
				if($postObj->Event == "CLICK" && $postObj->EventKey == "往期热追")
				{
					$contentStr = "往期热追";
				}
				
			
			$msgType = "text";
			$time = time();
			$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
			echo $resultStr;
			}
  
		}else{
			echo "";
			exit;
		}
	}
}





?>