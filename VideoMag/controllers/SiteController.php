<?php

include_once ROOT.'/models/Category.php';
include_once ROOT.'/models/Product.php';
include_once ROOT.'/models/User.php';

class SiteController{
    public function actionIndex(){
        
        $categories = array();
        $categories = Category::getCategoriesList();
        
        $latestProducts = array();
        $latestProducts = Product::getLatestProducts(3);
        
        $sliderProducts = Product::getRecommendedProducts();//добавили 
        
        require_once (ROOT.'/views/site/index.php');
        //echo 'SiteController actionIndex mama papa';
        return true;
    }
    
    
    public function actionContact(){
        
        $userEmail = '';
        $userText = '';
        $result = false;
        
        if(isset($_POST['submit'])){
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];
            
            $errors = FALSE;
            
            if (!User::checkEmail($userEmail)){                
                $errors[] = 'Неправильный email';                
            }
            
            if($errors == FALSE){
                
                $adminEmail = 'bardiervadim97@gmail.com';
                $message = "Текст: {$userText}. От {$userEmail}";                
                $subject = 'Тема письма';                
                $result = mail($adminEmail, $subject, $message); 
                $result = true;
            }
            
            
        }
        
        require_once (ROOT. '/views/site/contact.php');
        
        return TRUE;
        //var_dump($result);
    }
    
    public function actionAbout()
    {
         if (isset($_POST['submit'])){
            $id = $_POST['userId'];
            $user_id = $_POST['userEmail'];
            $review = $_POST['userText'];
            
            $result = Cart::saveMes($id, $user_id, $review);
         }
        
        
        // Подключаем вид
        require_once(ROOT . '/views/site/about.php');
        return true;
    }
    
    public function actionBlog()
    {
        // Подключаем вид
        require_once(ROOT . '/views/site/blog.php');
        return true;
    }
    
    
    
   
    
}