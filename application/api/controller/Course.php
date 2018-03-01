<?php
namespace app\api\controller;
class Course extends Apibase{
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
        $course_id = input('post.course_id',0,'intval');
    
        $page = input('post.page',1,'intval');
        // $type = input('post.type','','trim');
        // $item_type = ['article','video'];

        // if(!in_array($type, $item_type)){
        //     $this->ajax_return('10020','type is not exist');
        // }

        //数据分页
        $count = $this->article_model->where(['status'=>1,'course_id'=>$course_id])->count();
        
        $page_num = 1000;
        $page_count = ceil($count / $page_num);
        $limit = 0;
        if ($page > 0) {
            $limit = ($page - 1) * $page_num;
        }else{
            $limit = 0;
        }

        $data = ['article'=>[],'video'=>[]];
        $course_info = $this->course_model->where(['course_id'=>$course_id])->find();
        $is_free = $course_info['course_money'] > 0 ? 1 : 0;
        $course_data = ['title'=>$course_info['title'],'thumb'=>$course_info['thumb'],'top_thumb'=>$course_info['top_thumb'],'course_money'=>$course_info['course_money'],'is_free'=>$is_free];

        $data['course_info'] = $course_data;
        $data['count'] = $count;
        // if($type == 'article'){
            $article_data = $this->article_model->where(['status'=>1,'course_id'=>$course_id])->limit($limit,$page_num)->order('create_time asc')->select()->toArray();
           
            if(!empty($article_data)){
                foreach($article_data as $art_key=>$art_val){
                    $tmp = [];
                    $tmp['article_id'] = $art_val['article_id'];
                    $tmp['title'] = $art_val['title'];
                    $tmp['course_id'] = $art_val['course_id'];
                    $tmp['create_time'] = $art_val['create_time'];
                    $data['article'][] = $tmp;
                }
            }
        // }
        
        // if($type == 'video'){
            if(!empty($article_data)){
                foreach($article_data as $art_key=>$art_val){
                    if(!empty($art_val['audio'])){
                        $tmp = [];
                        $tmp['article_id'] = $art_val['article_id'];
                        $tmp['title'] = $art_val['title'];
                        $tmp['url'] = $art_val['audio'];
                        $tmp['course_id'] = $art_val['course_id'];
                        $tmp['create_time'] = $art_val['create_time'];
                        $data['video'][] = $tmp;
                    }
                }
            }
        // }

        $this->ajax_return('200','success',$data);
    }

    /**
    *   文章详情
    */
    public function article_detail(){
        // 1.游客、会员都可访问课程
        // 2.对于付费课程会员购买后才可访问旗下课程
        // 3.对于游客仅能访问5篇免费课程
        $token = input('post.token','','trim');
        $course_id = input('post.course_id',0,'intval');
        $article_id = input('post.article_id',0,'intval');
        $course_info = $this->course_model->field('course_money,thumb,author_name')->where(['course_id'=>$course_id])->find();
        $is_free = $course_info['course_money'] > 0 ? 1 : 0;

        if(!empty($token)){
            $member_id = $this->token_model->where(['token'=>$token])->value('member_id');
            if($is_free > 0){
                $buy_course = $this->member_model->where(['member_id'=>$member_id])->find();
                $buy_course = explode(',', $buy_course['buy_course']);
                
                if(!in_array($course_id,$buy_course)){
                    $this->ajax_return('10050','the course is not free');
                }
            }else{
                $this->article_model->where(['article_id'=>$article_id])->setInc('view_nums');
            }
        }else{
            if($is_free > 0){
                $this->ajax_return('10050','the course is not free');
            }else{
                $this->article_model->where(['article_id'=>$article_id])->setInc('view_nums');
                $client_ip = get_client_ip();
                $view_data = $this->article_model->where(['client_ip'=>$client_ip])->find();
                $data = [
                    'client_ip' => $client_ip,
                ];

                if(!empty($view_data)){
                    if($view_data['view_nums'] > 5){
                        $this->ajax_return('10000','login first');
                    }else{
                        $this->article_model->save($data);
                    }
                }else{
                     $this->article_model->save($data);
                }
            }
        }

        $article_info = $this->article_model->where(['article_id'=>$article_id])->find();
        $data = [
            'title' => $article_info['title'],
            'audio' => $article_info['audio'],
            'content' => $article_info['content'],
            'create_time' => $article_info['create_time'],
            'author_name' => $course_info['author_name'],
            'thumb' => $course_info['thumb'],
        ];

        $this->ajax_return('200','success',$data);
    }
}
