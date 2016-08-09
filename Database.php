<?php
require_once("Dbconfig.php");
date_default_timezone_set('Asia/Taipei');
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
    
    
    public function getUserData()
    {
        
        $query = "SELECT `remain` FROM `userdata` WHERE `userName` = 123 ";
 
        $result = $this->conn->_dsnconn->prepare($query);
            
        $result->execute(); 
        
        $row=$result->fetch(PDO::FETCH_ASSOC);
        
        
        
        $query = "SELECT * FROM `detail` WHERE `userName` = 123 ";
 
        $result = $this->conn->_dsnconn->prepare($query);
            
        $result->execute(); 
        
        
        $p=0;
        
        while($row1=$result->fetch(PDO::FETCH_ASSOC))
        {
            
            $arr[$p]=array(
                            "dataTime"=>$row1["dataTime"],
                            "addOrDel"=>$row1["addOrDel"],
                            "money"=>$row1["money"],
    		);
    			
    	    $p++;
            
            
        }
        
        $data[0]=$row["remain"];
        $data[1]=$arr;
        // var_dump($data[0]);
        return $data;

        
    }
    

    public function saveMoney($money, $accountSave)
    {
        
        try
        {
            $this->conn->_dsnconn->beginTransaction();
            
            $query = "SELECT * FROM `userdata` WHERE `id`=1 FOR UPDATE";
            
            $result = $this->conn->_dsnconn->prepare($query);
            
			$result->execute();
			
            sleep(5);
            

            $query = "INSERT INTO `detail` (userName, addOrDel, money) VALUES (123, ?, ?)";
            
            $result = $this->conn->_dsnconn->prepare($query);

            $result->bindValue(1, $accountSave, PDO::PARAM_INT);
            
            $result->bindValue(2, $money, PDO::PARAM_INT);
            
            $result->execute();
            
            
            $query="UPDATE `userdata` SET `remain`=`remain`+ ? WHERE `id`=1 ";

            $result = $this->conn->_dsnconn->prepare($query);

            $result->bindValue(1, $money, PDO::PARAM_INT);

            $result->execute();
                
            $this->conn->_dsnconn->commit();
   
        }    
        catch (Exception $err) 
        {
			$this->conn->_dsnconn->rollback();
			echo $err->getMessage();
        }
		
	
	}
        
   
    public function getMoney($money, $accountOut)
    {
    
        try
        {
            $this->conn->_dsnconn->beginTransaction();
            
            $query = "SELECT * FROM `userdata` WHERE `id`=1 FOR UPDATE";
            
            $result = $this->conn->_dsnconn->prepare($query);
            
			$result->execute();
			
			$row = $result->fetch();
            sleep(5);
            
            if($row["remain"] >= $money)
            {

                $query = "INSERT INTO `detail` (userName, addOrDel, money) VALUES (123, ?, ?)";
                
                $result = $this->conn->_dsnconn->prepare($query);
    
                $result->bindValue(1, $accountOut, PDO::PARAM_INT);
                
                $result->bindValue(2, $money, PDO::PARAM_INT);
                
                $result->execute();
                
                
                $query="UPDATE `userdata` SET `remain`=`remain`- ? WHERE `id`=1 ";
    
                $result = $this->conn->_dsnconn->prepare($query);
    
                $result->bindValue(1, $money, PDO::PARAM_INT);
    
                $result->execute();
                    
                $this->conn->_dsnconn->commit();
                
            }
            else
            {
            	throw new Exception('餘額不足'); 
            }
            
            
        }    
        catch (Exception $err) 
        {
			$this->conn->_dsnconn->rollback();
			echo $err->getMessage();
        }
    
    }
    
}

