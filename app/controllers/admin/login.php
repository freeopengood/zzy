<?php
namespace admin;
use controllers\BaseControllers;
use Gregwar\Captcha\CaptchaBuilder;
use models\BaseDao;


class Login extends BaseControllers{
    function index()
    {
        $this->display('admin/login/index');
    }

    function vcode()
    {
        $builder = new CaptchaBuilder;
        $builder->build();
        $_SESSION['code'] = strtoupper($builder->getPhrase());
        header('Content-type: image/jpeg');
        $builder->output();
    }

    function dologin()
    {
        $name = $_POST['name'];
        $pw = md5('ew' . $_POST['pw']);
        $db = new BaseDao();
        if (strtoupper($_POST['code']) != $_SESSION['code']) {
            $this->error('/admin/login', '验证码错误');
            #exit;
        }
        if(is_null($name)){
            $this->error('/admin/login', '账号不能为空');
        }
        if($data = $db->get('admin', ['id','pw', 'name'], ['name' => $name])){
            if ($pw === $data['pw']) {
                $db->update('admin',['ltime' => time()],['name' => $name]);
                $_SESSION = $data;
                $_SESSION['admin_token'] = md5($data['id'].$_SERVER['HTTP_HOST']);
                 #dd($_SESSION);
                $this->success('/admin', '登陆成功');
            } else {
                $this->error('/admin/login', '密码错误');
            }
        }else{$this->error('/admin/login', '用户名不存在');}
    }
    function logout(){
        $_SESSION = array();
        if(isset($cookie[session_name()])){
            setcookie(session_name(),'',time()-3600,'/');
        }
        session_destroy();
        $this->success('/admin/login', '退出成功');
    }
}