<?php

include_once '../classes/Database.php';
include_once '../classes/Car.php';

if (isset($_GET["search_word"])) {

    $database = new Database();
    $conn = $database->connect();
    $car = new Car($conn);

    $result = $car->search($_GET["search_word"]);
    $num = $result->rowCount();
    if ($num > 0) {
        $cars = $result->fetchAll(); // fetch()/fetchAll() do return an array of objects
        echo json_encode($cars, JSON_PRETTY_PRINT);
    } else {
        echo "0"; // no data found with given search word
    }

} else {
    die(); // no searchword given
}
