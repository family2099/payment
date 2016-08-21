<?php
date_default_timezone_set('Asia/Taipei');
require_once("/home/ubuntu/workspace/payment/Database.php");

class DatabaseTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp() {
        $pdo = new Bank();
        $testSql =$pdo->conn->_dsnconn->prepare("UPDATE `userdata` SET `remain` = 1000 WHERE `userName` = 'qq'");
        $testSql->execute();
    }

    //可加可不加
    protected function tearDown()
    {
        $pdo = new Bank();
        $testSql =$pdo->conn->_dsnconn->prepare("UPDATE `userdata` SET `remain` = 0 WHERE `userName` = 'qq'");
        $testSql->execute();
    }

    public function testFindUserId() {
        $findUserId = new Bank();
        $result = $findUserId->findUserId('qq');

        $this->assertEquals(4, $result);
    }

    public function testGetUserData() {
        $getUserData = new Bank();
        $result = $getUserData->getUserData('qq');

        $this->assertEquals(1000, $result[0]);
        $this->assertEquals(1000, $result[1][0]['money']);
    }

    public function testSaveMoney() {
        $saveMoney = new Bank();
        $result = $saveMoney->saveMoney(1000, 1, 'qq');

        // $this->assertNull($result);
        $this->assertEmpty($result);
    }

    public function testSaveMoneyError() {
        $saveMoney = new Bank();
        $result = $saveMoney->saveMoney(0, 1, 'qq');

        // $this->assertNull($result);
        $this->assertEmpty($result);
    }

    public function testGetMoney() {
        $getMoney = new Bank();
        $result = $getMoney->getMoney(1000, 2, 'qq');

        $this->assertEmpty($result);
        // exit;
    }

    public function testGetMoneyError() {
        $getMoney = new Bank();
        $result = $getMoney->getMoney(10000, 2, 'qq');

        $this->assertEmpty($result);
        // exit;
    }
}