<?php
/**
 * @param string $a
 * @param string $b
 * @return string
 * @throws Exception
 */
function sum($a, $b)
{
    /* проверка на ввод - только строки из чисел */
    if (!preg_match("#^[0-9]+$#",$a.$b)) {
        throw new Exception('Wrong number format');
    }

    $lengthA = mb_strlen($a);
    $lengthB = mb_strlen($b);
    $maxLen = max($lengthA,$lengthB);

    /* приведение строк к одной длинне */
    $a = str_repeat('0',$maxLen-$lengthA).$a;
    $b = str_repeat('0',$maxLen-$lengthB).$b;

    $result = '';
    /* перенос */
    $carry = 0;
    for ($i = $maxLen-1; $i >= 0; $i--) {

        /* Работаем с разрядами в обратном порядке */
        $itemA = substr($a,$i ,1);
        $itemB = substr($b,$i,1);

        $itemSum = $itemA + $itemB + $carry;

        /* Сохраняем перенос */
        $carry = 0;
        if ($itemSum >= 10) {
            $carry = 1;
            $itemSum -= 10;
        }

        $result = $itemSum.$result;
    }

    /* Выводим с удалением ведущих нулей */
    return ltrim($carry.$result,'0');
}