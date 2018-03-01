<?php
namespace app\admin\controller;
use think\File;
class Member extends Adminbase
{
	protected $member_model,$nav_model;
	public function _initialize() {
		parent::_initialize();
		$this->member_model = model("Member");
		$this->nav_model = model('Navigation');
	}

	/**
	*  会员添加
	*/
	public function index(){
		$where=array();
        $param = input('param.');
        if(!empty($param['keyword'])){
            $keyword = trim($param['keyword']);
            $where['member_mobile'] = ['like',"%$keyword%"];
        }
        $count = $this->member_model->where($where)->count();
        $list = $this->member_model->where($where)->order('member_id desc')->paginate(15,$count);

    	$page = $list ->render();
        $this->assign('page',$page);
        $this->assign('list',$list);
        return $this->fetch();
	}

	/**
	*  会员添加
	*/
	public function add(){
		$nav_data = $this->nav_model->select()->toArray();
		$this->assign('nav_data',$nav_data);
		return $this->fetch();
	}

	/**
	*  会员添加提交
	*/
	public function add_post(){
	 	if(request()->isPost()){
	 		$param = input('post.');

	 		if(empty($param['member_mobile']) || !is_mobile($param['member_mobile'])){
	            $this->error("手机号码无效");
			}

			$data = [];
			$has_info = $this->member_model->where(['member_mobile'=>$param['member_mobile']])->count();
			if($has_info > 0){
				$this->error('该手机号已经被注册');
			}

			if(!empty($param['member_limit'])){
				$member_limit = implode(',', $param['member_limit']);
				$data['member_limit'] = $member_limit;
			}

			$member_name = trim($param['member_name']);
			if(empty($member_name)){
				$this->error("昵称不能为空");
			}

			if(empty($param['member_pass'])){
	            $this->error('密码不能为空');
			}

			if(!empty($course_id)){
				$data['buy_course'] = $course_id;
			}

			//随机生成散列码
			$rand_num = random_string(6);
			$member_pass = sp_password($param['member_pass'],$rand_num);
			
			$data['member_mobile'] = $param['member_mobile'];
			$data['encrypt'] = $rand_num;
			$data['member_pass'] = $member_pass;
			$data['member_name'] = $param['member_name'];
			$data['member_time'] = time();
			$data['login_time'] = time();
			$data['login_ip']  = get_client_ip();
			$data['buy_course'] = $course_id;

			$result = $this->member_model->save($data);
			if($result === false){
				$this->error("添加会员失败!");
			}

			$this->success("添加会员成功!",url('member/index'));
		}
	}
	
	/**
	*  会员编辑
	*/
	public function edit(){
		$member_id = input('get.id',0,'intval');
		if (empty($member_id)) {
            $this->error('参数传入错误!');
		}
        $member_info = $this->member_model->where(['member_id'=>$member_id])->find();
        $member_limit = explode(',',$member_info['member_limit']);

   		$nav_data = $this->nav_model->select()->toArray();

		$this->assign('nav_data',$nav_data);
        $this->assign('member_limit',$member_limit);
        $this->assign('member_info',$member_info);
        return $this->fetch();
	}

	/**
	*  会员编辑提交
	*/
	public function edit_post(){  
		if(request()->isPost()){
			$param = input('post.');
			if(empty($param['member_mobile']) || !is_mobile($param['member_mobile'])){
	            $this->error("手机号码格式不正确");
			}

			$member_name = trim($param['member_name']);
			if(empty($member_name)){
				$this->error("昵称不能为空");
			}

			if(!empty($param['member_limit'])){
				$member_limit = implode(',', $param['member_limit']);
				$data['member_limit'] = $member_limit;
			}else{
				$data['member_limit'] = '';
			}

			if(empty($param['member_pass'])){
	            $this->error('密码不能为空');
			}
			
			$rand_num = $this->member_model->where(['member_id'=>$param['member_id']])->value('encrypt');
			$member_pass = sp_password($param['member_pass'],$rand_num);
			
			$data['member_pass'] = $member_pass;
			$data['member_name'] = $param['member_name'];
			$data['member_time'] = time();
			$data['login_time'] = time();
			$data['login_ip'] = get_client_ip();
			$data['buy_course'] = $param['course_id'];

			$result = $this->member_model->save($data,['member_id'=>$param['member_id']]);
			if($result === false){
				$this->error("修改会员失败!");
			}

			$this->success("修改会员成功!",url('member/index'));
		}	
	}

	/**
	*  会员头像上传
	*/
	public function avatar_upload(){
		$file = request()->file('avatar');
        $image = \think\Image::open($file);
        $type = $image->type();
        $save_path = 'public/uploads/avatar';
        $save_name = uniqid() . '.' . $type;

		//图片缩略上传
		$image->thumb(500, 499)->save(ROOT_PATH . $save_path . '/' . $save_name);

    	//开始上传
    	if (is_file(ROOT_PATH . $save_path . '/' . $save_name)) {
    		$data = [
    			'file' => $save_name,
    			'msg'  => '上传成功',
    			'code' => 1
            ];
    		//兼容ajaxfileupload插件的数据输出模式
    		echo json_encode($data);
    	} else {
    		$data = [
    			'data' => '',
    			'msg'  => $file->getError(),
    			'code' => 0
            ];
    		echo json_encode($data);
    	}
	}

	/**
     * 图片裁剪
     */
    public function pic_cut(){
    	if (request()->isPost()) {
    		$param = input('post.');
    		$pathinfo = pathinfo($param['url']);
    		$image = \think\Image::open('.'.$param['url']);
			//将图片裁剪为300x300并保存为crop.png
			$image->crop($param['w'], $param['h'],$param['x1'],$param['y1'])->save('.'.$param['url']);
			if (!empty($param['filename'])) {
				@unlink($param['filename']);
			}
			exit($pathinfo['basename']);
    	}else{
    		$param = input('get.');
	    	$src = $param['src'];
	    	$img_src = ROOT_PATH.'public'.$src;
	    	if (empty($src) || !is_file($img_src)) {
	    		$this->error('参数错误');
	    	}
	    	$size = getimagesize($img_src);
			$param['height'] = $size[1];
			$param['width'] = $size[0];
	    	$this->assign('param',$param);
	        return $this->fetch('open/pic_cut');
    	}
    }

	/**
     * 会员锁定
     */
	public function lock(){
		$member_id = input("get.id",0,"intval");
		if(!empty($member_id)){
			$result = $this->member_model->save(['member_state'=>0],['member_id'=>$member_id]);
	        if ($result !== false) {
	        	model('member_token')->where(['member_id'=>$member_id])->delete();
	    		$this->success("会员锁定成功",url("member/index"));
	    	}else{
	    		$this->error("锁定失败！");
	    	}
		}else{
			$this->error("传入数据有误!");
		}
	}

	/**
     * 会员解锁
     */
	public function unlock(){
		$member_id = input("get.id",0,"intval");
		if(!empty($member_id)){
			$result = $this->member_model->save(array('member_state'=>1),array('member_id'=>$member_id));
	        if ($result !== false) {
	    		$this->success("会员锁定成功",url("member/index"));
	    	}else{
	    		$this->error("锁定失败！");
	    	}
    	}else{
    		$this->error("传入数据有误!");
    	}
	}
}