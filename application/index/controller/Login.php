<?php
namespace app\index\controller;//所有的控制器默认都放在该目录下。故查找控制器时，默认路径是controller/控制器名
 
use think\Controller;

 
class Login extends Controller
{
    public function index()
    {
    	return $this->fetch(); //显示登录界面
      //查找并渲染/加载模板文件html。默认路径是：模块/view/以当前控制器名（小写）为名的文件夹/当前方法.html
      //$this表示Login类的实例化对象。
     
      //app/index(模板名，文件夹）/view（默认视图文件夹）/login（文件夹，控制器名，小写）/index.html（index为当前方法名）
      //application/index/view/login/inde.html
    }   
    public function regist() {
    	return $this->fetch();//寻找application/index/view(默认视图文件夹)/login(以小写控制器名为名的文件夹)/regist(当前方法名).html文件
    }
  
      // 处理登录逻辑
    public function doLogin()
    {
    	$param = input('post.');//把数据从html中取出来，作为一个集体$param
      	$user_name=$param['user_name'];
        $user_pwd=$param['user_pwd'];
    	if(empty($user_name)){
    		
    		$this->error('用户名不能为空');
    	}
    	
    	if(empty($user_pwd)){
    		
    		$this->error('密码不能为空');
    	}
    	
    	// 验证用户名
    	$has = db('users')->where('user_name', $param['user_name'])->find();
    	if(empty($has)){
    		
    		$this->error('用户名密码错误');//不存在该用户名，显示用户名密码错误
    	}
    	
    	// 验证密码
    	if($has['user_pwd'] != md5($param['user_pwd'])){//用md5($param)对参数$param进行加密
    		
    		$this->error('用户名密码错误');//该用户名的密码不对，显示用户名密码错误
    	}

    	
    	// 记录用户登录信息
    	cookie('user_id', $has['id'], 3600);  // 一个小时有效期
    	cookie('user_name', $has['user_name'], 3600);
    	
    	$this->redirect('index/index');//控制器名（小写）/方法名-->原模块->controller(控制器默认文件夹)->Index.php/index方法
    }
  
  //退出登录
 
  public function loginOut() 
  {
    cookie('user_id',null);
    cookie('user_name',null);
    $this->redirect('login/index');//控制器名（小写）/方法名-->原模块->controller(控制器默认文件夹)->Login.php/index方法

  }
  //处理注册的信息
  public function doRegist()
  {
    
    //$this->redirect('regist/regist');//控制器名（小写）/方法名-->原模块->controller(控制器默认文件夹)->Regist.php/regist方法
    $param = input('post.');
    $user_name=trim($param['user_name']);
    $user_pwd=trim($param['user_pwd']);
    $user_pwd2=trim($param['user_pwd2']);

    if(strlen($user_name) <3 || strlen($user_pwd) <3) 
    {
      $this->error('用户名和密码长度不得小于3');

    }

    if($user_pwd != $user_pwd2)
    {
      $this->error('两次密码输入不相同');
    }

    //判断用户是否已经被注册。数据库里的数据，users表名，user_name字段，
    $user_name_data=db('users')->where('user_name', $user_name)->find();

    if($user_name_data)
    {
      
      return $this->error('用户已经存在，请换一个重试');
    }else
    {
    	
      $inserted_data=['user_name' => $user_name, 'user_pwd'=>md5($user_pwd)];//md5($a)，是给$a加密
      $insert=db('users')->insert($inserted_data);//给表users插入数据
      if($insert == 1) {
        $this->success('恭喜注册成功，请前往登录页面', 'index',3);//3s后自动返回


      }else {
        $this->error('注册出现问题，请重试');
      }
    }


  }
  
  

}
