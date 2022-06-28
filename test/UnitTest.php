<?php
// Running test
// ./vendor/bin/phpunit
//Updating 
//compser update
use PHPUnit\Framework\TestCase;

class UnitTest extends Testcase 
{

    public function testAdd()
    {
        $calculator = new App\Calculator;
        $result = $calculator->add(20,5);
        $this->assertEquals(25, $result);

    }
    public function testF()
    {
        $calculator = new App\Calculator;
        $this->assertEquals(1, $calculator->f(0));
        $this->assertEquals(10, $calculator->f(3));
        $this->assertEquals('NaN', $calculator->f('A'));

    }

}



?>