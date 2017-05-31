<?php
$wechatObj = new wechat_php();
$wechatObj->ResponseNewsMsg();

class wechat_php
{
	public function ResponseNewsMsg ()
	{
		$postObj = $GLOBALS["HTTP_RAW_POST_DATA"];
		
		if (!empty($postObj))
		{
			$postObj = simplexml_load_string($postObj, 'SimpleXMLElement', LIBXML_NOCDATA);
			$fromUsername = $postObj->FromUserName;
			$toUsername = $postObj->ToUserName;
			$msgType = $postObj->MsgType;
			$keyword = trim($postObj->Content);
			$time = time();
			
			if (!empty($keyword))
			{
				$newsTpl = "<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></FromUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[news]]></MsgType>
								<ArticleCount>2</ArticleCount>
								<Articles>
								<item>
								<Title><![CDATA[%s]]></Title> 
								<Description><![CDATA[%s]]></Description>
								<PicUrl><![CDATA[%s]]></PicUrl>
								<Url><![CDATA[%s]]></Url>
								</item>
								<item>
								<Title><![CDATA[%s]]></Title>
								<Description><![CDATA[%s]]></Description>
								<PicUrl><![CDATA[%s]]></PicUrl>
								<Url><![CDATA[%s]]></Url>
								</item>
								</Articles>
							</xml>";
				$title1 = "霍金：强烈建议人类即刻搜寻代替行星";
				$description1 = "霍金：强烈建议人类即刻搜寻代替行星。";
				$picUrl1 = "https://ss1.baidu.com/6ONXsjip0QIZ8tyhnq/it/u=1839777718,1543369449&fm=80&w=179&h=119&img.JPEG";
				$url1 = "http://tech.hexun.com/2017-05-21/189277578.html";
				
				$title2 = "比特币价格首次突破2000美元大关";
				$description2 = "比特币价格首次突破2000美元大关。";
				$picUrl2 = "https://ss0.baidu.com/6ONWsjip0QIZ8tyhnq/it/u=3478597212,2596646673&fm=80&w=179&h=119&img.JPEG";
				$url2 = "http://it.sohu.com/20170521/n493850471.shtml";		
				
				$resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $title1, $description1, $picUrl1, $url1, $title2, $description2, $picUrl2, $url2);	
			} else {
				$textTpl = "<xml>
								<ToUserName><![CDATA[%s]]></ToUserName>
								<FromUserName><![CDATA[%s]]></ToUserName>
								<CreateTime>%s</CreateTime>
								<MsgType><![CDATA[text]]></CreateTime>
								<Content><![CDATA[%s]]></Content>
							</xml>";
				$contentStr = "请不要发送空消息...";
				$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $contentStr);
			}
			echo $resultStr;
		} else {
			echo "";
			exit;
		}
	}
}
?>