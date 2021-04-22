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
    //排序算法
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
    function add(){
        if (isset($_POST['do_submit'])){
            $db = new BaseDao();
            //if ($db->insert('link',['id'=>$_POST['id'],'name'=>$_POST['name'],'url'=>$_POST['url'],'ord'=>$_POST['ord']])){
            unset($_POST['do_submit']);
            if ($db->insert('link',$_POST)) {
                $this->success('/admin/link', '添加成功');
            } else {
                $this->error('/admin/link/add', '添加失败');
            }
        }
        $this->assign('title', '添加友情链接');
        $this->display('link/add');
    }
    function mod($id){
        $db = new BaseDao();
        $this->assign('link',$db->get('link','*',['id'=>$id]));
        $this->assign('title', '修改友情链接');
        $this->display('link/mod');

    }
    function doupdate(){
        $id = $_POST['id'];
        unset($_POST['id'],$_POST['do_submit']);
        $db = new BaseDao();
        //$db->debug()->update('link',$_POST,['id'=>$id]);
        if ($db->update('link',$_POST,['id'=>$id])){
            $this->success('/admin/link', '修改成功');
        } else {
            $this->error('/admin/link/mod/'.$id, '修改失败');
        }
    }
    function del($id){
        $db = new BaseDao();
        if($db->delete('link',['id'=>$id])){
            $this->success('/admin/link', '删除成功');
        } else {
            $this->error('/admin/link', '删除失败');
        }

    }
    function order(){
        $db = new BaseDao();
        foreach($_POST['ord'] as $id=>$ord){
            $data = $db->update('link',['ord'=>$ord],['id'=>$id]);
         }
        if(isset($data)){  //返回/admin/link路由会触发index()排序算法
            $this->success('/admin/link', '排序成功');
        } else {
            $this->error('/admin/link', '排序失败');
        }
    }
}