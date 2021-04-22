<?php
/**
 * Created by PhpStorm.
 * User: 8-bit
 * Date: 2021/4/4
 * Time: 18:35
 */

namespace admin;


use models\BaseDao;

class Adminuser extends admin{
    /*
    function __construct(){
    }*/
    function index(){
        $db = new BaseDao();
        $data = $db->select('admin','*',['ORDER'=>['id'=>"ASC"]]);
        //dd($data);
        $this->assign('data',$data);
        $this->assign('title','管理列表');
        $this->display('adminuser/index');
    }
    function add(){
        if(isset($_POST['name'])){
            $db = new BaseDao();
            $_POST['atime'] = $_POST['ltime'] = time();
            $_POST['pw'] = md5('ew'.$_POST['pw']);//["name" => $_POST['name'],"pw" => $_POST['pw'],'atime' => $_POST['atime'] ,'ltime' => $_POST['ltime']]
            if ($db->insert('admin',$_POST)){
                $this->success('/admin/adminuser', '添加成功');
            }else{
                $this->error('/admin/adminuser/add', '添加失败');
            }
        }
        $this->assign('title','管理列表');
        $this->display('adminuser/add');

    }
    function mod($id){
        $db = new BaseDao();
        $data = $db->get('admin','*',['id' => $id]);
        //dd($data);
        $this->assign('title','修改列表');
        $this->assign($data);
        $this->display('adminuser/mod');
    }
    function doupdate(){
        if(isset($_POST['id'])){
            $id = $_POST['id'];
            unset($_POST['id']);
            if(empty($_POST['pw'])){
                unset($_POST['pw']);
            }else{
                $_POST['pw'] = md5('ew'.$_POST['pw']);
            }
            $db = new BaseDao(); 
            if($db->update('admin', $_POST, ["id" => $id])){
                $this->success('/admin/adminuser','修改成功');
            }else{
                $this->error('/admin/adminuser/mod', '修改失败');
            }

        }
    }
    function del($id){
        $db = new BaseDao();
        if($id==9){
            $this->error('/admin/adminuser', '管理员不能被删除');
            exit;
        }
        if ($db->delete('admin',['id' => $id])){
            $this->success('/admin/adminuser', '删除成功');
        }else{
            $this->error('/admin/adminuser', '删除失败');
        }
    }

}