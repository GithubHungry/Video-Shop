<?php
require_once (ROOT. '/models/User.php');
require_once (ROOT. '/models/Order.php');
require_once (ROOT. '/models/Product.php');
class CabinetController{
    
    public function actionIndex(){
        
        
        $userId = User::checkLogged();
        
        $user = User::getUserById($userId);
        
        require_once (ROOT . '/views/cabinet/index.php');
        
        return true;
        
    }
    
    public function actionEdit(){
        
        $userId = User::checkLogged();
        
        $user  = User::getUserById($userId);
        
        $name = $user['name'];
        $password = $user['password'];
        
        $result = false;
        
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $password = $_POST['password'];
            
            $errors =false;
            
            if(!User::checkName($name)){
                $errors[]='Имя не должно быть короче 2-х символов';
            }
            
            if(!User::checkPassword($password)){
                $errors[]='Пароль не должно быть короче 6-ти символов';
            }
            
            
            if($errors == FALSE){
                $result = User::edit($userId, $name, $password);
            }
        }
        
        require_once (ROOT . '/views/cabinet/edit.php');
        
        return true;
        
    }
    
    public function actionHistory(){   
        
        $userId = User::checkLogged();//Проверяем залогинен ли
        
        $user  = User::getUserById($userId);
        
        $name = $user['name'];//Имя
        $id_u = $user['id'];//УИД

        
        $ordersList = Order::getOrdersListUs($id_u);

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/index2.php');
        return true;
        
    }
    
    
    
    public function actionView($id){   
        
        

        $order = Order::getOrderByIdOne($id);
        
        $orderProd = $order['products'];
        $orderId = $order['id'];
        
        $prod = json_decode($order['products'], true);
        
        $prodId = array_keys($prod);
        
        $products = Product::getProductsByIds($prodId);
        //echo gettype($products);die();
        //print_r($products);die();
        
        //сохранение json файла
         $perem = json_encode($products);
         $dperem = json_decode($perem);
     
        require ('tfpdf/tfpdf.php');
        $pdf=new tFPDF();
        
        $pdf->AddPage();
        
        $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
        $pdf->SetFont('DejaVu','',14);
        $pdf->Cell(40,10,'Your order : ');
        foreach ($products as $product):
            
            $pdf->Ln();
            $pdf->Cell(40,10,"Code : ".$product['code']);
            $pdf->Ln();
            $pdf->Cell(40,10,"Name : ".$product['name']);
            $pdf->Ln();
            $pdf->Cell(40,10,"Price : ".$product['price']);
            $pdf->Ln();
            $pdf->Cell(40,10,"Key : ".$product['site']);
            $pdf->Ln();
            
        endforeach;
        $pdf->Output();
        
        
        require_once (ROOT . '/views/cabinet/history.php');
        return true;
        
    }
    
    
}

