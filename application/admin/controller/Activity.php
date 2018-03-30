<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/25
 * Time: 11:40
 */

namespace app\admin\controller;


use think\Db;

class Activity extends Admin
{
    public function index(){
        $activity = Db::table('twothink_activity')->paginate(2);
        return $this->fetch('index',['activitys'=>$activity]);
    }
    public function add(){
        if (request()->isPost()) {
            $file = request()->file('pic');
                //移动到框架应用根目录/public/uploads/ 目录下
                $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
//            var_dump($info->getSaveName());die;
                if ($info) {
                    $data = $_POST;
//            var_dump($data);die;
                    $data['pic'] = '/uploads/' . $info->getSaveName();
//            var_dump($datas);die;
//                    var_dump($data);exit;
//                    $data['start_time']=strtotime($data['start_time']);
//                    $data['end_time']=strtotime($data['end_time']);
                Db::table('twothink_activity')->insert($data);
//                var_dump($res);die;
                $this->success('添加成功', 'activity/index', 3);
            } else {
                //上传失败获取错误信息
                $this->error($file->getError());
            }
        }
        return $this->fetch();
    }
    public function del($id){
        Db::table('twothink_activity')->delete($id);
        $this->success('删除成功','activity/index',3);die;
    }
    public function edit(){
        if(request()->isPost()){

            $file = request()->file('pic');
            //移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
//            var_dump($info->getSaveName());die;
            if ($info) {
                $data = $_POST;
//            var_dump($data);die;
                $data['pic'] = '/uploads/' . $info->getSaveName();
//            var_dump($datas);die;
                Db::table('twothink_activity')->update($data);
//                var_dump($res);die;
                $this->success('修改成功', 'activity/index', 3);
            } else {
                //上传失败获取错误信息
                $this->error($file->getError());
            }
        }else{
            $id = $_GET['id'];
            $row = Db::table('twothink_activity')->where('id',$id)->find();
            $this->assign('row',$row);
//            var_dump($row);die;
            return $this->fetch();
        }
    }
}