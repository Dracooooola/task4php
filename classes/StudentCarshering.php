<?php
require_once 'Carshering.php';
require_once  'Gps.php';

class StudentCarshering extends Carshering
{
    private $price_km = 4;
    private $price_time = 1;
    private $maxAge = 25;

    use Gps;

    private function checkMaxAge($age)
    {
        if($age > $this->maxAge){
            echo 'Вы слишком стары для этого тарифа, подберите другой';
            die;
        } else {
            return $this->checkAge($age);
        }
    }

    public function priceСalculation($age, $kilometers, $time, bool $gps, bool $driver){
        $priceServices = $this->priceGps($time, $gps);
        if($driver){
            echo 'На этом тарифе водитель не предусмотрен<br>';
        }
        return (($kilometers*$this->price_km) + ($time*$this->price_time) + $priceServices)*$this->checkMaxAge($age);
    }
}
