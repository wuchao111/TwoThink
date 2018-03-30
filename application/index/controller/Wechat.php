<?php

namespace app\index\controller;
class Wechat extends \think\Controller
{

    public function index(){
        $appid = "wxe078a1dd79ff84cd"; // 公众号唯一标识
        $redirect_uri = url('index/wechat/red','',true,true); //授权后重定向的回调链接地址
        $scope = "snsapi_userinfo"; // 应用授权作用域  snsapi_userinfo  ||snsapi_base
        $url= "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri={$redirect_uri}&response_type=code&scope={$scope}&state=STATE#wechat_redirect";
//        var_dump($url);die;
        $this->redirect($url);
    }

    public function red(){
        $appid = "wxe078a1dd79ff84cd"; // 公众号唯一标识
        $secret = "4910b2a3daf62c295f5ba84bb7b597bb"; // 公众号加密键
        $code = request()->get("code"); // 获取页面传过来的code
        $url = " https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$secret}&code={$code}&grant_type=authorization_code";
//        var_dump($url);die;
       $json = file_get_contents($url);
       var_dump($json);
    }
}