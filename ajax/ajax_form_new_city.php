<?php
require_once '../BaseModel.php';
$new_city = trim($_POST["new_city"]);
$travel_time = trim($_POST["travel_time"]);
if (isset($new_city) && isset($travel_time)) {
    if (is_numeric($new_city)) {
        $result=['message' => 'Ой, это число! Введите: Название',
            'flag' => false
        ];
    } elseif (empty($new_city) || empty($travel_time)) {
        $result=['message' => 'Ой, кое-что не заполнили! Введите:  Название и длительность поездки',
            'flag' => false
        ];
    } else {
        $db = new BaseModel();
        $flag = BaseModel::new_city($new_city, $travel_time);
        $result = ['message' => 'Успех!',
            'new_city' => $new_city,
            'travel_time' => $travel_time,
        ];
    }
}
echo json_encode($result);