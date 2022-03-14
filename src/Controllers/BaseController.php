<?php

abstract class BaseController {
    protected Container $c;

    public function __construct(Container $c) {
        $this->c = $c;
    }
}