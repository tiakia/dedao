<?php
namespace app\video\controller;
use think\Controller;
use think\View;
use think\Config;
class Appbase extends Controller{
	public $view;
	protected function _initialize(){
    	$this->view = new View([],Config::get('view_replace_str'));
    	$nav_data = model('Navigation')->order('nav_sort asc')->select()->toArray();
    	$this->assign('nav_data',$nav_data);
    	return $this->fetch('open/header');
    }
}
