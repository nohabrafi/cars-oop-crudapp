<?php

include_once '../classes/Database.php';
include_once '../classes/Car.php';

$database = new Database();
$conn = $database->connect();
$car = new Car($conn);

// read all from DB
$result = $car->read_all();

if($result->rowCount() > 0){
    $cars = $result->fetchAll(); // fetch()/fetchAll() do return an array of objects
} else {
    die();
}

echo json_encode($cars, JSON_PRETTY_PRINT);