<?php
	namespace app\api\controller;
	use think\Controller;
	class Weather extends Controller
    {
    	public function read()
          
        {
        	$weather_code=input('weather_code');
          	$model=model('Weather');
          	$weather_info=$model->getWeather($weather_code);
          	if($weather_info)
            {
            	$status=200;
            }else
            {
            	$status=400;
            }
          	$data=['code'=>$status, 'weather_info'=>$weather_info];
          	//echo $weather_info;
          	return json($data);
        }
    }