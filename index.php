<?php

    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display_errors', 1);

    $speed = 80;

    switch ($speed) {
        case '50':
        {
            echo 'Скорость в пределах нормы';
            break;
        }
        case '70':
        case '80':
        {
            echo 'Превышение скорости !'.'<br />';
        }
        default: 
        echo 'Скорость в допустимых нормах';
    break;
    
    }
    
?>