<?php

class Container {
    private array $objects;

    public function __construct() {
        $this->objects = [];
    }

    public function add(string $key, object $obj) {
        $this->objects[$key] = $obj;
    }

    public function getObject($key) {
        return $this->objects[$key];
    }
}