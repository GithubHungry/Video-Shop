<?php
//
//function __autoload($class_name){
//    
//    $array_paths = array(
//        '/models/',
//        '/components/',
//        '/controllers/'
//    );
//    
//    foreach ($array_paths as $path){
//        $path = ROOT . $path . $class_name . '.php';
//        if (is_file($path)){
//            include_once $path;
//        }
//    }
//    
//}
spl_autoload_register(function ($class_name)
{
    require_once ROOT.'/models/'.$class_name.'.php';
    require_once ROOT.'/components/User.php';
    require_once ROOT.'/controllers/'.$class_name.'.php';
});
//function loadComponentsClass($class_name)
//{
//    require_once ROOT.'/components/'.$class_name.'.php';
//}
//function loadControllersClass($class_name)
//{
//    require_once ROOT.'/controllers/'.$class_name.'.php';
//}
//class Main{
//    public static function autoload(){
//        require_once ROOT.'/';
//    }
//}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

