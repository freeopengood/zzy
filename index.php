<?php
    error_reporting(E_ALL^E_WARNING);
    session_start();
    require('vendor/autoload.php');
    use NoahBuscher\Macaw\Macaw;  //调用macaw
    /*
    Macaw::get('/fuck', function() {
        echo "成功！";
    });

    Macaw::get('(:num)', function($fu) {
        echo '未匹配到路由<br>'.$fu;
    });*/
    //Macaw::get('/admin', 'admin\Demo@index'); //namespace admin
    //Macaw::get('/admin', 'admin\Admin@index');
    //管理平台首页
    Macaw::get('/admin','admin\Index@index');
    //友情连接路由
    Macaw::get('/admin/link','admin\Link@index');
    Macaw::any('/admin/link/add','admin\Link@add');
    Macaw::get('/admin/link/mod/(:num)','admin\Link@mod');
    Macaw::post('/admin/link/doupdate','admin\Link@doupdate');
    Macaw::get('/admin/link/del/(:num)','admin\Link@del');
    Macaw::post('/admin/link/order','admin\Link@order');

    //管理列表路由
    Macaw::get('/admin/adminuser','admin\Adminuser@index');
    Macaw::any('/admin/adminuser/add','admin\Adminuser@add');
    Macaw::get('/admin/adminuser/mod/(:num)','admin\Adminuser@mod');
    Macaw::post('/admin/adminuser/doupdate','admin\Adminuser@doupdate');
    Macaw::get('/admin/adminuser/del/(:num)','admin\Adminuser@del');

    //登入退出操作
    Macaw::get('/admin/login','admin\Login@index');
    Macaw::get('/admin/login/vcode','admin\Login@vcode');
    Macaw::post('/admin/login/dologin','admin\Login@dologin');
    Macaw::get('/admin/login/logout','admin\Login@logout');

    //前台首页
    Macaw::get('/','home\Index@index');
Macaw::dispatch();
