<?php
namespace app\video\controller;
use Lib\Http;
use think\Request;
class Index extends Appbase{
	protected function _initialize(){
        parent::_initialize();
        $this->nav_model = model('Navigation');
        $this->course_model = model('Course');
        $this->cate_model = model('Category');
    }
    
    public function index(){
        $page = input('get.page','',1);
        $data['page'] = $page; 
    	$result = Http::ihttp_post(request()->domain().'/api/index', $data);
        $data = json_decode($result['content'],true);
        $course_info = $data['result']['course'];
   
        $this->assign('course_info',$course_info);
		return $this->fetch();
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
