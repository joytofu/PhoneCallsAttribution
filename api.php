<?php

require_once "autoload.php";

use app\CellsQuery;
use libs\KcRedis;


if(isset($_POST['phoneText'])){
    $phone = $_POST['phoneText'];
    $cellsQuery = new CellsQuery();
    $redis = new KcRedis();
    $res = $cellsQuery->query($phone,$redis);
    echo $res;
}else{
    echo "<script>alert('请输入电话号码!');</script>";
}


