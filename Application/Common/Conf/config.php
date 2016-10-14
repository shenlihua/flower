<?php

return array(
    //'配置项'=>'配置值'

//数据库配置信息

    'DB_TYPE' => 'mysqli',     // 数据库类型
    'DB_HOST' => 'localhost', // 服务器地址
    'DB_NAME' => 'flower',          // 数据库名
    'DB_USER' => 'root',      // 用户名
    'DB_PWD' => 'root',          // 密码
    'DB_PORT' => '3306',        // 端口
    'DB_PREFIX' => 'fl_',    // 数据库表前缀

    //七牛配置
    '_ext' => 'qyhh',
    'FILE_UPLOAD_TYPE' => 'qiniu',
    'UPLOAD_TYPE_CONFIG' => array(
        'secretKey' => 'wytOU9F0_Z2N8Wjj7rNzqhf5qy7VPHf2EvklIAGq', //七牛服务器
        'accessKey' => 'olmRsGTCDd-LH0WqdECsj63ZB-eXiFFhn86tTl8x', //七牛用户
        'domain' => '7xteyx.com1.z0.glb.clouddn.com/', //七牛
        'bucket' => 'a1010174887', //空间名称
        'timeout' => 3000, //超时时间
    ),

    'UE_CONFIG' => APP_PATH.'../Public/Admin/lib/ueditor/1.4.3/php/config.json',
//    'LOAD_EXT_CONFIG' =>'ueditor',
);