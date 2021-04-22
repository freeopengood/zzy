<?php
/**
 * Created by PhpStorm.
 * User: 8-bit
 * Date: 2021/3/28
 * Time: 20:42
 */

namespace admin;


use models\BaseDao;

class Link extends Admin{
    public function __construct(){
        parent::__construct();
        $this->assign('menumark','link');//按下高亮标记，通过总控制器display方法menumark值传送给前端模版
    }
    public function index(){
        $db = new BaseDao();
        // 获取全部友情链接，按order排序
        $data = $db->select('link','*',['ORDER'=>['ord'=>"ASC",'id'=>"DESC"]]);
        // 将数据分给模版
        $this->assign('data',$data);
        //标题
        $this->assign('title','友情链接');
        //导入模版
        $this->display('link/index');
    }
}