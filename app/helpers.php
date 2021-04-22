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
    function ew_login($utype) {
        if(isset($_SESSION['id'])) {
            return md5($_SESSION['id'] . $_SERVER['HTTP_HOST']) == $_SESSION[$utype . '_token'] ? 1 : 0;
        }
        return 0;
    }