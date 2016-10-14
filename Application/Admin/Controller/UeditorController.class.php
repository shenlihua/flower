<?php
namespace Admin\Controller;
use Think\Controller;
@ini_set('upload_max_filesize', '20M');

class UeditorController extends Controller
{
    /**
     * 用于百度ueditor
     * 其中UE_CONFIG在config文件中定义
     */
    public function manager() {
        date_default_timezone_set("Asia/Chongqing");
        $CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents(C('UE_CONFIG'))), true);
//        dump($CONFIG);
        $action = $_GET['action'];
        switch ($action) {
            case 'config' :
                $result = $CONFIG;
                break;
            case 'listfile' :
            case 'listimage' :
                $result = $this -> lists($CONFIG, $action);
                break;
            /* 上传图片 */
            case 'uploadimage' :
                /* 上传涂鸦 */
            case 'uploadscrawl' :
                $config = array('maxSize' => $CONFIG['imageMaxSize'], 'rootPath' => C('UPLOAD_PATH'), 'savePath' => 'images/', 'saveName' => array('uniqid', ''), 'exts' => $CONFIG['imageAllowFiles'], 'autoSub' => true, 'subName' => array('date', 'Ymd'), );
                $result = $this -> up($config);
                break;
            /* 上传视频 */
            case 'uploadvideo' :
                $config = array('maxSize' => $CONFIG['videoMaxSize'], 'rootPath' => C('UPLOAD_PATH'), 'savePath' => 'videos/', 'saveName' => array('uniqid', ''), 'exts' => array('jpg', 'gif', 'png', 'jpeg', 'zip', 'doc', 'pdf'), 'autoSub' => true, 'subName' => array('date', 'Ymd'), );
                $result = $this -> up($config);
                break;
            /* 上传文件 */
            case 'uploadfile' :
            default :
                $config = array('maxSize' => $CONFIG['fileMaxSize'], 'rootPath' => C('UPLOAD_PATH'), 'savePath' => 'files/', 'saveName' => array('uniqid', ''), 'exts' => $CONFIG['fileManagerAllowFilesarray'], 'autoSub' => true, 'subName' => array('date', 'Ymd'), );
                $result = $this -> up($config);
                break;
        }
        /* 输出结果 */
        if (isset($_GET["callback"])) {
            if (preg_match("/^[\w_]+$/", $_GET["callback"])) {
                $this -> ajaxReturn($result, 'JSON');
            } else {
                $tmp = array('state' => 'callback参数不合法');
                $this -> ajaxReturn($tmp, 'JSON');
            }
        } else {
            //echo $result;
            $this -> ajaxReturn($result, 'JSON');
        }
    }
    /**
     * 用于百度编辑器上传功能
     */
    public function up($config) {
        //TODO:删除不删除？
        @ini_set('upload_max_filesize', '20M');
        $info=qiniu_uploads(key($_FILES),'');
        if ($info['code']) {
            return array('state' => $info['msg']);
            //获取失败信息
        } else {
            return array('url' => 'http://'.C('UPLOAD_TYPE_CONFIG.domain').'/' . $info['msg'], 'title' => htmlspecialchars($_POST['pictitle'], ENT_QUOTES), 'original' => $_FILES['name'], 'state' => 'SUCCESS');
        }
    }
    /**
     *百度编辑器列出本地服务器上传目录
     *
     *
     **/
//    public function lists($config, $type) {
//        switch ($type) {
//            case 'listfile' :
//                $allowFiles = $config['fileManagerAllowFiles'];
//                $listSize = $config['fileManagerListSize'];
//                $path = $config['fileManagerListPath'];
//                break;
//            default :
//                $allowFiles = $config['imageManagerAllowFiles'];
//                $listSize = $config['imageManagerListSize'];
//                $path = $config['imageManagerListPath'];
//                break;
//        }
//        $allowFiles = substr(str_replace(".", "|", join("", $allowFiles)), 1);
//        /* 获取参数 */
//        $size = isset($_GET['size']) ? htmlspecialchars($_GET['size']) : $listSize;
//        $start = isset($_GET['start']) ? htmlspecialchars($_GET['start']) : 0;
//        $end = $start + $size;
//        /* 获取文件列表 */
//        $path = DOC_ROOT . C('UPLOAD_PATH');
//        $files = $this -> getfiles($path, $allowFiles);
//        if (!count($files)) {
//            return array("state" => "no match file", "list" => array(), "start" => $start, "total" => count($files));
//        }
//        /* 获取指定范围的列表 */
//        $len = count($files);
//        for ($i = min($end, $len) - 1, $list = array(); $i < $len && $i >= 0 && $i >= $start; $i--) {
//            $list[] = $files[$i];
//        }
//        $result = array("state" => "SUCCESS", "list" => $list, "start" => $start, "total" => count($files));
//        return $result;
//    }
    /**
     * 获取本地文件
     */
//    function getfiles($path, $allowFiles, &$files = array()) {
//        if (!is_dir($path)) {
//            exit('E1:path is wrong ' . $path);
//            return null;
//        }
//        if (substr($path, strlen($path) - 1) != '/')
//            $path .= '/';
//        $handle = opendir($path);
//        while (false !== ($file = readdir($handle))) {
//            if ($file != '.' && $file != '..') {
//                $path2 = $path . $file;
//                if (is_dir($path2)) {
//                    $this -> getfiles($path2, $allowFiles, $files);
//                } else {
//                    if (preg_match("/\.(" . $allowFiles . ")$/i", $file)) {
//                        $files[] = array('url' => substr($path2, strlen($_SERVER['DOCUMENT_ROOT'])), 'mtime' => filemtime($path2));
//                    }
//                }
//            }
//        }
//        return $files;
//    }
    /**
     * 上传图片
     * @author huajie <banhuajie@163.com>
     */
//    public function uploadPicture() {
//        /* 返回标准数据 */
//        $return = array('status' => 1, 'info' => '上传成功', 'data' => '');
//        /* 调用文件上传组件上传文件 */
//        $Picture = D('Picture');
//        $file_driver = C('PICTURE_UPLOAD_DRIVER');
//        $info = $Picture -> upload($_FILES, C('PICTURE_UPLOAD'), C('PICTURE_UPLOAD_DRIVER'), C("UPLOAD_{$file_driver}_CONFIG"));
//        //TODO:上传到远程服务器
//        /* 记录图片信息 */
//        if ($info) {
//            $return['status'] = 1;
//            $return = array_merge($info['download'], $return);
//        } else {
//            $return['status'] = 0;
//            $return['info'] = $Picture -> getError();
//        }
//        /* 返回JSON数据 */
//        $this -> ajaxReturn($return);
//    }

}