<?php
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