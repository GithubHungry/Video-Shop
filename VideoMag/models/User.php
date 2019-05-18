<?php

class User{
    public static function register($name, $email, $password, $role){
        
        $db = Db::getConnection();
        
        $sql = 'INSERT INTO user (name, email, password, role) VALUES (:name, :email, :password, :role);';
        //echo 'test user';
        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':role', $password, PDO::PARAM_INT);
        
        //print_r ($result);
        return $result->execute();
        // $result->execute();
        //print_r ($result);
    }
    
    
    public static function checkName($name){
        if(strlen($name) >= 2){
            return TRUE;
        }
        return false;
    }
    
    public static function checkPassword($password){
        if(strlen($password) >= 6){
                return TRUE;
        }
        return false;
        
    }
    public static function checkEmail($email){
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                return TRUE;
        }
        return false;
        
    }
    
    public static function checkEmailExists($email){
        
        $db =  Db::getConnection();
        
        $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';
        
        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();
        
        if($result->fetchColumn())
            return TRUE;
        return FALSE;
    }
    
    public static function checkUserData($email, $password){
        
        $db = Db::getConnection();
        
        $sql='SELECT * FROM user WHERE email = :email AND password = :password';
        
        $result = $db->prepare($sql);
        $result->bindParam(':email',$email, PDO::PARAM_INT);
        $result->bindParam(':password',$password, PDO::PARAM_INT);
        $result->execute();
        
        $user = $result->fetch();
        if($user){
            
            return $user['id'];
            
        }
        return false;
        
    }
    
    public static function auth($userId)
    {
       // session_start();
        $_SESSION['user']=$userId;
    }
    
    public static function checkLogged(){
       // session_start();
        
        if(isset($_SESSION['user'])){
            return $_SESSION['user'];
        }
        header("Location: /VideoMag/user/login");//Если все плохо убрать /Videomag/
    }
    
    public static function isGuest() {
        
       // session_start();
        if(isset($_SESSION['user'])){
            return FALSE;
        }
        return true;
        
    }
    
    public static function getUserById($id){
        
        if($id){
            
            $db = Db::getConnection();
            $sql = 'SELECT * FROM user WHERE id = :id';
            
            $result = $db->prepare($sql);
            $result->bindParam(':id',$id, PDO::PARAM_INT);
            
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
            
            return $result->fetch();
            
        }
        
    }
    
    public static function edit($userId, $name, $password){
        
        $db = Db::getConnection();
        
        $sql = "UPDATE user SET name = :name , password = :password WHERE id = :id";
        
        $result = $db->prepare($sql);
        $result->bindParam(':id',$userId, PDO::PARAM_INT);
        $result->bindParam(':name',$name, PDO::PARAM_STR);
        $result->bindParam(':password',$password, PDO::PARAM_STR);
        
        return $result->execute();       
    }
    
      public static function checkPhone($phone)
    {
        if (strlen($phone) >= 10) {
            return true;
        }
        return false;
    }

    
    
}