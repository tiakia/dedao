<?php
namespace app\admin\controller;
class Course extends Adminbase
{
	protected $ver_model,$nav_model,$cat_model,$article_model;
	public function _initialize() {
		parent::_initialize();
		$this->course_model = model('Course');
		$this->nav_model = model('Navigation');
		$this->cat_model = model('Category');
		$this->article_model = model('Article');
	}

	//课程管理首页
	public function index(){
		$course_name = input('get.course_name','','trim');
		$author_name = input('get.author_name','','trim');
		$course_id = input('get.course_id',0,'intval');
		$is_free = input('get.is_free');
		
		$where = [];
		if(!empty($course_name)){
			$where['title'] = ['like','%'.$course_name.'%'];
		}

		if(!empty($author_name)){
			$where['author_name'] = ['like','%'.$author_name.'%'];
		}

		if(!empty($course_id)){
			$where['course_id'] = ['eq',$course_id];
		}

		$type = ['0','1'];
		if(isset($is_free) && in_array($is_free, $type)){
			$where['is_free'] = ['eq',$is_free];
		}
		
		$count = $this->course_model->where($where)->count();
		
        $lists = $this->course_model->where($where)->order('course_id desc')->paginate(10,$count);

        $nav_data = $this->nav_model->select()->toArray();
        $cat_data = $this->cat_model->select()->toArray();

        foreach($lists as $co_key=>$co_val){
        	foreach($nav_data as $nav_key=>$nav_val){
        		if($co_val['nav_id'] == $nav_val['nav_id']){
        			$lists[$co_key]['plat_name'] = $nav_val['nav_title'];
        			break;
        		}
        	}

        	foreach($cat_data as $cat_key=>$cat_val){
        		if($co_val['cate_id'] == $cat_val['category_id']){
        			$lists[$co_key]['cate_name'] = $cat_val['catname'];
        			break;
        		}
        	}
        }
   
        $page = $lists->render();
        $this->assign('page',$page);
        $this->assign('lists', $lists);
        
        return $this->fetch();
	}

	/**
	* 课程添加
	*/
	public function add(){
		//导航
		$plat_data = $this->nav_model->where(['nav_type'=>0])->order('nav_id desc')->select()->toArray();
		//文章分类
		$last_nav = $this->nav_model->where(['nav_type'=>0])->order('nav_id desc')->value('nav_id');
		$cat_data = $this->cat_model->where(['status'=>1,'nav_id'=>$last_nav])->select()->toArray();
		$this->assign('cat_data',$cat_data);
		$this->assign('plat_data',$plat_data);
		return $this->fetch();
	}

	/**
	* 获取二级导航(文章分类)
	*/
	public function get_second(){
		$nav_id = input('post.nav_id',1,'intval');
		//文章分类
		$cat_data = $this->cat_model->where(['status'=>1,'nav_id'=>$nav_id])->select()->toArray();
		return $cat_data;
	}

	/**
	* 课程添加提交
	*/
	public function add_post(){
		if (request()->isPost()) {
			$data = [];
			$param = input('post.');
			if(empty($param['thumb'])){
				$this->error('请上传封面头像');
			}

			if(empty($param['top_thumb'])){
				$this->error('请上传顶部头像');
			}

			$nav = intval($param['to_nav']);
			if(empty($nav)){
				$this->error('平台不能为空');
			}

			$course_name = strip_tags($param['course_name']);
			if(empty($course_name)){
				$this->error('课程名称不能为空');
			}

			$author = strip_tags($param['author']);
			if(empty($author)){
				$this->error('作者不能为空');
			}

			if(empty($param['category'])){
				$this->error('课程分类不能为空');
			}

			$course_money = intval($param['course_money']);
			$data['title'] = $course_name;
			$data['author_name'] = $author;
			$data['nav_id'] = $nav;
			$data['thumb'] = $param['thumb'];
			$data['top_thumb'] = $param['top_thumb'];
			$data['cate_id'] = $param['category'];
			$data['add_time'] = time();
			$data['course_money'] = $course_money;

			$result = $this->course_model->save($data);
			if($result === false){
				$this->error('添加失败');
			}

			$this->success('添加成功',url('index'));
		}
	}

	/**
	* 课程编辑
	*/
	public function edit(){
		$course_id = input('get.course_id',0,'intval');

        $course_info = $this->course_model->where(['course_id'=>$course_id])->find();
        if (empty($course_info)) {
            $this->error('参数错误');
        }

        //导航
		$plat_data = $this->nav_model->where(['nav_type'=>0])->order('nav_id desc')->select()->toArray();
		//文章分类
		$cat_data = $this->cat_model->where(['status'=>1])->select()->toArray();
		$this->assign('cat_data',$cat_data);
		$this->assign('plat_data',$plat_data);
		$this->assign('course_info',$course_info);
        return $this->fetch();
	}

	/**
	* 课程编辑提交
	*/
	public function edit_post(){
		if (request()->isPost()) {
			$param = input('post.');
			if(empty($param['thumb'])){
				$this->error('请上传封面头像');
			}

			if(empty($param['top_thumb'])){
				$this->error('请上传顶部头像');
			}
			
			$nav = intval($param['to_nav']);
			if(empty($nav)){
				$this->error('平台不能为空');
			}

			$course_name = strip_tags($param['course_name']);
			if(empty($course_name)){
				$this->error('课程名称不能为空');
			}

			$author = strip_tags($param['author']);
			if(empty($author)){
				$this->error('作者不能为空');
			}

			if(empty($param['category'])){
				$this->error('课程分类不能为空');
			}

			$course_money = intval($param['course_money']);
			$data = [
				'title' => $course_name,
				'author_name' => $author,
				'nav_id' => $nav,
				'thumb' => $param['thumb'],
				'top_thumb' => $param['top_thumb'],
				'cate_id' => $param['category'],
				'course_money' => $course_money,
				'add_time' => time()
			];

			$result = $this->course_model->save($data,['course_id'=>$param['course_id']]);
			if($result === false){
				$this->error('修改失败');
			}

			$this->success('修改成功',url('index'));
		}
	}

	/**
	* 课程删除
	*/
	public function delete(){
		$course_id = input('get.course_id',0,'intval');

		$article_data = $this->article_model->where(['course_id'=>$course_id])->select()->toArray();

		if(!empty($article_data)){
    		$this->error('课程下存在文章不能删除!');
		}else{
			$result = $this->course_model->where(['course_id'=>$course_id])->delete();
			if($result === false){
				$this->error('课程删除失败！');
			}

			$this->success('课程删除成功',url('index'));
		}
	}

	/**
	* 课程下架
	*/
	public function lock(){
		$course_id = input('get.course_id',0,'intval');
    	if (!empty($course_id)) {
    		$result = $this->course_model->save(['is_use'=>'0'],['course_id' => $course_id]);
    		if ($result!==false) {
    			$this->success("课程下架成功！");
    		} else {
    			$this->error('课程下架失败！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
	}

	/**
	* 课程上架
	*/
	public function unlock(){
		$course_id = input('get.course_id',0,'intval');
    	if (!empty($course_id)) {
    		$result = $this->course_model->save(['is_use' =>'1'],['course_id' => $course_id]);
    		if ($result!==false) {
    			$this->success("课程上架成功！");
    		} else {
    			$this->error('课程上架失败！');
    		}
    	} else {
    		$this->error('数据传入失败！');
    	}
	}
}