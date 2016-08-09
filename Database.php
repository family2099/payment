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

    public function findUserId($name)
    {
        $query = "SELECT `id` FROM `userdata` WHERE `userName` = ?";
        $result = $this->conn->_dsnconn->prepare($query);
        $result->bindValue(1, $name, PDO::PARAM_STR);
        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);

        return $row["id"];

    }
    //取得使用者的餘額和交易明細
    public function getUserData($userName)
    {
        //取的餘額
        $query = "SELECT `remain` FROM `userdata` WHERE `userName` = ?";
        $result = $this->conn->_dsnconn->prepare($query);
        $result->bindValue(1, $userName, PDO::PARAM_STR);
        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);

        //取得交易明細
        $query = "SELECT * FROM `detail` WHERE `userName` = ?";
        $result = $this->conn->_dsnconn->prepare($query);
        $result->bindValue(1, $userName, PDO::PARAM_STR);
        $result->execute();
        $p = 0;
        while ($row1 = $result->fetch(PDO::FETCH_ASSOC)) {

            $arr[$p] = [
                "dataTime" => $row1["dataTime"],
                "addOrDel" => $row1["addOrDel"],
                "money" => $row1["money"]
    		];
    	    $p++;
        }

        $data[0] = $row["remain"];
        $data[1] = $arr;

        return $data;
    }

    public function saveMoney($money, $accountSave, $name)
    {
        try {
            //鎖定一筆紀錄
            $this->conn->_dsnconn->beginTransaction();
            //取得ID欄位
            $id=$this->findUserId($name);

            //鎖定一筆紀錄
            $query = "SELECT * FROM `userdata` WHERE `id` = ? FOR UPDATE";
            $result = $this->conn->_dsnconn->prepare($query);
            $result->bindValue(1, $id, PDO::PARAM_INT);
            $result->execute();

            //存入該筆交易紀錄
            $query = "INSERT INTO `detail` (userName, addOrDel, money) VALUES (?, ?, ?)";
            $result = $this->conn->_dsnconn->prepare($query);
            $result->bindValue(1, $name, PDO::PARAM_INT);
            $result->bindValue(2, $accountSave, PDO::PARAM_INT);
            $result->bindValue(3, $money, PDO::PARAM_INT);
            $result->execute();

            //餘額相加並存入資料庫
            $query = "UPDATE `userdata` SET `remain` = `remain` + ? WHERE `id` = ?";
            $result = $this->conn->_dsnconn->prepare($query);
            $result->bindValue(1, $money, PDO::PARAM_INT);
            $result->bindValue(2, $id, PDO::PARAM_INT);
            $result->execute();

            //上述都完成就寫入資料庫
            $this->conn->_dsnconn->commit();
        } catch (Exception $err) {
            //如果失敗就取消上述動作
            $this->conn->_dsnconn->rollback();
            echo $err->getMessage();
        }
    }

    public function getMoney($money, $accountOut, $name)
    {
        try {
            //取得ID欄位
            $id=$this->findUserId($name);

            //鎖定一筆紀錄
            $this->conn->_dsnconn->beginTransaction();
            $query = "SELECT * FROM `userdata` WHERE `id` = ? FOR UPDATE";
            $result = $this->conn->_dsnconn->prepare($query);
            $result->bindValue(1, $id, PDO::PARAM_INT);
            $result->execute();
            $row = $result->fetch();

            if ($row["remain"] < $money) {
            	throw new Exception('餘額不足');
            }

            //存入該筆交易紀錄
            $query = "INSERT INTO `detail` (userName, addOrDel, money) VALUES (?, ?, ?)";
            $result = $this->conn->_dsnconn->prepare($query);
            $result->bindValue(1, $name, PDO::PARAM_STR);
            $result->bindValue(2, $accountOut, PDO::PARAM_INT);
            $result->bindValue(3, $money, PDO::PARAM_INT);
            $result->execute();

            //餘額相減並存入資料庫
            $query = "UPDATE `userdata` SET `remain` = `remain`- ? WHERE `id` = ?";
            $result = $this->conn->_dsnconn->prepare($query);
            $result->bindValue(1, $id, PDO::PARAM_INT);
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

