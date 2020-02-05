<?php

function stanKonta(Bankomat $bankomat) {
    try {
        echo "Twój stan konta: ".$bankomat->PokazPieniadze()." zł" . PHP_EOL;
    } catch (\Exception $e) {
        echo "Nie można wykonać takiej operacji!" . PHP_EOL;
    }
}

class KasetkaPieniedzy {

    protected $nominal;

    protected $ilosc;

    public function __construct($nominal, $ilosc)
    {
        $this->nominal = $nominal;
        $this->ilosc = $ilosc;
    }

    public function pobierzPieniadze($ile) {
        if (!$this->czyMoznaPobrac($ile)) {
            return;
        }
        $this->ilosc -= $ile;
    }

    public function czyMoznaPobrac($ile) {
        return $ile <= $this->ilosc;
    }

    public function nominal() {
        return $this->nominal;
    }

    public function ilosc() {
        return $this->ilosc;
    }

}

class Bankomat {

    /** @var KasetkaPieniedzy[]  */
    private $pieniadze;

    function __construct()
    {
        $this->pieniadze =[
            new KasetkaPieniedzy(50,50),
            new KasetkaPieniedzy(10,100),
            new KasetkaPieniedzy(20,50),
            new KasetkaPieniedzy(200,50),
            new KasetkaPieniedzy(10,50),
            new KasetkaPieniedzy(100,50),
        ];
    }

