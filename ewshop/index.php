<?php
    error_reporting(E_ALL^E_WARNING);
    require('vendor/autoload.php');
    use NoahBuscher\Macaw\Macaw;  //调用macaw

    Macaw::get('/fuck', function() {
        echo "成功！";
    });

    Macaw::get('/(:all)', function($fu) {
        echo '未匹配到路由<br>'.$fu;
    });
    //Macaw::get('/admin', 'admin\Demo@index'); //namespace admin
    //Macaw::get('/admin', 'admin\Admin@index');

    Macaw::get('/home','home\Test@index');
    Macaw::get('/admin','home\Test@index');


    //进入管理平台的首页
    //Macaw::get('/admin','admin\Index@index');
    //友情连接路由
    Macaw::get('/admin/link','admin\Link@index');




    Macaw::dispatch();
