<?php
require_once '../BaseModel.php';
$db = new BaseModel();
$result['arrival'] = BaseModel::calc_date_arrival($_POST["city"]);
echo json_encode($result);
