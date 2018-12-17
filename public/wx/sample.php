<?php
require_once "jssdk.php";//把jssdk.php的代码加载到该文件里面
$jssdk = new JSSDK("wxc65f799272ad5101", "48c769dc796058d4caaae8fc1031b05c");//自己测试号的openId ,和secret
$signPackage = $jssdk->GetSignPackage();//里面有jsapi_ticket
?>

<!DOCTYPE html>
<!--引入jQuery库-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewpoint" content="width=device-width, initial-scale=1,user-scalable=1">
  <!--viewpoint是手机的视图，相当于layout，width=device-width页面宽度为手机的宽度，initiacal-scale初始的页面放大倍数，uer-scalable可否手动放大缩小-->
  <!-- 引入 WeUI，供微信内网页和微信小程序的样式库 -->
    <link rel="stylesheet" href="http://res.wx.qq.com/open/libs/weui/0.4.3/weui.min.css"/>
  <!--rel=relation="stylesheet"，描述了当前页面与 href 所指定文档的关系是一个样式表，即说明href连接的文档是一个样式表-->
  <title></title>
  
</head>
<body>
  <!--老师是这么写的<body ontouchstart>但我看不加ontouchstart也没什么区别，说是可以触屏手机网页，点击后响应-->
  <a href="javascript:;" onclick="openLocation()" class="weui_btn weui_btn_primary" style="height:150px;width:600px;font-size:60px">调用地图</a>
  <!--javascript:void(0)表示点击后不跳转，onlick调用script里自己写的方法，如果有参数的话，可以直接在()里放-->
  <!--先执行onclick，在跳转href-->
  <!--weui_btn_primary绿底白字，weui_btn_warn红底白字，weui_btn_default灰底白字-->
  <!--a href="#"表示回到页面顶端-->
  <!--a href="javascript:;分号"，同 href="javascript:void(0)"没区别-->
  <br><!--相当于\n-->
  <a href="javascript:void(0)" onclick="scanQRCode()" class="weui_btn weui_btn_primary" style="height:150px;width:600px;font-size:60px">微信扫一扫</a>
  <br>
  <a href="javascript:;" onclick="getWeather()" class="weui_btn weui_btn_primary" style="height:150px;width:600px;font-size:60px">获取天气</a>
  <br>
  <p id="city">aini</p>
 
  
 
  
</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<!--上面的js文件，在需要调用 JS 接口的页面引入-->
<script type="text/javascript">
  
  /*
   * 注意：
   
   *
   
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   */
  var latitude = 0.0;
  var longitude = 0.0;
  
  wx.config({
    debug: true,
    appId: '<?php echo $signPackage["appId"];?>',//公众号的唯一标识
    timestamp: <?php echo $signPackage["timestamp"];?>,//时间戳
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',// 必填，生成签名的随机串
    signature: '<?php echo $signPackage["signature"];?>',//必填，签名，里面有jsapi_ticket
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
    	'getLocation',//获取经纬度
    	'openLocation',//打开地图
    	'scanQRCode'
    ]
  });
  //验证config参数之后，自动调用ready
  wx.ready(function () {
    // 在这里调用 API
        wx.getLocation({
            type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
            success: function (res) {
                latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                var speed = res.speed; // 速度，以米/每秒计
                var accuracy = res.accuracy; // 位置精度
                //alert("latitude:" + latitude + "longitude:" + longitude);//在页面中弹出信息



               $.post("http://www.parcruz.site/wx/getWeatherInfo.php", {lat:latitude, lng:longitude}, function(data){
                 	alert("我谈谈");
                 	$("#city").text(data.cityInfo.city);
                 	//var data=JSON.parse(data);
               		//$("#city").text(data.time);
               }, "json");





               
              	
             
              
            }
        });

  });
  function openLocation()
  {//打开地图
	wx.ready(function()
	{
		wx.openLocation(
		{
			latitude: latitude,// 纬度，浮点数，范围为90 ~ -90
			longitude: longitude,// 经度，浮点数，范围为180 ~ -180。
			name: '',// 位置名
			address: '',// 地址详情说明
			scale: 15,// 地图缩放级别,整形值,范围从1~28。默认为最大

			infoUrl: '' // 在查看位置界面底部显示的超链接,可点击跳转
		});
	});
  }
  
  function scanQRCode()
  {//扫描二维码
	wx.ready(function()
	{
		wx.scanQRCode({
			needResult: 0,//默认为0，扫描结果有微信处理，1则直接返回扫描结果
			scanType: ["qrCode","barCode"],//可以指定扫二维码还是一维码，默认二者都有
			success: function(res) {
				var result = res.resultStr;//当needResult为1时，扫码返回的结果
			}
		});
	});
  }
  
  function getWeather()
  {
 	$("#city").text(data.cityInfo.city);
    
  }
  

  

  
</script>
</html>