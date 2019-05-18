<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//1. общие настройки
ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();
//2.Подключение файлов  системы
define('ROOT',dirname(__FILE__));
//require_once (ROOT.'/components/Autoload.php');

require_once (ROOT.'/components/Router.php');
require_once (ROOT.'/components/Db.php');
/*
 * Подключение БД
 * 
 */


//4.Вызов Router;
$router = new Router();//Вызов Router
$router->run();


