<?php
namespace app\api\controller;
use think\Controller;
class Face extends Controller
{
  	function index()
    {
      	//此处一定要用select，因为find只返回第一行数据，一维数组，select返回全部的数据，并且每一行是一个单元，二维数组。
      	$res = db('store')->select();
      	//dump($res);
      	$aa = array("bb"=>"bbb", "cc"=>"ccc");
      	$this->assign("data", $res);//以待传给html进行渲染的数据
      	$this->assign("a", $aa);
    	
      	return $this->fetch();//return后面的内容，是返回渲染的页面
    
    }
	function delete()
    {
      	$goodsname="aaa";
    	$model = model('Face');
      	$model->delete($goodsname);
  
      	
    }
}