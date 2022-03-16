<?php

include_once '../classes/Database.php';
include_once '../classes/Car.php';

$database = new Database();
$conn = $database->connect();
$car = new Car($conn);

// call delete 
if ($car->delete($_POST["car_id"])) {
    echo json_encode(
        array('message' => 'deleted succesfully')
    );
} else {
    echo json_encode(
        array('message' => 'something went wrong')
    );
};