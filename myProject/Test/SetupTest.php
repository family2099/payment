<?php
//設定命名空間
namespace myProject\Test;

class SetupTest extends \PHPUnit_Framework_TestCase
{
    public function testAssertTrue()
    {
        $foo = true;
        $this->assertTrue($foo);
    }
}

?>