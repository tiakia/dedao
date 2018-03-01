<?php
/**
 * 春雨医生异步通知处理
 */
namespace app\open\controller;
use think\Controller;
use Lib\Http;
class SpringNotify extends Controller {

	//春雨合作方key
	protected $partner_key;
	protected $msg_model,$member_model;
	public function _initialize() {
		$this->partner_key = 'iEv8qLQ5BN2nCG9y';
		$this->msg_model = model('Message');
	}

	/**
	 * 医生回复通知
	 */
	public function doctor_reply(){
		$param = input('post.');

		$sign = isset($param['sign']) ? trim($param['sign']) : '';
		if($sign !== $this->get_sign($param['problem_id'])){
			$this->ajax_return('1','签名不正确');
		}

		$msg_status = $param['dotor']['name'].'医生回复了您的问题';
		
		$result = $this->msg_storage($param['user_id'],$param['problem_id'],$msg_status);
		if($result === false){
			$this->ajax_return('2','存储消息失败');
		}

		$this->ajax_return('0','问题回复通知成功');
	}

	/**
	 * 问题关闭通知
	 */
	public function problem_close(){
		$param = input('post.');

		$sign = isset($param['sign']) ? trim($param['sign']) : '';
		if($sign !== $this->get_sign($param['problem_id'])){
			$this->ajax_return('1','签名不正确');
		}

		$status = ['close','refund'];
		$msg_status = in_array($param['status'],$status) && $param['status'] == 'close' ? '您提交的问题已回答完成自动关闭' : '您提交的问题已关闭，费用将原路退回到您的账户';
		
		$result = $this->msg_storage($param['user_id'],$param['problem_id'],$msg_status);
		if($result === false){
			$this->ajax_return('2','存储消息失败');
		}

		$this->ajax_return('0','问题关闭通知成功');
	}

	/**
    * 全局中断输出
    * @param $code string 响应码
    * @param $msg string 简要描述
    */
    public function ajax_return($code = 0,$msg = ''){
    	$data = array(
            'error'   => (int)$code,
            'error_msg'   =>  $msg,
        );
        ajax_return($data);
    }

    /**
	* 获取认证码
	*/
	protected function get_sign($problem_id = 0){
		if (empty($problem_id)) {
			return false;
		}

		$time = time();
		$sign = substr(md5($this->partner_key.$time.$problem_id), 8, 16);
		
		return $sign;
	}

	/**
	* 存储信息
	*/
	protected function msg_storage($user_id,$problem_id,$msg_status){
		$detail_data = [
			'user_id' => $user_id,
			'partner' => $this->$this->partner_key,
			'problem_id' => $problem_id,
			'sign' => $this->get_sign($problem_id),
			'atime' => time()
		];

		$detail_url = '/cooperation/wap/get_partner_problem_detail/?'.http_build_query($detail_data);

		$msg_data = [
			'to_member_id' => $user_id,
			'message_title' => $msg_status,
			'message_body' => $detail_url,
			'message_time' => time(),
			'message_type' => 3,
		];

		$result = $this->msg_model->save($msg_data);
		if($result === false){
			return false;
		}
		return true;
	}
}