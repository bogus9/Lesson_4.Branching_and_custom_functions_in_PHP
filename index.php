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


    # ==========================
    # Содержание:
    # 
    # Задание 1     стр 44
    # Задание 2.2   стр 127
    # Задание 3     стр 294
    # Задание 2.1   стр 489
    # Задание 2.3   стр 516
    # =========================
    

    # =========
    # Задание 1
    # =========
    # Вывести перечень заказанных товаров, их цену, кол-во и остаток на складе


    // Извлекаем подмассивы
    $bear_sub = array_slice($bd['игрушка мягкая мишка белый'], 0, 4, false);
    $jacket_sub = array_slice($bd['одежда детская куртка синяя синтепон'], 0, 4, false);
    $bicycle_sub = array_slice($bd['игрушка детская велосипед'], 0, 4, false);

//    var_dump($bear_sub);
//    var_dump($jacket_sub);
//    var_dump($bicycle_sub);
    
    
    // Переводим полученные ассоциативные массивы в индексные
    $bear = array_values($bear_sub);
    $jacket = array_values($jacket_sub);
    $bicycle = array_values($bicycle_sub);
    
//    var_dump($bear);
//    var_dump($jacket);
//    var_dump($bicycle);
    

    # ============================================
    // Создаем функцию с глобальной переменной для 
    // заполнения колонки - Наименование товара.
    
    $globalBear = 'Игрушка мягкая - мишка белый';
    $globalJacket = 'Одежда детская - куртка синяя синтепон';
    $globalBicycle = 'Игрушка детская - велосипед';

    function Bear() {
      global $globalBear;
      return $globalBear;
    }
    
    function Jacket() {
      global $globalJacket;
      return $globalJacket;
    }
    
    function Bicycle() {
      global $globalBicycle;
      return $globalBicycle;
    }


    
    // Создаем таблицу для вывода исходных данных
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
            echo '<tr><td align="left" width="200px">'.Bear().':'.'</td>'
                    . '<td align="center" width="100px">'.$bear[0].' руб.'.'</td>'
                    . '<td align="center" width="100px">'.$bear[1].' шт.'.'</td>'
                    . '<td align="center" width="100px">'.$bear[2].' шт.'.'</td></tr>'
            . '<tr><td align="left" width="200px">'.Jacket().':'.'</td>'
                    . '<td align="center" width="100px">'.$jacket[0].' руб.'.'</td>'
                    . '<td align="center" width="100px">'.$jacket[1].' шт.'.'</td>'
                    . '<td align="center" width="100px">'.$jacket[2].' шт.'.'</td></tr>'
            . '<tr><td align="left" width="200px">'.Bicycle().':'.'</td>'
                    . '<td align="center" width="100px">'.$bicycle[0].' руб.'.'</td>'
                    . '<td align="center" width="100px">'.$bicycle[1].' шт.'.'</td>'
                    . '<td align="center" width="100px">'.$bicycle[2].' шт.'.'</td></tr>';
    echo '</table>';
 
    echo '<hr width="600px">';

    
    # ===========
    # Задание 2.2
    # ===========

    /* - Cделать секцию "Уведомления", где необходимо извещать покупателя о том, что нужного количества товара не оказалось на складе
    * 
    * - Cделать секцию "Скидки", где известить покупателя о том, что если он заказал "игрушка детская велосипед" в количестве >=3 штук, 
    * то на эту позицию ему автоматически дается скидка 30% (соответственно цены в корзине пересчитываются тоже автоматически) */
    
    
    # ==================
    # Секция Уведомления
    
    // Вызываем функцию Уведомления, в случае отсутствия товара
    uvedomlenie_z($bear, $jacket, $bicycle);
    
    
    # ===========================
    # Всего заказано наименований
    
    // Извлекаем элементы, где указано кол-во заказанных товаров
    $zakaz_bear = array_slice($bear, 1, 1, false);
    $zakaz_jacket = array_slice($jacket, 1, 1, false);
    $zakaz_bicycle = array_slice($bicycle, 1, 1, false);
    
    // Объединяем извлеченные элементы в один массив
    $zakaz_vsego = array_merge($zakaz_bear, $zakaz_jacket, $zakaz_bicycle);
    
