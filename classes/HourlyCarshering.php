<?php
require_once 'Carshering.php';
require_once 'Gps.php';
require_once 'Driver.php';

class HourlyCarshering extends Carshering
{
    private $price_time = 200;

    use Gps;
    use Driver;

    public function priceСalculation($age, $kilometers, $time, bool $gps, bool $driver){
        $priceServices = $this->priceGps($time, $gps) + $this->priceDriver($driver);
        return ((ceil($time/60)*$this->price_time) + $priceServices)*$this->checkAge($age);
    }
}
