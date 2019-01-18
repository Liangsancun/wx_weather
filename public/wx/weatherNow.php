<?php
require_once "jssdk.php";//加载jssdk.php，把它的代码复制到该文件中
$jssdk = new JSSDK("wxc65f799272ad5101", "48c769dc796058d4caaae8fc1031b05c");//自己测试号的openId ,和secret
$signPackage = $jssdk->GetSignPackage();//里面有通过access_token获得的jsapi_ticket
?>
<!DOCTYPE html>
<html>
	<head>
        <!--http-equiv="Content-Type"规定文档的字符编码。-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		  <!--viewpoint是手机的视图，相当于layout，width=device-width页面宽度为手机的宽度，initiacal-scale初始的页面放大倍数，uer-scalable可否手动放大缩小-->
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scale=1">

		<!--引入jQuery Moblie样式-->
		<!--rel=relation="stylesheet"，描述了当前页面与 href 所指定文档的关系是一个样式表，即说明href连接的文档是一个样式表-->
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
		<!--引入jQuery库-->
      <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		<!--引入jQuery mobile库-->
		<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	</head>
	<body>
		<div data-role="page" id="pageone" style="background:white">
		<!--style="blackgroud:white"北京颜色，也可用#ffffff-->
			
            <div data-role="header" data-position="fixed">
                <a href="#" class="ui-btn ui-btn-left ui-icon-home ui-btn-icon-notext ui-corner-all ">首页</a>
                <h1 id="city">北京天气</h1>
                <a href="#mypopup" data-rel="popup" data-transition="slide" class="ui-btn ui-btn-right ui-icon-bullets ui-btn-icon-notext ui-corner-all">设置</a>
                <!--ui-btn：按钮，ui-btn-right：按钮放在右面，ui-icon-bullets：栅栏图标，ui-btn-icon-notext：只显示图标，ui-corner-all：为原元素添加圆角-->
                <!--data-rel="popup"：用于打开弹窗-->
                <!--data-transition="slide" 切换页面的效果，此时为滑动，还可以是弹出"popup"-->
                <!--data-role="popup"弹窗-->
                <div data-role="popup" id="mypopup">
                	<p>弹窗设置</p>
                </div>

            </div>
            <div date-role="content">
             	<h2 class="subtitle" id="type">晴天</h2>
             	<h2 class="subtitle" id="temper">15℃~20℃</h2>

	            <hr color="black" size=1>
	            <!--hr是指分割线。默认 横线，竖线的时候用style="height:50px;width:1px"-->
	        	<div class="ui-grid-b">
	        	<!--ui-grid-b：分成3列。ui-block-a|b|c，ui-grid-a：分成2列，ui-block-a|b -->
	        		<div class="subtitle">
	        			<h3>气候条件</h3>
	        		</div>
		            <div class="ui-block-a">
	              		 <img src="../static/weather_icon/fl.jpg" style="width:20px;height:20px">
	              		 <!--<img src="" alt="爱你" 如果图片不显示的话，显示alt的值-->
	               		 <p>风力情况</p>
	               		 <p id="fl">东风2级</p>
	                 	 
	              	
		            </div>
		         	<div class="ui-block-b">
		         		<img src="../static/weather_icon/shidu.jpg" style="width:20px;height:20px">
		         		<p>湿度</p>
		         		<p id="shidu">60%</p>
		         	</div>
		         	<div class="ui-block-c">
		         		<img src="../static/weather_icon/pm25.jpg" style="width:20px;height:20px">
		         		<p>PM2.5</p>
		         		<p id="pm25">120</p>
		         	</div>
		         	<hr color="black" size=1>
		         	<div class="subtitle">
		         		<h3>未来天气</h3>
		         	</div>
		         	<div class="ui-block-a">
		         	  	<p>明天</p>
                      	<p id="type_ming">晴</p>
                      	<p id="fl_ming">北风</p>
                      	<p id="temper_ming">温度</p>
                      
		         	</div>
		         	<div class="ui-block-b">
                      	<p>后天</p>
                      	<p id="type_hou">晴</p>
                      	<p id="fl_hou">北风</p>
                      	<p id="temper_hou">温度</p>
                    </div>
		         	<div class="ui-block-c">
                      	<p>大后天</p>
                      	<p id="type_dahou">晴</p>
                      	<p id="fl_dahou">北风</p>
                      	<p id="temper_dahou">温度</p>
                  	</div>
		         	<hr color="black" size=1>
		        </div>
			</div>
			<div data-role="footer" data-position="fixed">
				
			</div>
				
			
			
		</div>
      

	</body>
<style>
.ui-block-a,
.ui-block-b,
.ui-block-c
{
	height:180px;
	text-align:center;
}
.subtitle{
	text-align:center;
}
</style>
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
    debug: false,// 在开发时，要设为true，开启调试模式,调用的所有api的返回值会在客户端alert出来
    				//上线后设为false，避免老师弹出来东西

    appId: '<?php echo $signPackage["appId"];?>',//公众号的唯一标识
    timestamp: <?php echo $signPackage["timestamp"];?>,//时间戳
    nonceStr: '<?php echo $signPackage["nonceStr"];?>',// 必填，生成签名的随机串
    signature: '<?php echo $signPackage["signature"];?>',//必填，签名,里面有jsapi_ticket。
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
    	'getLocation',//获取经纬度
 
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

               $.post("http://www.parcruz.site/wx/wea/read", {lat:latitude, lng:longitude}, function(data){
                 	var data=JSON.parse(data);//默认把json格式的数据解析为对象
               		getWeather(data);
               }, "json");
   
              
            }
        });

  });


  
  function getWeather(data)
  {
    $("#city").text(data.cityInfo.city.substr(0,2)+"天气");
    //今天
	$("#temper").text(data.data.forecast[0].low.substr(3)+"~"+data.data.forecast[0].high.substr(3));
 	$("#type").text(data.data.forecast[0].type);
    $("#shidu").text(data.data.shidu);
    $("#pm25").text(data.data.pm25);
    $("#fl").text(data.data.forecast[0].fx+data.data.forecast[0].fl);
    //明天
    $("#type_ming").text(data.data.forecast[1].type);
    $("#fl_ming").text(data.data.forecast[1].fx+data.data.forecast[1].fl);
    $("#temper_ming").text(data.data.forecast[1].low.substr(3)+"~"+data.data.forecast[1].high.substr(3));
	//后天
    $("#type_hou").text(data.data.forecast[2].type);
    $("#fl_hou").text(data.data.forecast[2].fx+data.data.forecast[2].fl);
    $("#temper_hou").text(data.data.forecast[2].low.substr(3)+"~"+data.data.forecast[2].high.substr(3));
	//大后天
    $("#type_dahou").text(data.data.forecast[3].type);
    $("#fl_dahou").text(data.data.forecast[3].fx+data.data.forecast[3].fl);
    $("#temper_dahou").text(data.data.forecast[3].low.substr(3)+"~"+data.data.forecast[3].high.substr(3));
  }
  

  

  
</script>
</html>

