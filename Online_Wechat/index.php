<?php

$wechatObj = new wechat_php();
$wechatObj->GetMsg();
class wechat_php {
	public function GetMsg() {
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		if (!empty($postStr)) {
			libxml_disable_entity_loader(true); //防止文件泄漏
			$postObj      = simplexml_load_string($postStr,'SimpleXMLElement', LIBXML_NOCDATA); //解析XML
			$fromUsername = $postObj->FromUserName; //微信用户名
			$toUsername   = $postObj->ToUserName; //开发者微信号
			$msgType      = $postObj->MsgType; //消息类型
			$mediaId      = $postObj->MediaId;
			$picUrl       = trim($postObj->PicUrl);
			$keyword      = trim($postObj->Content);
			$location_X   = trim($postObj->Location_X);
			$location_Y   = trim($postObj->Location_Y);
			$scale        = trim($postObj->Scale); //地图缩放大小
			$label        = trim($postObj->Label); //位置标签
			$msgId        = trim($postObj->MsgId);
			$time         = time();
			if ($msgType == "event") {
				if ($postObj->Event == "subscribe") {
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
					echo $resultStr;
				}

				if ($postObj->Event == "CLICK") //事件类型是CLICK
				{
					if ($postObj->EventKey == "contact") {
						$textTpl = "<xml>
                                    <ToUserName><![CDATA[%s]]></ToUserName>
                                    <FromUserName><![CDATA[%s]]></FromUserName>
                                    <CreateTime>%s</CreateTime>
                                    <MsgType><![CDATA[text]]></MsgType>
                                    <Content><![CDATA[%s]]></Content>
                                    </xml>";
                    }
                    $time = time();                    
                    $contentStr = "欢迎来投稿到我们的邮箱：" . "\n" .  "2861327662@qq.com ！";                    
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $contentStr);
                    echo $resultStr;                    
				}
			}
			if ($msgType == "text") {
				if ($keyword == "解答") {
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
					$title1 = "【第一期】你们要的Q&A来啦！";
					$description1 = "为了让大家彻底爱上工大，小点在这里为大家献上福利偶～也就是我们的新栏目，“Q&A”学弟学妹负责采访调查学生中存在的困惑，学长学姐来解......";
					$picUrl1 = "http://upload-images.jianshu.io/upload_images/3235837-d0943c372b31e58b.jpeg?imageMogr2/auto-orient/strip%7CimageView2/2/w/1080/q/50";
					$url1 = "https://mp.weixin.qq.com/s?__biz=MzI3NDY0MTgwNA==&mid=2247483775&idx=1&sn=cfe3796fea02bad73fc028da560325d3&chksm=eb11a79cdc662e8ae830be9917bc69e9604d1338a87eb7d6e770e4f38bc909ebd44399a3b634#rd";

					$title2 = "【第二期】Q&A又来了，你准备好了吗？";
					$description2 = "给大家介绍一下，这是属于我们的Q&A@电气人....";
					$picUrl2 = "http://upload-images.jianshu.io/upload_images/3235837-38cc50a4053c3bc0.png?imageMogr2/auto-orient/strip%7CimageView2/2/w/1240";
					$url2 = "http://mp.weixin.qq.com/s?__biz=MzI3NDY0MTgwNA==&mid=2247483924&idx=1&sn=c351c5a9ded81ebd735f51ccc30760a3&chksm=eb11a4f7dc662de11b16c96ba899864da3e7340b312abebc8ad1841d783a0bbe6cc3f0259837&mpshare=1&scene=23&srcid=1014MActMl5KzT5NlxSce0zh#rd";

					$resultStr = sprintf($newsTpl,$fromUsername, $toUsername, $time, $title1, $description1, $picUrl1, $url1, $title2, $description2, $picUrl2, $url2);
					echo $resultStr;
				}
			}
		} else {
			echo "";
			exit;
		}
	}
}
