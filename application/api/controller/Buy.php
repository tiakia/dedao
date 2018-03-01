<?php
namespace app\api\controller;
class Buy extends Auth{
	protected $order_model,$course_model;
	public function _initialize(){
        parent::_initialize();
        $this->member_model = model('Member');
        $this->course_model = model('Course');
    }
    
    /**
    *   购买课程
    */
    public function buy_course(){
        $course_info = $this->course_model->where(['course_id'=>['in',$this->member_info['buy_course']]])->select()->toArray();
        $data = [];
        if(!empty($course_info)){
            foreach($course_info as $co_key=>$co_val){
                $tmp = [];
                $tmp['thumb'] = $co_val['thumb'];
                $tmp['course_id'] = $co_val['course_id'];
                $tmp['title'] = $co_val['title'];
                $tmp['author_name'] = $co_val['author_name'];
                $data[] = $tmp;
            }
        }
        $this->ajax_return('200','success',$data);
    }

    /**
    *   设置播放速度
    */
    public function set_speed(){
        $speed = input('post.speed');
        if(empty($speed)){
            $this->ajax_return('10041','invalid speed');
        }

        $data = [
            'speed' => $speed
        ];

        $result = $this->member_model->save($data,['member_id'=>$this->member_info['member_id']]);
        if(empty($result)){
            $this->ajax_return('10040','failed to update');
        }

        $this->ajax_return('200','success',$data);
    }
}
