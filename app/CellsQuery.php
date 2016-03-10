<?php

namespace app;

use libs\HttpRequest;
use libs\KcRedis;

class CellsQuery
{

    public function query($phone_number,KcRedis $redis){
        $phoneData = null;
        $redisKey = $phone_number;
        if($this->verifyPhone($phone_number)){
            $phoneData = $redis->getRedis()->get($redisKey);
            if(!$phoneData){
                $phoneData = $this->request($phone_number);
                $phoneData = json_decode($phoneData);
                $phoneData->errMsg = "Data from Baidu";
                $phoneData = json_encode($phoneData);
                $redis->getRedis()->set($redisKey,$phoneData);
            }else{
                $phoneData = json_decode($phoneData);
                $phoneData->errMsg = "Data from kcswag";
                $phoneData = json_encode($phoneData);
            }
        }
        return $phoneData;
    }

    /**
     * verify phone number is legit or nah
     * @param null $phone
     * @return bool
     */
    protected function verifyPhone($phone = null){

            if(preg_match('/^1[34578]{1}\d{9}$/',$phone)){
                return true;
            }else{
                return false;
            }
    }

    public function request($phone = null){
        $ch = curl_init();

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

        return $res;
    }
}