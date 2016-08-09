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
    
    
}

