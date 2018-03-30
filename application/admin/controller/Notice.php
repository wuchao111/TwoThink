<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/23
 * Time: 16:13
 */

namespace app\admin\controller;


use Qiniu\Auth;
use think\Db;

class Notice extends Admin{
    public function index(){
        $notice = Db::table('twothink_notice')->paginate(2);
        return $this->fetch('index',['notices'=>$notice]);
    }
    public function add(){
        if (request()->isPost()) {
            $file = request()->file('pic');

            //移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

//            var_dump($info->getSaveName());die;
            if ($info) {
                $data =$_POST;
//            var_dump($data);die;
                $data['pic'] = '/uploads/'.$info->getSaveName();
                $data['time'] = time();
//            var_dump($datas);die;
                Db::table('twothink_notice')->insert($data);
//                var_dump($res);die;
                $this->success('添加成功','notice/index',3);
            } else {
                //上传失败获取错误信息
                $this->error($file->getError());
            }
        }
        return $this->fetch();
    }
    public function del(){
        $id = $_GET['id'];
        Db::table('twothink_notice')->delete($id);
        $this->redirect('notice/index');
    }
    public function edit(){
        if (request()->isPost()) {
            $file = request()->file('pic');

            //移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

//            var_dump($info->getSaveName());die;
            if ($info) {
                $data =$_POST;
//            var_dump($data);die;
                $data['pic'] = '/uploads/'.$info->getSaveName();
                $data['time'] = time();
//            var_dump($datas);die;
                Db::table('twothink_notice')->update($data);
//                var_dump($res);die;
                $this->success('修改成功','notice/index',3);
            } else {
                //上传失败获取错误信息
                $this->error($file->getError());
            }
        }else{
            $id = $_GET['id'];
            $row = Db::query("select * from `twothink_notice` WHERE id = '{$id}'");
            $this->assign('row',$row);
            return $this->fetch();
        }
    }
    public function upload(){
//        //var_dump($_FILES);
//        //实例化上传文件类
//        //获取表单上传文件
//        $file = request()->file('files');
//        if (emptyempty($file)) {
//            $this->error('请选择上传文件');
//        }
//        //移动到框架应用根目录/public/uploads/ 目录下
//        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
//        if ($info) {
//            $this->success('文件上传成功');
//            echo $info->getFilename();
//        } else {
//            //上传失败获取错误信息
//            $this->error($file->getError());
//        }
//        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
//
//        $result = $file->saveAs(\Yii::getAlias('@webroot') . $info);
//        if($result){
//            //文件保存成功
//            //将图片上传到七牛云
//            // 需要填写你的 Access Key 和 Secret Key
//            $accessKey = "uwAwyPveZlfFyS6snALW_qx_kT-Ryj42OKlNABSs";
//            $secretKey = "19wbXkXpq9jbpBfdbmKl36xXppZyXVtGCr-F-6_P";
//            $bucket = "wuchao123";
//            // 构建鉴权对象
//            $auth = new Auth($accessKey, $secretKey);
//            // 生成上传 Token
//            $token = $auth->uploadToken($bucket);
//            // 要上传文件的本地路径
//            $filePath = \Yii::getAlias('@webroot').$info;
//            // 上传到七牛后保存的文件名
//            $key = $info;
//            // 初始化 UploadManager 对象并进行文件的上传。
//            $uploadMgr = new UploadManager();
//            // 调用 UploadManager 的 putFile 方法进行文件的上传。
//            list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
//            if($err == null){
//                //上传七牛云成功
//                //访问七牛云图片的地址http://<domain>/<key>
//                return json_encode([
//                    'url' => "http://p4t14zhct.bkt.clouddn.com/{$key}"
//                ]);
//            }else{
//                return json_encode([
//                    'url'=>$err
//                ]);
//            }
//
//
//
//        }else{
//            return json_encode([
//                'url'=>"fail"
//            ]);
//        }
        //获取表单上传文件

    }
}