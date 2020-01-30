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

    public function Wypłać(int $ilosc) {

        if($ilosc > $this->pieniadze) {
            return;
        }
        if($ilosc%10 != 0) {
            return;
        }
        $nominalminimalny = 0;
        $nominalmaksymalny = 0;
        $nominaltymczasowy = 0;

        foreach ($this->pieniadze as $item) {
            if($nominalmaksymalny == 0) {
                $nominalmaksymalny = $item->nominal();
            }
            else {
                $nominaltymczasowy = $item->nominal();
            }
            if($nominaltymczasowy == 0) {
                continue;
            }
            if($nominalmaksymalny > $nominaltymczasowy && ($nominaltymczasowy < $nominalminimalny || $nominalminimalny == 0)) {
                $nominalminimalny = $nominaltymczasowy;
            }
            elseif($nominaltymczasowy > $nominalmaksymalny && ($nominalmaksymalny > $nominalminimalny && $nominalminimalny != 0)) {
                $nominalmaksymalny = $nominaltymczasowy;
            }
            elseif($nominaltymczasowy > $nominalmaksymalny && ($nominalmaksymalny < $nominalminimalny || $nominalminimalny == 0)) {
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
        for(; $this->pieniadze[$i]->nominal() == $nominalmaksymalny; $i++) {}
        $this->pieniadze[$i]->pobierzPieniadze($ilebanknotow);
        



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
$bankomat->Wypłać(100000);
stanKonta($bankomat);
$bankomat->Wypłać(5.35);
stanKonta($bankomat);
for ($i = 0; $i < 955; $i++) {
    $bankomat->Wypłać(10);
}
stanKonta($bankomat);

