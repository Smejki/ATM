<?php

function silnia(int $wartosc) {
    $obliczenia = 1;
    $obliczenia2 = 1;
    for($od = 0;$od != $wartosc-1;$od++) {
        $obliczenia2 = $obliczenia2 * ($obliczenia+1);
        $obliczenia++;
       // echo $obliczenia2.PHP_EOL;
    }
    return $obliczenia2;
}

echo silnia(5).PHP_EOL;
echo silnia(2).PHP_EOL;
echo silnia(10).PHP_EOL;
echo silnia(-5).PHP_EOL;
