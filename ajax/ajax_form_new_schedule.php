<?php
require_once '../BaseModel.php';

// Проверка излишня, так как пользователю уже на форме предоставляются лишь свободные курьеры в выбранную дату

$db = new BaseModel();
$courier = BaseModel::get_courier_id($_POST["courier"]);
$city = BaseModel::get_city_id($_POST["city"]);
$flag = BaseModel::new_schedule($city, $courier, $_POST["date_departure"], $_POST["date_arrival"]); //
$result = array(
    'message' => 'Запись успешно внесена в БД',
    'city' => $courier,
    'courier' => $_POST["courier"],
    'date_departure' => $_POST["date_departure"],
    'date_arrival' => $_POST["date_arrival"],
    'flag' => $flag
);
echo json_encode($result);




