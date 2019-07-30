<?php
require_once 'Carshering.php';
require_once 'Gps.php';

class StandartCarshering extends Carshering
{
    private $price_km = 10;
    private $price_time = 3;

    use Gps;

    public function priceСalculation($age, $kilometers, $time, bool $gps, bool $driver){
        $priceServices = $this->priceGps($time, $gps);
        if($driver){
            echo 'На этом тарифе водитель не предусмотрен<br>';
        }
        return (($kilometers*$this->price_km) + ($time*$this->price_time) + $priceServices)*$this->checkAge($age);
    }
}
