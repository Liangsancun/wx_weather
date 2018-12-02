<?php

	namespace app\api\controller;
	
	use think\Controller;

	class News extends Controller
	{
		public function read()
		{
			$id=input('id');
			$model=model('News');
	
          	$arr=['a'=>'我','b'=>'你'];
          	$a='我';
          	
         
          	echo json_encode($arr, 256);
		

		}
	}