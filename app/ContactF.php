<?php

namespace App;

class ContactF{
    function isEmail($var){
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }
    
    function verifyInput($var){
        $var = trim($var);
        $var = stripslashes($var);
        $var = htmlspecialchars($var);
        return $var;
    }

}





?>