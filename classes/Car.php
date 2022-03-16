<?php

class Car
{
    // DB
    private $conn;

    // properties

    public $car_id;
    public $make;
    public $model;
    public $type;
    public $year;

    //constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read_all()
    {

        $sql = "SELECT * FROM car_data";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt;
    }

    public function search($searchWord)
    {
        $sql = "SELECT * FROM car_data WHERE car_id LIKE ? OR make LIKE ? OR model LIKE ? OR type LIKE ? OR year LIKE ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$searchWord, $searchWord, $searchWord, $searchWord, $searchWord]);

        return $stmt;
    }

    public function create()
    {
        $sql = "INSERT INTO car_data (make, model, type, year) VALUES (:make, :model, :type, :year)";
        $stmt = $this->conn->prepare($sql);

        // clean data
        $this->make = htmlspecialchars(strip_tags($this->make));
        $this->model = htmlspecialchars(strip_tags($this->model));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->year = htmlspecialchars(strip_tags($this->year));

        if ($stmt->execute(["make" => $this->make, "model" => $this->model, "type" => $this->type, "year" => $this->year])) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function update($car_id)
    {
        $sql = "UPDATE car_data SET make = :make, model = :model, type = :type, year = :year WHERE car_id = :car_id";
        $stmt = $this->conn->prepare($sql);

        // clean data
        $this->make = htmlspecialchars(strip_tags($this->make));
        $this->model = htmlspecialchars(strip_tags($this->model));
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->year = htmlspecialchars(strip_tags($this->year));

        // Bind data
        $stmt->bindParam(':make', $this->make);
        $stmt->bindParam(':model', $this->model);
        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':year', $this->year);
        $stmt->bindParam(':car_id', $car_id);

        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function delete($car_id)
    {

        // Create query
        $sql = "DELETE FROM car_data WHERE car_id = :car_id";

        // Prepare statement
        $stmt = $this->conn->prepare($sql);

        // Bind data
        $stmt->bindParam(':car_id', $car_id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }

        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
