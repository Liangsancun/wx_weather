<?php
namespace app\index\controller;

class Index
{
    public function index()
    {
      return '您好： '.cookie('user_name').'<a href="'.url('login/loginOut').'"> 退 出</a>';//也可以用echo代替return
      //url里是：控制器名（小写）/方法名，去  application/原模块/controller(控制器都放在其中，默认打开文件夹）/Login（控制器名）.php/loginOut方法
    }
}
