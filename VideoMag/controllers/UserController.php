<?php
include_once ROOT. '/models/User.php';
class UserController{
    
    public function actionRegister() {
        
        $name = '';
        $email = '';
        $password = '';
        $role = 0;
        $result = false;
        
        if (isset($_POST['submit'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password']; 
            
            $errors = false;
            
            if(!User::checkName($name)){
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            
            if(!User::checkEmail($email)){
                $errors[] = 'Неправильный email';
            }
            
            if(!User::checkPassword($password)){
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            
            if(User::checkEmailExists($email)){
                $errors[] = 'Такой email уже испоьзуется';
            }
            
            
        if($errors == FALSE){
            //echo 'test';
            
            $result = User::register($name, $email, $password, $role);
                      
        } 
        // echo 'after';   
        }
        //echo $result;
        //print_r($result);
        require_once (ROOT. '/views/user/register.php');
        
        return true;
    }
    
    public function actionLogin(){
        
        $email = '';
        $password = '';
        
        if (isset($_POST['submit'])){
            
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $errors = FALSE;
            
            if (!User::checkEmail($email)){
                $errors[] = 'Не правильный email';
            }
            if (!User::checkPassword($password)){
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }
            
            $userId = User::checkUserData($email,$password);
            
            if($userId == FALSE){
                $errors[]='Не правильные данные для входа на сайт';
            } else {
                
                User::auth($userId);
                
                header("Location: /VideoMag/cabinet/");
            }
            
        }
        
        require_once (ROOT . '/views/user/login.php');
        
        return true;
    }
    
    public function actionLogout(){
        session_start();
        unset($_SESSION["user"]);
        header("Location: /VideoMag/");
    }
    
    public function actionHistory()
    {
        // Проверка доступа
        self::checkAdmin();

        // Получаем список заказов
        $ordersList = Order::getOrdersList();

        // Подключаем вид
        require_once(ROOT . '/views/admin_order/index.php');
        return true;
    }
    
    
    
}


