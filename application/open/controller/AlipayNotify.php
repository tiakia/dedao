<?php
/**
 * 支付宝支付异步通知处理
 */
namespace app\open\controller;
use think\Controller;
use Alipay\AopClient;
use think\Log;
class AlipayNotify extends Controller {

	protected $orp_model,$order_model,$org_model;
	public function _initialize() {
		$this->orp_model = model('OrderPay');
		$this->order_model = model('Order');
		$this->org_model = model('OrderLog');
		$this->og_model = model('OrderGoods');
		$this->pl_model = model('PointsLog');
		$this->ex_model = model('ExperienceLog');
		$this->member_model = model('Member');
	}

	public function index(){

		if (!request()->isPost()) {
			abort(404,'页面不存在');
		}
		$alipayrsaPublicKey = file_get_contents(ROOT_PATH . 'extend/Alipay/alipayrsaPublicKey.txt');
		$param = input('param.');
		$aop = new AopClient;
		$aop->alipayrsaPublicKey = $alipayrsaPublicKey;
		$flag = $aop->rsaCheckV1($param, NULL, "RSA2");
		if (!$flag) {
			exit('failure');
		}
		$pay_sn = $param['out_trade_no'];
		$pay_result = $this->orp_model->where('pay_sn',$pay_sn)->find();
		if (is_null($pay_result)) {
			exit('failure');
		}

		$pay_info = $pay_result->toArray();
		if ($pay_info['api_pay_state'] == 1) {
			exit('success');
		}

		$buyer_id = $pay_info['buyer_id'];
		
		$order_info = $this->order_model->where(['buyer_id' => $buyer_id,'pay_sn' => $pay_sn])->find();
		if (empty($order_info)) {
			Log::write('客户支付宝支付成功，但查无订单数据，支付单号:'.$pay_sn,'notice');
			exit('success');
		}

		$this->orp_model->startTrans();
		$this->order_model->startTrans();
		$this->org_model->startTrans();
		$this->pl_model->startTrans();
		$this->member_model->startTrans();

		//处理订单信息表数据
		$data = [
			'payment_code' => 'alipay',
			'payment_time' => time(),
			'order_state' => '20'
		];
		$order_result = $this->order_model->where(['buyer_id' => $buyer_id,'pay_sn' => $pay_sn])->update($data);
		if (empty($order_result)) {
			exit('failure');
		}

		//处理支付信息表数据
		$orp_result = $this->orp_model->where(['pay_sn' => $pay_sn])->update(['api_pay_state' => 1,'pay_amount' => $param['total_amount']]);
		if (empty($orp_result)) {
			$this->order_model->rollback();
			exit('failure');
		}

		//写入订单错误日志
		$log_data = [
			'order_id' => $order_info['order_id'],
			'log_msg' => '客户通过支付宝支付订单成功,支付单号：'.$pay_sn,
			'log_time' => time(),
			'log_role' => '系统',
			'log_user' => 'admin',
			'log_orderstate' => '20'
		];
		$org_result = $this->org_model->insert($log_data);
		if (empty($org_result)) {
			$this->order_model->rollback();
			$this->orp_model->rollback();
			exit('failure');
		}

		$og_result = $this->og_model->where(['order_id'=>$order_info['order_id']])->field('goods_points,goods_experience,goods_parent_points')->find()->toArray();
		$goods_points = !empty($og_result['goods_points']) ? $og_result['goods_points'] : 0;
		$gp_points = !empty($og_result['goods_parent_points']) ? $og_result['goods_parent_points'] : 0;

		//获取用户上级
		$parent_id = $this->member_model->where(['member_id'=>$order_info['buyer_id']])->value('parent_id');

		$return_info = json_encode(['from_member_id'=>$order_info['buyer_id']]);
		
		//写入积分日志
		if($goods_points > 0){
			if($gp_points > 0 && $parent_id > 0){
				$points_log = [
					['member_id' => $order_info['buyer_id'],'points' => $goods_points,'add_time' =>time(),'pl_desc' => '用户下单增加冻结积分','type' => 'order_freeze'],
					['member_id' => $parent_id,'points' =>$gp_points,'add_time' =>time(),'pl_desc' => '用户消费赠送上级冻结积分','type' => 'order_return_parent','pl_data'=>$return_info]
				];

				$pl_result = $this->pl_model->saveAll($points_log);
			}else{
				$points_log = [
					'member_id' => $order_info['buyer_id'],
					'points' => $goods_points,
					'add_time' =>time(),
					'pl_desc' => '用户下单增加冻结积分',
					'type' => 'order_freeze'
				];

				$pl_result = $this->pl_model->save($points_log);
			}

			if (empty($pl_result)) {
				$this->order_model->rollback();
				$this->orp_model->rollback();
				$this->org_model->rollback();
				exit('failure');
			}
		}else{
			if($gp_points > 0 && $parent_id > 0){
				$points_log = ['member_id' => $parent_id,'points' =>$gp_points,'add_time' =>time(),'pl_desc' =>'用户消费赠送上级冻结积分','type' =>'order_return_parent','pl_data'=>$return_info];

				$pl_result = $this->pl_model->save($points_log);

				if (empty($pl_result)) {
					$this->order_model->rollback();
					$this->orp_model->rollback();
					$this->org_model->rollback();
					exit('failure');
				}
			}
		}
		
		//修改用户积分
		if($goods_points > 0){
			//赠送上级积分
			if($gp_points > 0 && $parent_id > 0){
				$mem_result = $this->member_model->where(['member_id'=>$order_info['buyer_id']])->update([
					'freeze_points' => ['exp','freeze_points+'.$goods_points]
				]);

				$parent_result = $this->member_model->where(['member_id'=>$parent_id])->update([
					'freeze_points' => ['exp','freeze_points+'.$gp_points]
				]);

				if(empty($mem_result) || empty($parent_result)){
					$this->order_model->rollback();
					$this->orp_model->rollback();
					$this->org_model->rollback();
					$this->pl_model->rollback();
					exit('failure');
				}
				
			}else{
				$mem_result = $this->member_model->where(['member_id'=>$order_info['buyer_id']])->update([
					'freeze_points' => ['exp','freeze_points+'.$goods_points]
				]);

				if(empty($mem_result)){
					$this->order_model->rollback();
					$this->orp_model->rollback();
					$this->org_model->rollback();
					$this->pl_model->rollback();
					exit('failure');
				}
			}
		}else{
			if($gp_points > 0 && $parent_id > 0){
				$parent_result = $this->member_model->where(['member_id'=>$parent_id])->update([
					'freeze_points' => ['exp','freeze_points+'.$gp_points]
				]);

				if(empty($parent_result)){
					$this->order_model->rollback();
					$this->orp_model->rollback();
					$this->org_model->rollback();
					$this->pl_model->rollback();
					exit('failure');
				}
			}
		}

		$this->orp_model->commit();
		$this->order_model->commit();
		$this->org_model->commit();
		$this->pl_model->commit();
		$this->member_model->commit();

		exit('success');
	}
}