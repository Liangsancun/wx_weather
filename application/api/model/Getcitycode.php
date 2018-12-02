<?php
	namespace app\api\model;
	use think\Model;

	class Getcitycode extends Model
	{
		public function getcitycode($city_name="")
	    {
			$res=db('ins_county')->where('county_name', $city_name)->find();
            $city_code=$res['weather_code'];
			return $city_code;
	    }
      	public function getallcitycode()
        {
          $res=db('ins_county')->where('id>0')->column('weather_code');
          return $res;
        }

	}