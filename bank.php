<?php

    require_once("Database.php");
    header("Content-Type:text/html; charset=utf-8");

    $account = new Bank();

    if (isset($_POST["userName"])) {
        $userName=$_POST["userName"];
        $accountData=$account->getUserData($userName);
    }

    if (isset($_POST["save"])) {
        $account->saveMoney($_POST["saveMoney"], $_POST["accountSave"], $_POST["accountName"]);
    }

    if (isset($_POST["out"])) {
        $account->getMoney($_POST["outMoney"], $_POST["accountOut"], $_POST["accountName"]);
    }
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

                                    <label>使用者:<?php echo $userName;?></label>

                                </div>
                            </form>

                            <form role="form" method="post">
                                <div class="form-group">

                                    <label>存款金額</label>
                                    <input type="number" class="form-control" name="saveMoney" min="0" required >

                                </div>

                                <input type="hidden" name="accountName" value="<?php echo $userName;?>">
                                <input type="hidden" name="accountSave" value="1">
                                <button type="submit" class="btn btn-default" name="save" >存款</button>

                            </form>

                            <form role="form" method="post">

                                <div class="form-group">

                                    <label for="input2">提款金額</label>
                                    <input type="number" class="form-control" name="outMoney" min="0" required >

                                </div>

                                <input type="hidden" name="accountName" value="<?php echo $userName;?>">
                                <input type="hidden" name="accountOut" value="2">
                                <button type="submit" class="btn btn-default" name="out" >提款</button>

                            </form>

                        </div>

                </div>

                <hr>

                <label>使用者餘額:</label><?php echo $accountData[0];?>

                <hr>

                <label>使用者交易明細:</label>

                <br>
                <br>

                <table class="table table-striped">

                    <thead>
                        <tr>
                            <center>

                                <th>日期</th>
                                <th>事項</th>
                                <th>金額</th>

                            </center>
                        </tr>
                    </thead>


                <?php


                    foreach ($accountData[1] as $value) {

                ?>
                        <tr>
                <?php
                        foreach ($value as $detail) {

                ?>
                            <td><?php echo $detail; ?></td>

                <?php
                        }
                ?>

                        <tr>
                <?php
                    }

                ?>

                </table>

        </div>
    </div>

</body>
</html>