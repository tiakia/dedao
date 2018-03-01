<?php
namespace app\api\controller;
use think\Controller;
class Auth extends Controller{
	protected $order_model,$token_model;
    //用户登录信息
    protected $member_info;
    
    public function _initialize(){
        $this->member_model = model('Member');
        $this->token_model = model('MemberToken');
        $token = input('post.token','','trim');
        
        $token_info = $this->token_model->get_token(['token'=>$token]);
        if(empty($token_info)) {
           $this->ajax_return('10000','login first');
        }
        
        $this->member_info = $this->member_model->where(array('member_id' => $token_info['member_id']))->find();
        if(empty($this->member_info)) {
            $this->ajax_return('10000','login first');
        }
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
}
