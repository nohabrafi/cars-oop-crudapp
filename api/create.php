<?php

include_once '../classes/Database.php';
include_once '../classes/Car.php';

$database = new Database();
$conn = $database->connect();
$car = new Car($conn);

// set properties of car object
$car->make = $_POST["make"];
$car->model = $_POST["model"];
$car->type = $_POST["type"];
$car->year = $_POST["year"];

// call create 
if ($car->create()) {
    echo json_encode(
        array('message' => 'created succesfully')
    );
} else {
    echo json_encode(
        array('message' => 'something went wrong')
    );
};