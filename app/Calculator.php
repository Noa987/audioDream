<?php

namespace App;

class Calculator
{    
    public function add($num1, $num2) {
        return $num1 + $num2;
    }

    public function f($x){
        if(is_int($x)){
            return $x*3+1;
        } else {
            return('NaN');
        }
    }
    
    function getFib($n){
        return round(pow((sqrt(5)+1)/2, $n) / sqrt(5));
    }

}

?>