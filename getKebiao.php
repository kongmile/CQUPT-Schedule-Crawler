<?php
$dsn = 'mysql:host=localhost;dbname=kebiao'; //主机名字，数据库名
$username = 'kaohe'; //用户名
$passwd = 'EMTshiwode'; //密码
try{
    $dbh = new PDO($dsn,$username,$passwd,array( PDO :: ATTR_PERSISTENT=> true));//长连接
    $dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);//报错会中断进行事物，并回滚
    $dbh->exec('set names utf8');
}catch( PDOException   $e){//抓错误
    die($e->getMessage());
}

for($i=2015210001; $i<=2015210999; $i++){
    $url = 'http://jwzx.cqupt.edu.cn/pubStuKebiao.php?xh='.$i;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $ori = curl_exec($ch);
    curl_close($ch);
    $ori = iconv("gb18030", "utf-8", $ori);
//echo $ori;//原始数据

    $course = array();
    $pattern = "/&nbsp;.*<\/td>/U";
    preg_match_all($pattern, $ori, $course);
//var_dump($course); //42组数据

    $table =array();
    $pattern1 = '/\d\d\d\d\d\d<br>.*选课状态:正常<br>/U';
    foreach($course[0] as $index => $c){
        preg_match_all($pattern1, $c, $table);
        $course2[$index] = $table[0];
    }
//print_r($course2);//42组数组数据

    $pattern2 = "/(\d\d\d\d\d\d)<br>(.*)<br>(.*)<br>(.*)<br><font color=#ff0000>(.*)<\/font><br>(.*)<br>选课状态:正常<br>/U";
    foreach($course2 as $i1 => $c1){
        foreach ($c1 as $i2 => $c2){
            preg_match($pattern2, $c2, $table);
            $course2[$i1][$i2] = $table;
        }
    }
    //var_dump($course2);//42组数组数组数据

    foreach($course2 as $i1 => $c1){
        if(empty($c1))  continue;
        foreach($c1 as $i2 => $c2){
            $course_id      =   $c2[1];
            $course_name    =   $c2[2];
            $teacher        =   $c2[3];
            $classroom      =   $c2[4];
            $lession_begin  =   floor($i1/7+1);
            $week           =   $c2[6];
            $property       =   $c2[5];
            $weekday        =   ($i1%7)+1;
            $sql = 'INSERT INTO course VALUES (NULL, "'.$i.'","'.$course_id.'","'.$course_name.'","'.$teacher.'","'.$classroom.'",'.$lession_begin.',"'.$week.'","'.$property.'",'.$weekday.')';
            //echo $sql;
            $dbh->exec($sql);
        }
    }
    unset($course);
    unset($course2);
    unset($table);
}
