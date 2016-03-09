<?php

class Autoload
{
    public static function load($className){
        $fileName = str_replace('\\','/',$className);
        $fileName = sprintf('%s.php',$fileName);
        if(is_file($fileName)){
            require_once $fileName;
        }
    }
}

spl_autoload_register(['Autoload','load']);
