<?php

    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display_errors', 1);

    echo 'прикол';
    
    $my_name = 'pavel2345';
    
    if($my_name=='pavel')
    {
        if($my_name=='pavel')
        {
            if($my_name=='pavel')
            {
                echo 'yes'; //1 => TRUE
            }
        }
    }
    elseif($my_name=='pavel123')
        echo 'pavel 123';
    
    elseif($my_name=='pavel2345')
        echo 'pavel2345';
    
    else
        echo 'no'; // 0 => FALSE
    
?>