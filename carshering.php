<?php
// НЕ уверен как было лучше распихать каждый класс в отдельный документ или все одним сделать, но решил оставить одним, мне кажется так легче будет проверять)))
interface iCarshering
{
    public function priceСalculation($age, $kilometers, $time, bool $gps, bool $driver);
//    Время задается в минутах
}

abstract class Carshering implements iCarshering
{
    protected function checkAge($age){
        if($age < 18 || $age > 65){
            echo 'Возраст не подходит';
            die;
        } elseif ($age >= 18 && $age <= 21) {
            return 1.1;
        } else {
            return 1;
        }
    }
    abstract public function priceСalculation($age, $kilometers, $time, bool $gps, bool $driver);
}

trait Gps
{
    private $priceForGps = 15;
    protected function priceGps($time, $check){
        if($check){
            $hour = ceil($time/60);
            return $this->priceForGps*$hour;
        } else {
            return 0;
        }
    }
}

trait Driver
{
    private $priceForDriver = 100;
    protected function priceDriver($check){
        if($check) {
            return $this->priceForDriver;
        } else {
            return 0;
        }
    }
}

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
