<?php
namespace app\admin\controller;
use Rbac\Tree;
class Article extends Adminbase
{
    protected $article_model;
	public function _initialize() {
		parent::_initialize();
		$this->article_model = model("article");
	}

	//文章管理首页
	public function index(){
		$course_id = input('get.course_id',0,'intval');
	    $query = [];
		if(request()->isGet()){   
			$where = [];
			$category = input('get.category',0,'intval');
			if(!empty($category)){
                $query['cate_id'] = $category;
				$where['cate_id'] = $category;
			}
			
			$start_time = input('get.start_time');
			if(!empty($start_time)){
				$start_time = strtotime($start_time);
                $query['start_time'] = strtotime($start_time);
				$where['create_time'] = ['egt',$start_time];
			}

			$end_time = input('get.end_time');
			if(!empty($end_time)){
				$end_time = strtotime($end_time);
				$query['end_time'] = strtotime($end_time);
				$where['create_time'] = ['lt',$end_time];
			}

	        $end_time = input('get.end_time');
			if(!empty($start_time) && !empty($end_time)){
                $query['start_time'] = strtotime($start_time);
				$start_time = strtotime($start_time);
                $query['end_time'] = strtotime($end_time);
				$over_time = strtotime($end_time);
				$where['create_time'] = [['egt',$start_time],['lt',$over_time]];
			}
			$keywords = trim(input('get.keywords'));
			if(!empty($keywords)){
                $query['keywords'] = $keywords;
				$where['title'] = ['like','%'.$keywords.'%'];
			}
		}

		$count = $this->article_model->where(['course_id'=>$course_id])->count();
        $lists = $this->article_model->where(['course_id'=>$course_id])->order('article_id desc')->paginate(15,$count);
		
	
		// foreach ($lists as $key => $value) {
		// 	$tmp = [];
		// 	$tmp['article_id'] = $value['article_id'];
		// 	$tmp['title'] = $value['title'];
		// 	$tmp['audio'] = $value['audio'];
		// 	$tmp['create_time'] = $value['create_time'];
		// 	$tmp['status'] = $value['status'];
		// 	$data[] = $tmp;
 	//  	}

		$page = $lists->render();
        $this->assign('page',$page);
        $this->assign('lists', $lists);
		$this->assign('course_id',$course_id);
		return $this->fetch();
	}


	//文章添加
	public function add(){
		$course_id = input('get.course_id',0,'intval');
		$this->assign('course_id',$course_id);
		return $this->fetch();
	}

	//文章添加处理
	public function add_post(){
		if(request()->isPost()){
			$param = input('post.');

			$title = strip_tags($param['title']);
			if(empty($title)){
				$this->error('文章标题不能为空');
			}

			$desc = strip_tags($param['description']);
			// if(empty($desc)){
			// 	$this->error('摘要不能为空');
			// }

			$content = $param['content'];
			if(empty($content)){
				$this->error('文章内容不能为空');
			}

			$data = [
				'title' => $title,
				'audio' => $param['audio'],
				'content' => $content,
				'course_id' =>$param['course_id'],
				'description' => $desc,
				'create_time' =>time()
			];

			$result = $this->article_model->save($data);
			if($result === false){
				$this->error('添加失败');
			}

			$this->success('添加成功',url('index'));
		}
	}
	
	//文章编辑
	public function edit(){
		$course_id = input('get.course_id',0,'intval');
		$article_id = input('get.article_id',0,'intval');
		$article_info = $this->article_model->where(['article_id'=>$article_id])->find();
		
		$this->assign('article_info',$article_info);
		$this->assign('course_id',$course_id);
		return $this->fetch();
	}

	//文章编辑处理
	public function edit_post(){
		if(request()->isPost()){
			$param = input('post.');

			$title = strip_tags($param['title']);
			if(empty($title)){
				$this->error('文章标题不能为空');
			}

			$desc = strip_tags($param['description']);
			// if(empty($desc)){
			// 	$this->error('摘要不能为空');
			// }

			$content = $param['content'];
			if(empty($content)){
				$this->error('文章内容不能为空');
			}

			$data = [
				'title' => $title,
				'audio' => $param['audio'],
				'content' => $content,
				'description' => $desc,
			];

			$result = $this->article_model->save($data,['article_id'=>$param['article_id']]);
			if($result === false){
				$this->error('修改失败');
			}

			$this->success('修改成功',url('index'));
		}
	}
    
    //下架文章
	public function lock(){
		$article_id = input("get.article_id",0,"intval");
        $course_id = input("get.course_id",0,"intval");
        if(!empty($article_id)){
        	$article_result = $this->article_model->save(array("status"=>0),array("article_id"=>$article_id));
	 		if ($article_result !== false) {
	    		$this->success("下架文章成功",url("article/index",['course_id'=>$course_id]));
	    	}else{
	    		$this->error("下架失败！");
	    	}
        }else{
        	$this->error('传入数据有误!');
        }
        
	}
     