    public function Wypłać(int $ilosc)
    {

        if ($ilosc > $this->pieniadze) {
            return;
        }
        if ($ilosc % 10 != 0) {
            return;
        }
        $nominalminimalny = 0;
        $nominalmaksymalny = 0;
        $nominaltymczasowy = 0;

        foreach ($this->pieniadze as $item) {
            if ($nominalmaksymalny == 0) {
                $nominalmaksymalny = $item->nominal();
            } else {
                $nominaltymczasowy = $item->nominal();
            }
            if ($nominaltymczasowy == 0) {
                continue;
            }
            if ($nominalmaksymalny > $nominaltymczasowy && ($nominaltymczasowy < $nominalminimalny || $nominalminimalny == 0)) {
                $nominalminimalny = $nominaltymczasowy;
            } elseif ($nominaltymczasowy > $nominalmaksymalny && ($nominalmaksymalny > $nominalminimalny && $nominalminimalny != 0)) {
                $nominalmaksymalny = $nominaltymczasowy;
            } elseif ($nominaltymczasowy > $nominalmaksymalny && ($nominalmaksymalny < $nominalminimalny || $nominalminimalny == 0)) {
                $swap = 0;
                $swap2 = 0;
                $swap = $nominalmaksymalny;
                $nominalmaksymalny = $nominaltymczasowy;
                $nominalminimalny = $swap;
            }
        }

        $pozostalo = $ilosc % $nominalmaksymalny;
        $ilebanknotow = ($ilosc - $pozostalo) / $nominalmaksymalny;
        $ilosc = $pozostalo;
        $i = 0;
        var_dump($this->pieniadze[$i]->nominal());
        echo "Nominal Obecny".PHP_EOL;
        var_dump($nominalmaksymalny);
        echo "Nominal Maksymalny".PHP_EOL;
        var_dump($this->pieniadze[$i]->nominal() == $nominalmaksymalny);
        echo "czy nominal jest rowny maksylany ".PHP_EOL;

        for (; $this->pieniadze[$i]->nominal() != $nominalmaksymalny; $i++) {
            var_dump('jesdtem w petli');
        }
        var_dump($this->pieniadze[$i]->nominal());
        echo "Nominal Obecny PO".PHP_EOL;
        var_dump($nominalmaksymalny);
        echo "Nominal Maksymalny PO".PHP_EOL;
        var_dump($this->pieniadze[$i]->nominal() == $nominalmaksymalny);
        echo "czy nominal jest rowny maksylany PO ".PHP_EOL;

        $this->pieniadze[$i]->pobierzPieniadze($ilebanknotow);
        var_dump($this->pieniadze[$i]->ilosc());
        echo "Ilosc kasetki ^^^".PHP_EOL;
        var_dump($i);
        echo "I ^^^".PHP_EOL;
        $nominaldotychczasowy = $nominalmaksymalny;
        if ($ilosc == 0) {
            return;
        }
        var_dump($nominalmaksymalny);
        var_dump($nominalminimalny);
        var_dump($nominaltymczasowy);
        var_dump($ilosc);
        ///
        ///
        ///
        ///
        ///
        $nominalmaksymalny = 0;
        $nominaltymczasowy = 0;
        $nominalminimalny = 0;

        foreach ($this->pieniadze as $item) {
            if ($item->nominal() == $nominaldotychczasowy) {
                continue;
            }
            if ($nominalmaksymalny == 0) {
                $nominalmaksymalny = $item->nominal();
            } else {
                $nominaltymczasowy = $item->nominal();
            }
            if ($nominaltymczasowy == 0) {
                continue;
            }
            if ($nominalmaksymalny > $nominaltymczasowy && ($nominaltymczasowy < $nominalminimalny || $nominalminimalny == 0)) {
                $nominalminimalny = $nominaltymczasowy;
            } elseif ($nominaltymczasowy > $nominalmaksymalny && ($nominalmaksymalny > $nominalminimalny && $nominalminimalny != 0)) {
                $nominalmaksymalny = $nominaltymczasowy;
            } elseif ($nominaltymczasowy > $nominalmaksymalny && ($nominalmaksymalny < $nominalminimalny || $nominalminimalny == 0)) {
                $swap = 0;
                $swap2 = 0;
                $swap = $nominalmaksymalny;
                $nominalmaksymalny = $nominaltymczasowy;
                $nominalminimalny = $swap;
            }
        }
        $pozostalo = $ilosc % $nominalmaksymalny;
        $ilebanknotow = ($ilosc - $pozostalo) / $nominalmaksymalny;
        $ilosc = $pozostalo;
        $i = 0;
        for (; $this->pieniadze[$i]->nominal() != $nominalmaksymalny; $i++) {
        }
        $this->pieniadze[$i]->pobierzPieniadze($ilebanknotow);
        $nominaldotychczasowy2 = $nominalmaksymalny;
        var_dump($this->pieniadze[$i]->ilosc());

        echo "Ilosc kasetki nr 2 ^^^".PHP_EOL;
        var_dump($i);
        echo "I ^^^".PHP_EOL;
        var_dump($pozostalo);
        var_dump($ilebanknotow);
        if ($ilosc == 0) {
            return;
        }
        var_dump($nominalmaksymalny);
        var_dump($nominalminimalny);
        var_dump($nominaltymczasowy);
        var_dump($ilosc);
        ///
        ///
        ///
        ///
        ///
        foreach ($this->pieniadze as $item) {
            if ($item->nominal() == $nominaldotychczasowy || $item->nominal() == $nominaldotychczasowy2) {
                continue;
            }
            if ($nominalmaksymalny == 0) {
                $nominalmaksymalny = $item->nominal();
            } else {
                $nominaltymczasowy = $item->nominal();
            }
            if ($nominaltymczasowy == 0) {
                continue;
            }
            if ($nominalmaksymalny > $nominaltymczasowy && ($nominaltymczasowy < $nominalminimalny || $nominalminimalny == 0)) {
                $nominalminimalny = $nominaltymczasowy;
            } elseif ($nominaltymczasowy > $nominalmaksymalny && ($nominalmaksymalny > $nominalminimalny && $nominalminimalny != 0)) {
                $nominalmaksymalny = $nominaltymczasowy;
            } elseif ($nominaltymczasowy > $nominalmaksymalny && ($nominalmaksymalny < $nominalminimalny || $nominalminimalny == 0)) {
                $swap = 0;
                $swap2 = 0;
                $swap = $nominalmaksymalny;
                $nominalmaksymalny = $nominaltymczasowy;
                $nominalminimalny = $swap;
            }
        }
        $pozostalo = $ilosc % $nominalmaksymalny;
        $ilebanknotow = ($ilosc - $pozostalo) / $nominalmaksymalny;
        $ilosc = $pozostalo;
        $i = 0;
        for (; $this->pieniadze[$i]->nominal() != $nominalmaksymalny; $i++) {
        }
        $this->pieniadze[$i]->pobierzPieniadze($ilebanknotow);
        $nominaldotychczasowy3 = $nominalmaksymalny;
        if ($ilosc == 0) {
            return;
        }
        var_dump($nominalmaksymalny);
        var_dump($nominalminimalny);
        var_dump($nominaltymczasowy);
        var_dump($ilosc);
        ///
        ///
        ///
        ///
        ///
        ///
        foreach ($this->pieniadze as $item) {
            if ($item->nominal() == $nominaldotychczasowy || $item->nominal() == $nominaldotychczasowy2 || $item->nominal() == $nominaldotychczasowy3) {
                continue;
            }
            if ($nominalmaksymalny == 0) {
                $nominalmaksymalny = $item->nominal();
            } else {
                $nominaltymczasowy = $item->nominal();
            }
            if ($nominaltymczasowy == 0) {
                continue;
            }
            if ($nominalmaksymalny > $nominaltymczasowy && ($nominaltymczasowy < $nominalminimalny || $nominalminimalny == 0)) {
                $nominalminimalny = $nominaltymczasowy;
            } elseif ($nominaltymczasowy > $nominalmaksymalny && ($nominalmaksymalny > $nominalminimalny && $nominalminimalny != 0)) {
                $nominalmaksymalny = $nominaltymczasowy;
            } elseif ($nominaltymczasowy > $nominalmaksymalny && ($nominalmaksymalny < $nominalminimalny || $nominalminimalny == 0)) {
                $swap = 0;
                $swap2 = 0;
                $swap = $nominalmaksymalny;
                $nominalmaksymalny = $nominaltymczasowy;
                $nominalminimalny = $swap;
            }
        }
        $pozostalo = $ilosc % $nominalmaksymalny;
        $ilebanknotow = ($ilosc - $pozostalo) / $nominalmaksymalny;
        $ilosc = $pozostalo;
        $i = 0;
        for (; $this->pieniadze[$i]->nominal() != $nominalmaksymalny; $i++) {
        }
        $this->pieniadze[$i]->pobierzPieniadze($ilebanknotow);
        $nominaldotychczasowy4 = $nominalmaksymalny;
        if ($ilosc == 0) {
            return;
        }
        var_dump($nominalmaksymalny);
        var_dump($nominalminimalny);
        var_dump($nominaltymczasowy);
        var_dump($ilosc);
        ///
        ///
        ///
        ///
        ///
        foreach ($this->pieniadze as $item) {
            if ($item->nominal() == $nominaldotychczasowy || $item->nominal() == $nominaldotychczasowy2 || $item->nominal() == $nominaldotychczasowy3 || $item->nominal() == $nominaldotychczasowy4) {
                continue;
            }
            if ($nominalmaksymalny == 0) {

                $nominalmaksymalny = $item->nominal();
            } else {
                $nominaltymczasowy = $item->nominal();
            }
            if ($nominaltymczasowy == 0) {
                continue;
            }
            if ($nominalmaksymalny > $nominaltymczasowy && ($nominaltymczasowy < $nominalminimalny || $nominalminimalny == 0)) {
                $nominalminimalny = $nominaltymczasowy;
            } elseif ($nominaltymczasowy > $nominalmaksymalny && ($nominalmaksymalny > $nominalminimalny && $nominalminimalny != 0)) {
                $nominalmaksymalny = $nominaltymczasowy;
            } elseif ($nominaltymczasowy > $nominalmaksymalny && ($nominalmaksymalny < $nominalminimalny || $nominalminimalny == 0)) {
                $swap = 0;
                $swap2 = 0;
                $swap = $nominalmaksymalny;
                $nominalmaksymalny = $nominaltymczasowy;
                $nominalminimalny = $swap;
            }
        }

        $pozostalo = $ilosc % $nominalmaksymalny;
        $ilebanknotow = ($ilosc - $pozostalo) / $nominalmaksymalny;
        $ilosc = $pozostalo;
        $i = 0;
        for (; $this->pieniadze[$i]->nominal() != $nominalmaksymalny; $i++) {
        }
        $this->pieniadze[$i]->pobierzPieniadze($ilebanknotow);
        $nominaldotychczasowy = $nominalmaksymalny;
        if ($ilosc == 0) {
            return;
        }
        var_dump($nominalmaksymalny);
        var_dump($nominalminimalny);
        var_dump($nominaltymczasowy);
        var_dump($ilosc);
        ///
        ///
        ///
        ///
        ///

    }

    public function PokazPieniadze() {
        $suma = 0;
        foreach ($this->pieniadze as $item) {
            $suma += $item->ilosc() * $item->nominal();
        }
        return $suma;
    }

}

// Uwierzytelnienie
// Wprowadź kwotę
// Dziękujemy
$bankomat = new Bankomat();
stanKonta($bankomat);
$bankomat->Wypłać(500);
stanKonta($bankomat);
/*$bankomat->Wypłać(100000);
stanKonta($bankomat);
$bankomat->Wypłać(5.35);
stanKonta($bankomat);
for ($i = 0; $i < 955; $i++) {
    $bankomat->Wypłać(10);
}
stanKonta($bankomat);
*/
