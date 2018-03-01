<?php
namespace app\api\controller;
class Index extends Apibase{
	protected function _initialize(){
        parent::_initialize();
        $this->nav_model = model('Navigation');
        $this->course_model = model('Course');
        $this->cate_model = model('Category');
    }
    
    /**
    *   首页信息
    **/
    public function index(){
    	$page = input('post.page',1,'intval');
        //数据分页
        $count = $this->course_model->where(['is_use'=>1])->count();
        $page_num = 9;
        $page_count = ceil($count / $page_num);
        $limit = 0;
        if ($page > 0) {
            $limit = ($page - 1) * $page_num;
        }else{
            $limit = 0;
        }

		$course_data = $this->course_model->where(['is_use'=>1])->limit($limit,$page_num)->order('course_id desc')->select()->toArray();

        $data = ['category'=>[],'course'=>[]];
         //导航
        $nav_data = $this->nav_model->order('nav_sort asc')->select()->toArray();
        if(!empty($nav_data)){
            foreach($nav_data as $nav_key=>$nav_val){
                $tmp = [];
                $tmp['nav_title'] = $nav_val['nav_title'];
                $tmp['nav_id'] = $nav_val['nav_id'];
                $data['category'][] = $tmp;
            }
        }

        //课程
        if(!empty($course_data)){
            foreach($course_data as $cour_key=>$cour_val){
                $tmp = [];
                $tmp['course_id'] = $cour_val['course_id'];
                $tmp['title'] = $cour_val['title'];
                $tmp['thumb'] = $cour_val['thumb'];
                $tmp['author_name'] = $cour_val['author_name'];
                $data['course'][] = $tmp;
            }
        }
        
        $this->ajax_return('200','success',$data);
    }

    public function action(){
    	$action_name = input('get.action');
    	$nav_id = input('get.nav_id');
    	$course_data = $this->course_model->where(['is_use'=>1,'nav_id'=>$nav_id])->select()->toArray();

    	$cate_data = $this->cate_model->select()->toArray();
    	foreach($cate_data as $cate_key => $cate_val){
    		$tmp = [];
    		foreach($course_data as $co_key=>$co_val){
    			if($co_val['cate_id'] == $cate_val['category_id']){
    				$tmp[] = $co_val;
    			}
    		}
    		$cate_data[$cate_key]['data'] = $tmp;
    	}
    
    	$this->assign('course_data',$course_data);
    	$this->assign('cate_data',$cate_data);
    	$this->assign('nav_id',$nav_id);
    	return $this->fetch($action_name);
    }
}