    //上架文章
	public function unlock(){
		$article_id = input("get.article_id",0,"intval");
        $course_id = input("get.course_id",0,"intval");
        if(!empty($article_id)){
        	$article_result = $this->article_model->save(["status"=>1],["article_id"=>$article_id]);
	 		if ($article_result !== false) {
	    		$this->success("上架文章成功",url("article/index",['course_id'=>$course_id]));
	    	}else{
	    		$this->error("上架失败！");
	    	}
        }else{
        	$this->error("传入数据有误!");
        }
	}

	//文章删除
	public function delete(){
		$course_id = input('get.course_id',0,'intval');
		$article_id = input('get.article_id',0,'intval');
		$result = $this->article_model->where(['article_id'=>$article_id])->delete();
		if($result === false){
			$this->error('删除失败');
		}
		$this->success('删除成功',url('index',['course_id'=>$course_id]));
	}

	// 文件上传
    public function plupload(){
        $upload_setting=sp_get_upload_setting();
        $filetypes=array(
            'image'=>array('title'=>'Image files','extensions'=>$upload_setting['image']['extensions']),
            'video'=>array('title'=>'Video files','extensions'=>$upload_setting['video']['extensions']),
            'audio'=>array('title'=>'Audio files','extensions'=>$upload_setting['audio']['extensions']),
            'file'=>array('title'=>'Custom files','extensions'=>$upload_setting['file']['extensions'])
        );
        
        $image_extensions=explode(',', $upload_setting['image']['extensions']);
        
        if (request()->isPost()) {
            $all_allowed_exts=array();
            foreach ($filetypes as $mfiletype){
                array_push($all_allowed_exts, $mfiletype['extensions']);
            }
            $all_allowed_exts=implode(',', $all_allowed_exts);
            $all_allowed_exts=explode(',', $all_allowed_exts);
            $all_allowed_exts=array_unique($all_allowed_exts);
            
            $file_extension=sp_get_file_extension($_FILES['file']['name']);
            $upload_max_filesize=$upload_setting['upload_max_filesize'][$file_extension];
            $upload_max_filesize=empty($upload_max_filesize)?2097152:$upload_max_filesize;//默认2M
            
            $app=input('post.app/s','');
            if(!in_array($app, config('configs.module_allow_list'))){
                $app='default';
            }else{
                $app= strtolower($app);
            }
            
			$savepath=$app.'/'.date('Ymd').'/';
            if(!empty($_FILES) && $_FILES['file']['size'] > 0){
				$file = request()->file('file');
				$image = \think\Image::open($file);
	        	$save_path = 'public/uploads/article';
                $type = $image->type();
	        	$save_name = uniqid() . '.' . $type;
	        	$info = $file->rule('uniqid')->validate(['size'=>$upload_max_filesize,'ext'=>$all_allowed_exts])
                    ->move(ROOT_PATH.$save_path.'/',true,false);
	        	
	        	if($info){
			        $url=config('configs.url').$info->getFilename();
                	$filepath = $savepath.$info->getSaveName();
                	ajax_return(['preview_url'=>$url,'filepath'=>$filepath,'url'=>$url,'name'=>$info->getSaveName(),'status'=>1,'message'=>'success']);
			    }else{
			    	ajax_return(['name'=>'','status'=>0,'message'=>$info->getError()]);
			    }
			}
        } else {
            $filetype = input('get.filetype/s','image');
            $mime_type=array();
            if(array_key_exists($filetype, $filetypes)){
                $mime_type=$filetypes[$filetype];
            }else{
                $this->error('上传文件类型配置错误！');
            }
            $multi=input('get.multi',0,'intval');
            $app=input('get.app/s','');
            $upload_max_filesize=$upload_setting[$filetype]['upload_max_filesize'];
            $this->assign('extensions',$upload_setting[$filetype]['extensions']);
            $this->assign('upload_max_filesize',$upload_max_filesize);
            $this->assign('upload_max_filesize_mb',intval($upload_max_filesize/1024));
            $this->assign('mime_type',json_encode($mime_type));
            $this->assign('multi',$multi);
            $this->assign('app',$app);
            return $this->fetch("open/plupload");
        }
    }

    // 上传限制设置界面
	public function upload(){
	    $upload_setting=sp_get_upload_setting();
	    $this->assign($upload_setting);
	    return $this->fetch('open/upload');
	}

	 /**
    * 获取当前网站域名
    *
    */
    public function host_url(){
        $base_url = 'http';
        if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
            $base_url .= "s";
        }
        $base_url .= "://";

        if (isset($_SERVER["SERVER_PORT"]) && $_SERVER["SERVER_PORT"] != "80") {
            $base_url .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];
        }else{
            $base_url .= $_SERVER["SERVER_NAME"];
        }
        return $base_url;
    }

} 

