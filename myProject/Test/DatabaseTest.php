<?php

// namespace myProject\Test;
// use myProject\Database;
require_once("/home/ubuntu/workspace/payment/myProject/Database.php");
// require_once('/home/ubuntu/workspace/payment/Database.php');

class DatabaseTest extends \PHPUnit_Framework_TestCase
{

    public function testFindUserId() {
        $paramCount = 123;
        // $paramWhat = "*";
        $expectedResult = "1";

        $tool = new Database();
        $result = $tool->findUserId($paramCount);

        $this->assertEquals($expectedResult, $result);
    }






}