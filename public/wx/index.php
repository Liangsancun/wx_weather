<?php
	//获得参数signature nonce token timestamp echostr
	$nonce=$_GET['nonce'];
	$token='haha';
	$timestamp=$_GET['timestamp'];
	$echostr=$_GET['echostr'];
	$signature=$_GET['signature'];
	//形成数组，然后按照字典序排序
	$array=array();
	$array=array($nonce, $timestamp, $token);
	sort($array);
	//拼接成字符串，sha1加密，然后与signature进行校验
	$str=sha1(implode($array));
	if($str==$signature && $echostr) {
		//第一次接入weixin api接口的时候
		echo $echostr;
		exit;
	} else {
        //获取到用户发送的post数据（xml格式）
        $postArr = $GLOBALS['HTTP_RAW_POST_DATA'];
        //处理消息类型，并设置回复类型和内容
        $postObj = simplexml_load_string( $postArr );
        //判断该数据包是订阅的事件推送?
        if( strtolower( $postObj->MsgType) == 'event') {
            //如果是subsribe(关注)事件
            if( strtolower($postObj->Event == 'subscribe') ) {
                //回复用户消息（纯文本格式）
                $toUser  = $postObj->FromUserName;
                $fromUser= $postObj->ToUserName;
                $time    = time();
                $msgType =  'text';
                $content = '欢迎关注我的测试号'.$postObj->FromUserName.'-'.$postObj->ToUserName;
                $template = "<xml>
                                <ToUserName><![CDATA[%s]]></ToUserName>
                                <FromUserName><![CDATA[%s]]></FromUserName>
                                <CreateTime>%s</CreateTime>
                                <MsgType><![CDATA[%s]]></MsgType>
                                <Content><![CDATA[%s]]></Content>
                                </xml>";		
                $info    = sprintf($template,$toUser,$fromUser,$time,$msgType,$content);
                echo $info;
            }
        }elseif( strtolower( $postObj->MsgType ) == 'text' ) {
              //接收文本信息          
    
       
                   //回复用户消息（纯文本格式）
                  $toUser = $postObj->FromUserName;
                  $fromUser = $postObj->ToUserName;
                  $time = time();
                  $msgType = 'text';
              	  $weather_city=mb_substr($postObj->Content,0,2,"utf-8");//mb_substr适用于有中文的，0开始下标，2长度
              	  
        		  if($weather_city)
                  { 	
                    	$weather_code_json = json_decode(file_get_contents("http://www.parcruz.site/getcitycode/".$weather_city));
                    	if($weather_code_json->code==200)
                        {
                        		$weather_code=$weather_code_json->city_code;
                          		$weather_info_json=json_decode(file_get_contents("http://www.parcruz.site/weather/".$weather_code));
                          		if($weather_info_json->code==200)
                                {
                                		$weather_info=$weather_info_json->weather_info;
                                }
                        }
                    
       
                        
                  }
                  $content = '更新时间：'.date('Y-m-d H:m:s')."\n".$weather_city.'天气实时发布'."\n".$weather_info."\n"."网页版"."\n".'http://www.parcruz.site/index/jquery/lala.html';
          			//  \n一定要用""，而不是''
                  $template = "<xml>
                                   <ToUserName><![CDATA[%s]]></ToUserName>
                                   <FromUserName><![CDATA[%s]]></FromUserName>
                                   <CreateTime>%s</CreateTime>
                                   <MsgType><![CDATA[%s]]></MsgType>
                                   <Content><![CDATA[%s]]></Content>
                                   </xml>";
                  $info = sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
                  echo $info;
           
        
        }
    }



    

	