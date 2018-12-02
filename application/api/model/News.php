<?php
	namespace app\api\model;
	use think\Model;
	
	class News extends Model
	{
		public function getNews($id=1)
		{
			$res=db('news')->where('id', $id)->find();
			return $res;
		}
		public function getNewsList()
		{
			$res=db('news')->where('id>0')->column('title');
			dump($res);
		}
	}