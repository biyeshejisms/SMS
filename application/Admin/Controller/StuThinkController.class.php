<?php
namespace Admin\Controller;
use Common\Controller\AdminbaseController;

class StuThinkController extends AdminbaseController {
    protected $model;
    private $params;

    public function _initialize() {
        parent::_initialize();
        $this->model = D('Grade');
        $this->params = I('params.');
    }

    public function index(){
        $stu_id = $_COOKIE['stu_id'];
        $Student = M('Student');
        $class_res = $Student->field('class_id')->where(array('stu_id'=>$stu_id))->find();
        $class = $class_res['class_id'];
        //班级所有学生
        $stu_all_res = $Student->field('stu_name')->where(array('class_id'=>$class))->select();
        foreach($stu_all_res as $v){
            $stu_all[] = $v['stu_name'];
        }
        print_r($stu_all);die;
        $this->assign("data",$data);
        $this -> display();
    }


}
