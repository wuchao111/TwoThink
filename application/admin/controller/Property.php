<?php
namespace app\admin\controller;
use think\Db;

class Property extends Admin
{
    public function index(){
        $property = Db::table('twothink_repair')->paginate(2);
        $page = $property->render();
        $this->assign('page',$page);
//        var_dump($page);die;
        return $this->fetch('index',['propertys'=>$property]);
    }
    public function add(){
        if (request()->isPost()) {
            $data = request()->param();
            $re = $this->validate($data,'Attribute');
            var_dump($re);
            if($re === true){
                $datas = [
                    'name' => $data['name'],
                    'tel' => $data['tel'],
                    'titel'=>$data['titel'],
                    'address'=>$data['address'],
                    'content'=>$data['content'],
                    'time'=>time(),
                    'status'=>1,
                ];
                Db::name('repair')->insert($datas);
            }else{
                $this->error($re,url('property/index'));
            }

            $this->success('添加成功','property/index',3);die;
        }
        return $this->fetch();
    }
    public function del(){
        $id = $_GET['id'];
        Db::table('twothink_repair')->delete($id);
        $this->success('删除成功','property/index',3);die;
    }
    public function edit(){
        if(request()->isPost()){
            $data = request()->param();
            $datas = [
                'id'=>$data['id'],
                'name' => $data['name'],
                'tel' => $data['tel'],
                'titel' => $data['titel'],
                'content' => $data['content'],
                'time'=>time(),
                'status'=>1,
            ];
              Db::name('repair')->update($datas);
//            var_dump($v);die;
            $this->success('修改成功','property/index');
        }else{
            $id = $_GET['id'];
            $row = Db::table('twothink_repair')->where('id',$id)->find();
            $this->assign('row',$row);
            return $this->fetch();
        }
    }
}