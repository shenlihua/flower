<?php
// 设置REST API调用基本参数
$sdkappid = 1400011154;
$identifier = "admin";
$private_key_path = dirname(__FILE__).DIRECTORY_SEPARATOR."../private_key";
$signature = dirname(__FILE__).DIRECTORY_SEPARATOR."/signature/windows-signature64";

require_once("TimRestInterface.php");
require_once("TimRestAPI.php");

// 初始化API
$api = createRestAPI();
$api->init($sdkappid, $identifier);

// 生成签名，有效期一天
// 对于FastCGI，可以一直复用同一个签名，但是必须在签名过期之前重新生成签名
if(!@$_COOKIE['sign']){
    $ret = $api->generate_user_sig($identifier, '86400', $private_key_path, $signature);
    setcookie('sign',$ret[0]);
    $api->set_user_sig($_COOKIE['sign']);
}else{
    $api->set_user_sig($_COOKIE['sign']);
}

//导入帐号信息
//$api->account_import('slh-1','test-slh','http://qiuxx.com/Uploads/abc.jpg');
////var_dump($ret);
//print_r($api->sns_friend_import('admin','slh-3'));
//print_r($api->openim_send_msg('admin','slh-1','发送消息!!'));
//print_r($api->openim_send_msg('slh-2','slh-1','发送消息给slh-1!!'));
//if ($ret == null)
//{
//    // 签名生成失败
//    return -10;
//}
//// 调用api的成员函数，实现REST API的调用，以下单发消息，群组内发送文本消息，通用接口为示例：
//// 单发消息
//$ret = $api->openim_send_msg("myadminaaaaaaa", "lileiaaaaaaa", "hello");

//// 群组内发送消息
//$ret = $api->group_send_group_msg("lilei", "@TGS#2QJXRPAE3", "hello");
//
//// 通用接口，在当前版本没有提供用户需要的REST API集成SDK的时候，才考虑使用该接口，
//// 用户可以使用该接口直接调用REST API， 需要用户构造REST API需要的请求包体
//// 以调用REST API group_get_group_member_info 为例：
//$req_body = array(
//    "GroupId" => "@TGS#2QJXRPAE3",      //群组ID
//    "Limit" => 20,           //Limit限制回包中群组的个数，不得超过10000
//    "Offset" => 5           //Offset控制从整个群组列表中的第多少个群组开始拉取信息
//);
//$ret = $api->comm_rest("group_open_http_svc", "group_get_group_member_info", $req_body);