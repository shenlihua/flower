<?php
namespace Wechat\Controller;
use Think\Controller;
use Com\WechatAuth;

class CommonController extends Controller{
//    public function _initialize(){
//        /*测试帐号*/
//        $appid     = 'wx7502c44234f7f6d8';
//        $appsecret = '3195a284c8c57f9330969ef451ae371b';
//
//        /*订阅号*/
////        $appid     = 'wx6cb25dfd791d6bff';
////        $appsecret = 'bb095622008f33cc8b533ef5161cbc66 ';
//
//
//        $redirect_url=urlencode("http://".$_SERVER['SERVER_NAME'].U('Index/index'));
//        $url="http://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_url&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
//
//        if(!session('id')){
//            if(!I('get.code')){//不存在code 请求code
//                redirect($url);
//            }else{
//                $auth  = new WechatAuth($appid, $appsecret);
//                $accessToken = $auth->getAccessToken('code',I('get.code'));
////                cookie('accessToken',$accessToken['access_token']);//缓存accessToken
////                cookie('openid',$accessToken['openid']);
//
//                $authInfo  = new WechatAuth($appid, $appsecret,$accessToken['access_token']);
//                $userInfo=$authInfo->getUserInfo($accessToken['openid']);
//                $userInfo['addtime']=time();
//                $userInfo['access_token']=$accessToken['access_token'];//记录最后一次授权token;
//                if($info=M('user')->getByopenid($accessToken['openid'])){//判断是否存在某人
//                    //更新数据
//                    $userInfo['lasttime']=time();//最后一次操作时间
//                    //保存用户ID
//                    session('id',$info['id']);
//                    M('user')->where(array('id'=>$info['id']))->save($userInfo);
//                }else{//添加数据
//                    $user_id=M('user')->add($userInfo);
//                    //保存用户ID
//                    session('id',$user_id);
//                }
//            }
//        }else{//检测accessToken是否有效
//            $user_info=M('user')->field('access_token,openid')->where(array('id'=>session('id')))->find();
//            $auth  = new WechatAuth($appid, $appsecret,$user_info['access_token']);
//            $data=json_decode($auth->checkAuth(array('access_token'=> $user_info['access_token'],'openid'=>$user_info['openid'])),true);
//            if($data['errcode']){//报错，重新获取accessToken
//                //删除openid
//                session('id',null);
//                $this->redirect("Index/index");
//            }else{
//
//            }
//        }
//    }
}