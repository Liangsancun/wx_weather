<?php
namespace app\api\controller;//所有的控制器默认都放在该目录下。故查找控制器时，默认路径是controller/控制器名
 
use think\Controller;
use think\Request;
 
class Face extends Controller
{
    //渲染二手商品列表
    public function index()
    {
      //此处一定要用select，因为find只返回第一行数据，一维数组，select返回全部的数据，并且每一行是一个单元，二维数组。
      $res=db('store')->select();
      //dump($res);
        //$aa = array("bb"=>"bbb", "cc"=>"ccc");
      $this->assign("data", $res);//也待传给html进行渲染的数据
      //$this->assign("a", $aa);
    	return $this->fetch(); //return 后面的内容，是返回渲染的页面
      //查找并渲染/加载模板文件html。默认路径是：模块/view/以当前控制器名（小写）为名的文件夹/当前方法.html
      //$this表示Login类的实例化对象。
     
      //app/api(模板名，文件夹）/view（默认视图文件夹）/Face（文件夹，控制器名，小写）/index.html（index为当前方法名）
      //application/api/view/face/index.html
    }   
    //发布二手信息
    public function publish()
    {

      return $this->fetch();
    }
    //返回所有的二手商品信息（以json的格式）
    //[{"id":2,"goodsname":"ll","price":"aa","introduce":"asdfasdfasf","contact":null,"image":null,"create_time":null},{"id":4,"goodsname":"bbb","price":"33","introduce":"adfagqegeqweqw","contact":null,"image":null,"create_time":null}]
    public function allGoodsInfo()
    {
      $res=db('store')->select();
      $data=json_encode($res,JSON_UNESCAPED_UNICODE);
      return $data;
    }
    //添加二手商品信息到数据库
    public function addData()
    {
    	$param = input('post.');//把数据从html中取出来，作为一个集体$param
        $goodsname=$param['goodsname'];
        $price=$param['price'];
        $introduce=$param['introduce'];
        $contact=$param['contact'];
      	//dump($param);
      

        $inserted_data=['goodsname' => $goodsname,  'price'=>$price, 'introduce'=>$introduce, 'contact'=>$contact, 'image'=>""];//md5($a)，是给$a加密
      
        $insert=db('store')->insert($inserted_data);//给表users插入数据
        if($insert == 1) {
          $this->success('发布二手信息成功', 'index',3);//3s后自动返回到二手商品列表页面


        }else {
          $this->error('注册出现问题，请重试');
        }        

    	
    
    }
    //接收要删除的商品的信息（json格式）
    public function delete()
    {
      	
      	$contact=$_POST['contact'];
   
        //$goodsinfo;//接收的删除的商品的信息（json格式）
       // $data=json_decode($goodsinfo);
        //$goodsname=$data['goodsname'];
        //$price=$data['price'];
       //$introduce=$data['introduce'];
        //$contact=$data['contact'];
       // $map=array("goodsname"=>$goodsname,"price"=>$price,"introduce"=>$introduce,"contact"=>$contact);
    
      	$map=array("contact"=>$contact);
        //删除数据库中的该条二手信息
        $delete=db('store')->where($map)->delete();
      	if($delete==1)
        {
          	$this->success("本次交易成功",'index',3);//并不显示
        }

    }
  

 
  

}