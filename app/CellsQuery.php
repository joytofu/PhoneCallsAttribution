<?php

namespace app;

use libs\HttpRequest;

class CellsQuery
{
    const TAOBAO_API = 'https://tcc.taobao.com/cc/json/mobile_tel_segment.html';

    public static function query($phone_number){
        if(self::verifyPhone($phone_number)){
            HttpRequest::request(self::TAOBAO_API,['tel'=>$phone_number]);
        }
    }

    /**
     * verify phone number is legit or nah
     * @param null $phone
     * @return bool
     */
    public static function verifyPhone($phone = null){
        if($phone){
            if(preg_match('/^1[34578]{1}\d{9}$/',$phone)){
                return true;
            }
        }
        return false;
    }
}