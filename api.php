<?php

require_once "autoload.php";

use app\CellsQuery;
use libs\KcRedis;


if(isset($_POST['phoneText'])){
    $phone = $_POST['phoneText'];
    $cellsQuery = new CellsQuery();
    $redis = new KcRedis();
    if(property_exists($redis->getRedis(),'socket')!=null){
        $res = $cellsQuery->query($phone,$redis);
        echo $res;
    }else{
        $res = $cellsQuery->request($phone);
        $res = json_decode($res);
        $res->errMsg = "Data from Baidu";
        $res = json_encode($res);
        echo $res;
    }
}else{
    echo "<script>alert('请输入电话号码!');</script>";
}


