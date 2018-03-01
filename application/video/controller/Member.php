<?php
namespace app\video\controller;
use Lib\Http;
use think\Request;
class Member extends Appbase{
	protected function _initialize(){
        parent::_initialize();
        $this->token_model = model('MemberToken');
        $this->member_model = model('Member');
        if(empty(session('token'))){
            $this->redirect('Open/login');
        }else{
            $session = session('token');
            $this->token = $session['token'];
        }
    }
    
    /**
    *   我的页
    */
    public function index(){
        $token_info = $this->token_model->where(['token'=>$this->token])->find();
        
        $member_info = $this->member_model->field('member_name,member_avatar,buy_coupon,speed')->where(['member_id'=>$token_info['member_id']])->find();
        $buy_coupon = empty($member_info['buy_coupon']) ? 0 : $member_info['buy_coupon'];

        $speed = $member_info['speed'] == 0 ? '正常' : $member_info['speed'];
        $this->assign('buy_coupon',$member_info['buy_coupon']);
        $this->assign('member_name',$member_info['member_name']);
        $this->assign('member_avatar',$member_info['member_avatar']);
        $this->assign('token',$this->token);
        $this->assign('speed',$speed);
		return $this->fetch();
    }

    /**
    *   修改密码
    */
    public function change_pass(){
		return $this->fetch();
    }

    /**
    *   设置播放速度
    */
    public function set_speed(){
        $speed = input('post.speed',1,'intval');
        $data = [
            'token' => $this->token,
            'speed' => $speed
        ];
        $result = Http::ihttp_post(request()->domain().'/api/buy/set_speed', $data);
        $data = json_decode($result['content'],true);
        
        return $this->fetch();
    }
}
