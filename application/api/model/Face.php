<?php
namespace app\api\model;

use think\Model;

class Face extends Model
{
	function delete($goodsname="")
    {
    	//$sql = "delete from store where goodsname = '{$goodsname}' and price = '12'";
        //$this->execute($sql);
      	//echo $sql;
      
      	$map = array("goodsname"=>$goodsname, "price"=>"22");
      	db('store')->where($map)->delete();
    }
}
