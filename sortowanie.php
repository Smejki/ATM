<?php

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

function bubbleSort(array $dane)
{
    $posortowaneDane = [];
    for ($w = 0; $w <= count($dane) - 2; $w++) {
        for ($i = 0; $i <= count($dane) - 2; $i++) {
            $x = $dane[$i];
            $y = $dane[$i + 1];
            if ($x > $y) {
                $dane[$i] = $y;
                $dane[$i + 1] = $x;
            }
        }
    }
    foreach ($dane as $item) {
        $posortowaneDane[] = $item;
    }

    return $posortowaneDane;
}

function quicksort(array $dane)
{
    $posrtowaneDane = [];
    $ileElementow = count($dane);
    $poczatek = 0;
    $podzialka = -1;
    $y = 1;
    if($ileElementow <= 2) {
        return $dane;
    }

    for($i = 0; $i<=$ileElementow-1; $i++) {

        $j = $ileElementow - $y;
        $k = 0;
        if($dane[$k] > $dane[$j]) {
            $x = $dane[$k];
            $dane[$k] = $dane[$j];
            $dane[$j] = $x;
            $podzialka = $dane[$j];
            $y++;
        }
        else{
            $j--;
        }

    }

    $nowaTablica = array_slice($dane, 0, $j);
    $posrtowaneDane += quicksort($nowaTablica);

    foreach ($dane as $item) {
        $posortowaneDane[] = $item;
    }
    return $posrtowaneDane;
}

$in = range(2500, 1);

$start = microtime_float();
$res = bubbleSort($in);
echo microtime_float() - $start . PHP_EOL;
echo sort($in) == $res
    ? "dobrze"
    : "źle";
echo PHP_EOL;

$in = range(2500, 1);
$start = microtime_float();
$res = sort($in);
echo microtime_float() - $start . PHP_EOL;

echo sort($in) == $res
    ? "dobrze"
    : "źle";
echo PHP_EOL;

$in = range(2500, 1);
$start = microtime_float();
$res = quicksort($in);
echo microtime_float() - $start . PHP_EOL;

echo sort($in) == $res
    ? "dobrze"
    : "źle";
echo PHP_EOL;