//    var_dump($zakaz_vsego);
    
    
    // Фильтруем полученный массив и оставляем только те элементы, значение которых > 0
    $filter_names = array_filter($zakaz_vsego,
        function($height) {
            return $height > 0;
        }
    );

//    var_dump($filter_names);
    
    
    
    // Извлекаем элементы, где указаны остатки на складе
    $bear_stock = array_slice($bear, 2, 1, false);
    $jacket_stock = array_slice($jacket, 2, 1, false);
    $bicycle_stock = array_slice($bicycle, 2, 1, false);
    
    // Объединяем извлеченные элементы в один массив
    $vsego_stock = array_merge($bear_stock, $jacket_stock, $bicycle_stock);

//    var_dump($vsego_stock);
    
    
    // Фильтруем полученный массив и оставляем только те элементы, значение которых > 0
    $filter_stock = array_filter($vsego_stock,
        function($height) {
            return $height > 0;
        }
    );
        
//    var_dump($filter_stock);
    
    
    
    // Подсчитываем общее количество элементов массивах
    $all_names=count($filter_names);
    $all_stock=count($filter_stock);
    
//    var_dump($all_names);
//    var_dump($all_stock);
    
    
    // Определяем наименьшее количество наименований продукции, исходя из полученных данных
    if ($all_names > $all_stock) {
        $names_result=$all_stock;
    }else{
        $names_result=$all_names;
    }
    
    // Всего заказано наименований
//    var_dump($names_result);
    
    

    # ===========================
    # Общее количество товара

    // Ставим условие, при котором выводим наименьшее значение, 
    // либо остатков на складе, либо заказанных товаров
    if ($bear[2] < $bear[1]) {
            $bear_basket=$bear[2];
        }else{
            $bear_basket=$bear[1];
    }
    
    
        if ($jacket[2] < $jacket[1]) {
                $jacket_basket=$jacket[2];
            }else{
                $jacket_basket=$jacket[1];
        }
    
    
            if ($bicycle[2] < $bicycle[1]) {
                    $bicycle_basket=$bicycle[2];
                }else{
                    $bicycle_basket=$bicycle[1];
            }
    
    // Общее количество заказанного товара в корзине
    $basket = $bear_basket+$jacket_basket+$bicycle_basket;
    
    
    # ========================================
    // Создаем функцию со статичной переменной
    
    $a=0;
    
    function basket($basket) {
        static $a = 0;
        $a=$a+$basket;
        echo $a.'<br />';
    }
    
    /* Как использовать эту функцию в данном коде я так и не понял. 
     * Какая ее роль? Зачем она нужна? Я понял как она работает, 
     * но где и когда это используется, конкретные случаи?
     */

//    basket($basket);
//    echo $a;
//    basket($basket);
//    echo $a;
    
    
    
    # ===========================
    # Общая сумма заказа
    
    $sum=($bear[0]*$bear_basket)+($jacket[0]*$jacket_basket)+($bicycle[0]*$bicycle_basket);
    
    
    # =============
    # Секция Скидки
    
    // Вызываем функцию Скидки
    discount($bicycle, $bicycle_basket);
    
    
    
    # ====================================
    # Высчитываем 30% скидки на велосипеды
    
    // Ставим условие, при котором высчитывается скидка 30% на велосипеды,
    if ($bicycle[1] >= 3 && $bicycle[2] >= 3) {
        $discount = $bicycle[0]*$bicycle_basket*30/100;
    }else{
        $discount = 0;
    }
    
    // Высчитываем стоимость велосипедов с учетом 30% скидки
    $bicycle_30 = $bicycle[0]*$bicycle_basket - $discount;
    
