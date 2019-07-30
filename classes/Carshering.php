<?php
require_once 'iCarshering.php';

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