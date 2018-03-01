<?php
namespace app\api\controller;
class Order extends Auth{
	protected $order_model,$course_model;
	public function _initialize(){
        parent::_initialize();
        $this->order_model = model('Order');
        $this->course_model = model('Course');
        $this->member_model = model('Member');
        $this->pay_model = model('OrderPay');
        $this->pl_model = model('PointsLog');
    }
    
    /**
    *   购买课程
    */
    public function create_order(){
        $course_id = input('post.course_id');
        if(empty($course_id)) {
            $this->ajax_return('10300','invalid course_id');
        }

        $buy_course = $this->member_model->where(['member_id'=>$this->member_info['member_id']])->value('buy_course');
        $buy_course = explode(',',$this->member_info['buy_course']);
        if(in_array($course_id, $buy_course)){
            $this->ajax_return('10303','course has buyed');
        }
        //查询课程基本信息
        $course_info = $this->course_model->where('course_id',$course_id)->find();
        if(empty($course_info)){
            $this->ajax_return('10301','invalid course');
        }

        if($course_info['course_money'] > $this->member_info['buy_coupon']){
            $this->ajax_return('10304','points is not enough');
        }

        $this->member_model->startTrans();
        $this->order_model->startTrans();
        $this->pl_model->startTrans();

        //生成支付信息
        $paysn = $this->order_model->make_paysn($this->member_info['member_id']);
        $pay_result = $this->pay_model->save(['pay_sn' => $paysn,'buyer_id' => $this->member_info['member_id']]);
        if (empty($pay_result)) {
            $this->ajax_return('10302','create order failed');
        }
        $pay_id = $this->pay_model->pay_id;

        //生成订单信息
        $order_sn = $this->order_model->make_ordersn($pay_id);

        $order_data = [
            'order_sn'     => $order_sn,
            'pay_sn'       => $paysn,
            'order_type'   => 1,
            'order_state' => 20,
            'buyer_id'     => $this->member_info['member_id'],
            'buyer_name'   => $this->member_info['member_name'],
            'buyer_mobile' => $this->member_info['member_name'],
            'create_time'  => time(),
            'goods_amount' => $course_info['course_money'],
            'order_amount' => $course_info['course_money'],
            'payment_time' => time(),
        ];
        $result = $this->order_model->save($order_data);
        if(empty($result)) {
            $this->pay_model->rollback();
            $this->ajax_return('10302','create order failed');
        }

        array_push($buy_course,$course_id);
       
        if(is_array($buy_course)){
            $course = implode(',',$buy_course);
        }

        $buy_coupon = $this->member_info['buy_coupon'] - $course_info['course_money'];
        $data = [
            'buy_course' => $course,
            'buy_coupon' => $buy_coupon
        ];

        //修改用户余额
        $result = $this->member_model->save($data,['member_id'=>$this->member_info['member_id']]);

        if(empty($result)) {
            $this->pay_model->rollback();
            $this->order_model->rollback();
            $this->ajax_return('10302','create order failed');
        }

        //修改用户点券信息
        $pl_data = [
            'member_id' => $this->member_info['member_id'],
            'member_mobile' => $this->member_info['member_mobile'],
            'points' => $course_info['course_money'],
            'add_time' => time(),
            'pl_desc' => '用户购买课程',
            'type' => 'order_pay'
        ];
        $result = $this->pl_model->save($pl_data);
        if(empty($result)) {
            $this->pay_model->rollback();
            $this->order_model->rollback();
            $this->member_model->rollback();
            $this->ajax_return('10302','create order failed');
        }

        $this->member_model->commit();
        $this->order_model->commit();
        $this->pl_model->commit();

        $this->ajax_return('200','success');
    }
}
