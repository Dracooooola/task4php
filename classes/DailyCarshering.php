<?php
require_once 'Carshering.php';
require_once 'Gps.php';
require_once 'Driver.php';

class DailyCarshering extends Carshering
{
    private $price_km = 1;
    private $price_time = 1000;

    use Gps;
    use Driver;

    public function priceСalculation($age, $kilometers, $time, bool $gps, bool $driver){
        $priceServices = $this->priceGps($time, $gps) + $this->priceDriver($driver);
//        Проверяется если количество минут до следующего час меньше 30 и с начала следующих суток не прошло хотя бы часа, то считается оплата без новых суток
        if ($time%60 <= 29 && intdiv($time, 60)%24==0){
            $time = intdiv(intdiv($time, 60), 24);
        } else { //В остальных случаях округление идет в большую сторону
            $time = ceil(ceil($time/60)/24);
        }
        return (($time*$this->price_time) + ($kilometers*$this->price_km) + $priceServices)*$this->checkAge($age);
    }
}