<?php

    error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
    ini_set('display_errors', 1);

    
$ini_string='
[игрушка мягкая мишка белый]
цена = '.  mt_rand(1, 10).';
количество заказано = '.  mt_rand(1, 10).';
осталось на складе = '.  mt_rand(0, 10).';
diskont = diskont'.  mt_rand(0, 2).';
    
[одежда детская куртка синяя синтепон]
цена = '.  mt_rand(1, 10).';
количество заказано = '.  mt_rand(1, 10).';
осталось на складе = '.  mt_rand(0, 10).';
diskont = diskont'.  mt_rand(0, 2).';
    
[игрушка детская велосипед]
цена = '.  mt_rand(1, 10).';
количество заказано = '.  mt_rand(1, 10).';
осталось на складе = '.  mt_rand(0, 10).';
diskont = diskont'.  mt_rand(0, 2).';

';
$bd=  parse_ini_string($ini_string, true);
//print_r($bd);
//var_dump($bd);
    
    # =========
    # Задание 1
    # =========
    # Вывести перечень заказанных товаров, их цену, кол-во и остаток на складе

    $bear = array_slice($bd['игрушка мягкая мишка белый'], 0, 4, false);
    $jacket = array_slice($bd['одежда детская куртка синяя синтепон'], 0, 4, false);
    $bicycle = array_slice($bd['игрушка детская велосипед'], 0, 4, false);

//    var_dump($bear);
    
    $bear_s = array_values($bear);
    $jacket_s = array_values($jacket);
    $bicycle_s = array_values($bicycle);
    
//    var_dump($bear_s);
    
    echo '<hr width="600px">';
    
    echo '<table align=center border=0 cellpadding=10 cellspacing=0 bordercolor=black width=600px>';
    
    echo '<tr><th colspan="4">'.'В корзине'.'</th></tr>'
            . '<tr><th width="200px">'.'Наименование товара'.'</th>'
                    . '<th width="100px">'.'цена 1 шт.'.'</th>'
                    . '<th width="100px">'.'заказано'.'</th>'
                    . '<th width="100px">'.'на складе'.'</th></tr>';
    echo '</table>';  
    
    echo '<hr width="600px">';
    
    echo '<table align=center border=0 cellpadding=10 cellspacing=0 bordercolor=black width=600px>';
            echo '<tr><td align="left" width="200px">'.'Игрушка мягкая - мишка белый:'.'</td>'
                    . '<td align="center" width="100px">'.$bear_s[0].' руб.'.'</td>'
                    . '<td align="center" width="100px">'.$bear_s[1].' шт.'.'</td>'
                    . '<td align="center" width="100px">'.$bear_s[2].' шт.'.'</td></tr>'
            . '<tr><td align="left" width="200px">'.'Одежда детская - куртка синяя синтепон:'.'</td>'
                    . '<td align="center" width="100px">'.$jacket_s[0].' руб.'.'</td>'
                    . '<td align="center" width="100px">'.$jacket_s[1].' шт.'.'</td>'
                    . '<td align="center" width="100px">'.$jacket_s[2].' шт.'.'</td></tr>'
            . '<tr><td align="left" width="200px">'.'Игрушка детская - велосипед:'.'</td>'
                    . '<td align="center" width="100px">'.$bicycle_s[0].' руб.'.'</td>'
                    . '<td align="center" width="100px">'.$bicycle_s[1].' шт.'.'</td>'
                    . '<td align="center" width="100px">'.$bicycle_s[2].' шт.'.'</td></tr>';
    echo '</table>';
 
    echo '<hr width="600px">';

    
    # =========
    # Задание 2
    # =========
    /* В секции ИТОГО должно быть указано: сколько всего наименований было заказано, каково общее количество товара, какова общая сумма заказа
    * 
    * - Cделать секцию "Уведомления", где необходимо извещать покупателя о том, что нужного количества товара не оказалось на складе
    * 
    * - Cделать секцию "Скидки", где известить покупателя о том, что если он заказал "игрушка детская велосипед" в количестве >=3 штук, 
    * то на эту позицию ему автоматически дается скидка 30% (соответственно цены в корзине пересчитываются тоже автоматически) */
    
    # ==================
    # Секция Уведомления
    
    uvedomlenie_z($bear_s, $jacket_s, $bicycle_s); // Вызываем Уведомления, в случае отсутствия товара
    
    
    # ===========================
    # Всего заказано наименований
    
    $zakaz_bear = array_slice($bear_s, 1, 1, false);
    $zakaz_jacket = array_slice($jacket_s, 1, 1, false);
    $zakaz_bicycle = array_slice($bicycle_s, 1, 1, false);
    $zakaz_vsego = array_merge($zakaz_bear, $zakaz_jacket, $zakaz_bicycle);
    
