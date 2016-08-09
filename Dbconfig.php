<?php

class Dbconfig
{

    public $_dbms = "mysql";             //資料庫類型 
    public $_host = "localhost";         //資料庫ip位址
    public $_port = "3306";           //資料庫埠
    public $_username = "root";          //資料庫用戶名
    public $_password = "";              //密碼
    public $_dbname = "bank";            //資料庫名
    public $_charset = "utf-8";       //資料庫字元編碼
    public $_dsnconn;                    //data soruce name 資料來源


    /*-------------------------
    預設先連資料庫
    -------------------------*/
    public function __construct()
    {
        
        try {

        	$this->_dsnconn = new PDO($this->_dbms.':host='.$this->_host.';dbname='.$this->_dbname,$this->_username,$this->_password);
            
        	$this->_dsnconn->exec("SET CHARACTER SET utf8");
            
            
            
        } 
        catch (PDOException $e) {
            
        	return 'Error!: ' . $e->getMessage() . '<br />';
        }
        
    
    }


    public function close()
    {
 		$this->$_dsnconn = NULL;
 		
    }


}

