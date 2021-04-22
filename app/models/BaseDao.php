<?php
/**
 * Created by PhpStorm.
 * User: 8-bit
 * Date: 2021/3/26
 * Time: 16:04
 */
// If you installed via composer, just use this code to require autoloader on the top of your projects.
namespace models;
// Using Medoo namespace
use Medoo\Medoo;

class BaseDao extends Medoo{
    public function __construct()
    {
        // Initialize
        $options =[
            'database_type' => 'mysql',
            'database_name' => DBNAME,
            'server' => HOST,
            'username' => USER,
            'password' => PASS,
            'prefix' => TAB_PREFIX
        ];
        parent::__construct($options);
    }
}