<?php

function Potega(int $podstawa, int $wykladnik) {
    $obliczenia = $podstawa;
    if($wykladnik==0) {
        return 1;
    }
    for($od = 0;$od != $wykladnik-1;$od++) {
        $obliczenia = $obliczenia * $podstawa;
    }

    return $obliczenia;
}

echo Potega(3, 2).PHP_EOL;
echo Potega(3, 3).PHP_EOL;
echo Potega(2, 2).PHP_EOL;
echo Potega(2, 3).PHP_EOL;
echo Potega(2, 4).PHP_EOL;
echo Potega(2, 10).PHP_EOL;
echo Potega(2, 9).PHP_EOL;
echo Potega(2, 1).PHP_EOL;
echo Potega(2, 0).PHP_EOL;
/*echo Potega(-2, -5).PHP_EOL;*/
echo pow(-2,-5);