//    var_dump($zakaz_vsego);
    
    $filter_names = array_filter($zakaz_vsego,
        function($height) {
            return $height > 0;
        }
    );

    $zakaz_bear_stock = array_slice($bear_s, 2, 1, false);
    $zakaz_jacket_stock = array_slice($jacket_s, 2, 1, false);
    $zakaz_bicycle_stock = array_slice($bicycle_s, 2, 1, false);
    $zakaz_vsego_stock = array_merge($zakaz_bear_stock, $zakaz_jacket_stock, $zakaz_bicycle_stock);

//    var_dump($zakaz_vsego_stock);
    
    $filter_stock = array_filter($zakaz_vsego_stock,
        function($height) {
            return $height > 0;
        }
    );
        
    $all_names=count($filter_names);
    $all_stock=count($filter_stock);
    
//    var_dump($all_stock);
    
    if ($all_names > $all_stock) {
        $names_result=$all_stock;
    }else{
        $names_result=$all_names;
    }
    
    
//    var_dump($names_result); // Всего заказано наименований
    
    

    # ===========================
    # Общее количество товара

        
    if ($bear_s[2] < $bear_s[1]) {
            $bear_basket=$bear_s[2];
        }else{
            $bear_basket=$bear_s[1];
    }
    
    
        if ($jacket_s[2] < $jacket_s[1]) {
                $jacket_basket=$jacket_s[2];
            }else{
                $jacket_basket=$jacket_s[1];
        }
    
    
            if ($bicycle_s[2] < $bicycle_s[1]) {
                    $bicycle_basket=$bicycle_s[2];
                }else{
                    $bicycle_basket=$bicycle_s[1];
            }
    
    
    $obshee = $bear_basket+$jacket_basket+$bicycle_basket; // Общее количество товара

    
    # ===========================
    # Общая сумма заказа
    
    $sum=($bear_s[0]*$bear_basket)+($jacket_s[0]*$jacket_basket)+($bicycle_s[0]*$bicycle_basket);
    
    $bicycle_sum=$bicycle_s[0]*$bicycle_basket;
    
    $sum_discount=($bear_s[0]*$bear_basket)+($jacket_s[0]*$jacket_basket)+$bicycle_s[0]*$bicycle_basket;
    
    # =============
    # Секция Скидки
    
    discount($bicycle_s, $bicycle_basket); // Вызываем Скидки
    
    
    
    # ============
    # Секция ИТОГО
    
    echo '<table align=center border=0 cellpadding=10 cellspacing=0 bordercolor=black width=600px>';
        echo '<tr><th colspan="4">'.'Итого'.'</th></tr>'
            .'<tr><td align="right" width="435px" colspan="3">'.'Всего заказано наименований:'.'</td>'
            . '<td align="center" width="100px">'.$names_result.' ед.'.'</td></tr>'
            . '<tr><td align="right" width="435px" colspan="3">'.'Общее количество товара:'.'</td>'
            . '<td align="center" width="100px">'.$obshee.' шт.'.'</td></tr>'
            . '<tr><td align="right" width="435px" colspan="3">'.'Общая сумма заказа:'.'</td>'
            . '<td align="center" width="100px">'.$sum.' руб.'.'</td></tr>'
            . '<tr><td align="right" width="435px" colspan="3">'.'Ваша скидка:'.'</td>'
            . '<td align="center" width="100px">'.$sum_discount.' руб.'.'</td></tr>'
            . '<tr><td align="right" width="435px" colspan="3">'.'К оплате:'.'</td>'
            . '<td align="center" width="100px">'.$sum_discount.' руб.'.'</td></tr>';
    echo '</table>';
    echo '<hr width="600px">';
    
  
    # =========================
    # Делаем секцию Уведомления
    
    
        function uvedomlenie_z($bear_s, $jacket_s, $bicycle_s) {
        if ($bear_s[1] > $bear_s[2] || $jacket_s[1] > $jacket_s[2] || $bicycle_s[1] > $bicycle_s[2]) {
            echo '<table align=center border=0 cellpadding=10 cellspacing=0 bordercolor=black>';
            echo '<tr><th colspan="4">'.'Уведомления'.'</th></tr>';
            echo '</table>';
            
                if ($bear_s[1] > $bear_s[2]) {
                    echo '<table align=center border=0 cellpadding=10 cellspacing=0 bordercolor=black width=600px>';
                    echo '<tr><td colspan="1" width="200px" align="left">'.'Игрушка мягкая - мишка белый: '.'</td><td colspan="3" width="400px">'.'нужного количества товара не оказалось на складе'.'</td></tr><tr><td align="right" width="435px" colspan="3">'.'На складе:'.'</td><td align="center" width="100px"><FONT color="red">'.$bear_s[2].' шт.'.'</FONT></td></tr>';
                    echo '</table>';
                }
                if ($jacket_s[1] > $jacket_s[2]) {
                    echo '<table align=center border=0 cellpadding=10 cellspacing=0 bordercolor=black width=600px>';
                    echo '<tr><td colspan="1" width="200px" align="left">'.'Одежда детская - куртка синяя синтепон: '.'</td><td colspan="3" width="400px">'.'нужного количества товара не оказалось на складе'.'</td></tr><tr><td align="right" width="435px" colspan="3">'.'На складе:'.'</td><td align="center" width="100px"><FONT color="red">'.$jacket_s[2].' шт.'.'</FONT></td></tr>';
                    echo '</table>';
                }
                if ($bicycle_s[1] > $bicycle_s[2]) {
                    echo '<table align=center border=0 cellpadding=10 cellspacing=0 bordercolor=black width=600px>';
                    echo '<tr><td colspan="1" width="200px" align="left">'.'Игрушка детская - велосипед: '.'</td><td colspan="3" width="400px">'.'нужного количества товара не оказалось на складе'.'</td></tr><tr><td align="right" width="435px" colspan="3">'.'На складе:'.'</td><td align="center" width="100px"><FONT color="red">'.$bicycle_s[2].' шт.'.'</FONT></td></tr>';
                    echo '</table>';
                } echo '<hr width="600px">';
        }
    }
    
    
    
    # ===========================
    # Делаем секцию Скидки
    
    
        function discount($bicycle_s, $bicycle_basket) {
            switch ($bicycle_s && $bicycle_basket) {
                case ($bicycle_s[1] >= 3 && $bicycle_s[2] >= 3):
                    echo '<table align=center border=0 cellpadding=10 cellspacing=0 bordercolor=black>';
                    echo '<tr><th colspan="4">'.'Скидки'.'</th></tr>'
                            . '<tr><td colspan="4" width="600px" align="left">'.'Поздравляем! Так как Вы заказали "Игрушка детская - велосипед" в количестве: <b>'.$bicycle_basket.' шт.</b>, Вам предоставляется скидка на велосипеды в размере - <b>30%</b>!</td></tr>';
                    echo '</table>';
                    echo '<hr width="600px">';

                    break;

                default:

                    break;
            }
    }


    
?>