<?php
namespace app\video\controller;
use Lib\Http;
use think\Request;
class Open extends Appbase{
	protected $nav_model,$member_model;
	protected function _initialize(){
        parent::_initialize();
        $this->nav_model = model('Navigation');
        $this->token_model = model('MemberToken');
        $this->member_model = model('Member');
    }
    
     /**
    *   登录页面
    */
    public function login(){
        return $this->fetch();
    }
    /**
    *   页面登录
    */
    public function check_login(){
        $member_mobile = input('post.member_mobile');
        if(empty($member_mobile) || !is_mobile($member_mobile)){
            return ['code'=>10001];exit;
        }

        $member_pass = input('post.member_pass');
        if(empty($member_pass)){
            return ['code'=>10001];exit;
        }

        $data = [
            'member_mobile' => $member_mobile,
            'member_pass' => $member_pass,
        ];
        
        $result = Http::ihttp_post(request()->domain().'/api/open/login', $data);
        $data = json_decode($result['content'],true);
        
        if($data['code'] == '200'){
            session('token',$data['result']);
            return ['code'=>200];
        }else{
            return ['code'=>10012];
        }
    }

    /**
    *   页面登录
    */
    public function dologin(){
        if(request()->isPost()){
            $member_mobile = input('post.member_mobile','','trim');

            $member_pass = input('post.member_pass');
            $has_info = $this->member_model->where(['member_mobile'=>$member_mobile])->find();
   
            if($has_info['is_login'] != 1){
                $is_equal = sp_password($member_pass,$has_info['encrypt']) == $has_info['member_pass'] ? 1 : 0;
                if(empty($has_info) || $is_equal < 1){
                    return ['code'=>10001];exit;
                }

                $data = [
                    'is_login' => 1,
                    'login_time' => time(),
                    'login_ip' => get_client_ip()
                ];

                $result = $this->member_model->save($data,['member_id'=>$has_info['member_id']]);
                if(!empty($result)){
                    // session('member_id',$has_info['member_id']);
                    // session('member_name',$has_info['member_name']);
                    // cookie("member_name",$has_info['member_name']);
                    session('token',$data['result']);
                    return ['code'=>200];
                }else{
                    return ['code'=>10012];exit;
                }
            }else{
                $this->error('当前用户已登录');
            }

            
        }
    }

     /**
    *   注册页面
    */
    public function register(){
		return $this->fetch();
    }

    /**
    *   用户注册
    */
    public function doregister(){
    	if(request()->isPost()){
    		$param = input('post.');
    		if(empty($param['member_mobile']) || !is_mobile($param['member_mobile'])){
                return ['code'=>10001];
                exit;
    		}

            $has_info = $this->member_model->where(['member_mobile'=>$param['member_mobile']])->find();
            if(!empty($has_info)){
                return ['code'=>10001];exit;
            }
    		$member_name = strip_tags($param['member_name']);
    		if(empty($member_name) || !is_username($member_name)){
    			// $this->error('昵称格式不正确');
                return ['code'=>10002];exit;
    		}

    		$member_pass = trim(strip_tags($param['member_pass']));
    		if(empty($member_pass)){
    			// $this->error('密码不能为空');
                return ['code'=>10003];exit;
    		}

    		$member_confirm = trim(strip_tags($param['member_confirm']));
    		if(empty($member_pass)){
    			// $this->error('确认密码不能为空');
                return ['code'=>10004];exit;
    		}

    		if($member_pass !== $member_confirm){
    			// $this->error('两次密码输入不一致');
                return ['code'=>10005];exit;
    		}

    		//随机生成散列码
			$rand_num = random_string(6);
			$member_pass = sp_password($member_pass,$rand_num);
    		$data = [
    			'member_mobile' => $param['member_mobile'],
    			'member_pass' => $member_pass,
    			'encrypt' => $rand_num,
    			'member_name' => $member_name,
    			'member_time' => time()
    		]; 

    		$result = $this->member_model->save($data);
    		if(empty($result)){
                return ['code'=>10006];exit;
    		}
    		return ['code'=>200];
    	}
    }

     /**
    *   用户退出
    */
    public function logout(){
        $token = input('get.token','','trim');
        $session = session('token');
        if($token !== $session['token']){
            return ['code'=>2001];exit;
        }
        session('token',null);
        $this->redirect('member/index');
    }
}