//    var_dump($bicycle_30);
//    var_dump($discount);
    
    
    # =========
    # Задание 3
    # =========
    
    /* У каждого товара есть автоматически генерируемый скидочный купон diskont, 
     * используйте переменную функцию, чтобы делать скидку на итоговую цену в корзине
    * diskont0 = скидок нет, diskont1 = 10%, diskont2 = 20%
     */

    
    # =======================================
    # Высчитываем скидки по дисконтным картам 
    
    // Извлекаем элементы скидочных купонов
    $diskont_bear = array_slice($bear, 3, 1, false);
    $diskont_jacket = array_slice($jacket, 3, 1, false);
    $diskont_bicycle = array_slice($bicycle, 3, 1, false);
    
    // Объединяем извлеченные элементы в один массив
    $diskont_vsego = array_merge($diskont_bear, $diskont_jacket, $diskont_bicycle);
    
//    var_dump($diskont_vsego);
    

    // Просчет скидок в процентах
    $discount_bear=0;
    $discount_bear_10=$bear[0]*$bear_basket*10/100;
    $discount_bear_20=$bear[0]*$bear_basket*20/100;
    
    
    // Создаем конструкцию из перменных функций для вывода необходимой скидки
    // в зависимости от сгенерированной скидочной карты
    function discount_bear() {
        global $discount_bear;
        return $discount_bear;
    }

    function discount_bear_10() {
         global $discount_bear_10;
         return $discount_bear_10;
    }

    function discount_bear_20() {
         global $discount_bear_20;
         return $discount_bear_20;
    }

    
    // Ставим условия, при которых будут выполнятся переменные функции
    switch ($diskont_vsego[0])
    {
      case 'diskont0' : $start_function_bear = 'discount_bear';
      break;
      case 'diskont1' : $start_function_bear = 'discount_bear_10';
      break;
      case 'diskont2' : $start_function_bear = 'discount_bear_20';
      break;
    }
    

//    var_dump($start_function_bear);
    
    
    // Производим те же самые манипуляция с остальными элементами массива $diskont_vsego
    

    $discount_jacket=0;
    $discount_jacket_10=$jacket[0]*$jacket_basket*10/100;
    $discount_jacket_20=$jacket[0]*$jacket_basket*20/100;
    

    function discount_jacket() {
        global $discount_jacket;
        return $discount_jacket;
    }

    function discount_jacket_10() {
         global $discount_jacket_10;
         return $discount_jacket_10;
    }

    function discount_jacket_20() {
         global $discount_jacket_20;
         return $discount_jacket_20;
    }

    
    switch ($diskont_vsego[1])
    {
      case 'diskont0' : $start_function_jacket = 'discount_jacket';
      break;
      case 'diskont1' : $start_function_jacket = 'discount_jacket_10';
      break;
      case 'diskont2' : $start_function_jacket = 'discount_jacket_20';
      break;
    }
    
    
//    var_dump($start_function_jacket);
    
    
    
    $discount_bicycle=0;
    $discount_bicycle_10=$bicycle[0]*$bicycle_basket*10/100;
    $discount_bicycle_20=$bicycle[0]*$bicycle_basket*20/100;
    

    function discount_bicycle() {
        global $discount_bicycle;
        return $discount_bicycle;
    }

    function discount_bicycle_10() {
         global $discount_bicycle_10;
         return $discount_bicycle_10;
    }

    function discount_bicycle_20() {
         global $discount_bicycle_20;
         return $discount_bicycle_20;
    }


    switch ($diskont_vsego[1])
    {
      case 'diskont0' : $start_function_bicycle = 'discount_bicycle';
      break;
      case 'diskont1' : $start_function_bicycle = 'discount_bicycle_10';
      break;
      case 'diskont2' : $start_function_bicycle = 'discount_bicycle_20';
      break;
    }
    
    
//    var_dump($start_function_bicycle);
    
    
    
    // Сумма скидок по скидочным картам
    $discount_card=$start_function_bear()+$start_function_jacket()+$start_function_bicycle();
    
//    var_dump($discount_card);

    
    // Общая скидка на всю покупку, с учетом скидки на велосипеды 30%
    $discount_sum=$discount+$start_function_bear()+$start_function_jacket()+$start_function_bicycle();
    
//    var_dump($discount_sum);
 
    
    // Итого к оплате с учетом скидки
    $sum_discount=(($bear[0]*$bear_basket)+($jacket[0]*$jacket_basket)+$bicycle_30) - $discount_card;
    
    
    
