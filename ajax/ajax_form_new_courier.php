<?php
// Формируем массив для JSON`а
require_once '../BaseModel.php'; 
if (isset($_POST["lastname"]) && isset($_POST["firstname"]) && isset($_POST["patronymic"])) { 
    $result = ['message' => '','lastname' => $_POST["lastname"], 'firstname' => $_POST["firstname"], 'patronymic' => $_POST["patronymic"] ];
    if (is_numeric($result['lastname']) || is_numeric($result['firstname']) || is_numeric($result['patronymic'])) {
    	$result['message'] = 'Ой, это число! Введите: Имя Фамилия Отчество';
    	echo json_encode($result);
    }elseif(empty($result['lastname']) || empty($result['firstname']) || empty($result['patronymic'])){
        $result['message'] = 'Ой, кое-что не заполнили! Введите:  Фамилия Имя Отчество';
        echo json_encode($result);
    }else{
        $db = new BaseModel();
        $flag = BaseModel::new_courier($result['lastname'], $result['firstname'], $result['patronymic']);
        $result = ['message' => 'Успех!','lastname' => $_POST['lastname'], 'firstname' => $_POST['firstname'], 'patronymic' =>$_POST['patronymic']];
        echo json_encode($result);
    }
}