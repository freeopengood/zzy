<?php
    namespace home;
    use controllers\BaseControllers;
    class Home extends BaseControllers{
        public function __construct()
        {
            $loader = new \Twig\Loader\FilesystemLoader(DIR . '/app/views/'.TEMPNAME);
            $this->twig = new \Twig\Environment($loader, []
            //'cache' => APP_PATH  . '/cache',
            );
        }
        protected function display($template){
            $url = get_url();
            $this->assign('url',$url.'/app/views/'.TEMPNAME.'/resource');  //自己都资源
            $this->assign('public',$url.'/app/views/public');  //公共资源
            $this->assign('res',$url.'/uploads');  //文件上传资源
            echo $this->twig->render($template.'.html', $this->data); //render加载模版文件.html
        }
    }