<?php
/**
 * Created by PhpStorm.
 * User: kcswag
 * Date: 3/8/16
 * Time: 4:33 PM
 */

namespace libs;

class KcRedis
{
    private $redis;

    public function getRedis(){
        if(!$this->redis instanceof \Redis){
            $this->redis = new \Redis();
            $this->redis->connect('127.0.0.1',6379);
        }
        return $this->redis;
    }
}