<?php
    require_once '../BaseModel.php';
    $from = $_POST["from_date"];
    $to = $_POST["to_date"];
    function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    if (isset($from) && isset($to)) {
        if (empty($from) || empty($to)) {
            $result = ['message' => 'Дата введена неверно', 'flag' => false];
        } elseif (validateDate($from, 'Y-m-d') || validateDate($to, 'Y-m-d')) {
            $db = new BaseModel();
            $result = BaseModel::get_schedule_by_date($from, $to);
            if (empty($result)) {
                $result = ['message' => 'Записей удовлетворяюших диапазону - нет', 'flag' => false];
            }
        }
    }
    echo json_encode($result);
