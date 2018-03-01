<?php
namespace app\api\controller;
use think\Controller;
class Apibase extends Controller{
	protected function _initialize(){
        parent::_initialize();
    }
    
    /**
    * 全局中断输出
    * @param $code string 响应码
    * @param $msg string 简要描述
    * @param $result array 返回数据
    */
    public function ajax_return($code = '200',$msg = '',$result = array()){
        $data = array(
            'code'   => (string)$code,
            'msg'    =>  $msg,
            'result' => $result
        );
        ajax_return($data);
    }

    /**
    * 获取当前网站域名
    *
    */
    public function host_url(){
        $base_url = 'http';
        if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
            $base_url .= "s";
        }
        $base_url .= "://";

        if (isset($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"] != "80") {
            $base_url .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];
        }else{
            $base_url .= $_SERVER["SERVER_NAME"];
        }
        return $base_url;
    }
}
