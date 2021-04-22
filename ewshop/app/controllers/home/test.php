<?php
/**
 * Created by PhpStorm.
 * User: 8-bit
 * Date: 2021/3/26
 * Time: 16:29
 */
namespace home;
use models\BaseDao;

class Test extends Home{
    function index(){
        /*
        $arr = array('one'=>'111','two'=>'222','three'=>'333');
        $this->assign('data',$arr);
        //dd($this->data);
        $this->display('test/index',$this->data);
        $db = new BaseDao();
        $data = $db->select('product','*');
        dd($data);
        $this->assign('data',$data);*/

        $this->display("test/index");


    }
}