//        // Ставим условие, при котором определяем, какая скидка будет предоставлена,
//        // исходя из генерируемой скидочной карты
//
//        if ($diskont_vsego[0]==='diskont0') {
//            $discount_bear=0;
//        }elseif($diskont_vsego[0]==='diskont1') {
//            $discount_bear=$bear[0]*$bear_basket*10/100;
//        }elseif ($diskont_vsego[0]==='diskont2') {
//            $discount_bear=$bear[0]*$bear_basket*20/100;
//        }
//        
//        if ($diskont_vsego[1]==='diskont0') {
//            $discount_jacket=0;
//        }elseif($diskont_vsego[1]==='diskont1') {
//            $discount_jacket=$jacket[0]*$jacket_basket*10/100;
//        }elseif ($diskont_vsego[1]==='diskont2') {
//            $discount_jacket=$jacket[0]*$jacket_basket*20/100;
//        }
//        
//        if ($diskont_vsego[2]==='diskont0') {
//            $discount_bicycle=0;
//        }elseif($diskont_vsego[2]==='diskont1') {
//            $discount_bicycle=$bicycle[0]*$bicycle_basket*10/100;
//        }elseif ($diskont_vsego[2]==='diskont2') {
//            $discount_bicycle=$bicycle[0]*$bicycle_basket*20/100;
//        }
//        
//        var_dump($discount_bear);
//        var_dump($discount_jacket);
//        var_dump($discount_bicycle);
//        
//        // Сумма скидок по скидочным картам
//        $discount_card=$discount_bear+$discount_jacket+$discount_bicycle;
//        
//        // Общая скидка на всю покупку, с учетом скидки на велосипеды 30%
//        $discount_sum=$discount+$discount_bear+$discount_jacket+$discount_bicycle;
 
    
    
    
    # ===========
    # Задание 2.1
    # ===========
    /* В секции ИТОГО должно быть указано: сколько всего наименований было заказано, 
     * каково общее количество товара, какова общая сумма заказа
     */ 
    
    # ============
    # Секция ИТОГО
    
    echo '<table align=center border=0 cellpadding=10 cellspacing=0 bordercolor=black width=600px>';
        echo '<tr><th colspan="4">'.'Итого'.'</th></tr>'
            .'<tr><td align="right" width="435px" colspan="3">'.'Всего заказано наименований:'.'</td>'
            . '<td align="center" width="100px">'.$names_result.' ед.'.'</td></tr>'
            . '<tr><td align="right" width="435px" colspan="3">'.'Общее количество товара:'.'</td>'
            . '<td align="center" width="100px">'.$basket.' шт.'.'</td></tr>'
            . '<tr><td align="right" width="435px" colspan="3">'.'Общая сумма заказа:'.'</td>'
            . '<td align="center" width="100px">'.$sum.' руб.'.'</td></tr>'
            . '<tr><td align="right" width="435px" colspan="3">'.'Ваша скидка:'.'</td>'
            . '<td align="center" width="100px">'.$discount_sum.' руб.'.'</td></tr>'
            . '<tr><td align="right" width="435px" colspan="3">'.'К оплате:'.'</td>'
            . '<td align="center" width="100px">'.$sum_discount.' руб.'.'</td></tr>';
    echo '</table>';
    echo '<hr width="600px">';
    
  
    
    # ===========
    # Задание 2.3
    # =========================
    # Делаем секцию Уведомления
    
    $globalName = 'Игрушка мягкая - мишка белый';
    
    /*??? Здесь хотел создать еще одну функцию с глобальной переменной, в которую указал наименование товара со скидкой,
     * после чего когда вставлял функцию в echo внутри функции discount,  на выходе в данной секции глобальная 
     * переменная не отоброжалась, хотя var_dump нормально выводил функцию discount вместе с этой переменной. 
     * Независимо от того указываю ли я в этой функции эту переменную как глобальную или нет. ???
     * 
     *  ??? Также пробовал просто указывать в функции discount глобальную переменную и определять
     *  ее сразу в echo - все равно не отображается ????
     */
    
    // Создаем функцию, где выполняется условие, в котором уведомление появляется в том случае, 
    // когда количество товара на складе меньше количества заказанных товаров
    function uvedomlenie_z($bear, $jacket, $bicycle) {
        if ($bear[1] > $bear[2] || $jacket[1] > $jacket[2] || $bicycle[1] > $bicycle[2]) {
            echo '<table align=center border=0 cellpadding=10 cellspacing=0 bordercolor=black>';
            echo '<tr><th colspan="4">'.'Уведомления'.'</th></tr>';
            echo '</table>';
            
                if ($bear[1] > $bear[2]) {
                    echo '<table align=center border=0 cellpadding=10 cellspacing=0 bordercolor=black width=600px>';
                    echo '<tr><td colspan="1" width="200px" align="left">'.'Игрушка мягкая - мишка белый: '.'</td><td colspan="3" width="400px">'.'нужного количества товара не оказалось на складе'.'</td></tr><tr><td align="right" width="435px" colspan="3">'.'На складе:'.'</td><td align="center" width="100px"><FONT color="red">'.$bear[2].' шт.'.'</FONT></td></tr>';
                    echo '</table>';
                }
                if ($jacket[1] > $jacket[2]) {
                    echo '<table align=center border=0 cellpadding=10 cellspacing=0 bordercolor=black width=600px>';
                    echo '<tr><td colspan="1" width="200px" align="left">'.'Одежда детская - куртка синяя синтепон: '.'</td><td colspan="3" width="400px">'.'нужного количества товара не оказалось на складе'.'</td></tr><tr><td align="right" width="435px" colspan="3">'.'На складе:'.'</td><td align="center" width="100px"><FONT color="red">'.$jacket[2].' шт.'.'</FONT></td></tr>';
                    echo '</table>';
                }
                if ($bicycle[1] > $bicycle[2]) {
                    echo '<table align=center border=0 cellpadding=10 cellspacing=0 bordercolor=black width=600px>';
                    echo '<tr><td colspan="1" width="200px" align="left">'.'Игрушка детская - велосипед: '.'</td><td colspan="3" width="400px">'.'нужного количества товара не оказалось на складе'.'</td></tr><tr><td align="right" width="435px" colspan="3">'.'На складе:'.'</td><td align="center" width="100px"><FONT color="red">'.$bicycle[2].' шт.'.'</FONT></td></tr>';
                    echo '</table>';
                } echo '<hr width="600px">';
        }
    }
    
    
    
    # ===========================
    # Делаем секцию Скидки
  
    /*??? Здесь хотел создать еще одну функцию с глобальной переменной, в которую указал наименование товара со скидкой,
     * после чего когда вставлял функцию в echo внутри функции discount,  на выходе в данной секции глобальная 
     * переменная не отоброжалась, хотя var_dump нормально выводил функцию discount вместе с этой переменной. 
     * Независимо от того указываю ли я в этой функции эту переменную как глобальную или нет. ???
     * 
     *  ??? Также пробовал просто указывать в функции discount глобальную переменную и определять
     *  ее сразу в echo - все равно не отображается ????
     */
    
    
    // Создаем функцию, где выполняется условие, в котором скидка на велосипеды появляется в том случае,
    // когда количество заказанных велосипедов больше или равна 3
    function discount($bicycle, $bicycle_basket) {
        switch ($bicycle) {
            case ($bicycle[1] >= 3 && $bicycle[2] >= 3):
                echo '<table align=center border=0 cellpadding=10 cellspacing=0 bordercolor=black>';
                echo '<tr><th colspan="4">'.'Скидки'.'</th></tr>'
                        . '<tr><td colspan="4" width="600px" align="left">Поздравляем! Вы заказали <b><i>"Игрушка детская - велосипед"</i></b> в количестве: <b>'.$bicycle_basket.' шт.</b>, поэтому Вам предоставляется скидка на велосипеды в размере - <b>30%</b>!</td></tr>';
                echo '</table>';
                echo '<hr width="600px">';
                break;

            default:
                break;
        }
    }

?>