<?php
namespace app\video\controller;
use Lib\Http;
use think\Request;
class Course extends Appbase{
    protected $nav_model,$member_model,$article,$course_model;
    protected function _initialize(){
        parent::_initialize();
        $this->nav_model = model('Navigation');
        $this->member_model = model('Member');
        $this->article_model = model('Article');
        $this->course_model = model('Course');
        $this->token_model = model('MemberToken');
    }
    
    /**
    *   课程条目
    */
    public function item(){
        $course_id = input('get.course_id');
        $page = input('get.page',1,'intval');
  
        $data = [
            'page' => $page,
            'course_id' => $course_id,
        ];
        
        $result = Http::ihttp_post(request()->domain().'/api/course/item', $data);
        $data = json_decode($result['content'],true);
        // dump($data);die;
        $course_info = $data['result']['course_info'];

        $count = $data['result']['count'];
        $article = $video = [];
        if(isset($data['result']['article'])){
            $article = $data['result']['article'];
        }
       
        if(!empty($data['result']['video'])){
            $video = $data['result']['video'];
        }
        $count = count($article);

        $this->assign('course_info',$course_info);
        $this->assign('article',$article);
        $this->assign('video',$video);
        $this->assign('count',$count);
        return $this->fetch();
    }

    /**
    *   已购课程
    */
    public function buy_course(){
        // if(empty($token)){
        //     $this->redirect('Open/login');
        // }
        $token = '692a9fdd83818bc418f46718e22d2e1f';
        $token_info = $this->token_model->where(['token'=>$token])->find();
        $buy_course = $this->member_model->where(['member_id'=>$token_info['member_id']])->value('buy_course');
        $course_info = $this->course_model->field('thumb,title,author_name')->where(['course_id'=>['in',$buy_course]])->select();
        $this->assign('course_info',$course_info);
        return $this->fetch();
    }

    /**
    *   播放历史
    */
    public function play_history(){
        return $this->fetch();
    }

    /**
    *   图文详情
    */
    public function detail(){
        $course_id = input('get.course_id');
        $article_id = input('get.article_id','article_id','intval');
        $token = session('token');
        $data = [
            'token' => '692a9fdd83818bc418f46718e22d2e1f',
            'course_id' => $course_id,
            'article_id' => $article_id
        ];
        
        $result = Http::ihttp_post(request()->domain().'/api/course/article_detail',$data);
        $data = json_decode($result['content'],true);
        
        if($data['code'] == 200){
            $content = $data['result'];
            $this->assign('content',$content);
            return $this->fetch();
        }elseif($data['code'] == 10000){
            $this->redirect('open/login');
        }elseif($data['code'] == 10050){
            $this->error('该课程为付费课程');
        }
    }
}
