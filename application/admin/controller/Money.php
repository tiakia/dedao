<?php
namespace app\admin\controller;
class Money extends Adminbase
{
	protected $money_model;
	public function _initialize() {
		parent::_initialize();
		$this->money_model = model('PointsLog');
		$this->member_model = model('Member');
	}

	/**
	*	点券首页
	*/
	public function index(){
		$where = [];
		$count = $this->money_model->where($where)->count();
        $list = $this->money_model->where($where)->order('pl_id desc')->paginate(15,$count);
        
    	$page = $list ->render();
        $this->assign('page',$page);
        $this->assign('lists',$list);
		return $this->fetch();
	}

	/**
	*	点券添加
	*/
	public function add_points(){
		return $this->fetch();
	}

	/**
	*	点券添加
	*/
	public function add_post(){
        if(request()->isPost()){
            $param = input('post.');
            $member_mobile = trim($param['member_mobile']);
            if(!is_mobile($member_mobile)){
                $this->error('会员账号填写错误');
            }

            $member_info = $this->member_model->where(['member_mobile'=>$member_mobile])->find();

            if(empty($member_info)){
                $this->error('该会员不存在，请重新填写');
            }

            $points = intval($param['points']);
            if($points < 1){
                $this->error("积分数值有误");
            }

            $data = [
            	'type'     => $param['type'],
            	'add_time' => time(),
            	'pl_stage' => "system",
            	'admin_id' => session('ADMIN_ID'),
            	'pl_desc'  => strip_tags($param['pl_desc']),
            	'points'   => $points,
            	'member_id'   => $member_info['member_id'],
            	'member_mobile'   => $member_mobile,
            	'admin_name'   => session('name')
            ];
            
            $this->member_model->startTrans();
            $this->money_model->startTrans();

            if($param['type'] == 'admin_add') {
                $result = $this->member_model->where(['member_id'=>$member_info['member_id']])->setInc("buy_coupon",$points);
            }

            if($param['type'] == 'admin_del'){
                if($member_info['buy_coupon'] >= $points){
                    $result = $this->member_model->where(['member_id'=>$member_info['member_id']])->setDec("buy_coupon",$points);
                }else{
                    $this->error('积分不足，不能扣除');
                }
            }

            if(empty($result)){
                $this->error('积分操作失败');
            }

            $points_result = $this->money_model->save($data);
            if(empty($points_result)){
                $this->member_model->rollback();
                $this->error('积分操作日志记录失败');
            }

            $this->member_model->commit();
            $this->money_model->commit();
            $this->success('操作成功','money/index');
        }
	}
}