<?php error_reporting(-1);
//Для  каждого  числа  заданной  последовательности  натуральных   чисел   n0 ,n1,...,nm установить,  можно  ли  вычеркнуть
// в  нем  некоторые  цифры, чтобы сумма оставшихся равнялась заданному числу к.
$n = 10;
$nm = 500;
$k= 8;

for($i = $n; $i <= $nm; $i++){
  if(summnumk($i, $k)){
        echo("Для ".$i." МОЖНО вычеркнуть некоторые цифры, чтобы сумма оставшихся равнялась {$k}<br>");
    }else{
        echo("Для ".$i." НЕЛЬЗЯ вычеркнуть некоторые цифры, чтобы сумма оставшихся равнялась {$k}<br>");
    }
}

function summnumk($n, $k){
    $sum = 0;
    $value =  $n;
    while($value != 0){  
        $num1 = round((($value / 10 )- (floor($value / 10)) )*10);  //раскладываем число на цифры
        $value = floor($value / 10);  
        $sum += $num1;
        }
    if($sum < $k){
        return false;
    }elseif($sum == $k){
        return false; //т.к. в задании указано,что нужно именно вычеркивать цифры
    }elseif($sum > $k){
//-------------------------Проверяем условия-------------------        
       if(one_number_summ($n, $k)){ // k = цифре из числа
           return true;
       }elseif(all_without_this($n, $k)){ //k = сумме цифр без одной цифры
            return true;
       }elseif(number_plus_number($n,$k)){ //k = цифра + цифра 
            return true;
       }else{
           return false;
       }
    }
}     
//---Попутно, описнные далее функции проверяют все промежуточные сложения на соответствие k. 
//---------------------------------Служебные функции        
        
function one_number_summ($n, $k){ //узнаем, соответвсвует ли цифра числа числу k
    for($i = 0; $i <= 9; $i++){
        $value =  $n;
        $flag = 0;
        while($value != 0){  
            $num1 = round((($value / 10 )- (floor($value / 10)) )*10);  //раскладываем число на цифры
            $value = floor($value / 10);
            if($num1 == $k){
                return true;
            }
        }
    }
}
    
function all_without_this($n, $k){ // складываем все цифры, кроме одной попорядку 
    $numsum = 0;
    for($i = 0; $i <= 9; $i++){
        $flag = 0;
        $value =  $n;
        $numsum = 0;
        while($value != 0){  
            $num1 = round((($value / 10 )- (floor($value / 10)) )*10);  //раскладываем число на цифры
            $value = floor($value / 10); 
            if($flag == 0){
                if($num1 == $i){
                    $num1 = 0; // зануляем одну цифру. 
                    $flag = 1;
                }
            }
            $numsum += $num1;
            if($numsum == $k){
                return true;
            }
        }
        
    }
}

function number_plus_number($n, $k){ //складываем все цифры между собой попорядку, ищем совпадения
    for($a = 0; $a <=9; $a++){  
        $num = 0;
        $value = $n; 
        $flagsave = 0; //разрешаем запись в текущей итерации
        $b = 0; // счётчик итераций цикла while
        while($value != 0){  
            $num1 = round((($value / 10 )- (floor($value / 10)) )*10);  //раскладываем число на цифры
            $value = floor($value / 10);  
            if($flagsave == 0){ //разрешение на запись 
                if($a == $b){   // проверка синхронизации итераций двух циклов
                    $num = $num1; //записываем цифру, которую будем складвать с остальными
                    $flagsave = 1; // запрещаем запись остальных цифр 
                }
            }else{ //если цифра в текущеи итерации записана
                $res = $num + $num1; //складываем её с каждой по очереди 
                if($res == $k){     
                    return true;
                }
            }
            $b++;
        }
        
       
    }
    return false;
}
