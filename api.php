<?php
use app\CellsQuery;

$ch = curl_init();
if(isset($_POST['phoneText'])){
    $phone = $_POST['phoneText'];
}else{
    $phone = null;
}
$url = 'http://apis.baidu.com/apistore/mobilephoneservice/mobilephone?tel='.$phone;
$header = array(
    'apikey: fb212e30ed9e256272b3a34a58f54cb2',
);
// 添加apikey到header
curl_setopt($ch, CURLOPT_HTTPHEADER  , $header);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 执行HTTP请求
curl_setopt($ch , CURLOPT_URL , $url);
$res = curl_exec($ch);
//$result = json_decode($res);
echo $res;


