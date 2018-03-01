<?php
namespace app\admin\controller;
class Order extends Adminbase
{
	protected $order_model;
	public function _initialize() {
		parent::_initialize();
		$this->order_model = model('Order');
	}

	/**
	*	导航首页
	*/
	public function index(){
		$where = [];
        $query = [];
        $order_sn = input('get.order_sn','','trim');
        if(!empty($order_sn)){
            $query['order_sn'] = $order_sn;
            $where['order_sn'] = $order_sn;
        }

        $order_state = input('get.order_state','','intval');
        if(!empty($order_state) && strlen($order_state) > 0){
            $query['order_state'] = $order_state;
            $where['order_state'] = $order_state;
        }

        $order_model = $this->order_model;
        $count = $order_model->where($where)->count();
        $where['order_type'] = 1;
        $where['lock_state'] = 0;

        $lists = $order_model->where($where)->field('order_sn,buyer_name,order_amount,order_state,create_time,order_id,payment_code')->order('order_id desc')->paginate(14,$count,['query'=>$query]);

        $page = $lists->render();
        $this->assign('page',$page);
        $this->assign('lists',$lists);
        return $this->fetch();
	}

}