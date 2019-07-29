<?php
require_once 'carshering.php';

$classInstance = new StandartCarshering();
$result = $classInstance->priceСalculation(26, 100, 40, true, false);

echo "Стандартный тариф: $result <br><br>";

$classInstance = new HourlyCarshering();
$result = $classInstance->priceСalculation(20, 10, 100, true, true);
echo "Почасовой тариф: $result <br><br>";

$classInstance = new DailyCarshering();
$result = $classInstance->priceСalculation(23, 100, 14468, false, false);
echo "Суточный тариф: $result <br><br>";

$classInstance = new StudentCarshering();
$result = $classInstance->priceСalculation(23, 100, 100, true, true);
echo "Студентчесткий тариф: $result <br><br>";