<?php
namespace app\wx\controller;
use think\Controller;
class Wea extends Controller
{
  public function read()
  {
    $lat=isset($_POST['lat']) ? $_POST['lat']:30.68093376455154;//如果$_GET['lat']未定义或定义成NULL，则将0赋值给$_GET['lat']，并将$_GET['lat']赋值给$lat
	$lng=isset($_POST['lng']) ? $_POST['lng']:104.06552381979525;
  	

	$get_url="http://api.map.baidu.com/geocoder/v2/?location=".$lat.",".$lng."&coordtype=wgs84ll&output=json&pois=0&ak=mwz8r0sSO7bin5XxzH8xnhR4yRyMTH1I";
    
	//coordtype坐标类型。wgs8411：GPS类型
	//output输出类型json格式
	//pois=1获取周边的地理信息,pois=0不获取（默认不获取）
	//callback=renderReverse，有的网站只让和自己网站访问自己的文件，如：a.com不能访问b.com的文件。就加它。jsonp。
    
	$location_info=json_decode(file_get_contents($get_url));
	$weather_city=$location_info->result->addressComponent->city;
	$weather_city=str_replace("市", "", $weather_city);
    //str_replace(find,replace,String)，把String中的find替换为replace
 
    
    $weather_code=json_decode(file_get_contents("http://www.parcruz.site/getcitycode/".$weather_city));
	$weather_code=$weather_code->city_code;
    $get_info=file_get_contents("http://www.parcruz.site/weather/".$weather_code);//json格式
     $result;//返回json格式
  
    $result=json_decode($get_info)->weather_info;//得到的还是json格式(因为它本来就是json格式）得到{"code":200,"weather_info":{xxx}}
    return $result;
    //var_dump(json_decode($weather_info));//用return json_decode($weather_info)不显示
    
  }
}
	
	
	


	

	
	
