<?php
	namespace app\api\model;
	use think\Model;

	class Getallcitycode extends Model
	{
	
      	public function getallcitycode()
        {
          $res=db('ins_county')->where('id>0')->column('weather_code');
          return $res;
        }

	}