<?php
namespace app\api\controller;
class Open extends Apibase{
	protected $nav_model,$member_model,$token_model;
	protected function _initialize(){
        parent::_initialize();
        $this->nav_model = model('Navigation');
        $this->member_model = model('Member');
        $this->token_model = model('MemberToken');
    }
    
    /**
    *   页面登录
    */
    public function login(){
        if(request()->isPost()){
            $member_mobile = input('post.member_mobile','','trim');

            $member_pass = input('post.member_pass');
            $has_info = $this->member_model->where(['member_mobile'=>$member_mobile])->find();
            
            if(empty($has_info)){
                $this->ajax_return('10010','member is not exist');
            }

            $is_equal = sp_password($member_pass,$has_info['encrypt']) == $has_info['member_pass'] ? 1 : 0;
            if($is_equal < 1){
                $this->ajax_return('10011','member_pass is wrong');
            }

            $data = [
                'is_login' => 1,
                'login_time' => time(),
                'login_ip' => get_client_ip()
            ];

            $token = $this->_get_token($has_info['member_id'], $member_mobile);
        
            if(empty($token)){
                $this->ajax_return('10012','failed to login');
            }
            
            $result = $this->member_model->save($data,['member_id'=>$has_info['member_id']]);
            $member_info = [
                'member_name' => $has_info['member_name'],
                'token' => $token
            ];

            $this->ajax_return('200','success',$member_info);
        }
    }

     /**
    *   注册
    */
    public function register(){
        if(request()->isPost()){
            $param = input('post.');
            if(empty($param['member_mobile']) || !is_mobile($param['member_mobile'])){
                $this->ajax_return('10001','invalid member_mobile');
            }

            $member_name = strip_tags($param['member_name']);
            if(empty($member_name) || !is_username($member_name)){
                $this->ajax_return('10002','invalid member_name');
            }

            $member_pass = trim(strip_tags($param['member_pass']));
            if(empty($member_pass)){
                $this->ajax_return('10003','pass is not empty');
            }

            $member_confirm = trim(strip_tags($param['member_confirm']));
            if(empty($member_pass)){
                $this->ajax_return('10004','confirm pass is not empty');
            }

            $has_info = $this->member_model->where(['member_mobile'=>$param['member_mobile']])->find();
            if(!empty($has_info)){
                $this->ajax_return('10007','the member exist');
            }

            if($member_pass !== $member_confirm){
                $this->ajax_return('10005','two pass is not equal');
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
                $this->ajax_return('10006','failed to register');
            }

            $this->ajax_return('200','success');
        }
    }

    /**
     * 登录生成token
     *
     */
    private function _get_token($member_id, $mobile) {
        $condition = array();
        $condition['member_id'] = $member_id;
        $condition['mobile'] = $mobile;

        $token_info = $this->token_model->get_token($condition);
        //生成新的token
        $data = array();
        $token = md5($mobile . strval(time()) . strval(rand(0,999999)));
        $data['token'] = $token;
        $data['create_time'] = time();

        if (empty($token_info)) {
            $data['member_id'] = $member_id;
            $data['mobile'] = $mobile;
            $result = $this->token_model->add_token($data);
        }else{
            $result = $this->token_model->update_token($condition,$data);
        }
        
        if($result) {
            return $token;
        } else {
            return null;
        }

    }
    /**
    *   用户注册
    */
    public function doregister(){
    	if(request()->isPost()){
    		$param = input('post.');
    		if(empty($param['member_mobile']) || !is_mobile($param['member_mobile'])){
    			$this->error('请填写正确的手机号');
    		}

    		$member_name = strip_tags($param['member_name']);
    		if(empty($member_name) || !is_username($member_name)){
    			$this->error('昵称格式不正确');
    		}

    		$member_pass = trim(strip_tags($param['member_pass']));
    		if(empty($member_pass)){
    			$this->error('密码不能为空');
    		}

    		$member_confirm = trim(strip_tags($param['member_confirm']));
    		if(empty($member_pass)){
    			$this->error('确认密码不能为空');
    		}

    		if($member_pass !== $member_confirm){
    			$this->error('两次密码输入不一致');
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
    			$this->error('注册失败');
    		}
    		$this->redirect('login');
    	}
    }

     /**
    *   用户退出
    */
    public function logout(){
        session('member_id',null);
        session('member_name',null);  
        cookie('member_name',null);
        // $data = ['is_login'=>0];
        // $result = $this->member_model->save();
        $this->redirect('index/index');
    }
}
