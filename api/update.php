<?php

include_once '../classes/Database.php';
include_once '../classes/Car.php';

$database = new Database();
$conn = $database->connect();
$car = new Car($conn);
// search for given id in DB
$result = $car->search($_POST["car_id"]);

// if id not found -> error message and die
if($result->rowCount() > 0){
    $carOld = $result->fetchAll();
} else{
    echo json_encode(
        array('message' => 'id not found')
    );
    die();
}

// set properties of car object, depending on what has been submitted
if ($_POST["make"] === "") {
    $car->make = $carOld[0]["make"];
} else {
    $car->make = $_POST["make"];
}

if ($_POST["model"] === "") {
    $car->model = $carOld[0]["model"];
} else {
    $car->model = $_POST["model"];
}

if ($_POST["type"] === "") {
    $car->type = $carOld[0]["type"];
} else {
    $car->type = $_POST["type"];
}

if ($_POST["year"] === "") {
    $car->year = $carOld[0]["year"];
} else {
    $car->year = $_POST["year"];
}

// call update 
if ($car->update($_POST["car_id"])) {
    echo json_encode(
        array('message' => 'updated succesfully')
    );
} else {
    echo json_encode(
        array('message' => 'something went wrong')
    );
};
