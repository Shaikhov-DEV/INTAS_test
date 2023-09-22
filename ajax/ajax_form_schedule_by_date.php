<?php
require_once'../BaseModel.php';
// нужна проверка на пустой ввод
$from=$_POST["from_date"];
$to=$_POST["to_date"];
if ($_POST["from_date"] > $_POST["to_date"]) {
    $from=$_POST["to_date"];
    $to=$_POST["from_date"];
}
    $db = new BaseModel();
    $result = BaseModel::get_schedule_by_date($from, $to);
    echo json_encode($result);
