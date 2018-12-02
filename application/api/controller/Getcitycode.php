<?php
	namespace app\api\controller;javascript:;

	use think\Controller;
	class Getcitycode extends Controller
	{
		public function read()
		{
			$city_name=input('city_name');
			$model=model('Getcitycode');
			$city_code=$model->getcitycode($city_name);
			if($city_code)
			{
				$code=200;
              
			}else
			{
				$code=400;
     
			}
			$city_code=['code'=>$code,'city_code'=>$city_code];
            return json($city_code);
		}
    }