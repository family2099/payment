<?php

class DbConfig
{
    //資料庫類型
    public $_dbms = "mysql";
    //資料庫ip位址
    public $_host = "localhost";
    //資料庫埠
    public $_port = "3306";
    //資料庫用戶名
    public $_username = "root";
    //密碼
    public $_password = "";
    //資料庫名
    public $_dbname = "bank";
    //data soruce name 資料來源
    public $_dsnconn;

    /**
     * 預設先連資料庫
     */
    public function __construct()
    {
        try {
            $this->_dsnconn = new PDO($this->_dbms.':host='.$this->_host.';dbname='.$this->_dbname, $this->_username, $this->_password);
            $this->_dsnconn->exec("SET CHARACTER SET utf8");

        } catch (PDOException $e) {

            return 'Error!: ' . $e->getMessage() . '<br />';
        }
    }

    public function close()
    {
        $this->$_dsnconn = NULL;
    }
}

