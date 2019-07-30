<?php
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