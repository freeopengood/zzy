<?php
/**
 * Created by PhpStorm.
 * User: 8-bit
 * Date: 2021/3/23
 * Time: 20:40
 */
namespace  controllers;
class BaseControllers{
    protected $twig;
    protected $data=[];
    public function __construct(){ //构造函数：类被加载时自动执行
        $loader = new \Twig\Loader\FilesystemLoader(DIR.'/app/views');
        $this->twig = new \Twig\Environment($loader,[]
        //'cache' => APP_PATH  . '/cache',
        );//预加载twig模版引擎(demo类继承BaseControllers时)
    }
    protected function assign($var, $value=null) { //合并数据为数组
        if(is_array($var)){
            $this->data = array_merge($this->data, $var);
        }else{
            $this->data[$var] = $value;
        }
    }
    protected function display($template){
        echo $this->twig->render($template.'.html', $this->data); //render加载模版文件.html
    }




/*判断成功
    protected function success($url, $mess){

        echo '<script>';
        echo "alert('{$mess}');";

        if(!empty($url)){
            echo "location.href='{$url}';";
        }
        echo "</script>";
    }

    protected function error($url, $mess){
        echo '<script>';
        echo "alert('ERROR:{$mess}');";

        if(!empty($url)){
            echo "location.href='{$url}';";
        }
        echo "</script>";
    }
*/
}