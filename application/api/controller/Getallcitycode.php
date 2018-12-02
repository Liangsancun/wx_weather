<?php
	namespace app\api\controller;

	use think\Controller;
	class Getallcitycode extends Controller
	{
		public function read()
		{
		
			$model=model('Getallcitycode');
				
            $res=$model->getallcitycode();
            foreach($res as $value)
            {
              echo $value.',';
            }
           //dump($res);
			
		}
    }