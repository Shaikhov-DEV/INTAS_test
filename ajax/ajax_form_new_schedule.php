<?php
    require_once '../BaseModel.php';
    $db = new BaseModel();
    $courier = BaseModel::get_courier_id($_POST["courier"]);
    $city = BaseModel::get_city_id($_POST["city"]);
    $flag = BaseModel::new_schedule($city, $courier, $_POST["date_departure"], $_POST["date_arrival"]); //
    if ($flag == TRUE) {
        $result = array(
            'message' => 'Запись успешно внесена в БД',
            'city' => $courier,
            'courier' => $_POST["courier"],
            'date_departure' => $_POST["date_departure"],
            'date_arrival' => $_POST["date_arrival"],
            'flag' => true
        );
    } else {
        $result = ['message' => 'Ой, не удалось внести запись в БД!', 'flag' => false];
    }
    echo json_encode($result);





