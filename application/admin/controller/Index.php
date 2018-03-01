<?php
namespace app\admin\controller;
class Index extends Adminbase
{
    public function index()
    {
        $menus = model("Menu")->menu_json();
        $this->assign('menus',$menus);
        return $this->view->fetch();
    }

    public function main()
    {
        //系统参数信息
        $mysql = model('admin')->field("VERSION() as version")->find();
        $mysql = $mysql['version'];
        $mysql = empty($mysql) ? L('UNKNOWN') : $mysql;

        $data = [];
        if(ini_get('safe_mode')){
            $data['safe_mode'] = '是';
        }else{
            $data['safe_mode'] = '否';
        }
        if(ini_get('safe_mode_gid')){
            $data['safe_mode_gid'] = '是';
        }else{
            $data['safe_mode_gid'] = '否';
        }
        $data['mysql'] = $mysql;
        if(extension_loaded('sockets')){
            $data['sockets'] = '已开启';
        }else{
            $data['sockets'] = "未开启";
        }
        $data['time'] = date_default_timezone_get();
        $data['gd'] = gd_info()['GD Version'];
        $data['file'] = ini_get('upload_max_filesize');
        $data['extra'] = round((@disk_free_space(".") / (1024 * 1024)), 2) . 'M';
        $data['run_time'] = ini_get('max_execution_time') . "s";

        $this->assign('data',$data);
        return $this->fetch();
    }
}