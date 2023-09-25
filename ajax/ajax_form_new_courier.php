<?php
require_once '../BaseModel.php';
$lastname = trim($_POST['lastname']);
$firstname = trim($_POST['firstname']);
$patronymic = trim($_POST['patronymic']);
if (isset($lastname) && isset($_POST["firstname"]) && isset($_POST["patronymic"])) {
    if (empty($lastname) || empty($firstname) || empty($patronymic)) {
        $result = ['message' => 'Ой, кое-что не заполнили! Введите:  Фамилия Имя Отчество',
            'flag' => false
        ];
    } else {
        $db = new BaseModel();
        $flag = BaseModel::new_courier($lastname, $firstname, $patronymic);
        $result = ['message' => 'Успех!',
            'lastname' => $lastname,
            'firstname' => $firstname,
            'patronymic' => $patronymic
        ];
    }
}
echo json_encode($result);


