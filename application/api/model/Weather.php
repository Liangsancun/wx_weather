<?php 
	namespace app\api\model;
	use think\Model;
	class Weather extends Model
    {
    	public function getWeather($weather_code=1)
        {
        	$res=db('ins_county')->where('weather_code',$weather_code)->find();
          	$weather_info=$res['weather_info'];
          	return $weather_info;
          
        }
    }