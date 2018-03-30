<?php
// +----------------------------------------------------------------------
// | TwoThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.twothink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace app\home\controller;
use app\home\model\Document;
use think\Db;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class Index extends Home{


	//系统首页
    public function index(){
        $category = model('Category')->getTree();
        $document = new Document();
        $lists    = $document->lists(null);
        $this->assign('category',$category);//栏目
        $this->assign('lists',$lists);//列表
        $this->assign('page',model('Document')->page);//分页

        return $this->fetch();
    }
    // 在线保修
    public function add(){
        if (request()->isPost()) {
            $data = $_POST;
            $datas = [
                'name' => $data['name'],
                'tel' => $data['tel'],
                'titel'=>$data['titel'],
                'address'=>$data['address'],
                'content'=>$data['content'],
                'time'=>time(),
                'status'=>0,
            ];
            Db::name('repair')->insert($datas);
            $this->success('添加成功','index/index',3);die;
        }
        return $this->fetch('add');
    }
    // 小区通知
    public function notice(){
        $notice = Db::table('twothink_notice')->select();
        return $this->fetch('notice',['notices'=>$notice]);
    }
    // 小区通知详情
    public function details($id){
        $details = Db::table('twothink_notice')->where('id',$id)->find();
//        var_dump($_GET);die;
//        $details['clicks'] ++ ;
        Db::table('twothink_notice')->where('id',$id)->setInc('clicks');
//        var_dump($details);
        $this->assign('details',$details);
        return $this->fetch('notice-detail');

    }
    // 便民服务
    public function fuwu(){
        return $this->fetch();
    }
    // 调查问卷
    public function diaocha(){
        $diaocha = Db::table('twothink_notice')->select();
        return $this->fetch('diaocha',['diaocha'=>$diaocha]);
    }
    // 问卷调查详情
    public function diaochas(){
        return $this->fetch('diaochawenjuan');
    }
    // 业主认证
    public function yezhu(){
        if (request()->isPost()) {

            $data = $_POST;

//            var_dump($data);die;
            Db::name('yezhu')->insert($data);
            $this->success('添加成功','index/index',3);die;
        }
        return $this->fetch('yezhu');
    }
    // 租售
    public function zushou(){
        return $this->fetch('zushou');
    }
    // 商家活动
    public function shangjia(){
        $shangjia = Db::table('twothink_shangjia')->select();
        return $this->fetch('shangjia',['shangjias'=>$shangjia]);
    }
    // 小区活动
    public function activity($page = 1){
        $pageSize=1;
        $page=($page-1)*$pageSize;
        $activity = Db::table('twothink_activity')->where('status',1)->limit($page,$pageSize)->select();

        if($page != 0){
            return json_encode($activity);
        }
        return $this->fetch('activity',['activitys'=>$activity]);
    }
    // 报名
    public function sign(){
       $id = is_login();
        if($id){
//            var_dump(11);exit;
            $sign = Db::table('twothink_sign')->where(['user_id'=>$id])->select();
            if($sign){
                $data = 0;
            }else{
                $sign['uid'] = $_GET['id'];
                $sign['user_id'] = $id;
                Db::table('twothink_sign')->insert($sign);
                $data = 1;
            }
            return json_encode($data);
        }else{
            $data = 2;
            return json_encode($data);
        }
    }
}
