<?php
namespace app\admin\controller;
class Setting extends Appbase{
	protected $set_model;
	protected function _initialize(){
        parent::_initialize();
        $this->set_model = model('Setting');
    }
    
    /**
    *   页面设置添加
    */
    public function add(){
        $web_info = ['web_name'=>'','web_download'=>'','web_qrcode'=>''];
        $web_info = $this->set_model->order('option_id desc')->find();
        if(!empty($web_info)){
            $web_info = json_decode($web_info['option_value'],true);
        }
        
        if(request()->isPost()){
            $param = input('post.');

            if(!empty($param)){
                $web_info = [
                    'web_name' => $param['web_name'],
                    'web_download' => $param['web_download'],
                    'web_qrcode' => $param['web_qrcode']
                ];  
                
                $web_data = json_encode($web_info);

                $this->set_model->save(['option_value'=>$web_data]);
            }
        }
        $this->assign('web_info',$web_info);
		return $this->fetch();
    }
}
