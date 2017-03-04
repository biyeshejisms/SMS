<?php
namespace Admin\Controller;
use Common\Controller\AdminbaseController;

class StuGradeController extends AdminbaseController {
    protected $model;
    private $params;

    public function _initialize() {
        parent::_initialize();
        $this->model = D('Grade');
        $this->params = I('params.');
    }

    public function index(){
        $stu_id = $_COOKIE['stu_id'];
        //分页
        $count=$this->model->where(array('stu_id'=>$stu_id))->count();
        $page = $this->page($count, 8);
        $this->assign("page", $page->show('Admin'));


        $sel = $this->model->field('cmf_subject.subject_name,cmf_grade.grade,cmf_subject.subject_id')
            ->join('cmf_subject ON cmf_subject.subject_id = cmf_grade.subject_id')
            ->limit($page->firstRow , $page->listRows)
            ->where(array('cmf_grade.stu_id'=>$stu_id))
            ->select();
//             print_r($sel);die;
        foreach($sel as $k=>$v){
            $data[$k]['subject_name'] = $v['subject_name'];
            $data[$k]['grade'] = $v['grade'];
            $subject[] = $v['subject_id'];
        }

//        print_r($subject);die;
        //排名
//        $Student = M("Student");
//        //获取班级
//        $class_res = $Student->field('class_id')->where(array('stu_id'=>$stu_id))->find();
//        $class = $class_res['class_id'];
//        //班级所有学生
//        $stu_all_res = $Student->field('stu_id')->where(array('class_id'=>$class))->select();
//        foreach($stu_all_res as $v){
//            $stu_all[] = $v['stu_id'];
//        }
////        print_r($stu_all);die;
//        $c =count($subject);
////        print_r($c);die;
//        for($i=$subject[0];$i<=$subject[$c];$i++){
//            $res = $this->model ->field()
//                                ->where(array('subject_id'=>$i))
//                                ->
//        }


        $this->assign("data",$data);
        $this -> display();
    }


}
