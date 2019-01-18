<?php
namespace app\index\controller;
use think\Controller;

class Face extends Controller
{
  	
    public function face()
    {
      	return $this->fetch();
    }
  	public function index()
    {
    	return $this->fetch();
    }
  	public function delete($goodsname="")
    {

    	$sql = "delete from store where goodsname = '{$goodsname}' and price = '12' ";
      	//$model = new Model();
      
      	//$model->execute($sql);
      	$this->execute(sql);
    }
}