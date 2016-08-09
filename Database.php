<?php

require_once("Dbconfig.php");
date_default_timezone_set('Asia/Taipei');

class Bank
{
    //data soruce name 資料來源
    private $conn;
    
    /**
     *預設先連資料庫
     */
    public function __construct()
    {
        $this->conn = new DbConfig();
    }
    
    //取得使用者的餘額和交易明細
    public function getUserData()
    {
        //取的餘額
        $query = "SELECT `remain` FROM `userdata` WHERE `userName` = 123 ";
        $result = $this->conn->_dsnconn->prepare($query);
        $result->execute(); 
        $row=$result->fetch(PDO::FETCH_ASSOC);

        //取得交易明細
        $query = "SELECT * FROM `detail` WHERE `userName` = 123 ";
        $result = $this->conn->_dsnconn->prepare($query);
        $result->execute(); 
        $p=0;
        while ($row1=$result->fetch(PDO::FETCH_ASSOC)) {
            
            $arr[$p]=array(
                            "dataTime"=>$row1["dataTime"],
                            "addOrDel"=>$row1["addOrDel"],
                            "money"=>$row1["money"],
    		);
    			
    	    $p++;
        }
        $data[0]=$row["remain"];
        $data[1]=$arr;
        
        return $data;
    }

    public function saveMoney($money, $accountSave)
    {
        
        try {
            //鎖定一筆紀錄
            $this->conn->_dsnconn->beginTransaction();
            $query = "SELECT * FROM `userdata` WHERE `id` = 1 FOR UPDATE";
            $result = $this->conn->_dsnconn->prepare($query);
			$result->execute();

            //存入該筆交易紀錄
            $query = "INSERT INTO `detail` (userName, addOrDel, money) VALUES (123, ?, ?)";
            $result = $this->conn->_dsnconn->prepare($query);
            $result->bindValue(1, $accountSave, PDO::PARAM_INT);
            $result->bindValue(2, $money, PDO::PARAM_INT);
            $result->execute();
            
            //餘額相加並存入資料庫
            $query="UPDATE `userdata` SET `remain` = `remain` + ? WHERE `id` = 1 ";
            $result = $this->conn->_dsnconn->prepare($query);
            $result->bindValue(1, $money, PDO::PARAM_INT);
            $result->execute();

            //上述都完成就寫入資料庫    
            $this->conn->_dsnconn->commit();
        } catch (Exception $err) {
            //如果失敗就取消上述動作    
			$this->conn->_dsnconn->rollback();
			echo $err->getMessage();
        }
    }

    public function getMoney($money, $accountOut)
    {
    
        try {
            //鎖定一筆紀錄
            $this->conn->_dsnconn->beginTransaction();
            $query = "SELECT * FROM `userdata` WHERE `id` = 1 FOR UPDATE";
            $result = $this->conn->_dsnconn->prepare($query);
			$result->execute();
			$row = $result->fetch();
            
            if ($row["remain"] < $money) {
            	throw new Exception('餘額不足'); 
            }

            //存入該筆交易紀錄
            $query = "INSERT INTO `detail` (userName, addOrDel, money) VALUES (123, ?, ?)";
            $result = $this->conn->_dsnconn->prepare($query);
            $result->bindValue(1, $accountOut, PDO::PARAM_INT);
            $result->bindValue(2, $money, PDO::PARAM_INT);
            $result->execute();
            
            //餘額相減並存入資料庫
            $query="UPDATE `userdata` SET `remain` = `remain`- ? WHERE `id` = 1 ";
            $result = $this->conn->_dsnconn->prepare($query);
            $result->bindValue(1, $money, PDO::PARAM_INT);
            $result->execute();
            //上述都完成就寫入資料庫    
            $this->conn->_dsnconn->commit();
        } catch (Exception $err) {
            //如果失敗就取消上述動作 
            $this->conn->_dsnconn->rollback();
            echo $err->getMessage();
        }
    }
}

