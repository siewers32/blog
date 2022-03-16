<?php

class Container {
    private array $objects;

    public function __construct() {
        $this->objects = [];
    }

    public function set(string $key, object $obj) {
        $this->objects[$key] = $obj;
    }

    public function get($key) {
        return $this->objects[$key];
    }
}