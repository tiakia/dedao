<?php
/**
* 后台验证基础类
*
*/
namespace app\admin\controller;
use Rbac\Auth;
class Adminbase extends Appbase{

    protected function _initialize(){
        $session_admin_id = intval(session('ADMIN_ID'));
        
        if(!empty($session_admin_id)){
            $users_obj= model("Admin");
            $user=$users_obj->where(array('admin_id'=>$session_admin_id))->find();
            if(!$this->check_access($session_admin_id)){
                $this->error("您没有访问权限！");
            }
            $this->assign("admin",$user);
        }else{
            
            if(request()->isAjax()){
                $this->error("您还没有登录！",url("admin/open/login"));
            }else{

                header("Location:".url("admin/open/login"));
                exit();
            }

        }
    }

    /**
     *  检查后台用户访问权限
     * @param int $uid 后台用户id
     * @return boolean 检查通过返回true
     */
    private function check_access($uid){
        //如果用户角色是1，则无需判断
        if($uid == 1){
            return true;
        }

        $rule = request()->module().request()->controller().request()->action();
        $no_need_check_rules = array("adminIndexindex","adminIndexmain");

        if( !in_array($rule,$no_need_check_rules) ){
            $iauth_obj = new Auth();
            return $iauth_obj->check($uid);
        }else{
            return true;
        }
    }

   

}
