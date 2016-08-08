<?php

// var_dump($_POST);


?>

<!DOCTYPE>
<html>

<head>
    
	<meta charset="utf-8">
	<!---PS:其他js檔都要放JQUERY後面要不其他js檔先執行會錯誤--->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/jquery.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="views/js/bootstrap.min.js"></script>

</head>

<body>
    
    <div class="row">
        <div class="col-xm-12 col-sm-10 col-sm-offset-1 col-md-9 col-md-offset-1 col-lg-8 col-lg-offset-2">

                <div class="panel panel-info">
                      
                        <div class="panel-heading">
                            
                            <div class="page-header">
                                
                                <center><h1>銀行簡易系統</h1><center>
                                
                            </div>
                              
                        </div>

                        <div>
                            <form role="form" method="post">
                                
                                <div class="form-group">
                                    
                                    <label>使用者</label>
                                    <input type="text" class="form-control" name="userName" placeholder="輸入使用者名稱" required >
                                    
                                </div>
                                
                                <button type="submit" class="btn btn-default" name="inquire" >查詢餘額與明細</button>
                                
                            </form>
                            
                            <form role="form" method="post">    
                                
                                <div class="form-group">
                                    
                                    <label>存款金額</label>
                                    <input type="number" class="form-control" name="saveMoney" min="0" required >
                                
                                </div>
                                
                                <input type="hidden" name="accountSave" value="1">
                                
                                <button type="submit" class="btn btn-default" name="save" >存款</button>
                                
                            </form>
                            
                            <form role="form" method="post">
                                
                                <div class="form-group">
                                    
                                    <label for="input2">提款金額</label>
                                    <input type="number" class="form-control" name="outMoney" min="0" required >
                                
                                </div>
                                 
                                <input type="hidden" name="accountOut" value="2">
                                
                                <button type="submit" class="btn btn-default" name="out" >提款</button>
                                
                            </form>
                                
                                
                            
                        </div>    
                  
                </div>
        </div>        
    </div>

</body>
</html>