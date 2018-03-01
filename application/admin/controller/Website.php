<?php
namespace app\admin\controller;
class Website extends Adminbase
{
	protected $web_model;
	public function _initialize() {
		parent::_initialize();
		$this->web_model = model('Navigation');
	}

	/**
	*	导航首页
	*/
	public function navigation(){
		$nav_data = $this->web_model->order('nav_sort asc')->select()->toArray();

		$this->assign('nav_data',$nav_data);
		return $this->fetch();
	}

	/**
	*	添加导航
	*/
	public function add(){
		return $this->fetch();
	}

	/**
	*	添加导航提交
	*/
	public function add_post(){
		if(request()->isPost()){
			$param = input('post.');

			$nav_title = strip_tags($param['nav_title']);
			if(empty($nav_title)){
				$this->error('导航标题不能为空');
			}

			$data = [
				'nav_title' => $nav_title,
				'nav_url' => $param['nav_url'],
				'nav_sort' =>$param['nav_sort']		
			];

			$result = $this->web_model->save($data);
			if($result === false){
				$this->error('添加失败');
			}

			$this->success('添加成功',url('navigation'));
		}
	}

	/**
	*	修改导航
	*/
	public function edit(){
		$nav_id = input('get.nav_id',0,'intval');
		$nav_info = $this->web_model->where(['nav_id'=>$nav_id])->find();

		$this->assign('nav_info',$nav_info);
		return $this->fetch();
	}

	/**
	*	修改导航
	*/
	public function edit_post(){
		if(request()->isPost()){
			$param = input('post.');

			$nav_title = strip_tags($param['nav_title']);
			if(empty($nav_title)){
				$this->error('导航标题不能为空');
			}

			$data = [
				'nav_title' => $nav_title,
				'nav_url' => $param['nav_url'],
				'nav_sort' =>$param['nav_sort']		
			];

			$result = $this->web_model->save($data,['nav_id'=>$param['nav_id']]);
			if($result === false){
				$this->error('修改失败');
			}

			$this->success('修改成功',url('navigation'));
		}
	}
	/**
	*	删除导航
	*/
	public function delete(){
		$nav_id = input('get.nav_id',0,'intval');
		$result = $this->web_model->where(['nav_id'=>$nav_id])->delete();

		if($result === false){
			$this->error('删除失败');
		}

		$this->success('删除成功',url('navigation'));
	}

	/**
	*	排序
	*/
	public function listorders(){
		$ids = $_POST['listorders'];

        if (!is_array($ids)) {
            $this->error("参数错误！");
        }
        foreach ($ids as $key => $r) {
            if ($r > 0) {
                $this->web_model->save(['nav_sort' => $r],['nav_id' => $key]);
            }
        }
        $this->success("排序更新成功！");
	}

}