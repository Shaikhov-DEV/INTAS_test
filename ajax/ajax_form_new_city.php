<?php
// Формируем массив для JSON`а
require_once '../BaseModel.php'; 
if (isset($_POST["new_city"]) && isset($_POST["travel_time"])) {
    $result = ['message' => '','new_city' => $_POST["new_city"], 'travel_time' => $_POST["travel_time"]];
    if (is_numeric($result['new_city'])) {
    	$result['message'] = 'Ой, это число! Введите: Название';
    	echo json_encode($result);
    }elseif(empty($result['new_city']) || empty($result['travel_time'])){
        $result['message'] = 'Ой, кое-что не заполнили! Введите:  Название и длительность поездки';
        echo json_encode($result);
    }else{
        $db = new BaseModel();
        $flag = BaseModel::new_city($result['new_city'], $result['travel_time']);
        $result = ['message' => 'Успех!'];
        echo json_encode($result);
    }
}