<?php
/**
 * Created by PhpStorm.
 * User: 8-bit
 * Date: 2021/3/25
 * Time: 19:55
 */
if(!function_exists('dd')){

    function dd(...$args){
        http_response_code(500);

        foreach($args as $x){
            var_dump($x);
        }
        die(1);
    }
}
    function get_url(){
        $url = 'http://';

        if(isset($_SERVER['SERVER_HTTPS']) && $_SERVER['SERVER_HTTPS']=='on'){
            $url = 'https;//';
        }
        //判读端口
        if($_SERVER['SERVER_PORT']!='80') {
            $url .= $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
        }else{
                $url .= $_SERVER['SERVER_NAME'];
            }
        return $url;
    }