<?php
    namespace app\index\controller;
    use think\Controller;
    class Regist extends Controller
    {
        public function regist() 
        {
            $this->redirect('index/index');
        }
    }