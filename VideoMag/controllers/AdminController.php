<?php
require_once (ROOT . '/components/AdminBase.php');
require_once (ROOT . '/models/User.php');
class AdminController extends AdminBase{
    
    public function actionIndex() {
        
        self::checkAdmin();
        
        require_once (ROOT . '/views/admin/index.php');
        return TRUE;
        
    }
    
}
