<?php
namespace home;

class Index extends Home{
    function index(){
        $this->assign('title','EWShop首页');
        $this->display('index/index');
    }
}