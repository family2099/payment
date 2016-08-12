<?php

// namespace myProject\Test;
// use myProject\Database;
require_once("/home/ubuntu/workspace/payment/myProject/Database.php");
// require_once('/home/ubuntu/workspace/payment/Database.php');

class DatabaseTest extends \PHPUnit_Framework_TestCase
{

    public function testFindUserId() {
        $userName = 123;
        $expectedResult = "1";

        $findUserId = new Database();
        $result = $findUserId->findUserId($userName);

        $this->assertEquals($expectedResult, $result);
    }

    public function testGetUserData()
    {
        $userName = 123;
        $expectedRemain = "30000";
        $expectedmoney = "1000";

        $getUserData = new Database();
        $result = $getUserData->getUserData($userName);

        $this->assertEquals($expectedRemain, $result[0]);
        $this->assertEquals($expectedmoney, $result[1][0]['money']);
    }

    public function testSaveMoney()
    {
        $money = 1000;
        $accountSave = 1;
        $name = 123;

        $saveMoney = new Database();
        $result = $saveMoney->saveMoney($money , $accountSave, $name);
        $this->assertEmpty($result);
    }


}