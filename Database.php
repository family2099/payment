<?php
require_once("Dbconfig.php");
class Bank
{
    
    private $conn;                    //data soruce name 資料來源


    /*-------------------------
    預設先連資料庫
    -------------------------*/
    public function __construct()
    {
        
        $this->conn = new Dbconfig();
 
    }
    
    
    
    
    
}

