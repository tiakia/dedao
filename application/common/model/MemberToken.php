<?php
namespace app\common\model;
use think\Model;
class MemberToken extends Model
{
	/**
	* 角色表关联
	*/
    public function member(){
        return $this->hasOne('Member','member_id','member_id')->field('member_id,member_mobile,member_name,member_avatar,member_state');
    }

    public function create_token($mobile,$client_type){
    	$member_info = db('member')->where('member_mobile',$mobile)->find();
        if (empty($member_info)) {
            return null;
        }
        $this->where(array('mobile' => $mobile,'client_type' => $client_type))->delete();
        //生成新的token
        $user_token = array();
        $token = md5($mobile . strval(time()) . strval(rand(0,999999)));
        $user_token['member_id'] = $member_info['member_id'];
        $user_token['mobile'] = $mobile;
        $user_token['token'] = $token;
        $user_token['create_time'] = time();
        $user_token['client_type'] = $client_type;

        $result = $this->save($user_token);
        if ($result === false) {
        	return null;
        }else{
        	return $token;
        }
    }

    /**
     * 查询
     *
     * @param array $condition 条件
     * @return array
     */
    public function get_token($condition){
        $result = $this->where($condition)->find();
        return $result;
    }

    /**
     * 更新
     *
     * @param array $condition 条件
     * @return array
     */
    public function update_token($condition,$data){
        $result = $this->where($condition)->update($data);
        return $result;
    }

    /**
     * 新增
     *
     * @param array $param 参数内容
     * @return bool 布尔类型的返回结果
     */
    public function add_token($param){
        $result = $this->save($param);
        return $result;
    }

    /**
     * 删除
     *
     * @param int $condition 条件
     * @return bool 布尔类型的返回结果
     */
    public function del_token($param){
        $result = $this->where($param)->delete();
        return $result;
    }
}