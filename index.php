<?php

//    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display_errors', 1);

    
    function factorial ($x) {
        echo $x.' | ';
        if ($x === 0)
            return 1;
        else
            return $x * factorial($x - 1);
    }
    
    echo factorial(6);
    
    // 3! = 1*2*3 = 6
    // 5! = 1*2*3*4*5 = 120
    // 6! = 1*2*3*4*5*6 = 720
    
    exit;
    function fact($x) {
        for ($result = 1; $x > 1; --$x) {
            $result *= $x;
        }
        return $result;
    }
    
    echo (fact(5));
    
    ?>