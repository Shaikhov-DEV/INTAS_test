<?php
require_once'../BaseModel.php';

    $db = new BaseModel();
    $courier = BaseModel::get_courier($_POST["date_departure"], $_POST["date_arrival"]);
echo json_encode($courier);

