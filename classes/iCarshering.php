<?php
interface iCarshering
{
    public function priceСalculation($age, $kilometers, $time, bool $gps, bool $driver);
//    Время задается в минутах
}