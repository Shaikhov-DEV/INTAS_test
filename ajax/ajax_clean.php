<?php
    require_once '../BaseModel.php';
    $db = new BaseModel();
    $clean = BaseModel::clean();
    if ($clean == TRUE) {
        $result = ['message' => 'БД успешно очищена!'];
    } else {
        $result = ['message' => 'Ой, не удалось очистить БД!'];
    }
    echo json_encode($result);