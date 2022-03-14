<?php

class Db {
    private $connection;

    public function __construct($dsn, $username, $password) {
        $this->connection = new PDO($dsn, $username, $password);
    }

    public function getConnection() {
        return $this->connection;
    }
}
