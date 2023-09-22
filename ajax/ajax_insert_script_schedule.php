<?php
require_once '../BaseModel.php';
$db = new BaseModel();
$clean = BaseModel::clean();
$a_i_default = BaseModel::a_i();
$db_city = BaseModel::get_count_city();
$today = date('Y-m-d', strtotime('yesterday'));
$sql = "INSERT INTO schedule VALUES ";
for($i=1; $i<=90; $i++) {
    $today = strtotime("+1 days",strtotime('yesterday'));
    $date_d= date('Y-m-d', $today);
    $date_a=date('Y-m-d', $today);
    $db_ci=$db_city;
    $count_del_of_day=rand(1, 3);
    for ($j=1; $j<=$count_del_of_day; $j++) {
        $city_key=array_rand($db_ci);
        $city=$db_ci[$city_key];
        $plus_day=2*$city["city_travel_time"];
        $date_a=strtotime("+".$plus_day." days",strtotime($date_a));
        $date_a= date('Y-m-d', $date_a);
        $db_courier = BaseModel::get_courier_script($date_d, $date_a);
        $courier_key=array_rand($db_courier);
        $courier=$db_courier[$courier_key];
        $sql.="(NULL, '".$city["city_id"]."', '".$courier["courier_id"]."', '".$date_d."', '".$date_a."'), ";
        unset($db_ci[$city_key]);
    }
}
$sql=rtrim($sql, ', ');
$result = BaseModel::insert_schedule($sql);
echo json_encode($result);
