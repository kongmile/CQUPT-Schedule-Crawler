<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        //获取原始数据
        $where['student'] = I('get.id','2015210001');
        $res = M('course')->where($where)->select();

        //初始化table数组
        $table = array();
        for($i=0; $i<7; $i++){
            for($j=0; $j<6; $j++){
                $table[$i][$j] = null;
            }
        }
        //var_dump($res);
        //存入数据
        foreach($res as $index => $v){
            $i = 0;
            $b = $v['begin_lesson']-1;
            $w = $v['weekday']-1;
            while(!empty($table[$b][$w][$i])){
                $i++;
            }
            $table[$b][$w][$i]['course_id'] = $v['course_id'];
            $table[$b][$w][$i]['course'] = $v['course'];
            $table[$b][$w][$i]['teacher'] = $v['teacher'];
            $table[$b][$w][$i]['classroom'] = $v['classroom'];
            $table[$b][$w][$i]['week'] = $v['week'];
            $table[$b][$w][$i]['property'] = $v['property'];
        }
        $this->assign('student', $where['student']);
        $this->assign('table', $table);
        $this->display();
    }
}