<?php

class Database
{
    private $host = '127.0.0.1';
    private $db   = 'cars_oop_crud';
    private $user = 'root';
    private $pass = '';

    private $dsn;
    private $options;
    private $pdo;

    public function connect()
    {
        $this->dsn = "mysql:host=$this->host;dbname=$this->db;";
        $this->options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {

            $this->pdo = new PDO($this->dsn,  $this->user,  $this->pass,  $this->options);
        } catch (\PDOException $e) {

            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        return $this->pdo;
    }
}
