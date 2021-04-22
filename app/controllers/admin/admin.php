<?php
    namespace admin;
    use controllers\BaseControllers;
    use Twig\Util\TemplateDirIterator;

    class Admin extends BaseControllers{
        /*定义构造变量
         * 预加载twig模版引擎(demo/index类继承BaseControllers时)
         * twig目录为/app/views/admin,使用display方法时直接到视图的admin目录下
         */
        public function __construct()
        {
            $loader = new \Twig\Loader\FilesystemLoader(DIR.'/app/views/admin');//加载后台视图的文件目录
            $this->twig = new \Twig\Environment($loader, []);
            $this->assign('session',$_SESSION);
            if(!ew_login('admin')){
                $this->error('/admin/login','请登陆');
            }
            //'cache' => APP_PATH  . '/cache',
            /*$this->success('/home','成功');
            //$this->assign('name', "易佳颖"); //添加数据
            //$this->assign('title', "哈哈哈哈哈哈");
            //$this->assign(['aaa','bbb','ccc']);
            //print_r($this->data);
            //dd($this->data);
            //$this->display('admin/index/index');*/
        }
        protected function display($template){
            $url = get_url();
            $this->assign('url',$url.'/app/views/admin/resource');  //自己的资源
            $this->assign('public',$url.'/app/views/public');  //公共资源
            $this->assign('res',$url.'/uploads');  //文件上传资源
            echo $this->twig->render($template.'.html', $this->data); //render加载模版文件.html
        }
    }


/**
class Demo{
    function index(){
        echo 'index';
    }
    function add(){
        echo 'add';
    }
}*/