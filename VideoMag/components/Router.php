<?php
class Router{
    
    private $routes;
    
    public function __construct() {
        $routesPath=ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }    
    
    private function getURI() {
        if (!empty($_SERVER['REQUEST_URI'])){
            return substr($_SERVER['REQUEST_URI'], strlen('/VideoMag/'));
        }  
    }
    
    public function run() {
        //получаем строку запроса
       $uri = $this->getURI();     
//       echo $uri;
        //проверяем наличие такого запроса в routes.php
        foreach ($this->routes as $uriPattern =>$path){
//            echo "<br>$uriPattern->$path";
            
            //Сравниваем $uriPattern c $uri
            if(preg_match("~$uriPattern~", $uri)){ //Если совпадают
            
            /*    
                
//                echo $path;//если все хорошо, то в перем. path будте находиться имя контроллера и action() 
            
                //Определить какой контроллер
                //и action обрабатывают запрос
                
                $segments = explode('/', $path);
                
                //получаем имя контроллера
                $controllerName = array_shift($segments).'Controller';//array_shift получает первый элемен из массива и удаляет его,к этому значению добавляем слово контроллер
                $controllerName = ucfirst($controllerName);
                             
                $actionName = 'action'.ucfirst(array_shift($segments));
 */
                //Получаем внутренний путь из внешнего согласно правилу
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                //Определяем коетроллер , экшн, параметры
                $segments = explode('/', $internalRoute);
                
                //$nullName=  array_shift($segments);//ЧТОБЫ ИЗБАВИТЬСЯ ОТ TESTSITE!!!
                $controllerName = array_shift($segments).'Controller';//array_shift получает первый элемен из массива и удаляет его,к этому значению добавляем слово контроллер
                $controllerName = ucfirst($controllerName);
                
                $actionName = 'action'.ucfirst(array_shift($segments));
                             
               // echo '<br>coontroller name: '.$controllerName;
                //echo '<br>actionName: '.$actionName;
                $parametres = $segments;
                //echo '<pre>';
                //print_r($parametres);   
                
                      
                
                //Подключить файл класса-контроллера
                $controllerFile = ROOT .'/controllers/'.
                        $controllerName . '.php';
                
                if (file_exists($controllerFile)){
                    include_once ($controllerFile);
                }
                // Создать объект, вызвать метод(action)
                $controllerObject = new $controllerName;
                
                $result = call_user_func_array(array($controllerObject,$actionName), $parametres);
                
                if($result != null){
                    break;
                }
        }
        
    }
    
}

}