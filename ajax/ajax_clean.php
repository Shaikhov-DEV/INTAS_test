<?php
require_once '../BaseModel.php';
$db = new BaseModel();
$clean = BaseModel::clean();
echo json_encode($clean);
