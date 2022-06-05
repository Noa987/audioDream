<?php

use PHPUnit\Framework\TestCase;

class UnitTest extends Testcase {
    public function testAdd()
    {
        $calculator = new App\Calculator;
        $result = $calculator->add(20,5);
        $this->assertEquals(25, $result);

    }
}



?>