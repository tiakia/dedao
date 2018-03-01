<?php
namespace app\common\model;
use think\Model;
class Member extends Model
{
	/**
	* 会员详细关联
	*/
    public function info(){
        return $this->hasOne('MemberInfo','member_id','member_id');
    }

    public function has_info($mobile){
    	$member_id = $this->where(['member_mobile' => $mobile])->value('member_id');
    	$result = model('Member')->where(['member_id' => $member_id])->value('member_name');

    	if (!empty($result)) {
    		return true;
    	}else{
    		return false;
    	}
    }

    public function has_infos($mobile){
        $member_id = $this->where(['member_mobile' => $mobile])->value('member_id');
        $result = model('MemberInfo')->where(['member_id' => $member_id])->value('member_height');
        if (!empty($result)) {
            return true;
        }else{
            return false;
        }
    }

    /**
    * 更新member表中多个数据
    */
    public function save_all($member_id,$points,$experience,$freeze_points,$av_predeposit=0){
        $data = [
            'points' => ['exp','points-'.$points],
            'experience' => ['exp','experience+'.$experience],
            'freeze_points' => ['exp','freeze_points+'.$freeze_points],
            'av_predeposit' => ['exp','av_predeposit-'.$av_predeposit]
        ];

        $result = $this->where(['member_id'=>$member_id])->update($data);
        
        if($result === false){
            return false;
        }
        return true;
    }

    /**
    *  消费商基本信息
    */
    public function basic_info($member_id){
        $member_info = $this->field('member_name,member_grade,member_avatar')->where(['member_id'=>$member_id])->find();

        $data = ['member_name'=>'','member_grade'=>'','grade_name' => '','member_avatar' => ''];
        if(!empty($member_info) && $member_info['member_grade'] > 6){
            $grade_array = ['7'=>'F','8'=>'E','9'=>'D','10'=>'C','11'=>'B','12'=>'A'];
            $grade_name = $grade_array[$member_info['member_grade']].'级消费商';
           
            $data = [
                'member_name'=>$member_info['member_name'],
                'member_grade'=>$member_info['member_grade'],
                'grade_name' => $grade_name,
                'member_avatar' => $member_info['member_avatar']
            ];
        }

        return $data;
    }
}