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
var_dump($bd);
    
    # =========
    # Задание 1
    # =========
    # Вывести перечень заказанных товаров, их цену, кол-во и остаток на складе

    $mishka = array_slice($bd['игрушка мягкая мишка белый'], 0, 4, false);
    $kurtka = array_slice($bd['одежда детская куртка синяя синтепон'], 0, 4, false);
    $bicycle = array_slice($bd['игрушка детская велосипед'], 0, 4, false);

    var_dump($mishka);
    $mishka_s = array_values($mishka);
    $kurtka_s = array_values($kurtka);
    $bicycle_s = array_values($bicycle);
    var_dump($mishka_s);
    
    echo '=========<br />';
    
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
                    . '<td align="center" width="100px">'.$mishka_s[0].' руб.'.'</td>'
                    . '<td align="center" width="100px">'.$mishka_s[1].' шт.'.'</td>'
                    . '<td align="center" width="100px">'.$mishka_s[2].' шт.'.'</td></tr>'
            . '<tr><td align="left" width="200px">'.'Одежда детская - куртка синяя синтепон:'.'</td>'
                    . '<td align="center" width="100px">'.$kurtka_s[0].' руб.'.'</td>'
                    . '<td align="center" width="100px">'.$kurtka_s[1].' шт.'.'</td>'
                    . '<td align="center" width="100px">'.$kurtka_s[2].' шт.'.'</td></tr>'
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
    
    uvedomlenie_z($mishka_s, $kurtka_s, $bicycle_s); // Вызываем Уведомления, в случае отсутствия товара
    
    
    
    # ===========================
    # Всего заказано наименований
    
    $zakaz_mishek = array_slice($mishka_s, 1, 1, false);
    $zakaz_kurtok = array_slice($kurtka_s, 1, 1, false);
    $zakaz_bicycle = array_slice($bicycle_s, 1, 1, false);
    $zakaz_vsego = array_merge($zakaz_mishek, $zakaz_kurtok, $zakaz_bicycle);
    var_dump($zakaz_vsego);

    $filter_names = array_filter($zakaz_vsego,
        function($height) {
            return $height > 0;
        }
    );

    $all_names=count($filter_names); // всего заказанных наименований
    var_dump($all_names);

    # ===========================
    # Всего заказано наименований
    
    # ============
    # Секция ИТОГО
    
    echo '<table align=center border=0 cellpadding=10 cellspacing=0 bordercolor=black width=600px>';
        echo '<tr><th colspan="4">'.'Итого'.'</th></tr>'
            .'<tr><td align="right" width="435px" colspan="3">'.'Всего заказано наименований:'.'</td>'
            . '<td align="center" width="100px">'.$all_names.' ед.'.'</td></tr>'
            . '<tr><td align="right" width="435px" colspan="3">'.'Общее количество товара:'.'</td>'
            . '<td align="center" width="100px">'.'itogo($obshee)'.' шт.'.'</td></tr>'
            . '<tr><td align="right" width="435px" colspan="3">'.'Общая сумма заказа:'.'</td>'
            . '<td align="center" width="100px">'.'itogo($summa)'.' руб.'.'</td></tr>';
    echo '</table>';
    
    
    
    # =========================
    # Делаем секцию Уведомления
    
    
        function uvedomlenie_z($mishka_s, $kurtka_s, $bicycle_s) {
        if ($mishka_s[1] > $mishka_s[2] || $kurtka_s[1] > $kurtka_s[2] || $bicycle_s[1] > $bicycle_s[2]) {
            echo '<table align=center border=0 cellpadding=10 cellspacing=0 bordercolor=black>';
            echo '<tr><th colspan="4">'.'Уведомления'.'</th></tr>';
            echo '</table>';
            
                if ($mishka_s[1] > $mishka_s[2]) {
                    echo '<table align=center border=0 cellpadding=10 cellspacing=0 bordercolor=black width=600px>';
                    echo '<tr><td colspan="1" width="200px" align="left">'.'Игрушка мягкая - мишка белый: '.'</td><td colspan="3" width="400px">'.'нужного количества товара не оказалось на складе'.'</td></tr><tr><td align="right" width="435px" colspan="3">'.'На складе:'.'</td><td align="center" width="100px"><FONT color="red">'.$mishka_s[2].' шт.'.'</FONT></td></tr>';
                    echo '</table>';
                }
                if ($kurtka_s[1] > $kurtka_s[2]) {
                    echo '<table align=center border=0 cellpadding=10 cellspacing=0 bordercolor=black width=600px>';
                    echo '<tr><td colspan="1" width="200px" align="left">'.'Одежда детская - куртка синяя синтепон: '.'</td><td colspan="3" width="400px">'.'нужного количества товара не оказалось на складе'.'</td></tr><tr><td align="right" width="435px" colspan="3">'.'На складе:'.'</td><td align="center" width="100px"><FONT color="red">'.$kurtka_s[2].' шт.'.'</FONT></td></tr>';
                    echo '</table>';
                }
                if ($bicycle_s[1] > $bicycle_s[2]) {
                    echo '<table align=center border=0 cellpadding=10 cellspacing=0 bordercolor=black width=600px>';
                    echo '<tr><td colspan="1" width="200px" align="left">'.'Игрушка детская - велосипед: '.'</td><td colspan="3" width="400px">'.'нужного количества товара не оказалось на складе'.'</td></tr><tr><td align="right" width="435px" colspan="3">'.'На складе:'.'</td><td align="center" width="100px"><FONT color="red">'.$bicycle_s[2].' шт.'.'</FONT></td></tr>';
                    echo '</table>';
                } echo '<hr width="600px">';
        }
    }
    



    

    
?>