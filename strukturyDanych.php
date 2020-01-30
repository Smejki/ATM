<?php

class Owoc
{
    private $waga;

    private $nazwa;

    public function __construct(string $nazwa, int $waga)
    {
        $this->nazwa = $nazwa;
        $this->waga = $waga;
    }

    /**
     * @return int
     */
    public function getWaga(): int
    {
        return $this->waga;
    }

    /**
     * @return string
     */
    public function getNazwa(): string
    {
        return $this->nazwa;
    }
}

class KoszykOwocow
{
    /** @var Owoc[] */
    private $owoce;

    public function __construct()
    {
        $this->owoce = [];
    }

    public function DodajOwoc(Owoc $owoc) {
        $this->owoce[] = $owoc;
    }

    public function PoliczOwoce() {
        return count($this->owoce);
    }

    public function WyciagnijOwoc($nazwa) {
        foreach ($this->owoce as $key => $item) {
            if($item->getNazwa() == $nazwa) {
              unset($this->owoce[$key]);
              return;
            }
        }
    }

    public function PokazOwoce() {
        return $this->owoce;
    }
    public function SprawdzWage() {
        $y = 0;
        foreach ($this->owoce as $item) {
            $y += $item->getWaga();
        }
        return $y;
    }

}

$koszykOwocow = new KoszykOwocow();
echo($koszykOwocow->SprawdzWage()."g").PHP_EOL;

$koszykOwocow->DodajOwoc(new Owoc("jablko", 300));
$koszykOwocow->DodajOwoc(new Owoc("pomarancza", 200));
$koszykOwocow->DodajOwoc(new Owoc("banan", 250));
$koszykOwocow->DodajOwoc(new Owoc("banan", 225));
$koszykOwocow->DodajOwoc(new Owoc("jablko", 350));
$koszykOwocow->DodajOwoc(new Owoc("jablko", 275));
echo($koszykOwocow->PoliczOwoce()).PHP_EOL;
echo($koszykOwocow->SprawdzWage()."g").PHP_EOL;

$koszykOwocow->WyciagnijOwoc("jablko");
$koszykOwocow->WyciagnijOwoc("banan");

echo($koszykOwocow->PoliczOwoce()).PHP_EOL;
echo($koszykOwocow->SprawdzWage()."g").PHP_EOL;

foreach ($koszykOwocow->PokazOwoce() as $item) {
    echo($item->getNazwa()).PHP_EOL;
}

